<?php
namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Wallet;
use App\Models\PaymentHistory;

class PaymentHistoryController extends Controller
{
    public function index()
    {
        $userId = session('user_id');
        $wallet_number = User::where('id', $userId)->value('wallet_number');
        $paymentHistory = PaymentHistory::where('wallet_number', $wallet_number)->orderBy('transaction_date', 'desc')->get();
        $contentView = 'account.paymentHistory';
        $viewData = [
            'title' => 'Payment History',
            'contentView' => $contentView,
            'paymentHistory' => $paymentHistory,
        ];
        return view('home.account', $viewData);
    }
}