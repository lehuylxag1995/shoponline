<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\StoreRequest;
use App\Models\Menu;
use App\Repositories\Interfaces\MenuRepositoryInterface;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    private $MenuRepository;

    public function __construct(MenuRepositoryInterface $MenuRepository)
    {
        $this->MenuRepository = $MenuRepository;
    }

    public function List()
    {
        $data = $this->MenuRepository->getList();
        return view('admin.menu.list', [
            'listMenu' => $data,
        ]);
    }

    public function Create()
    {
        $data = $this->MenuRepository->getListActive();
        return view('admin.menu.create', [
            'listParentMenu' => $data,
        ]);
    }

    public function Store(StoreRequest $req)
    {
        $isSuccess = $this->MenuRepository->Store($req);
        $stringStatus = $isSuccess ? 'Thêm thành công' : 'Thêm thất bại';
        return back()->with('status', $stringStatus);
    }

    public function Edit(Menu $menu)
    {
        $listParentMenu = $this->MenuRepository->getListActive();
        return view('admin.menu.edit', [
            'menu' => $menu,
            'listParentMenu' => $listParentMenu
        ]);
    }

    public function Update(StoreRequest $req)
    {
        $isSuccess = $this->MenuRepository->Update($req);
        if ($isSuccess) {
            $stringStatus = 'Cập nhật thành công';
            return redirect()->route('Menu.List')->with('status', $stringStatus);
        } else {
            $stringStatus = 'Cập nhật thất bại';
            return back()->with('status', $stringStatus);
        }
    }

    public function Destroy(Request $req)
    {
        $isSuccess = $this->MenuRepository->Remove($req->idMenu);
        if ($isSuccess)
            return response()->json([
                'error' => $isSuccess,
                'message' => 'Xoá thành công'
            ]);
        else
            return response()->json([
                'error' => $isSuccess,
                'message' => 'Xoá thất bại'
            ], 404);
    }
}
