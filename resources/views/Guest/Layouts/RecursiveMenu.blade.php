@foreach ($ListMenu as $menu)
    @if ($menu->parent_id == 0)
        <li><a href="/danh-muc/{{ $menu->slug }}.html">{{ $menu->name }}</a>
            @if (count($menu->childs))
                @include('guest.layouts.RecursiveMenuChild', ['childs' => $menu->childs])
            @endif
        </li>
    @endif
@endforeach
