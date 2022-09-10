<?php

namespace App\Repositories;

use App\Http\Requests\Product\StoreProductRequest;
use App\Models\Menu;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Exception;

class ProductRepository implements ProductRepositoryInterface
{

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
            $product->thumb = '';

            $product->menu()->associate($menu);

            return $product->save();
        } catch (Exception $e) {
            $message = $e->getMessage();
            dd($message);
            return false;
        }
    }
}
