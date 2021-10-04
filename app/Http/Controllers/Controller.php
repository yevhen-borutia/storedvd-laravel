<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

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
}
