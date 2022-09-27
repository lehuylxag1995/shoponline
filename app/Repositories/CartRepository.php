<?php

namespace App\Repositories;

use App\Models\Cart;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\CartRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;

class CartRepository implements CartRepositoryInterface
{
    private $ProductRepository;
    public function __construct(ProductRepositoryInterface $p)
    {
        $this->ProductRepository = $p;
    }
    public function StoreCartWithIdCustomer(int $idCustomer, array $dataCart)
    {
        try {
            $customer = Customer::find($idCustomer);

            $arrayIdProducts = array_keys($dataCart);
            $ListProduct = $this->ProductRepository->getProductByArray($arrayIdProducts);

            foreach ($ListProduct as $i => $product) {
                $quantity = $dataCart[$product->id];

                $cartItem = new Cart();
                $cartItem->customer_id = $customer->id;
                $cartItem->product_id = $product->id;
                $cartItem->quantity = $quantity;
                $cartItem->price = $product->price * $quantity;
                $cartItem->save();
            }

            return true;
        } catch (Exception $e) {
            dd($e->getMessage());
            return false;
        }
    }

    public function UpdateItemCartBySession(array $arrProductId, array $arrQuantity)
    {
        try {
            $cartUpdate = array_combine($arrProductId, $arrQuantity);

            $cart = Session::get('cart');
            if ($cart != null) {
                Session::put('cart', $cartUpdate);
            } else
                return false;

            return true;
        } catch (Exception $e) {
            dd($e->getMessage());
            return false;
        }
    }

    public function RemoveItemCartBySession($idProduct)
    {
        try {
            $cart = Session::get('cart');
            if (Arr::has($cart, $idProduct)) {
                Arr::forget($cart, $idProduct);
                Session::put('cart', $cart);
                return true;
            } else
                return false;
        } catch (Exception $e) {
            dd($e->getMessage());
            return false;
        }
    }

    public function StoreCartBySession(Request $req)
    {
        try {
            // $req->session()->flush();
            $cart = $req->session()->get('cart');
            $productId = $req->input('id');
            $productQuantity = (int)$req->input('quantity');

            //Thêm sản phẩm mới
            if ($cart == null) {
                $req->session()->put('cart', [
                    $productId => $productQuantity
                ]);
            } else {
                //Cập nhật số lượng sản phẩm
                if (Arr::exists($cart, $productId)) {
                    $cart[$productId] += $productQuantity;
                    $addProduct = Arr::set($cart, $productId, $cart[$productId]);
                    $req->session()->put('cart', $addProduct);
                } else {
                    $addProduct = Arr::add($cart, $productId, $productQuantity);
                    $req->session()->put('cart', $addProduct);
                }
            }
            return true;
        } catch (Exception $th) {
            dd($th->getMessage());
            return false;
        }
    }
}
