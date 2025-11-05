<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // 1️⃣ Xác thực người dùng
        $request->authenticate();
        $request->session()->regenerate();

        // 2️⃣ Lấy user hiện tại
        $user = Auth::user();

        // 3️⃣ Lấy giỏ hàng trong session (nếu có)
        $sessionCart = session('cart', []); // [product_id => quantity]

        // 4️⃣ Lấy giỏ hàng trong database
        $cartRecord = DB::table('carts')->where('user_id', $user->id)->first();
        $dbCart = [];

        if ($cartRecord) {
            $dbCart = DB::table('cart_items')
                ->where('cart_id', $cartRecord->cart_id)
                ->pluck('quantity', 'product_id') // => [product_id => quantity]
                ->toArray();
        }

        // 5️⃣ Gộp hai giỏ hàng (ưu tiên cộng dồn)
        $mergedCart = $dbCart;

        foreach ($sessionCart as $productId => $quantity) {
            if (isset($mergedCart[$productId])) {
                $mergedCart[$productId] += $quantity;
            } else {
                $mergedCart[$productId] = $quantity;
            }
        }

        // 6️⃣ Lưu kết quả vào session
        session(['cart' => $mergedCart]);

        // 7️⃣ Cập nhật lại database
        // Nếu user chưa có cart thì tạo mới
        if (!$cartRecord) {
            $cartId = DB::table('carts')->insertGetId([
                'user_id' => $user->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } else {
            $cartId = $cartRecord->cart_id;
        }

        // Xóa toàn bộ cart_items cũ
        DB::table('cart_items')->where('cart_id', $cartId)->delete();

        // Thêm lại toàn bộ từ mergedCart
        foreach ($mergedCart as $productId => $quantity) {
            DB::table('cart_items')->insert([
                'cart_id' => $cartId,
                'product_id' => $productId,
                'quantity' => $quantity,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 8️⃣ Chuyển hướng sau khi login
        return redirect()->intended('/');
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
