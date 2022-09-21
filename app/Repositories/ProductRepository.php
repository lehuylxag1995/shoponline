<?php

namespace App\Repositories;

use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Menu;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\Storage;

class ProductRepository implements ProductRepositoryInterface
{

    public function getListActive($page = 1)
    {
        $pageSize = 16;
        $data = Product::select('id', 'name', 'thumb', 'price', 'price_sale')->where('active', 1)
            ->orderBy('id', 'desc')
            ->skip(($page * $pageSize)  - $pageSize)
            ->take($page * $pageSize)
            ->get();
        return $data;
    }

    public function getList()
    {
        $query = Product::with('menu:id,name')->orderBy('id', 'desc')->paginate(5);
        return $query;
    }

    public function Store(StoreProductRequest $req)
    {
        try {
            $menu = Menu::find($req->input('menu_id'));

            $product = new Product();
            $product->name = $req->input('name');
            $product->slug = Str::slug($req->input('name'), '-');
            $product->description = $req->input('description');
            $product->content = $req->input('content');
            $product->price = $req->input('price');
            $product->price_sale = $req->input('price_sale');
            if ($req->hasFile('thumb')) {
                $path = Storage::putFile('images', $req->file('thumb'));
                $product->thumb = $path;
            } else
                $product->thumb = '';

            $product->menu()->associate($menu);

            return $product->save();
        } catch (Exception $e) {
            $message = $e->getMessage();
            dd($message);
            return false;
        }
    }

    public function UpdateProduct(UpdateProductRequest $request, Product $product)
    {
        try {

            $product->name = $request->name;
            $product->menu_id = $request->menu_id;
            $product->price = $request->price;
            $product->price_sale = $request->price_sale;
            $product->description = $request->description;
            $product->content = $request->content;
            $product->active = $request->active;
            $product->slug = Str::slug($request->name);
            if ($request->hasFile('thumb')) {
                //Xoá hình
                Storage::delete($product->thumb);
                //Thêm hình mới
                $path = $request->file('thumb')->store('images');
                //Cập nhật lại database
                $product->thumb = $path;
            } else
                $product->thumb = $product->thumb;

            $product->save();
            return true;
        } catch (Exception $e) {
            dd($e->getMessage());
            return false;
        }
    }

    public function DeleteProduct(Product $p)
    {
        try {
            if (!empty($p->thumb)) {
                Storage::delete($p->thumb);
            }
            $p->delete();
            return true;
        } catch (Exception $e) {
            dd($e->getMessage());
            return false;
        }
    }
}
