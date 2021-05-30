<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\comment;
use App\Models\User;

class userController extends Controller
{
    //============admin=============//
    public function getdanhsach()
    {
        $user=User::all();
        return view('admin.user.danhsach',['user'=>$user]);
    }
    public function getthem()
    {
        return view('admin.user.them');
    }
    public function postthem(Request $request)
    {
        $this->validate($request,
        [
            'ten'=>'required|min:3',
            'email'=>'required|unique:users,email',//kiểm tra email trong csdl có bị trùng k chú ý tên bảng phải đúng csdl
            'password'=>'required|min:3|max:32',
            'passwordagain'=>'required|same:password'
        ],
        [
            'ten.required'=>'bạn chưa nhập tên người dùng',
            'ten.min'=>'tên người dùng tối thiểu 3 kí tự',
            'email.required'=>'bạn chưa nhập email',
            'email.unique'=>'đã tồn tại email',
            'password.required'=>'bạn chưa nhập password',
            'password.min'=>'password tối thiểu 3 kí tự tối đa 32 kí tự',
            'password.max'=>'password tối thiểu 3 kí tự tối đa 32 kí tự',
            'passwordagain.required'=>'bạn chưa nhập lại password',
            'passwordagain.same'=>'bạn nhập chưa khớp password',

        ]);
        $user= new User;
        $user->name=$request->ten;
        $user->email=$request->email;
        $user->password=bcrypt($request->password);
        $user->quyen=$request->rdoquyen;
        $user->save();
        return redirect('admin/user/them')->with('thongbao','thêm thành công');
        //echo $request->rdoquyen;
    }
    public function getsua($id)
    {
       $user= user::find($id);
       return view('admin.user.sua',['user'=>$user]);
    }
    public function postsua(Request $request,$id)
    {
        
        $this->validate($request,
        [
            'ten'=>'required|min:3',
            
        ],
        [
            'ten.required'=>'bạn chưa nhập tên người dùng',
            'ten.min'=>'tên người dùng tối thiểu 3 kí tự',
            
        ]);
        $user=User::find($id);
        $user->name=$request->ten;
        //$user->email=$request->email;
        if($request->changpass=="on")
        { $this->validate($request,
            [
                
                'password'=>'required|min:3|max:32',
                'passwordagain'=>'required|same:password'
            ],
            [
               
                'password.required'=>'bạn chưa nhập password',
                'password.min'=>'password tối thiểu 3 kí tự tối đa 32 kí tự',
                'password.max'=>'password tối thiểu 3 kí tự tối đa 32 kí tự',
                'passwordagain.required'=>'bạn chưa nhập lại password',
                'passwordagain.same'=>'bạn nhập chưa khớp password',
    
            ]);
            $user->password=bcrypt($request->password);

        }
       
        $user->quyen=$request->rdoquyen;
        $user->save();
        return redirect('admin/user/sua/'.$id)->with('thongbao','bạn đã sửa thành công');
        
    }
    public function getxoa($id)
    {
        $slide=user::find($id);
        $slide->delete();
        return redirect('admin/user/danhsach')->with('thongbao','xóa thành công');
    }
    //dăng nhập
    public function getdangnhapadmin()
    {

        return view('admin.login');
    }
    public function postdangnhapadmin(Request $request)
    {


        $this->validate($request,
        [
            'email'=>'required',
            'password'=>'required|min:3|max:32',
        ],
        [
            'email.required'=>'bạn chưa nhập email',
            'password.required'=>'bạn chưa nhập password',
            'password.min'=>'password tối thiểu 3 kí tự và tối đa 32 kí tự',
            'password.max'=>'password tối thiểu 3 kí tự và tối đa 32 kí tự',
        ]);
        
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password]))//kiểm tra đang nhap
            return redirect('admin/theloai/danhsach');
        else
            return  redirect('admin/dangnhap')->with('thongbao','đăng nhập không thành công');
    }
    public function getdangxuatadmin()
    {
        Auth::logout();
        return  redirect('admin/dangnhap');
    }
    
   
}
