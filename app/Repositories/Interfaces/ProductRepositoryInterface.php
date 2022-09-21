<?php

namespace App\Repositories\Interfaces;

use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Product;

interface ProductRepositoryInterface
{
    /**
     *
     * @return Collection Danh sách sản phẩm đã active
     */
    public function getListActive($page = 1);

    /**
     *
     * @return bool thành công hay không
     */
    public function Store(StoreProductRequest $req);

    /**
     *
     * @return Collection Danh sách sản phẩm
     */
    public function getList();

    /**
     *
     * @return bool thành công hay không ?
     */
    public function UpdateProduct(UpdateProductRequest $request, Product $product);

    /**
     * @return bool thành công hay không ?
     */
    public function DeleteProduct(Product $p);
}
