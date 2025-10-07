<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;



class ChangePasswdController extends Controller
{
    public function view()
    {
        $contentView = 'account.changePasswd';
        $viewData = [
            'title' => 'Change Password',
            'contentView' => $contentView,
        ];
        return view('home.account', $viewData);
    }

    public function changepasswd(Request $request) {
        // Tạo OTP
        //session()->flush();  
        $otp = $request->session()->get('otp');
        $otpExpire = $request->session()->get('otp_expire');
        if(!$otp || !$otpExpire || now()->gt($otpExpire)){
            $otp = rand(100000, 999999);
            session(['otp' => $otp]);
            $request->session()->put('otp_expire', now()->addMinutes(1));
            return response()->json(['otp' => $otp]);
        }
        $userId = $request->session()->get('user_id');
        $user = User::find($userId);
        if ($request->input('otp') != session('otp')) {
            return redirect()->back()->with('error', 'Sai mã OTP');
        } else if(!Hash::check($request->input('crpasswd'),$user->password)){
            return redirect()->back()->with('error', 'Sai mật khẩu');
        } else {
            $user->password = ($request->input('newpasswd'));
            $user->save();
            return redirect()->back()->with('error', 'Đổi mật khẩu thành công');
        }
    }
}