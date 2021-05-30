@extends('admin.layout.index')<!--kế thừa giao diện của trang index-->
@section('content') <!--lấy nội dung ở đấy truyền cho biến yield có tên content-->
<!-- Page Content -->
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">slide
                            <small>sửa</small>
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

                        <form action="admin/slide/sua/{{$slide->id}}" method="POST" enctype="multipart/form-data">
                        @csrf
                          
                            <div class="form-group">
                                <label>Tên</label>
                                <input class="form-control" name="ten" value="{{$slide->Ten}}" placeholder="nhập tên"/>
                            </div>
                            <div class="form-group">
                                <label>nội dung</label>
                                <!--add class cheditor vào-->
                                <textarea class="form-control ckeditor" rows="3" name="noidung" id="demo" >
                                    {{$slide->NoiDung}}
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label>hình ảnh</label>
                                <!--add class cheditor vào-->
                                <p><img width="400px" src="upload/slide/{{$slide->Hinh}}"/></p>
                                <input type="file" name="hinh" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label>link</label>
                                <input class="form-control" name="link" value="{{$slide->link}}" placeholder="nhập link" />
                            </div>
                            
                            <button type="submit" class="btn btn-default">sửa</button>
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