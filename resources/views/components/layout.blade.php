<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ $title ?? __('Online store') }}</title>
    <link href="{{ asset('storage/css/main.css') }}" rel="stylesheet" />
</head>
<body>
<div id="container">
    <div id="header">
        <img src="{{ asset('storage/images/header.png') }}" alt="Шапка" />
        <div>
            <p class="red">8-800-123-45-67</p>
            <p class="blue">{!! __('Opening hours from 9AM to 9PM without breaks and days off') !!}</p>
        </div>
        <x-cart></x-cart>
    </div>
    <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
    @foreach(config('app.available_locales') as $locale_name => $available_locale)
        @if($available_locale === app()->getLocale())
            <span class="ml-2 mr-2 text-gray-700">{{ $locale_name }}</span>
        @else
            <a class="ml-1 underline ml-2 mr-2" href="/language/{{ $available_locale }}">
                <span>{{ $locale_name }}</span>
            </a>
        @endif
    @endforeach
</div>
    <div id="topmenu">
        <ul>
            <li>
                <a href="{{url('/')}}">{{ __('MAIN') }}</a>
            </li>
            <li>
                <img src="{{ asset('storage/images/topmenu_border.png') }}" alt="" />
            </li>
            <li>
                <a href="{{url('/delivery')}}">{{ __('PAYMENT AND DELIVERY') }}</a>
            </li>
            <li>
                <img src="{{ asset('storage/images/topmenu_border.png') }}" alt="" />
            </li>
            <li>
                <a href="{{url('/contacts')}}">{{ __('CONTACTS')}}</a>
            </li>
        </ul>
        <div id="search">
            <form name="search" action="{{url('/search')}}" method="get">
                <table>
                    <tbody><tr>
                        <td class="input_left"></td>
                        <td>
                            <input type="text" name="q" value="{{ __('search') }}" onfocus="if(this.value == '{{ __('search') }}') this.value=''" onblur="if(this.value == '') this.value='{{ __('search') }}'">
                        </td>
                        <td class="input_right"></td>
                    </tr>
                    </tbody></table>
            </form>
        </div>
    </div>
    <div id="content">
        <div id="left">
            <div id="menu">
                <div class="header">
                    <h3>{{ __('Sections') }}</h3>
                </div>
                <div id="items">
                    @foreach ($genres as $genre)
                        <p>
                            <a href="{{url('/section/'.$genre->id)}}">{{ $genre->title }}</a>
                        </p>
                    @endforeach
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
                        <td>{{ __('Payment methods:') }}</td>
                        <td>
                            <img src="{{ asset('storage/images/pm.png') }}" alt="Способы оплаты" />
                        </td>
                    </tr>
                </table>
            </div>
            <div id="copy">
                <p>Copyright &copy; {{ request()->getHost() }} {{ __('All rights reserved.') }}</p>
            </div>
        </div>
    </div>
    <script src="{{ asset('storage/js/functions.js') }}"></script>
</body>
</html>
