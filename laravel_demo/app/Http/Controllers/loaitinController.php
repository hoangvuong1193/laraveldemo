<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\loaitin;
use App\Models\theloai;
class loaitinController extends Controller
{
    //
    public function getdanhsach()
    {
        $loaitin=loaitin::all();
        
        return view('admin.loaitin.danhsach',['dsloaitin'=>$loaitin]);
    }
    public function getthem()
    {
        $theloai=theloai::all();
        return view('admin.loaitin.them',['theloai'=>$theloai]);
    }
    public function postthem(Request $request)
    {
        //echo $request->ten;
        $this->validate($request,
        [
            'ten'=>'required|unique:loaitin,Ten|min:3|max:100',
            'theloai'=>'required'// mảng check lỗi
        ],
        [
            'ten.required'=>'bạn chưa nhập tên thể loại',
            'ten.min'=>'độ dài tối thiểu là 3 đến 100 kí tự',
            'ten.unique'=>'đã tồn tại loại tin',
            'ten.max'=>'độ dài tối thiểu là 3 đến 100 kí tự',// mảng thông báo lỗi
            'ten.required'=>'bạn chưa chọn thể loại'
        ]);
        $loaitin= new loaitin;
        $loaitin->Ten= $request->ten;// tên tron csdl 
        $loaitin->TenKhongDau=changeTitle($request->ten);
        $loaitin->idTheLoai=$request->theloai;
        //echo changeTitle($request->ten);;
        $loaitin->save();
        return redirect('admin/loaitin/them')->with('thongbao','thêm thành công');
        
    }
    public function getsua($id)
    {
        $loaitin=loaitin::find($id);
        $theloai=theloai::all();
        return view('admin.loaitin.sua',['loaitin'=>$loaitin,'theloai'=>$theloai]);
    }
    public function postsua(Request $request,$id)
    {
        $loaitin=loaitin::find($id);
        $this->validate($request,
        [
            'ten'=>'required|unique:loaitin,Ten|min:3|max:100',
            'theloai'=>'required'// mảng check lỗi
        ],
        [
            'ten.required'=>'bạn chưa nhập tên thể loại',
            'ten.min'=>'độ dài tối thiểu là 3 đến 100 kí tự',
            'ten.unique'=>'đã tồn tại loại tin',
            'ten.max'=>'độ dài tối thiểu là 3 đến 100 kí tự',// mảng thông báo lỗi
            'ten.required'=>'bạn chưa chọn thể loại'
        ]);
        $loaitin->Ten=$request->ten;
        $loaitin->TenKhongDau=changeTitle($request->ten);
        $loaitin->idTheLoai=$request->theloai;//mọi $request đều trỏ đến name dc khai báo bên form theloai là tên name select
        $loaitin->save();
        return redirect('admin/loaitin/sua/'.$id)->with('thongbao','sửa thành công');
    }
    public function getxoa($id)
    {
        $loaitin=loaitin::find($id);
        $loaitin->delete();
        return redirect('admin/loaitin/danhsach')->with('thongbao','xóa thành công');
    }
    
}
