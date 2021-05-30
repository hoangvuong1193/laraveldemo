<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\loaitin;
use App\Models\theloai;
use App\Models\slide;

class slideController extends Controller
{
    //
    public function getdanhsach()
    {
        $slide=slide::all();
        
        return view('admin.slide.danhsach',['dsslide'=>$slide]);
    }
    public function getthem()
    {
        //return redirect('admin/slide/them');
        return view('admin.slide.them');
    }
    public function postthem(Request $request)
    {
        //echo $request->ten;
        $this->validate($request,
        [
            'ten'=>'required',
            'noidung'=>'required',
            
        ],
        [
            'ten.required'=>'bạn chưa nhập tên slide',
            
            'noidung.required'=>'bạn nhập nội dung'
        ]);
        $slide= new slide;
        $slide->Ten= $request->ten;// tên tron csdl 
        $slide->NoiDung=$request->noidung;
        if($request->has('link'))
        $slide->link=$request->link;

        if($request->hasFile('hinh'))
       {
           $file=$request->file('hinh');
           $duoifile=$file->getClientOriginalExtension();
           if($duoifile!='jpg'&&$duoifile!='png'&&$duoifile!='jpeg')
           {
               return redirect('admin/slide/them')->with('thongbao','không phải file ảnh chọn lại');
           }
           $name=$file->getClientoriginalName();
           $hinh=Str::random(4)."_".$name;
           while(file_exists("upload/slide/".$hinh))
           $hinh=Str::random(4)."_".$name;
           $file->move("upload/slide/",$hinh);//luu hinh vào thư mực
           //unlink("upload/slide/".$slide->Hinh);// xóa file ảnh cũ
           $slide->Hinh=$hinh;

       }
       else
            $slide->Hinh="";
       
        $slide->save();
        //echo changeTitle($request->ten);;
        
        return redirect('admin/slide/them')->with('thongbao','thêm thành công');
        
    }
    public function getsua($id)
    {
        $slide=slide::find($id);
       
        return view('admin.slide.sua',['slide'=>$slide]);
    }
    public function postsua(Request $request,$id)
    {
        
        $this->validate($request,
        [
            'ten'=>'required',
            'noidung'=>'required',
            
        ],
        [
            'ten.required'=>'bạn chưa nhập tên slide',
            
            'noidung.required'=>'bạn nhập nội dung'
        ]);
        $slide= slide::find($id);
        $slide->Ten= $request->ten;// tên tron csdl 
        $slide->NoiDung=$request->noidung;
        if($request->has('link'))
        $slide->link=$request->link;

        if($request->hasFile('hinh'))
        {
           $file=$request->file('hinh');
           $duoifile=$file->getClientOriginalExtension();
           if($duoifile!='jpg'&&$duoifile!='png'&&$duoifile!='jpeg')
           {
               return redirect('admin/slide/sua/'.$slide->id)->with('thongbao','không phải file ảnh chọn lại');
           }
           $name=$file->getClientoriginalName();
           $hinh=Str::random(4)."_".$name;
           while(file_exists("upload/slide/".$hinh))
           $hinh=Str::random(4)."_".$name;
           $file->move("upload/slide/",$hinh);//luu hinh vào thư mực
           unlink("upload/slide/".$slide->Hinh);// xóa file ảnh cũ
           $slide->Hinh=$hinh;
        }
        $slide->save();
        
        return redirect('admin/slide/sua/'.$id)->with('thongbao','sửa thành công');
    }
    public function getxoa($id)
    {
        $slide=slide::find($id);
        $slide->delete();
        return redirect('admin/slide/danhsach')->with('thongbao','xóa thành công');
    }
    
}
