<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PaymentHistory;


class WalletController extends Controller
{
    public function view()
    {
        $userId = session('user_id'); 
        $user = User::find($userId);
        $contentView = 'account.wallet';
        $viewData = [
            'title' => 'Wallet',
            'contentView' => $contentView,
            'user' => $user
        ];
        return view('home.account', $viewData);
    }

    public function upwallet(Request $request)
    {
        $userId = session('user_id'); 
        $user = User::findOrFail($userId);

        $amount = (float) $request->input('amount');
        $user->wallet->wallet_balance += $amount;
        $user->wallet->save();

        $walletNumber = $user->wallet->wallet_number;
        PaymentHistory::create([
            'wallet_number' => $walletNumber,
            'amount' => $amount,
        ]);
        return redirect()->route('account.wallet')->with('success', 'Nạp tiền thành công!');
    }
}