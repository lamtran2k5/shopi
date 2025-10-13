<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;


class InfoController extends Controller
{
    public function view()
    {
        $userId = session('user_id'); // hoặc Auth::id() nếu dùng auth
        $user = User::find($userId);
        $contentView = 'account.info';
        $viewData = [
            'title' => 'Info',
            'contentView' => $contentView,
            'user' => $user
        ];
        return view('home.account', $viewData);
    }

    public function changeinfo(Request $request) {
        $userId = $request->session()->get('user_id');
        $user = User::find($userId);
        $user->full_name = $request->input('full_name');
        $user->email = $request->input('email');
        $user->sdt = $request->input('sdt');
        $user->sex = $request->input('sex');
        $user->address = $request->input('address');
        $user->save();
        return redirect()->back()->with('error', 'Cập nhật thông tin thành công');
    }
}