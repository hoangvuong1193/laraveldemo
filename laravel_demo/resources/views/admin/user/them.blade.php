@extends('admin.layout.index')<!--kế thừa giao diện của trang index-->
@section('content') <!--lấy nội dung ở đấy truyền cho biến yield có tên content-->
<!-- Page Content -->
    <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">User
                            <small>thêm</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
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
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="admin/user/them" method="POST">
                        @csrf
                            <div class="form-group">
                                <label>Tên</label>
                                <input class="form-control" name="ten" placeholder="nhập tên" />
                            </div>
                            <div class="form-group">
                                <label>email</label>
                                <input class="form-control" type="email" name="email" placeholder="nhập địa chỉ email" />
                            </div>
                            <div class="form-group">
                                <label>password</label>
                                <input class="form-control" name="password" placeholder="nhập password" type="password" />
                            </div>
                            <div class="form-group">
                                <label>nhập lại password</label>
                                <input class="form-control" name="passwordagain" placeholder="nhập lại password" type="password" />
                            </div>
                           
                            <div class="form-group">
                                <label>quyền người dùng</label>
                                <label class="radio-inline">
                                    <input name="rdoquyen" value="1" type="radio">admin
                                </label>
                                <label class="radio-inline">
                                    <input name="rdoquyen" value="0" checked="" type="radio">thường
                                </label>
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