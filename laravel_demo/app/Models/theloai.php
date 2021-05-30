<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class theloai extends Model
{
    use HasFactory;
    protected $table="theloai";
    public function loaitin()
    {
       return $this->hasMany('App\Models\loaitin','idTheLoai','id');
    }
    public function tintuc()
    {
        return $this->hasManyThRough('App\Models\tintuc','App\Models\loaitin','idTheLoai','idLoaiTin','id');//liên kết qua bảng trung gian
    }
}
