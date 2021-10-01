<x-layout>
    <table>
        <tr>
            <td rowspan="2">
                <div class="header">
                    <h3>Новинки</h3>
                </div>
            </td>
            <td class="section_bg"></td>
            <td class="section_right"></td>
        </tr>
        <tr>
            <td colspan="2">
                <table class="sort">
                    <tr>
                        <td>Сортировать по:</td>
                        <td>цене (<a href="">возр.</a> | <a href="">убыв.</a>)
                        <td>названию (<a href="">возр.</a> | <a href="">убыв.</a>)
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
