<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\tintuc;
use App\Models\theloai;
use App\Models\loaitin;
use App\Models\comment;
class tintucController extends Controller
{
    //
    public function getdanhsach()
    {
        $tintuc=tintuc::orderBy('id','DESC')->get();
        return view('admin.tintuc.danhsach',['tintuc'=>$tintuc]);
    }
    public function getthem()
    {
        $theloai=theloai::all();
        $loaitin=loaitin::all();
       return view('admin.tintuc.them',['theloai'=>$theloai,'loaitin'=>$loaitin]);
    }
    public function postthem(Request $request)
    {
        $this->validate($request,
        [
                'loaitin'=>'required',//name truyền sang
                'tieude'=>'required|min:3|max:100|unique:Tintuc,TieuDe',// trỏ tới cột trong csdl của models
                'tomtat'=>'required',
                'noidung'=>'required',
        ],
        [
                'loaitin.required'=>'bạn chưa nhập loại tin',
                'tieude.required'=>'bạn chưa nhập tiêu đề',
                'tieude.min'=>'tiêu đề tối tiểu 3 kí tự',
                'tieude.unique'=>'tiêu đề đã tồn tại',
                'tomtat.required'=>'bạn chưa nhập tóm tắt',
                'noidung.required'=>'bạn chưa nhập nội dung',

        ]);
        $tintuc= new tintuc;
        $tintuc->TieuDe=$request->tieude;
        $tintuc->TieuDeKhongDau=changeTitle($request->tieude);
        $tintuc->idLoaiTin=$request->loaitin;
        $tintuc->TomTat=$request->tomtat;
        $tintuc->NoiDung=$request->noidung;
        if($request->hasFile('hinh'))
        {
            $file=$request->file('hinh');
            $duoifile=$file->getClientOriginalExtension();
            if($duoifile!='jpg'&&$duoifile!='png'&&$duoifile!='jpeg')
            {
                return redirect('admin/tintuc/them')->with('thongbao','không phải file ảnh chọn lại');
            }
            $name=$file->getClientoriginalName();
            $hinh=Str::random(4)."_".$name;
            while(file_exists("upload/tintuc/".$hinh))
            $hinh=Str::random(4)."_".$name;
            $file->move("upload/tintuc/",$hinh);//luu hinh vào thư mực
            $tintuc->Hinh=$hinh;
        }
        else
            $tintuc->Hinh="";
        $tintuc->save();
        return redirect('admin/tintuc/them')->with('thongbao','đã thêm tin tức thành công');
        //tại sao dùng redirect không dùng view ở đây vì
        // redirect gọi đến đường dẫn chỉ dẫn đến route rồi gọi đến pt get 
        //từ get đó mới trỏ đến view và truyền tham số cần thiết
        // còn view thì gọi trục tiếp đến view đó luôn
        // nếu dùng view ở đây phải truyền lại tham số k bên view sẽ bị lỗi
    }
    public function getsua($id)
    {
        $tintuc=tintuc::find($id);
        $theloai=theloai::all();
        $loaitin=loaitin::all();
       return view('admin.tintuc.sua',['tintuc'=>$tintuc,'theloai'=>$theloai,'loaitin'=>$loaitin]);
    }
    public function postsua(Request $request,$id)
    {
      
       $this->validate($request,
       [
               'loaitin'=>'required',//name truyền sang
               'tieude'=>'required|min:3|max:100|unique:Tintuc,TieuDe',// trỏ tới cột trong csdl của models
               'tomtat'=>'required',
               'noidung'=>'required',
       ],
       [
               'loaitin.required'=>'bạn chưa nhập loại tin',
               'tieude.required'=>'bạn chưa nhập tiêu đề',
               'tieude.min'=>'tiêu đề tối tiểu 3 kí tự',
               'tieude.unique'=>'tiêu đề đã tồn tại',
               'tomtat.required'=>'bạn chưa nhập tóm tắt',
               'noidung.required'=>'bạn chưa nhập nội dung',

       ]);
       $tintuc=tintuc::find($id);
       
       $tintuc->TieuDe=$request->tieude;
       $tintuc->TieuDeKhongDau=changeTitle($request->tieude);
       $tintuc->idLoaiTin=$request->loaitin;
       $tintuc->TomTat=$request->tomtat;
       $tintuc->NoiDung=$request->noidung;
       if($request->hasFile('hinh'))
       {
           $file=$request->file('hinh');
           $duoifile=$file->getClientOriginalExtension();
           if($duoifile!='jpg'&&$duoifile!='png'&&$duoifile!='jpeg')
           {
               return redirect('admin/tintuc/them')->with('thongbao','không phải file ảnh chọn lại');
           }
           $name=$file->getClientoriginalName();
           $hinh=Str::random(4)."_".$name;
           while(file_exists("upload/tintuc/".$hinh))
           $hinh=Str::random(4)."_".$name;
           $file->move("upload/tintuc/",$hinh);//luu hinh vào thư mực
           unlink("upload/tintuc/".$tintuc->Hinh);// xóa file ảnh cũ
           $tintuc->Hinh=$hinh;
       }
       
       $tintuc->save();
       return redirect('admin/tintuc/sua/'.$id)->with('thongbao','đã sửa tin tức thành công');
    }
    public function getxoa($id)
    {
        $tintuc=tintuc::find($id);
        $tintuc->delete();
        return redirect('admin/tintuc/danhsach')->with('thongbao','đã xóa tin tức '.$id.' thành công');
    }
    
}
