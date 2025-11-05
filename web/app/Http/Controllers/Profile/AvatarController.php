<?php
namespace App\Http\Controllers\Profile;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;



class AvatarController extends Controller
{
    public function index(){
        return redirect()->route('account.avatar');
    }
    public function view()
    {
        $contentView = 'Profile.Avatar';
        $viewData = [
            'title' => 'Avatar',
            'contentView' => $contentView,
        ];
        return view('layouts.profile', $viewData);
    }

    public function upload(Request $request)
    {
        // Xử lý upload ảnh
        if ($request->isMethod('post') && $request->hasFile('fileToUpload')) {
            $uploadPath = public_path('upload/');

            $imageName = time() . '_' . Str::random(4);
            $parts = explode('.', $_FILES["fileToUpload"]["name"]);
            $ext = end($parts); // => "jpg"

            $allowed = ['jpg', 'jpeg', 'png'];
            if($ext && !in_array($ext, $allowed)) {
                return redirect()->back()->with('error', 'Chỉ nhận file JPG, JPEG, PNG.');
            }

            if ($_FILES["fileToUpload"]["size"] > 5000000) {
                return redirect()->back()->with('error', 'File quá lớn (tối đa 5MB).');
            }
            
            $tagetImage = $imageName.".".$ext;
            if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $uploadPath ."/".$tagetImage)){
                $user = auth()->user();
                if (!$user) return redirect()->route('login');
                if ($user->avatar && file_exists($uploadPath . '/' . $user->avatar)) {
                    unlink($uploadPath . '/' . $user->avatar);
                }    
                $tagetImage = 'upload/' . $tagetImage;   
                $user->avatar = $tagetImage;
                if ($user instanceof \App\Models\User) {
                    $user->save();
                }
                return redirect()->route('profile.avatar');
            } else{
            return redirect()->back()->with('error', 'Có lỗi khi upload file.');
            }
        } else {
            return redirect()->back()->with('error', 'Không có file nào được chọn.');
        }
    }
}
