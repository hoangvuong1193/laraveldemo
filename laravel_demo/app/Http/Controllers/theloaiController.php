<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\theloai;
class theloaiController extends Controller
{
    //
    public function getdanhsach()
    {
        $theloai=theloai::all();
        return view('admin.theloai.danhsach',['dstheloai'=>$theloai]);
    }
    public function getthem()
    {
        return view('admin.theloai.them');
    }
    public function postthem(Request $request)
    {
        //echo $request->ten;
        $this->validate($request,
        [
            'ten'=>'required|min:3|max:100'
        ],
        [
            'ten.required'=>'bạn chưa nhập tên thể loại',
            'ten.min'=>'độ dài tối thiểu là 3 đến 100 kí tự',
            'ten.max'=>'độ dài tối thiểu là 3 đến 100 kí tự',
        ]);
        $theloai= new theloai;
        $theloai->Ten= $request->ten;// tên tron csdl 
        $theloai->TenKhongDau=changeTitle($request->ten);
        //echo changeTitle($request->ten);;
        $theloai->save();
        return redirect('admin/theloai/them')->with('thongbao','thêm thành công');
        
    }
    public function getsua($id)
    {
        $theloai=theloai::find($id);
        
        return view('admin.theloai.sua',['theloai'=>$theloai]);
    }
    public function postsua(Request $request,$id)
    {
        $theloai=theloai::find($id);
        $this->validate($request,
        [
            'ten'=>'required|unique:theloai,ten|min:3|max:100'
        ],
        [
            'ten.unique'=>'tên thể loại đã tồn tại',
            'ten.required'=>'bạn chưa nhập tên thể loại',
            'ten.min'=>'độ dài tối thiểu là 3 đến 100 kí tự',
            'ten.max'=>'độ dài tối thiểu là 3 đến 100 kí tự',
        ]
    );
        $theloai->Ten=$request->ten;
        $theloai->TenKhongDau=changeTitle($request->ten);
        $theloai->save();
        return redirect('admin/theloai/sua/'.$id)->with('thongbao','sửa thành công');
    }
    public function getxoa($id)
    {
        $theloai=theloai::find($id);
        $theloai->delete();
        return redirect('admin/theloai/danhsach')->with('thongbao','xóa thành công');
    }
    
}
