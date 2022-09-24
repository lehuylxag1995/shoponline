<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slide;
use App\Http\Requests\Slide\StoreSlideRequest;
use App\Http\Requests\Slide\UpdateSlideRequest;
use App\Repositories\Interfaces\SlideRepositoryInterface;

class SlideController extends Controller
{
    protected $slideRepository;
    public function __construct(SlideRepositoryInterface $s)
    {
        $this->slideRepository = $s;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listSlides = $this->slideRepository->getListSlide();
        return view('admin.slides.list', ['listSlides' => $listSlides]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slides.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\Slide\StoreSlideRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSlideRequest $req)
    {
        $isSuccess = $this->slideRepository->StoreSlide($req);
        if ($isSuccess)
            return redirect()->route('slide.index')->with('success', 'Thêm ảnh quảng cáo thành công');
        else
            return back()->with('error', 'Thêm ảnh quảng cáo thất bại');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function edit(Slide $slide)
    {
        return view('admin.slides.edit', ['slide' => $slide]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Slide\UpdateSlideRequest  $request
     * @param  \App\Models\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSlideRequest $request, Slide $slide)
    {
        $isSuccess = $this->slideRepository->UpdateSlide($request, $slide);
        if ($isSuccess)
            return redirect()->route('slide.index')->with('success', 'Cập nhật ảnh quảng cáo thành công');
        else
            return back()->with('error', 'Thêm ảnh quảng cáo thất bại');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slide $slide)
    {
        $isSuccess = $this->slideRepository->RemoveSlide($slide);
        if ($isSuccess)
            return redirect()->route('slide.index')->with('success', 'Xoá ảnh quảng cáo thành công');
        else
            return back()->with('error', 'Xoá ảnh quảng cáo thất bại');
    }
}
