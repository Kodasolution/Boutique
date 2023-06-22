<?php

namespace App\Classes\Services;

use App\Models\Product;

class ProductService
{
    public function getAllProduct()
    {
        $product = Product::orderBy('id', 'desc')->get();
        return $product;
    }
    public function showProduct(Product $product)
    {
        return $product;
    }
}
