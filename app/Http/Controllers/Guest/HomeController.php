<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\MenuRepositoryInterface;
use App\Repositories\Interfaces\SlideRepositoryInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $SlideRepository;
    private $MenuRepository;
    public function __construct(SlideRepositoryInterface $slide, MenuRepositoryInterface $menu)
    {
        $this->SlideRepository = $slide;
        $this->MenuRepository = $menu;
    }
    public function index()
    {
        $ListSlide = $this->SlideRepository->getListSlide();
        $ListMenuHot = $this->MenuRepository->getListHot();
        return view('guest.home.app', [
            'ListSlide' => $ListSlide,
            'ListMenuHot' => $ListMenuHot
        ]);
    }
}
