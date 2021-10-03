<x-layout>
    <x-slot name="title">
        {{$section->title}}
    </x-slot>
    <table id="product">
        <tbody><tr>
            <td class="product_img">
                <img src="{{asset('storage/'. $product->img)}}" alt="{{ $product->title }}" />
            </td>
            <td class="product_desc">
                <p>Название: <span class="title">{{ $product['title'] }}</span></p>
                <p>Год выхода: <span>{{$product['year'] }}</span></p>
                <p>Жанр: <span>{{ $section['title'] }}</span></p>
                <p>Страна-производитель: <span>{{ $product['country'] }}</span></p>
                <p>Режиссёр: <span>{{$product['director'] }}</span></p>
                <p>Продолжительность: <span>{{ $product['play'] }}</span></p>
                <p>В ролях: <span>{{ $product['cast'] }}</span></p>
                <table>
                    <tbody><tr>
                        <td>
                            <p class="price">{{ $product['price'] }}</p>
                        </td>
                        <td>
                            <p>
                                <a class="link_cart" href=""></a>
                            </p>
                        </td>
                    </tr>
                    </tbody></table>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <p class="desc_title">Описание:</p>
                <p class="desc">{{ $product['description'] }}</p>
            </td>
        </tr>
        </tbody>
    </table>
    <div id="others">
        <h3>С этим товаром также заказывают:</h3>
        <table class="products">
            <tbody><tr>
                <?php foreach ($otherProducts as $prod) { ?>
                    @include('intro_product', ['movie' => $prod])
                <?php } ?>
            </tr>
            </tbody></table>
    </div>
</x-layout>
