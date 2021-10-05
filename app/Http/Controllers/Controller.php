<?php

namespace App\Http\Controllers;

use App\Models\DeliveryType;
use App\Models\Discount;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {

        $movies = null;
        $sort = request('sort', null);
        $up = request('up', null);
        if (($sort === 'price' || $sort === 'title') && ($up === '1' || $up === '0')) {
            $movies = Db::select("SELECT * FROM (SELECT * FROM sd_movies WHERE active = 1 ORDER BY id DESC LIMIT 8) t1 ORDER BY t1.$sort " . ($up == 1 ? 'ASC' : 'DESC'));
        } else {
            $movies = Movie::where('active', 1)->orderBy('id', 'desc')->take(8)->get();
        }

        return view('index', [
            'movies' => $movies
        ]);
    }

    public function delivery()
    {
        return view('delivery');
    }

    public function contacts()
    {
        return view('contacts');
    }

    public function section($id)
    {
        $genre = Genre::findOrFail($id);
        $movies = null;
        $sort = request('sort');
        $up = request('up');

        $movies = Movie::where('active', 1)->where('genre_id', $genre->id);

        if (($sort === 'price' || $sort === 'title') && ($up === '1' || $up === '0')) {
            $movies->orderBy($sort, ($up == 1 ? 'asc' : 'desc'));
        }

        return view('section', [
            'movies' => $movies->get(),
            'genre' => $genre
        ]);
    }

    public function product($id)
    {
        $product = Movie::where('active', 1)->findOrFail($id);
        $section = Genre::findOrFail($product->genre_id);
        $otherProducts = Movie::where('genre_id', $product->genre_id)
            ->where('active', 1)
            ->where('id', '!=', $product->id)->inRandomOrder()->limit(4)->get();
        return view('product', [
            'product' => $product,
            'section' => $section,
            'otherProducts' => $otherProducts
        ]);
    }

    public function cart()
    {
        $func = request('func');
        $id = request('id');
        if (($func === 'add' || $func === 'del') && !empty($id)) {
            $movie = Movie::where('active', 1)->findOrFail($id);
            $cart = session('cart', []);
            if ($func === 'add') {
                $cart[$movie->id] = array_key_exists($movie->id, $cart) ? ++$cart[$movie->id] : 1;
            } else {
                unset($cart[$id]);
            }
            session(['cart' => $cart]);
            return back();
        } else {
            $cart = session('cart', []);
            $movies = Movie::whereIn('id', array_keys($cart))->where('active', 1)->get();
            $disc = null;
            if (request()->method() == 'POST' && request()->validate([
                    'countIDs.*' => 'integer|min:1'
                ])) {
                session(['cart' => array_replace($cart, array_map('intval',request('countIDs')))]);
                if (!empty(request('discount')) && $disc = Discount::where('code', request('discount'))->first()) {
                    session(['discount' => $disc->id]);
                }
                else {
                    session(['discount' => '']);
                }
                return redirect()->to('/cart');
            }
            else {
                $disc = session('discount', '');
                if (!empty($disc)) {
                    $disc = Discount::find($disc);
                }
            }
            return view('cart', [
                'movies' => $movies,
                'cart' => $cart,
                'disc_code' => $disc->code ?? '',
                'disc_value' => $disc->value ?? 0
            ]);
        }
    }

    public function order() {
        if (request()->method() == 'POST') {
            $val = Validator::make(request()->all(), [
                'name' => 'required',
                'phone' => 'required',
                'email' => 'required|email',
                'delivery_type' => 'required|exists:delivery_types,type',
                'address' => 'required_if:delivery_type,==,deli'
            ]);
            $val->after(function ($validator) {
                if (empty(session('cart'))) {
                    $validator->errors()->add('cart', 'Your cart is empty');
                }
            });
            $val->validate();

            $cart = session('cart',[]);
            $prices = Movie::select(['id', 'price'])->whereIn('id', array_keys($cart))->where('active',1)->get()->keyBy('id')->toArray();
            $discount = session('discount');
            if (empty($discount)) {
                request()->merge([
                    'discount_id' => null,
                    'discount_code' => null,
                    'discount_value' => null
                ]);
            }
            else {
                $discount = Discount::find($discount);
                if (!is_null($discount)) {
                    request()->merge([
                        'discount_id' => $discount->id,
                        'discount_code' => $discount->code,
                        'discount_value' => $discount->value
                    ]);
                }
            }
            DB::beginTransaction();
            try {
                $order = Order::create(request()->all());
                $order_items = [];
                foreach ($cart as $item_id => $item_count) {
                    if (!empty($prices[$item_id])) {
                        $order_items[] = new OrderItem([
                            'order_id' => $order->id,
                            'movie_id' => $item_id,
                            'quantity' => $item_count,
                            'price' => $prices[$item_id]['price']
                        ]);
                    }
                }
                $order->items()->saveMany($order_items);
                DB::commit();
                session(['order_id' => $order->id]);
                return redirect()->to('/addorder/'.$order->id);
            } catch (\Exception $e) {
                DB::rollback();
                throw $e;
            } catch (\Throwable $e) {
                DB::rollback();
                throw $e;
            }
        }
        else {
            $delivery_types = DeliveryType::all();
            return view('order',[
                'delivery_types' => $delivery_types
            ]);
        }
    }

    public function addorder($id) {
        if ($id != session('order_id')) {
            abort(404);
        }
        $order = Order::findOrFail($id);
        return view('addorder', [
            'order' => $order
        ]);
    }
}
