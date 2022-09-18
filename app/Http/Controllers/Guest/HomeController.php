<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\SlideRepositoryInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $SlideRepository;
    public function __construct(SlideRepositoryInterface $slide)
    {
        $this->SlideRepository = $slide;
    }
    public function index()
    {
        $ListSlide = $this->SlideRepository->getListSlide();
        return view('guest.home.app', [
            'ListSlide' => $ListSlide
        ]);
    }
}
