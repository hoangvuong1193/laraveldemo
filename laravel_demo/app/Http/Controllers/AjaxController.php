<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\loaitin;
use App\Models\theloai;
class AjaxController extends Controller
{
    //
    public function getloaitin($idtheloai)
    {
        $loaitin=loaitin::where('idTheLoai',$idtheloai)->get();
        foreach($loaitin as $loai)
               echo '<option value="'.$loai->id.'">'.$loai->Ten.'</option>';
        
    }
    
}
