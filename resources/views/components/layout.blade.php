<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ $title ?? 'Интернет-магазин' }}</title>
    <link href="{{ asset('css/main.css') }}" rel="stylesheet" />
</head>
<body>
<div id="container">
    <div id="header">
        <img src="{{ asset('images/header.png') }}" alt="Шапка" />
        <div>
            <p class="red">8-800-123-45-67</p>
            <p class="blue">Время работы с 09:00 до 21:00<br />без перерыва и выходных</p>
        </div>
        <div class="cart">
            <p class="cart_title">Корзина</p>
            <p class="blue">Текущий заказ</p>
            <p>В корзине <span></span> товаров<br />на сумму <span></span> руб.</p>
            <a href="">Перейти в корзину</a>
        </div>
    </div>
    <div id="topmenu">
        <ul>
            <li>
                <a href="">ГЛАВНАЯ</a>
            </li>
            <li>
                <img src="{{ asset('images/topmenu_border.png') }}" alt="" />
            </li>
            <li>
                <a href="">ОПЛАТА И ДОСТАВКА</a>
            </li>
            <li>
                <img src="{{ asset('images/topmenu_border.png') }}" alt="" />
            </li>
            <li>
                <a href="">КОНТАКТЫ</a>
            </li>
        </ul>
    </div>
    <div id="content">
        <div id="left">
            <div id="menu">
                <div class="header">
                    <h3>Разделы</h3>
                </div>
                <div id="items">
                    <p >
                        <a href=""></a>
                    </p>
                </div>
                <div class="bottom"></div>
            </div>
        </div>
        <div id="right">
            {{ $slot }}
        </div>
        <div class="clear"></div>
        <div id="footer">
            <div id="pm">
                <table>
                    <tr>
                        <td>Способы оплаты:</td>
                        <td>
                            <img src="{{ asset('images/pm.png') }}" alt="Способы оплаты" />
                        </td>
                    </tr>
                </table>
            </div>
            <div id="copy">
                <p>Copyright &copy; Site.ru. Все права защищены.</p>
                <p class="counter">
                    <!--LiveInternet counter--><script type="text/javascript"><!--
                        document.write("<a href='http://www.liveinternet.ru/click' "+
                            "target=_blank><img src='//counter.yadro.ru/hit?t11.2;r"+
                            escape(document.referrer)+((typeof(screen)=="undefined")?"":
                                ";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
                                screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
                            ";h"+escape(document.title.substring(0,80))+";"+Math.random()+
                            "' alt='' title='LiveInternet: показано число просмотров за 24"+
                            " часа, посетителей за 24 часа и за сегодня' "+
                            "border='0' width='88' height='31'><\/a>")
                        //--></script><!--/LiveInternet-->
                </p>
            </div>
        </div>
    </div>
</body>
</html>
