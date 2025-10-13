<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function view($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found');
        }
        $contentView = 'product.detail';
        $viewData = [
            'title' => 'Product Detail',
            'contentView' => $contentView,
            'product' => $product
        ];
        return view('product.product', $viewData);
    }
}