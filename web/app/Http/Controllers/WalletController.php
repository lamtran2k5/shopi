<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Wallet;


class WalletController extends Controller
{
    public function view()
    {
        $userId = session('user_id'); 
        $user = User::find($userId);
        $contentView = 'account.wallet';
        $viewData = [
            'title' => 'Info',
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

        return redirect()->route('account.wallet')->with('success', 'Nạp tiền thành công!');
    }
}