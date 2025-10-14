<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Wallet;
use App\Models\PaymentHistory;

class OrderDetailController extends Controller
{
    public function index(Product $product)
    {
        $userId = session('user_id');
        $user = User::find($userId);
        $shop = $product->shop;
        $viewData = [
            'title' => 'Order Detail',
            'user' => $user,
            'product' => $product,
            'shop' => $shop,
        ];
        return view('order.orderdetail', $viewData);
    }

public function payment(Request $request)
{
    $userId = $request->input('user_id');
    $shopId = $request->input('shop_id');
    $totalPrice = (float) $request->input('total_price');
    // Lấy user
    $user = User::find($userId);
    $shop = User::find($shopId);
    // Lấy ví của user và shop
    $user_wallet = $user->wallet;
    $shop_wallet = $shop->wallet;

    // Nếu không tìm thấy ví
    if (!$user_wallet || !$shop_wallet) {
        return back()->with('error', 'Không tìm thấy ví của người dùng hoặc shop!');
    }

    // Kiểm tra số dư
    if ($user_wallet->wallet_balance < $totalPrice) {
        return back()->with('error', 'Số dư trong ví không đủ để thanh toán!');
    }

    // Thực hiện giao dịch an toàn bằng Transaction
    DB::beginTransaction();
    try {
        // Trừ tiền người mua
        $user_wallet->wallet_balance -= $totalPrice;
        $user_wallet->save();

        // Cộng tiền cho shop
        $shop_wallet->wallet_balance += $totalPrice;
        $shop_wallet->save();

        DB::commit();
        return redirect()->back()->with('success', 'Giao dịch thành công!');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Lỗi giao dịch: '.$e->getMessage());
    }
}
}

// Ghi lịch sử giao dịch cho cả hai bên
/*
PaymentHistory::create([
    'wallet_number' => $user_wallet->wallet_number,
    'amount' => -$totalPrice,
    'transaction_type' => 'purchase',
    'description' => 'Thanh toán cho shop ID '.$shopId,
]);

PaymentHistory::create([
    'wallet_number' => $shop_wallet->wallet_number,
    'amount' => $totalPrice,
    'transaction_type' => 'income',
    'description' => 'Nhận tiền từ user ID '.$userId,
]);
*/
