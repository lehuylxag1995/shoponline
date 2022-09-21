<?php

namespace App\Repositories;

use Illuminate\Support\Str;
use App\Http\Requests\Menu\StoreRequest;
use App\Models\Menu;
use App\Repositories\Interfaces\MenuRepositoryInterface;
use Exception;

class MenuRepository implements MenuRepositoryInterface
{
    public function getMenuBySlug($slug)
    {
        try {
            return Menu::where('slug', $slug)->firstOrFail();
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
    public function getListProductByMenu($idMenu, $price = null)
    {
        try {
            $data = Menu::find($idMenu)->products()->where('active', 1)->get();

            if ($price == "desc")
                $sort = $data->sortByDesc('price');
            if ($price == "asc")
                $sort = $data->sortBy('price');
            if (!empty($sort))
                $data = $sort->values()->all();

            return $data;
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
    public function getListHot()
    {
        return Menu::all(['id', 'name', 'slug'])->sortByDesc('parent_id')->take(3);
    }

    public function Store(StoreRequest $req)
    {
        $menu = new Menu();
        $menu->name = $req->name;
        $menu->parent_id = $req->parent_id ?? 0;
        $menu->description = $req->description;
        $menu->content = $req->content;
        $menu->active = true;
        $menu->slug  = Str::slug($req->name, '-');
        return $menu->save();
    }


    public function getListActive()
    {
        return Menu::where('active', true)->get();
    }

    public function getList()
    {
        $data = Menu::orderBy('id', 'desc')->get();
        return $data;
    }


    public function Remove(int $idMenu)
    {
        try {
            //Xoá Root
            Menu::where('id', $idMenu)->delete();
            //Lấy danh sách con của Root
            $listMenu = Menu::where('parent_id', $idMenu)->get();
            //Duyệt danh sách con
            foreach ($listMenu as $menu) {
                //Gọi đệ quy
                $this->Remove($menu->id);
                //Xoá danh sách con
                Menu::destroy($menu);
            }
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function Update(StoreRequest $req)
    {
        $menu = Menu::find($req->id);
        $menu->name = $req->name;
        $menu->parent_id = $req->parent_id;
        $menu->description = $req->description;
        $menu->content = $req->content;
        $menu->active = $req->active;
        $menu->slug  = Str::slug($req->name, '-');
        return $menu->save();
    }
}
