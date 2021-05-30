<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\comment;
use App\Models\tintuc;
class commentController extends Controller
{
    //
    
    public function getxoa($id,$idtintuc)
    {
        $comment=comment::find($id);
        $comment->delete();
        return redirect('admin/tintuc/sua/'.$idtintuc)->with('thongbao','xóa commnet thành công');
    }
    public function postcomment($id,Request $request)
    {
        $tintuc= tintuc::find($id);
        $comment= new comment;
        $comment->idTinTuc=$id;
        $comment->idUser=Auth::user()->id;
        
        $comment->NoiDung=$request->noidung;
        $comment->save();
        return redirect('tintuc/'.$id.'/'.$tintuc->TieuDeKhongDau.'.html')->with('thongbao','viết bình luận thành công');
    }
    
}
