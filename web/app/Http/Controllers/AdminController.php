<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;



class AdminController extends Controller
{
    public function index(){
        return view('layouts.admin');
    }
    public function view()
    {
        $contentView = 'account.account';
        $viewData = [
            'title' => 'Account',
            'contentView' => $contentView,
        ];
        return view('home.account', $viewData);
    }
}