<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AccountController extends Controller
{
    public function index(Request $request)
    {       
        $option = $request->query('option', '1');
        switch ($option) {
            case '1':
                $contentView = 'account.account';
                break;
            case '2':
                $contentView = 'account.info'; 
                break;
            case '3':
                $contentView = 'account.forgetPasswd'; 
                break;
            case '4':
                $contentView = 'account.address'; 
                break; 
            case '5':
                $contentView = 'account.orderHistory'; 
                break;
            default:
                abort(404);
        }
        $viewData = [
            'title' => 'Account',
            'contentView' => $contentView,
            'activeOption' => $option
        ];
        return view('home.account', $viewData);
    }
}
