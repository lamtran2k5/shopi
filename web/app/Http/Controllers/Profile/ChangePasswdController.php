<?php
namespace App\Http\Controllers\Profile;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class ChangePasswdController extends Controller
{
    public function view()
    {
        $contentView = 'profile.changePasswd';
        $viewData = [
            'title' => 'Change Password',
            'contentView' => $contentView,
        ];
        return view('layouts.profile', $viewData);
    }


    public function changepasswd(Request $request)
    {
        // 1️⃣ Validate dữ liệu từ form
        $request->validate([
            'crpasswd' => 'required',
            'newpasswd' => 'required|min:8',
        ]);

        $user = Auth::user(); // Lấy user hiện tại

        // 2️⃣ Kiểm tra mật khẩu hiện tại có đúng không
        if (!Hash::check($request->crpasswd, $user->password)) {
            return back()->withErrors(['crpasswd' => 'Mật khẩu hiện tại không đúng.']);
        }

        // 3️⃣ Cập nhật mật khẩu mới
        $user->password = Hash::make($request->newpasswd);
        if ($user instanceof \App\Models\User) {
            $user->save();
        }

        // 4️⃣ Trả về thông báo
        return back()->with('success', 'Đổi mật khẩu thành công!');
    }
}