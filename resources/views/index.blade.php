<x-layout>
    <table>
        <tr>
            <td rowspan="2">
                <div class="header">
                    <h3>{{ __("New movies") }}</h3>
                </div>
            </td>
            <td class="section_bg"></td>
            <td class="section_right"></td>
        </tr>
        <tr>
            <td colspan="2">
                <table class="sort">
                    <tr>
                        <td>{{ __('Sort by:') }}</td>
                        <td>{{ __('price') }} (<a href="{{request()->fullUrlWithQuery(['sort' => 'price', 'up' => 1])}}">{{ __('asc') }}.</a> | <a href="{{request()->fullUrlWithQuery(['sort' => 'price', 'up' => 0])}}">{{ __('desc') }}.</a>)
                        <td>{{ __('title') }} (<a href="{{request()->fullUrlWithQuery(['sort' => 'title', 'up' => 1])}}">{{ __('asc') }}.</a> | <a href="{{request()->fullUrlWithQuery(['sort' => 'title', 'up' => 0])}}">{{ __('desc') }}.</a>)
                    </tr>
                </table>
            </td>
        </tr>
    </table><table class="products">
        <tr>
            @for($i = 0; $i < count($movies); $i++)
                @include('intro_product', ['movie' => $movies[$i]])
            @if ($i === 3)</tr><tr>@endif
            @endfor
        </tr>
    </table>
</x-layout>
