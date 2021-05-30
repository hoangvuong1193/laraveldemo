<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class loaitin extends Model
{
    use HasFactory;
    protected $table="loaitin";
    public function theloai()
    {
        return $this->belongsTo('App\models\theloai','idTheLoai','id');// viết đúng trường theo csdl
    }
    public function tintuc()
    {
        return $this->hasMany('App\Models\tintuc','idLoaiTin','id');
    }
}
