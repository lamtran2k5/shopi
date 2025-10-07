<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;



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

    public function upload(Request $request)
    {
        // Xử lý upload ảnh
        if ($request->isMethod('post') && $request->hasFile('fileToUpload')) {
            $uploadPath = public_path('upload/');

            $imageName = time() . '_' . Str::random(4);
            $parts = explode('.', $_FILES["fileToUpload"]["name"]);
            $ext = end($parts); // => "jpg"

            $allowed = ['jpg', 'jpeg', 'png', 'gif'];
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
                $img_bg = $tagetImage;
                $user->background_image = $img_bg;
                $user->save();
                return redirect()->route('home.account');
            } else{
            return redirect()->back()->with('error', 'Không có file nào được chọn.');
            }
        } else {
            return redirect()->back()->with('error', 'Không có file nào được chọn.');
        }
    }
}
