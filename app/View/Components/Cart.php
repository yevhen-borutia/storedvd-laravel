<?php

namespace App\View\Components;

use App\Models\Discount;
use Illuminate\View\Component;
use App\Models\Movie;

class Cart extends Component
{

    public $count;
    public $sum;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($count = null, $sum = null)
    {
        $cart_items = session('cart',[]);
        $this->sum = 0;
        $this->count = 0;
        $products = Movie::whereIn('id', array_keys($cart_items))->where('active', 1)->select(['price','id'])->get()->toArray();
        $products = array_column($products, 'price', 'id');
        foreach ($cart_items as $item_id => $item_count) {
            if (!empty($products[$item_id])) {
                $this->count += $item_count;
                $this->sum += ($item_count * $products[$item_id]);
            }
        }
        if (!empty($disc = session('discount', ''))) {
            if ($disc = Discount::find($disc)) {
                $this->sum -= ($this->sum * $disc->value);
            }
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.cart');
    }
}
