<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class AuthController extends Controller
{
    // Hiển thị form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

// Xử lý login
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Lấy user từ DB
        $user = DB::table('users')->where('username', $request->username)->first();

        if ($user) {
            // So sánh mật khẩu (giả sử DB lưu hash md5)
            if (md5($request->password) === $user->password_hash) {
                // Lưu session đơn giản
                session(['user_id' => $user->id, 'username' => $user->username]);

                return redirect('/'); // Chuyển hướng về trang chính
            } else {
                return back()->withErrors(['password' => 'Sai mật khẩu']);
            }
        } else {
            return back()->withErrors(['username' => 'Không tìm thấy tài khoản']);
        }
    }
}