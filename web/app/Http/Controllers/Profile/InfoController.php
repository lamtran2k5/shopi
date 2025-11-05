<?php
namespace App\Http\Controllers\Profile;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class InfoController extends Controller
{
    public function view()
    {
        $user = auth()->user();
        $contentView = 'profile.info';
        $viewData = [
            'title' => 'Info',
            'contentView' => $contentView,
            'user' => $user
        ];
        return view('layouts.profile', $viewData);
    }

    public function changeinfo(Request $request) {
        $user = auth()->user();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');
        if ($user instanceof \App\Models\User) {
            $user->save();
        }
        return redirect()->back()->with('success', 'Cập nhật thông tin thành công');
    }
}