@forelse ($listMenu as $menu)
    @if ($menu->parent_id == $id_root)
        <tr>
            <td>{{ $menu->id }}</td>
            <td>{{ $char . $menu->name }}</td>
            <td>
                {{ $nameParent }}
            </td>
            <td>
                @if ($menu->active == 1)
                    <button class="btn btn-success">Đang hiển thị</button>
                @else
                    <button class="btn btn-danger">Không hiển thị</button>
                @endif
            </td>
            <td>{{ $menu->created_at->format('d/m/Y') }}</td>
            <td>{{ $menu->updated_at->format('d/m/Y') }}</td>
            <td>
                <a class="btn btn-info btn-sm" href="/menu/edit/{{ $menu->id }}">
                    <i class="fas fa-edit"></i>
                </a>
                <a class="btn btn-danger btn-sm" onclick="removeMenu({{ $menu->id }},'{{ route('Menu.Destroy') }}')">
                    <i class="fas fa-trash"></i>
                </a>
            </td>
        </tr>
        @include('admin.menu.RecursiveList', [
            'listMenu' => $listMenu,
            'id_root' => $menu->id,
            'char' => '-----' . $char,
            'nameParent' => $menu->name,
        ])
    @endif
@empty
    <h3>Chưa có dữ liệu nào...</h3>
@endforelse
