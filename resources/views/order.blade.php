<x-layout>
    <x-slot name="title">
        {{ __("Checkout")}}
    </x-slot>
    <div id="order">
        <h2>{{ __("Checkout")}}</h2>
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
                    <td class="w120">{{ __("Full name") }}:</td>
                    <td>
                        <input type="text" name="name" value="{{old('name')}}">
                    </td>
                </tr>
                <tr>
                    <td>{{ __("Phone number") }}:</td>
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
                    <td>{{ __("Delivery") }}:</td>
                    <td>
                        <select name="delivery_type" onchange="changeDelivery(this)">
                            <option value="">{{ __("choose, please") }}...</option>
                            @foreach($delivery_types as $delivery_type)
                            <option value="{{$delivery_type->type}}" @if (old('delivery_type') == $delivery_type->type) selected="selected" @endif>{{$delivery_type->getTranslatedAttribute("description")}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                </tbody></table>
            <table>
                <tbody><tr id="address" @if (old('delivery_type') == 'pick') style="display: none" @endif>
                    <td>
                        <p>{{ __("Full address (Country, city, zip code, street, house, apartment)") }}:</p>
                        <textarea name="address" cols="80" rows="6">{{old('address')}}</textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>{{ __("Order note") }}:</p>
                        <textarea name="notice" cols="80" rows="6">{{old('notice')}}</textarea>
                    </td>
                </tr>
                <tr>
                    <td class="button">
                        <input type="hidden" name="func" value="order">
                        <input type="submit" class="fin_check" value="{{ __("Finish checkout") }}" alt="Закончить оформление заказа">
                    </td>
                </tr>
                </tbody></table>
        </form>
    </div>
</x-layout>
