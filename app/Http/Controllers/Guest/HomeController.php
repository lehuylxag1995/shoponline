<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\CartRepositoryInterface;
use App\Repositories\Interfaces\MenuRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\Interfaces\SlideRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class HomeController extends Controller
{
    private $SlideRepository;
    private $MenuRepository;
    private $ProductRepository;
    private $CartRepository;

    public function __construct(
        SlideRepositoryInterface $slide,
        MenuRepositoryInterface $menu,
        ProductRepositoryInterface $product,
        CartRepositoryInterface $cart
    ) {
        $this->SlideRepository = $slide;
        $this->MenuRepository = $menu;
        $this->ProductRepository = $product;
        $this->CartRepository = $cart;
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

    public function LoadProductByMenu(Request $req, $slug)
    {
        $optionPrice = $req->query('price');
        $menu = $this->MenuRepository->getMenuBySlug($slug);
        $products = $this->MenuRepository->getListProductByMenu($menu->id, $optionPrice);
        return view('guest.menu.product', [
            'ListProduct' => $products
        ]);
    }

    public function ShowProduct($slug)
    {
        $product = $this->ProductRepository->getProductBySlug($slug);
        $products = $this->MenuRepository->getListProductRelatedByMenu($product->menu->id, $product->id, 4);

        return view('guest.product.show', [
            'product' => $product,
            'products' => $products
        ]);
    }


    public function ListCartSession(Request $req)
    {
        $cart = $req->session()->get('cart');
        $arrayId = array_keys($cart);
        $ListProduct = $this->ProductRepository->getProductByArray($arrayId);
        return view('guest.cart.list', [
            'ListProduct' => $ListProduct,
            'Cart' => $cart
        ]);
    }

    public function StoreCartSession(Request $req)
    {
        $isSuccess = $this->CartRepository->StoreCartBySession($req);
        if ($isSuccess)
            return redirect()->back();
        else
            return redirect()->route('CartSession.List')->with('error', 'Thêm giỏ hàng thất bại');
    }

    public function RemoveItemCartSession($id = 0)
    {
        $isSuccess = $this->CartRepository->RemoveItemCartBySession($id);
        if ($isSuccess)
            return redirect()->back();
        else
            return redirect()->route('CartSession.List')->with('error', 'Xoá giỏ hàng thất bại');
    }

    public function UpdateItemCartSession(Request $req)
    {
        $productId = $req->input('productId');
        $quantity = $req->input('quantity');

        $isSuccess = $this->CartRepository->UpdateItemCartBySession($productId, $quantity);
        if ($isSuccess)
            return redirect()->back();
        else
            return redirect()->route('CartSession.List')->with('error', 'Xoá giỏ hàng thất bại');
    }
}
