<?php

namespace App\Http\Services\Product;

use App\Models\Menu;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ProductAdminService
{
    public function getMenu()
    {
        return Menu::where('active', 1)->get();
    }

    public function getAll()
    {
        return Product::with('menu')
            ->orderByDesc('id')->paginate(15);
    }

    public function isValidPrice($request)
    {
        $price = $request->input('price');
        $price_sale = $request->input('price_sale');
        if ($price !== 0 && $price_sale !== 0 && $price_sale >= $price) {
            Session::flash('error', 'Giá giảm phải nhỏ hơn giá gốc');
            return false;
        }
        if ($price_sale !== 0 && $price === 0) {
            Session::flash('error', 'Vui lòng nhập giá gốc trước');
            return false;
        }
        return true;
    }

    public function insert($request)
    {
        $isValidPrice = $this->isValidPrice($request);
        if (!$isValidPrice) return false;
        // dd($request->all());
        try {
            $request->except('_token');
            Product::create($request->all());
            Session::flash('success', 'Thêm sản phẩm thành công');
        } catch (\Exception $err) {
            Session::flash('error', 'Thêm sản phẩm lỗi');
            return false;
        }
        return true;
    }

    public function update($request, $product)
    {
        $isValidPrice = $this->isValidPrice($request);
        if (!$isValidPrice) return false;

        try {
            $product->fill($request->input());
            $product->save();
            Session::flash('success', 'Cập nhật sản phẩm thành công');
        } catch (\Exception $err) {
            Session::flash('error', 'Cập nhật sản phẩm thất bại');
            Log::info($err->getMessage());
            return false;
        }
        return true;
    }

    public function delete($request)
    {
        $id = $request->input('id');
        $product = Product::where('id', $id)->first();
        if ($product) {
            $product->delete();
            return true;
        }
        return false;
    }
}
