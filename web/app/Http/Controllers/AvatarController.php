<?php
namespace App\Http\Controllers;
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
        $contentView = 'account.account';
        $viewData = [
            'title' => 'Avatar',
            'contentView' => $contentView,
        ];
        return view('home.account', $viewData);
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
                $userId = session('user_id');
                $user = $userId ? User::find($userId) : null;
                if ($user->background_image && file_exists($uploadPath . '/' . $user->background_image)) {
                    unlink($uploadPath . '/' . $user->background_image);
                }    
                $tagetImage = 'upload/' . $tagetImage;   
                $user->background_image = $tagetImage;
                $user->save();
                return redirect()->route('home.account');
            } else{
            return redirect()->back()->with('error', 'Có lỗi khi upload file.');
            }
        } else {
            return redirect()->back()->with('error', 'Không có file nào được chọn.');
        }
    }
}
