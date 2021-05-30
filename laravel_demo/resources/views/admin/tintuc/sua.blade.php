@extends('admin.layout.index')<!--kế thừa giao diện của trang index-->
@section('content') <!--lấy nội dung ở đấy truyền cho biến yield có tên content-->
<!-- Page Content -->
    <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">tin tức
                            <small>{{$tintuc->TieuDe}}</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">

                    @if(count($errors) > 0)<!--check loi-->
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $err)
                                {{$err}}<br>
                            @endforeach
                        </div>
                    @endif
                    @if(session('thongbao'))
                    <div class="alert alert-success">
                            {{session('thongbao')}}
                        </div>
                    @endif
                    
                        <form action="admin/tintuc/sua/{{$tintuc->id}}" method="POST" enctype="multipart/form-data">
                        @csrf
                            <div class="form-group">
                                <label>thể loại</label>
                                <select class="form-control" name="theloai" id="theloai">
                                    @foreach($theloai as $tl)
                                    <option value="{{$tl->id}}"
                                    @if($tintuc->loaitin->theloai->id==$tl->id)
                                        {{"selected"}}
                                    @endif
                                       >{{$tl->Ten}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>loại tin</label>
                                <select class="form-control" name="loaitin" id="loaitin">
                                @foreach($loaitin as $loai)
                                        <option 
                                        @if($tintuc->loaitin->id==$loai->id)
                                        {{"selected"}}
                                        @endif
                                        value="{{$loai->id}}">{{$loai->Ten}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tiêu Đề</label>
                                <input class="form-control" name="tieude" value="{{$tintuc->TieuDe}}" placeholder="nhập tiêu đề" />
                            </div>
                            <div class="form-group">
                                <label>tóm tắt</label>
                                <!--add class cheditor vào-->
                                <textarea class="form-control ckeditor" rows="3" name="tomtat" id="demo" >
                                {{$tintuc->TomTat}}
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label>nội dung</label>
                                <!--add class cheditor vào-->
                                <textarea class="form-control ckeditor" rows="3" name="noidung" id="demo" >
                                {{$tintuc->NoiDung}}
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label>hình ảnh</label>
                                <p>
                                <img width=300px;  src="upload/tintuc/{{$tintuc->Hinh}}" />
                                </p>
                                <!--add class cheditor vào-->
                                <input type="file" name="hinh" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label>nổi bật</label>
                                <label class="radio-inline">
                                    <input name="rdoStatus" value="1" @if($tintuc->NoiBat == 1 ) {{"checked"}} @endif type="radio">có
                                </label>
                                <label class="radio-inline">
                                    <input name="rdoStatus" value="2" @if($tintuc->NoiBat == 0 ) {{"checked"}} @endif type="radio">không
                                </label>
                            </div>
                            <button type="submit" class="btn btn-default">Thêm</button>
                            <button type="reset" class="btn btn-default">Làm Mới</button>
                        <form>
                    </div>
                </div>
                
                <!-- /.row -->
                                                          <!--comment-->
        <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">bình luận
                            <small>danh sách</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    @if(session('thongbao'))
                    <div class="alert alert-success">
                            {{session('thongbao')}}
                        </div>
                    @endif
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Người Dùng</th>
                                <th>Nội Dung</th>
                                <th>Ngày Đăng</th>
                                <th>Delete</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($tintuc->comment as $cm)
                            <tr class="odd gradeX" align="center">
                                    <td>{{$cm->id}}</td>
                                    <td>{{$cm->User->name}}</td>
                                    <td>{{$cm->NoiDung}}</td>
                                    <td>{{$cm->created_at}}</td>
                                    <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/comment/xoa/{{$cm->id}}/{{$tintuc->id}}"> Delete</a></td>
                             </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>
            <!--/row-->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

       @endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function(){
            $("#theloai").change(function(){
                var idtheloai=$(this).val();
                //alert(idtheloai);
                $.get("admin/ajax/loaitin/"+idtheloai,function(data)//gọi đến đường dẫn để gọi route=>controller
                {
                    $("#loaitin").html(data);//lấy data bên controller ajax loại tin đổ vào id loại tin
                });
            });
        });
    </script>
@endsection