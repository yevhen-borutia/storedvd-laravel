<x-layout>
    <x-slot name="title">
        {{$section->getTranslatedAttribute('title')}}
    </x-slot>
    <table id="hornav">
        <tbody><tr>
            <td>
                <a href="{{url('/')}}">{{ __("Main") }}</a>
            </td>
            <td>
                <img src="{{asset('storage/images/hornav_arrow.png')}}" alt="">
            </td>
            <td>
                <a href="{{url('/section/'.$section->id)}}">{{$section->getTranslatedAttribute('title')}}</a>
            </td>
            <td>
                <img src="{{asset('storage/images/hornav_arrow.png')}}" alt="">
            </td>
            <td>{{$product->getTranslatedAttribute('title')}}</td>
        </tr>
        </tbody></table>
    <table id="product">
        <tbody><tr>
            <td class="product_img">
                <img src="{{asset('storage/'. $product->img)}}" alt="{{ $product->getTranslatedAttribute('title') }}" />
            </td>
            <td class="product_desc">
                <p>{{ __("Title") }}: <span class="title">{{ $product->getTranslatedAttribute('title') }}</span></p>
                <p>{{ __("Year of release") }}: <span>{{$product['year'] }}</span></p>
                <p>{{__("Genre")}}: <span>{{ $section->getTranslatedAttribute('title') }}</span></p>
                <p>{{ __("Country of release") }}: <span>{{ $product->getTranslatedAttribute('country') }}</span></p>
                <p>{{ __("Director") }}: <span>{{$product->getTranslatedAttribute('director') }}</span></p>
                <p>{{ __("Play") }}: <span>{{ $product['play'] }}</span></p>
                <p>{{__("Cast")}}: <span>{{ $product->getTranslatedAttribute('cast') }}</span></p>
                <table>
                    <tbody><tr>
                        <td>
                            <p class="price">{{ $product['price'] }} {{ __("cad") }}</p>
                        </td>
                        <td>
                            <p>
                                <a class="link_cart" href="{{url("/cart?func=add&id={$product->id}")}}">{{ __("Add to cart") }}</a>
                            </p>
                        </td>
                    </tr>
                    </tbody></table>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <p class="desc_title">{{ __("Description") }}:</p>
                <p class="desc">{{ $product->getTranslatedAttribute('description') }}</p>
            </td>
        </tr>
        </tbody>
    </table>
    <div id="others">
        <h3>{{ __("Also ordered with this product") }}:</h3>
        <table class="products">
            <tbody><tr>
                <?php foreach ($otherProducts as $prod) { ?>
                    @include('intro_product', ['movie' => $prod])
                <?php } ?>
            </tr>
            </tbody></table>
    </div>
</x-layout>
