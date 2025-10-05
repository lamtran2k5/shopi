<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // nhớ import model User

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

        return response("Thông tin đăng nhập không hợp lệ.", 401);
    }
}
