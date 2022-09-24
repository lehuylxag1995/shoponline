<?php

namespace App\View\Composers;

use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class CartComposer
{

    protected $productRepository;


    public function __construct(ProductRepositoryInterface $p)
    {
        $this->productRepository = $p;
    }


    public function compose(View $view)
    {
        $cart = Session::get('cart');
        if ($cart != null) {
            $ListIdProduct = array_keys($cart);
            $ListProductSession = $this->productRepository->getProductByArray($ListIdProduct);
            $view->with('ListProductSession', $ListProductSession)->with('CartSession', $cart);
        } else {
            $view->with('ListProductSession', null)->with('CartSession', null);
        }
    }
}
