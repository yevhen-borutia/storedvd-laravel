<x-layout>
    <x-slot name="title">
        {{ __('Contacts') }}
    </x-slot>
    <div id="article">
        <h2>{{ __('Contacts') }}</h2>
        {!! __("<p>We are located at the address So-and-So street, such-and-such, Moscow</p><p>We work from 09:00 to 21:00 without breaks and weekends.</p><p>At all this is a test site that was created in the training course by Mikhail Rusakov<br /><a href=\"https://srs.myrusakov.ru/im\">Creating an Internet store with PHP and MySQL</a></p><p>In this regard, this site does not actually sell anything. So when you order some movie, you shouldn't expect it to come to you.</p>") !!}
    </div>
    <div id="map" style="width:400px; height:300px"></div>
    <script src="//api-maps.yandex.ru/2.0-stable/?load=package.standard&lang=ru-RU" type="text/javascript"></script>
    <script src="https://yandex.st/jquery/1.6.4/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        ymaps.ready(init);

        function init () {
            var myMap = new ymaps.Map("map", {
                    center: [55.739533,37.624744],
                    zoom: 17
                }),
                myPlacemark = new ymaps.Placemark([55.739533,37.624744], {
                    // Чтобы балун и хинт открывались на метке, необходимо задать ей определенные свойства.
                    balloonContentHeader: "{{ __("Our store") }}",
                    balloonContentBody: "<em>{{ __("Moscow, st. such and such, d. such and such") }}</em>",
                    balloonContentFooter: "{{ __("Waiting for you") }}!",
                    hintContent: "{{ __("We are here") }}!"
                });
            // элемента управления и его параметры.
            myMap.controls
                // Кнопка изменения масштаба.
                .add('zoomControl', { left: 5, top: 5 })
                // Список типов карты
                .add('typeSelector')
                // Кнопка изменения масштаба - компактный вариант.
                // Расположим её справа.
                .add('smallZoomControl', { right: 5, top: 75 })
                // Стандартный набор кнопок
                .add('mapTools', { left: 35, top: 5 });
            myMap.geoObjects.add(myPlacemark);

            // Показываем хинт на карте (без привязки к геообъекту).
            myMap.hint.show(myMap.getCenter(), "{{ __("Tooltip content") }}", {
                // Опция: задержка перед открытием.
                showTimeout: 1500
            });
        }
    </script>			</div>
</x-layout>
