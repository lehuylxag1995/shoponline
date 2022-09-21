<?php

namespace App\Repositories\Interfaces;

use App\Http\Requests\Menu\StoreRequest;

interface MenuRepositoryInterface
{
    /**
     * Lấy danh sách sản phẩm phục thuộc menu bằng id menu
     *
     * @param Integer $idMenu
     *
     * @return Collection
     */
    public function getListProductByMenu($idMenu, $price = null);

    /**
     * Tìm 1 menu bằng slug
     *
     * @param string $slug
     *
     * @return Model
     */
    public function getMenuBySlug($slug);


    /**
     *  Lấy danh sách menu hot
     *
     * @return Collection Danh sách
     *
     */
    public function getListHot();

    /**
     *  Lấy tất cả thuộc tính, điều kiện active = true
     *
     * @return Collection Danh sách
     */
    public function getListActive();

    /**
     * Lấy danh sách menu, tất cả các thuộc tính
     */
    public function getList();

    /**
     * Lưu 1 bản ghi mới vào CSDl
     *
     * @return bool Thành công hay không
     */
    public function Store(StoreRequest $data);


    /**
     * Xoá menu và toàn bộ menu phụ thuộc
     *
     * @return int số dòng bị được xoá
     */
    public function Remove(int $idMenu);

    /**
     * Cập nhật menu
     *
     * @return bool Thành công hay không
     */
    public function Update(StoreRequest $data);
}
