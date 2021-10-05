<x-layout>
    <x-slot name="title">
        Ваш заказ принят
    </x-slot>
    <div id="message">
        <h2>Ваш заказ принят!</h2>
        <p>Дождитесь звонка менеджера для подтверждения заказа.</p>
    </div>
    <div class="center">
        <form name="payment" action="https://www.interkassa.com/lib/payment.php" method="post" enctype="application/x-www-form-urlencoded" accept-charset="cp1251">
            <input type="hidden" name="ik_shop_id" value="35C43966-2026-0BE5-BC9C-09051DC38A50">
            <input type="hidden" name="ik_payment_amount" value="350">
            <input type="hidden" name="ik_payment_id" value="3145">
            <input type="hidden" name="ik_payment_desc" value="Оплата заказа 3145">
            <input type="submit" name="process" value="Оплатить">
        </form>
    </div>
</x-layout>
