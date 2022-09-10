<?php

namespace App\Repositories\Interfaces;

use App\Http\Requests\Product\StoreProductRequest;

interface ProductRepositoryInterface
{
    /**
     *
     * @return bool thành công hay không
     */
    public function Store(StoreProductRequest $req);
}
