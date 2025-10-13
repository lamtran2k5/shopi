<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // nhớ import model User
use App\Models\Wallet;

class AuthController extends Controller
{
    // Hiển thị form login
    public function showLoginForm()
    {
        return view('auth.login');
    }
    // Xử lý đăng nhập
    public function login(Request $request)
    {
        // Lấy user từ DB theo username
        $user = User::where('username', $request->username)->first();

        // Kiểm tra user tồn tại và mật khẩu đúng
        if ($user && Hash::check($request->password, $user->password)) {
            // Lưu user id vào session
            $request->session()->put('user_id', $user->id);
            $request->session()->put('username', $user->username);
            return redirect()->route('home.index');
        }
        return back()->with('error', 'Error username or password'); 
    }

    // Hiển thị form đưang ký
    public function showRegisterForm()
    {
        return view('auth.register');
    }
    // Xử lý đăng ký
    public function register(Request $request)
    {
        $user = new User();
        // Kiểm tra username đã tồn tại chưa
        $exists = User::where('username', $request->username)->exists();
        if($exists){
            return back()->with('error', 'Username exists!');
        }elseif ($request->role == 1) {
            return back()->with('error', 'Hack detected'); 
        }else{
            $user -> role_id = $request->role;
        }
        do {
            $wallet_number =  (string)rand(100000000, 999999999); // 9 chữ số
            $exists = Wallet::where('wallet_number', $wallet_number)->exists();
        } while ($exists);

        Wallet::create([
            'wallet_number' => $wallet_number,
            'wallet_balance' => 0,
]       );
        $user->fill([
            'username' => $request->username,
            'email'    => $request->email,
            'password' => $request->password,
            'wallet_number' => $wallet_number,
        ]);
        $user->save();

        return redirect()->route('login.form');
    }
}
