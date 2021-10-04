<td>
    <div class="intro_product">
        <p class="img">
            <img src="{{asset('storage/'. $movie->img)}}" alt="{{ $movie->title }}" />
        </p>
        <p class="title">
            <a href="{{url('/product/'.$movie->id)}}">{{ $movie->title }}</a>
        </p>
        <p class="price">{{ $movie->price }} руб.</p>
        <p>
            <a class="link_cart" href="{{url("/cart?func=add&id={$movie->id}")}}"></a>
        </p>
    </div>
</td>
