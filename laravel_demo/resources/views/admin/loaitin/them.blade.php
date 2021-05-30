@extends('admin.layout.index')<!--kế thừa giao diện của trang index-->
@section('content') <!--lấy nội dung ở đấy truyền cho biến yield có tên content-->
<!-- Page Content -->
    <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">loại tin
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
                    
                        <form action="admin/loaitin/them" method="POST">
                        @csrf
                            <div class="form-group">
                                <label>thể loại</label>
                                <select class="form-control" name="theloai">
                                @foreach($theloai as $tl)
                                    <option value="{{$tl->id}}">{{$tl->Ten}}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>tên loại tin</label>
                                <input class="form-control" name="ten" placeholder="nhập tên loại tin" />
                            </div>
                          
                            <button type="submit" class="btn btn-default">thêm</button>
                            <button type="reset" class="btn btn-default">làm mới</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

@endsection