<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\MenuRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\Interfaces\SlideRepositoryInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $SlideRepository;
    private $MenuRepository;
    private $ProductRepository;

    public function __construct(SlideRepositoryInterface $slide, MenuRepositoryInterface $menu, ProductRepositoryInterface $product)
    {
        $this->SlideRepository = $slide;
        $this->MenuRepository = $menu;
        $this->ProductRepository = $product;
    }
    public function index()
    {
        $ListSlide = $this->SlideRepository->getListSlide();
        $ListMenuHot = $this->MenuRepository->getListHot();
        $ListProduct = $this->ProductRepository->getListActive();
        return view('guest.home.app', [
            'ListSlide' => $ListSlide,
            'ListMenuHot' => $ListMenuHot,
            'ListProduct' => $ListProduct
        ]);
    }

    public function LoadMore(Request $req)
    {
        $ListProduct = $this->ProductRepository->getListActive($req->page);
        if ($ListProduct->count()) {
            $html = view('guest.home.product', ['ListProduct' => $ListProduct])->render();
            return response()->json([
                'status' => true,
                'data' => $html
            ]);
        } else
            return response()->json([
                'status' => false,
            ]);
    }
}
