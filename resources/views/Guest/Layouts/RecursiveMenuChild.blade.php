<ul class="sub-menu">
    @foreach ($childs as $child)
        <li><a href="/danh-muc/{{ $child->slug }}.html">{{ $child->name }}</a>
            @if (count($child->childs))
                @include('guest.layouts.RecursiveMenuChild', ['childs' => $child->childs])
            @endif
        </li>
    @endforeach
</ul>
