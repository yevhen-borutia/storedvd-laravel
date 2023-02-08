<x-layout>
    <x-slot name="title">
        {{ __('Cart') }}
    </x-slot>
<div id="cart">
    <h2>{{ __('Cart') }}</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <table>
        <tr>
            <td colspan="8" id="cart_top"></td>
        </tr>
        <tr>
            <td class="cart_left"></td>
            <td colspan="2">{{ __("Product") }}</td>
            <td>{{ __("Price for 1 item") }}.</td>
            <td>{{ __("Quantity") }}</td>
            <td>{{ __("Price") }}</td>
            <td></td>
            <td class="cart_right"></td>
        </tr>
        <tr>
            <td class="cart_left"></td>
            <td colspan="6">
                <hr />
            </td>
            <td class="cart_right"></td>
        </tr>
        <form method="post">
            @csrf
        @php
        $sum = 0;
        foreach ($movies as $movie) { @endphp
        <tr class="cart_row">
            <td class="cart_left"></td>
            <td class="img">
                <img src="{{asset('storage/'. $movie->img)}}" alt="{{ $movie->img }}" />
            </td>
            <td class="title">{{ $movie->getTranslatedAttribute('title') }}</td>
            <td>{{ $movie->price }} {{ __("cad") }}.</td>
            <td>
                <table class="count">
                    <tr>
                        <td>
                            <input type="text" value="{{$cart[$movie->id]}}" name="countIDs[{{$movie->id}}]">
                        </td>
                        <td>{{ __("items") }}.</td>
                    </tr>
                </table>
            </td>
            <td class="bold">{{ $cart[$movie->id] * $movie->price }} {{ __("cad") }}.</td>
            <td>
                <a href="{{url("/cart?func=del&id={$movie->id}")}}" class="link_delete">x {{ __("delete") }}</a>
            </td>
            <td class="cart_right"></td>
        </tr>
        <tr>
            <td class="cart_left"></td>
            <td colspan="6" class="cart_border">
                <hr />
            </td>
            <td class="cart_right"></td>
        </tr>
        @php
        $sum += ($cart[$movie->id] * $movie->price);
        }
        @endphp
        <tr id="discount">
            <td class="cart_left"></td>
            <td colspan="6">
                <table>
                    <tr>
                        <td>{!! __("Enter discount coupon number<br /><span>(if available)</span>") !!}</td>
                        <td>
                            <input type="text" value="{{$disc_code}}" name="discount">
                        </td>
                        <td>
                            <input type="submit" class="apply_disc" value="{{ __("Apply discount code") }}" alt="Получить скидку" />
                        </td>
                    </tr>
                </table>
            </td>
            <td class="cart_right"></td>
        </tr>
        <tr id="summa">
            <td class="cart_left"></td>
            <td colspan="6">
                <p>{{ __("Total") }} @if (!empty($disc_code)) ({{ __("with discount") }}): @endif <span>{{ $sum-($sum*$disc_value) }} {{ __("cad") }}.</span></p>
            </td>
            <td class="cart_right"></td>
        </tr>
        <tr>
            <td class="cart_left"></td>
            <td colspan="2">
                <div class="left">
                    <input type="submit" value="{{ __("Recalculate") }}" class="recalc" alt="Пересчитать" />
                </div>
            </td>
            <td colspan="4">
                <div class="right">
                    <input type="hidden" name="func" value="cart" />
                    <a href="{{url('/order')}}" class="checkout">{{ __("Checkout") }}</a>
                </div>
            </td>
            <td class="cart_right"></td>
        </tr>
        <tr>
            <td colspan="8" id="cart_bottom"></td>
        </tr>
    </table>
    </form>
</div>
</x-layout>
