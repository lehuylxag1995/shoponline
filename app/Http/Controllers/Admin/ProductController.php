<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Repositories\Interfaces\MenuRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class ProductController extends Controller
{
    protected $ProductRepository;
    protected $MenuRepository;

    public function __construct(ProductRepositoryInterface $p, MenuRepositoryInterface $m)
    {
        $this->ProductRepository = $p;
        $this->MenuRepository = $m;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = $this->ProductRepository->getList();
        return view('admin.product.list')
            ->with('listProduct', $list);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ListMenu = $this->MenuRepository->getListActive();
        return view('admin.product.create')
            ->with('ListMenu', $ListMenu);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $req)
    {
        $isSuccess = $this->ProductRepository->Store($req);
        if ($isSuccess)
            return redirect()->route('products.index')
                ->with('success', 'Thêm sản phẩm thành công');
        else
            return redirect()->route('products.create')
                ->with('error', 'Thêm sản phẩm thất bại');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('admin.product.edit', ['product' => $product, 'ListMenu' => $this->MenuRepository->getListActive()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $req, Product $product)
    {
        $isSuccess = $this->ProductRepository->UpdateProduct($req, $product);
        if ($isSuccess)
            return redirect()->route('products.index')
                ->with('success', 'Cập nhật sản phẩm thành công');
        else
            return redirect()->route('products.create')
                ->with('error', 'Cập nhật sản phẩm thất bại');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $isSuccess = $this->ProductRepository->DeleteProduct($product);
        if ($isSuccess)
            return redirect()->route('products.index')
                ->with('success', 'Xoá sản phẩm thành công');
        else
            return redirect()->route('products.index')
                ->with('error', 'Xoá sản phẩm thất bại');
    }
}
