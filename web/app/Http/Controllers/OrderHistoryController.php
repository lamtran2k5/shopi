<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;


class OrderHistoryController extends Controller
{
    public function index()
    {
        $userId = session('user_id'); 
        $user = User::find($userId);
        $contentView = 'account.info';
        $viewData = [
            'title' => 'Info',
            'contentView' => $contentView,
            'user' => $user
        ];
        return view('home.account', $viewData);
    }
}