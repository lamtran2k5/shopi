<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AccountController extends Controller
{
    public function index(Request $request)
    {
        $viewData = [];
        $viewData["title"] = "Account";
        $option = $request->query('option', 'a'); // mặc định 'a' nếu không truyền
        $content = "";
        $user = Auth::user(); 
        switch ($option) {
            case 'a':
                $content = view('account.info', compact('user'))->render();
                break;
            case 'b':
                $content = view('account.address'); 
                break;
            case 'c':
                $content = view('account.forgetPasswd'); 
                break;
            case 'd':
                $content = view('account.orderHistory'); 
                break; 
            default:
                return "Trang không tồn tại!";
        }
        return view('home.account', ['activeOption' => $option,'content' => $content,'viewData' => $viewData,]);
    }
}
