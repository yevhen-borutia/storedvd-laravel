<div class="cart">
    <p class="cart_title">{{ __('Cart') }}</p>
    <p class="blue">{{ __('Current order') }}</p>
    <p>{!! __("In the cart <span>:count</span> of goods<br />for <span>:sum</span> cad.", ['count' => $count, 'sum' => $sum]) !!}</p>
    <a href="{{url('/cart')}}">{{ __("Go to cart") }}</a>
</div>
