<?php

namespace App\Repositories\Interfaces;

use App\Http\Requests\Menu\StoreRequest;

interface MenuRepositoryInterface
{
    /**
     *  Lấy danh sách menu đã active
     */
    public function getListActive();

    /**
     * Lấy danh sách menu, tất cả các thuộc tính, có phân trang
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
