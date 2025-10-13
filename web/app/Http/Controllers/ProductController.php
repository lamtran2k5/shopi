<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;

class ProductController extends Controller
{
    public function view($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return redirect(404);
        }
        $shop = User::find($product->shop_id);
        $contentView = 'product.detail';
        $viewData = [
            'title' => 'Product Detail',
            'contentView' => $contentView,
            'product' => $product,
            'shop' => $shop
        ];
        return view('product.product', $viewData);
    }
}