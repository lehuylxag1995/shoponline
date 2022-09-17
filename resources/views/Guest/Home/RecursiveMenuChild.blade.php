<ul class="sub-menu">
    @foreach ($childs as $child)
        <li><a href="#">{{ $child->name }}</a>
            @if (count($child->childs))
                @include('guest.home.RecursiveMenuChild', ['childs' => $child->childs])
            @endif
        </li>
    @endforeach
</ul>
