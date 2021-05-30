<?php

use Illuminate\Support\Facades\Route;
use App\Models;
use App\Http\Controller;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



                                        //====admin====//



Route::get('admin/dangnhap','App\Http\Controllers\userController@getdangnhapadmin');
Route::post('admin/dangnhap','App\Http\Controllers\userController@postdangnhapadmin');
Route::get('admin/logout','App\Http\Controllers\userController@getdangxuatadmin');
//tet
/*
    Route::get('thu',function(){
        $theloai=App\Models\theloai::find(1);
        foreach ($theloai->loaitin as $loaitin) 
        {
            echo $loaitin->Ten.'<br>';
        } //test models
        return view('admin.theloai.danhsach');//test giao diện
    });
*/
Route::group(['prefix'=>'admin','middleware'=>'adminLogin'],function(){//adminLogin là biến bên file kernel
    // đường dẫn admin/theloai/
    Route::group(['prefix'=>'theloai'],function(){
        Route::get('danhsach','App\Http\Controllers\theloaiController@getdanhsach');

        Route::get('sua/{id}','App\Http\Controllers\theloaiController@getsua');
        Route::post('sua/{id}','App\Http\Controllers\theloaiController@postsua');

        Route::get('them','App\Http\Controllers\theloaiController@getthem');
        Route::post('them','App\Http\Controllers\theloaiController@postthem');

        Route::get('xoa/{id}','App\Http\Controllers\theloaiController@getxoa');
    });
    // đường dẫn admin/loaitin/
    Route::group(['prefix'=>'loaitin'],function(){
        
        Route::get('danhsach','App\Http\Controllers\loaitinController@getdanhsach');

        Route::get('sua/{id}','App\Http\Controllers\loaitinController@getsua');
        Route::post('sua/{id}','App\Http\Controllers\loaitinController@postsua');

        Route::get('them','App\Http\Controllers\loaitinController@getthem');
        Route::post('them','App\Http\Controllers\loaitinController@postthem');

        Route::get('xoa/{id}','App\Http\Controllers\loaitinController@getxoa');
    });
    // đường dẫn admin/tintuc/
    Route::group(['prefix'=>'tintuc'],function(){
        Route::get('danhsach','App\Http\Controllers\tintucController@getdanhsach');

        Route::get('sua/{id}','App\Http\Controllers\tintucController@getsua');
        Route::post('sua/{id}','App\Http\Controllers\tintucController@postsua');

        Route::get('them','App\Http\Controllers\tintucController@getthem');
        Route::post('them','App\Http\Controllers\tintucController@postthem');
        
        Route::get('xoa/{id}','App\Http\Controllers\tintucController@getxoa');
    });
    // đường dẫn admin/comment/
    Route::group(['prefix'=>'comment'],function(){
        
        Route::get('xoa/{id}/{idtintuc}','App\Http\Controllers\commentController@getxoa');
    });
    // đường dẫn admin/slide/
    Route::group(['prefix'=>'slide'],function(){
        Route::get('danhsach','App\Http\Controllers\slideController@getdanhsach');

        Route::get('sua/{id}','App\Http\Controllers\slideController@getsua');
        Route::post('sua/{id}','App\Http\Controllers\slideController@postsua');

        Route::get('them','App\Http\Controllers\slideController@getthem');
        Route::post('them','App\Http\Controllers\slideController@postthem');
        
        Route::get('xoa/{id}','App\Http\Controllers\slideController@getxoa');
    });
    // đường dẫn admin/user/
    Route::group(['prefix'=>'user'],function(){
        Route::get('danhsach','App\Http\Controllers\userController@getdanhsach');

        Route::get('sua/{id}','App\Http\Controllers\userController@getsua');
        Route::post('sua/{id}','App\Http\Controllers\userController@postsua');

        Route::get('them','App\Http\Controllers\userController@getthem');
        Route::post('them','App\Http\Controllers\userController@postthem');
        
        Route::get('xoa/{id}','App\Http\Controllers\userController@getxoa');
    });
  route::group(['prefix'=>'ajax'],function(){
        route::get('loaitin/{idtheloai}','App\Http\Controllers\AjaxController@getloaitin');
  });
});


//========================================================================================//

//====người dùng====//
/*route::get('trangchu',function(){
    return view('pages.trangchu');
});*/
route::get('trangchu','App\Http\Controllers\PageController@trangchu');
route::get('lienhe','App\Http\Controllers\PageController@lienhe');
route::get('loaitin/{id}/{tenkhongdau}.html','App\Http\Controllers\PageController@loaitin');
route::get('tintuc/{id}/{tenkhongdau}.html','App\Http\Controllers\PageController@tintuc');


route::get('dangnhap','App\Http\Controllers\PageController@getdangnhap');
route::post('dangnhap','App\Http\Controllers\PageController@postdangnhap');

route::get('dangxuat','App\Http\Controllers\PageController@getdangxuat');

route::get('nguoidung','App\Http\Controllers\PageController@getnguoidung');
route::post('nguoidung','App\Http\Controllers\PageController@postnguoidung');

route::get('dangky','App\Http\Controllers\PageController@getdangky');
route::post('dangky','App\Http\Controllers\PageController@postdangky');
//commnet
route::post('comment/{id}','App\Http\Controllers\commentController@postcomment');
//tim kiem tin tuc
route::post('timkiem','App\Http\Controllers\PageController@timkiem');