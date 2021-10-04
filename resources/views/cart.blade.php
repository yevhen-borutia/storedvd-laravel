<x-layout>
    <x-slot name="title">
        Корзина
    </x-slot>
<div id="cart">
    <h2>Корзина</h2>
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
            <td colspan="2">Товар</td>
            <td>Цена за 1 шт.</td>
            <td>Количество</td>
            <td>Стоимость</td>
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
            <td class="title">{{ $movie->title }}</td>
            <td>{{ $movie->price }} руб.</td>
            <td>
                <table class="count">
                    <tr>
                        <td>
                            <input type="text" value="{{$cart[$movie->id]}}" name="countIDs[{{$movie->id}}]">
                        </td>
                        <td>шт.</td>
                    </tr>
                </table>
            </td>
            <td class="bold">{{ $cart[$movie->id] * $movie->price }} руб.</td>
            <td>
                <a href="{{url("/cart?func=del&id={$movie->id}")}}" class="link_delete">x удалить</a>
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
                        <td>Введите номер купона со скидкой<br /><span>(если есть)</span></td>
                        <td>
                            <input type="text" value="{{$disc_code}}" name="discount">
                        </td>
                        <td>
                            <input type="image" src="{{asset('storage/images/cart_discount.png')}}" alt="Получить скидку" onmouseover="this.src='{{asset('storage/images/cart_discount_active.png')}}'" onmouseout="this.src='{{asset('storage/images/cart_discount.png')}}'" />
                        </td>
                    </tr>
                </table>
            </td>
            <td class="cart_right"></td>
        </tr>
        <tr id="summa">
            <td class="cart_left"></td>
            <td colspan="6">
                <p>Итого @if (!empty($disc_code)) (с учётом скидки): @endif <span>{{ $sum-($sum*$disc_value) }} руб.</span></p>
            </td>
            <td class="cart_right"></td>
        </tr>
        <tr>
            <td class="cart_left"></td>
            <td colspan="2">
                <div class="left">
                    <input type="image" src="{{asset('storage/images/cart_recalc.png')}}" alt="Пересчитать" onmouseover="this.src='{{asset('storage/images/cart_recalc_active.png')}}'" onmouseout="this.src='{{asset('storage/images/cart_recalc.png')}}'" />
                </div>
            </td>
            <td colspan="4">
                <div class="right">
                    <input type="hidden" name="func" value="cart" />
                    <a href="">
                        <img src="{{asset('storage/images/cart_order.png')}}" alt="Оформить заказ" onmouseover="this.src='{{asset('storage/images/cart_order_active.png')}}'" onmouseout="this.src='{{asset('storage/images/cart_order.png')}}'" />
                    </a>
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
