<x-layout>
    <x-slot name="title">
        Оформление заказа
    </x-slot>
    <div id="order">
        <h2>Оформление заказа</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form name="order" method="post">
            @csrf
            <table>
                <tbody><tr>
                    <td class="w120">ФИО:</td>
                    <td>
                        <input type="text" name="name" value="{{old('name')}}">
                    </td>
                </tr>
                <tr>
                    <td>Телефон:</td>
                    <td>
                        <input type="text" name="phone" value="{{old('phone')}}">
                    </td>
                </tr>
                <tr>
                    <td>E-mail:</td>
                    <td>
                        <input type="text" name="email" value="{{old('email')}}">
                    </td>
                </tr>
                <tr>
                    <td>Доставка:</td>
                    <td>
                        <select name="delivery_type" onchange="changeDelivery(this)">
                            <option value="">выберите, пожалуйста...</option>
                            @foreach($delivery_types as $delivery_type)
                            <option value="{{$delivery_type->type}}" @if (old('delivery_type') == $delivery_type->type) selected="selected" @endif>{{$delivery_type->description}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                </tbody></table>
            <table>
                <tbody><tr id="address" @if (old('delivery_type') == 'pick') style="display: none" @endif>
                    <td>
                        <p>Полный адрес (Страна, город, индекс, улица, дом, квартира):</p>
                        <textarea name="address" cols="80" rows="6">{{old('address')}}</textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>Примечание к заказу:</p>
                        <textarea name="notice" cols="80" rows="6">{{old('notice')}}</textarea>
                    </td>
                </tr>
                <tr>
                    <td class="button">
                        <input type="hidden" name="func" value="order">
                        <input type="image" src="{{asset('storage/images/order_end.png')}}" alt="Закончить оформление заказа" onmouseover="this.src='{{asset('storage/images/order_end_active.png')}}'" onmouseout="this.src='{{asset('storage/images/order_end.png')}}'">
                    </td>
                </tr>
                </tbody></table>
        </form>
    </div>
</x-layout>
