@if ($paginator->lastPage() > 1)
<ul class="pagination" style="margin-top:5px;margin-right:0;">
    <li class="{{ ($paginator->currentPage() == 1) ? ' ' : '' }}">
        <a href="{{ $paginator->url(1) }}"><</a>
    </li>
    @for ($i = 1; $i <= $paginator->lastPage(); $i++)
        <li id="{{$i}}" class="{{ ($paginator->currentPage() == $i) ? ' active' : '' }}">
            <a href="{{ $paginator->url($i) }}" >{{ $i }}</a>
        </li>
    @endfor
    <li class="{{ ($paginator->currentPage() == $paginator->lastPage()) ? ' ' : '' }}">
        <a href="{{ $paginator->url($paginator->currentPage()+1) }}">></a>
    </li>
</ul>
@endif