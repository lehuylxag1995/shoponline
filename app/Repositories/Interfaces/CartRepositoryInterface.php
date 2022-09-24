<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;

interface CartRepositoryInterface
{
    /**
     *
     * @return bool thành công hay không?
     */
    public function StoreCartBySession(Request $req);

    /**
     * Xoá 1 sản phẩm bằng session
     * @param int $idProduct
     * @return bool Xoá thành công hay không ?
     */
    public function RemoveItemCartBySession($idProduct);

    /**
     * Cập nhật 1 sản phẩm bằng session
     *
     * @return bool Xoá thành công hay không ?
     */
    public function UpdateItemCartBySession(array $arrProductId, array $arrQuantity);
}
