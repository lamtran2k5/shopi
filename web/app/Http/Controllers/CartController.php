<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    // 🛒 Hiển thị giỏ hàng
    public function index()
    {
        $cart = session()->get('cart', []);
        $products = Product::whereIn('id', array_keys($cart))->get();

        $total = 0;
        foreach ($products as $product) {
            $total += $product->final_price * $cart[$product->id];
        }

        return view('cart.index', compact('cart', 'products', 'total'));
    }

    // ➕ Thêm sản phẩm vào giỏ
    public function add(Request $request, Product $product)
    {
        $quantity = (int) $request->input('quantity', 1);
        if ($quantity <= 0) {
            return redirect()->back()->with('error', 'Số lượng không hợp lệ!');
        }

        // Kiểm tra tồn kho
        if ($product->stock < $quantity) {
            return redirect()->back()->with('error', 'Sản phẩm không đủ hàng trong kho!');
        }

        // Lấy giỏ hàng hiện tại
        $cart = session()->get('cart', []);

        // Nếu đã có trong giỏ thì cộng dồn
        if (isset($cart[$product->id])) {
            $newQuantity = $cart[$product->id] + $quantity;

            if ($product->stock < $newQuantity) {
                return redirect()->back()->with('error', 'Số lượng vượt quá tồn kho!');
            }

            $cart[$product->id] = $newQuantity;
        } else {
            $cart[$product->id] = $quantity;
        }

        // Lưu lại vào session
        session(['cart' => $cart]);

        // Đồng bộ database
        $this->syncCartToDatabase();

        return redirect()->back()->with('success', 'Đã thêm sản phẩm vào giỏ hàng!');
    }

    // 🔁 Cập nhật số lượng
    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (!isset($cart[$id])) {
            return redirect()->back()->with('error', 'Sản phẩm không tồn tại trong giỏ hàng!');
        }

        $quantity = (int) $request->input('quantity', 1);
        if ($quantity <= 0) {
            unset($cart[$id]);
        } else {
            $product = Product::find($id);
            if (!$product) {
                return redirect()->back()->with('error', 'Sản phẩm không tồn tại!');
            }

            if ($product->stock < $quantity) {
                return redirect()->back()->with('error', 'Số lượng vượt quá tồn kho!');
            }

            $cart[$id] = $quantity;
        }

        session(['cart' => $cart]);
        $this->syncCartToDatabase();

        return redirect()->back()->with('success', 'Đã cập nhật giỏ hàng!');
    }

    // ❌ Xóa sản phẩm khỏi giỏ
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session(['cart' => $cart]);
            $this->syncCartToDatabase();

            return redirect()->back()->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng!');
        }

        return redirect()->back()->with('error', 'Sản phẩm không tồn tại trong giỏ hàng!');
    }

    // 🧹 Xóa toàn bộ giỏ hàng
    public function clear()
    {
        session()->forget('cart');
        $this->syncCartToDatabase();

        return redirect()->back()->with('success', 'Đã xóa toàn bộ giỏ hàng!');
    }

    // ⚙️ Hàm đồng bộ cart giữa session và database
    private function syncCartToDatabase()
    {
        if (!Auth::check()) return; // Nếu chưa login thì bỏ qua

        $user = Auth::user();
        $cart = session()->get('cart', []); // [product_id => quantity]

        // ✅ Lấy hoặc tạo cart cho user
        $cartRecord = DB::table('carts')->where('user_id', $user->id)->first();

        if (!$cartRecord) {
            // Nếu chưa có cart thì tạo mới
            $cartId = DB::table('carts')->insertGetId([
                'user_id' => $user->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } else {
            $cartId = $cartRecord->cart_id; // chú ý dùng cart_id vì đây là PK custom
        }

        // ✅ Xóa toàn bộ item cũ trong cart_items
        DB::table('cart_items')->where('cart_id', $cartId)->delete();

        // ✅ Thêm lại toàn bộ item từ session
        foreach ($cart as $productId => $quantity) {
            DB::table('cart_items')->insert([
                'cart_id' => $cartId,
                'product_id' => $productId,
                'quantity' => $quantity,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}