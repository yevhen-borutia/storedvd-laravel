<td>
    <div class="intro_product">
        <p class="img">
            <img src="{{asset('storage/'. $movie->img)}}" alt="{{ $movie->getTranslatedAttribute('title') }}" />
        </p>
        <p class="title">
            <a href="{{url('/product/'.$movie->id)}}">{{ $movie->getTranslatedAttribute('title') }}</a>
        </p>
        <p class="price">{{ $movie->price }} {{ __("cad") }}</p>
        <p>
            <a class="link_cart" href="{{url("/cart?func=add&id={$movie->id}")}}">{{ __("Add to cart") }}</a>
        </p>
    </div>
</td>
