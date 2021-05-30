<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\theloai;
use App\Models\slide;
use App\Models\tintuc;
use App\Models\loaitin;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class PageController extends Controller
{
    //
    function __construct()//khởi tạo khi chạy page controller 
    {
        $theloai= theloai::all();
        view()->share('theloai',$theloai);//sẽ truyền sang tất cả view biến thể loại

        $slide=slide::all();//lấy tất cả dữ liệu slide trong thông qua models
        view()->share('slide',$slide);

        //kiểm tra đang nhập
       // if(Auth::check())
            //view()->share('nguoidung',Auth::user());

    }
    function trangchu()
    {
        
        return view('pages.trangchu');
    }
    function lienhe()
    {
       
        return view('pages.lienhe');
    }
    function loaitin($id)
    {
        $loaitin=loaitin::find($id);
        $tintuc=tintuc::where('idLoaiTin',$id)->paginate(5);
        //lấy tin tức có id= id loại tin rồi 
        //phần trang 5 tin trên 1 trang
        return view('pages.loaitin',['loaitin'=>$loaitin,'tintuc'=>$tintuc]);
    }
    public function tintuc($id)
    {
        $tintuc=tintuc::find($id);
        $tinnoibat=tintuc::where('NoiBat',1)->take(5)->get();//take là lấy ra có 5 tin
        $tinlienquan=tintuc::where('idLoaiTin',$tintuc->idLoaiTin)->take(4)->get();
        return view('pages.tintuc',['tintuc'=>$tintuc,'tinnoibat'=>$tinnoibat,'tinlienquan'=>$tinlienquan]);
    }
     //==============người dùng===============//
     public function getdangnhap()
     {
         return view('pages.dangnhap');
     }
     public function postdangnhap(Request $request)
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
             return redirect('trangchu');
         else
             return  redirect('dangnhap')->with('thongbao','đăng nhập không thành công');
     }
     public function getdangxuat()
     {
         Auth::logout();
         return  redirect('dangnhap');
     }
     public function getnguoidung()
     {
        if(Auth::check())
            return view('pages.nguoidung');
        else
            return redirect('dangnhap');
     }
     public function postnguoidung(Request $request)
     {
        $this->validate($request,
        [
            'ten'=>'required|min:3',
            
        ],
        [
            'ten.required'=>'bạn chưa nhập tên người dùng',
            'ten.min'=>'tên người dùng tối thiểu 3 kí tự',
            
        ]);
        $user=Auth::user();
        $user->name=$request->ten;
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
        $user->save();
        return redirect('nguoidung')->with('thongbao','bạn đã sửa thành công');
     }

     public function getdangky()
     {
         return view('pages.dangky');
     }
     public function postdangky(Request $request)
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
        $user->quyen=0;
        $user->save();
        
        return redirect('dangnhap')->with('thongbao','chúc mừng đăng kí thành công');
     }
     public function timkiem(Request $request)
     {
        $tukhoa=$request->tukhoa;
        $tintuc=tintuc::where('TieuDe','like',"%$tukhoa%")
        ->orwhere('TomTat','like',"%$tukhoa%")
        ->orwhere('NoiDung','like',"%$tukhoa%")//or là kết hợp các điều kiện 
        ->take(30)// lấy ra 30 tin
        ->paginate(5);//5 tin =>1 trang

        return view('pages.timkiem',['tintuc'=>$tintuc,'tukhoa'=>$tukhoa]);
     }
}
