<?php

namespace App\Repositories\Interfaces;

use App\Http\Requests\StoreSlideRequest;
use App\Http\Requests\UpdateSlideRequest;
use App\Models\Slide;

interface SlideRepositoryInterface
{
    /**
     * Lấy danh sách slide
     *
     * @return Collecion Danh sách slide
     */
    public function getListSlide();

    /**
     * Lưu 1 bản ghi mới vào CSDl
     *
     * @return bool Thành công hay không
     */
    public function StoreSlide(StoreSlideRequest $req);

    /**
     * Cập nhật dữ liệu
     *
     * @return bool Thành công hay không
     */
    public function UpdateSlide(UpdateSlideRequest $request, Slide $slide);

    /**
     * Xoá dữ liệu
     *
     * @return int số dòng bị được xoá
     */
    public function RemoveSlide(Slide $slide);
}
