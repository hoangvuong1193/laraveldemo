@extends('admin.layout.index')<!--kế thừa giao diện của trang index-->
@section('content') <!--lấy nội dung ở đấy truyền cho biến yield có tên content-->
<!-- Page Content -->
    <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">tin tức
                            <small>thêm</small>
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
                    
                        <form action="admin/tintuc/them" method="POST" enctype="multipart/form-data">
                        @csrf
                            <div class="form-group">
                                <label>thể loại</label>
                                <select class="form-control" name="theloai" id="theloai">
                                    @foreach($theloai as $tl)
                                        <option value="{{$tl->id}}">{{$tl->Ten}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>loại tin</label>
                                <select class="form-control" name="loaitin" id="loaitin">
                                @foreach($loaitin as $loai)
                                        <option value="{{$loai->id}}">{{$loai->Ten}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tiêu Đề</label>
                                <input class="form-control" name="tieude" placeholder="nhập tiêu đề" />
                            </div>
                            <div class="form-group">
                                <label>tóm tắt</label>
                                <!--add class cheditor vào-->
                                <textarea class="form-control ckeditor" rows="3" name="tomtat" id="demo" ></textarea>
                            </div>
                            <div class="form-group">
                                <label>nội dung</label>
                                <!--add class cheditor vào-->
                                <textarea class="form-control ckeditor" rows="3" name="noidung" id="demo" ></textarea>
                            </div>
                            <div class="form-group">
                                <label>hình ảnh</label>
                                <!--add class cheditor vào-->
                                <input type="file" name="hinh" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label>nổi bật</label>
                                <label class="radio-inline">
                                    <input name="rdoStatus" value="1" checked="" type="radio">có
                                </label>
                                <label class="radio-inline">
                                    <input name="rdoStatus" value="2" type="radio">không
                                </label>
                            </div>
                            <button type="submit" class="btn btn-default">Thêm</button>
                            <button type="reset" class="btn btn-default">Làm Mới</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
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