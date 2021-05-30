 @extends('admin.layout.index')
 @section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Loại Tin
                            <small>{{$loaitin->Ten}}</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="" method="POST">
                        @csrf<!--thêm dòng này dưới mọi form mới gửi dc tin-->
                            <div class="form-group">
                                <label>Thể Loại</label>
                                <select class="form-control" name="theloai">
                                @foreach($theloai as $tl)
                                 <option value="{{$tl->id}}"
                                    @if($loaitin->idTheLoai==$tl->id)
                                       {{"selected"}}
                                    @endif
                                    >{{$tl->Ten}}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Loại Tin</label>
                                <input class="form-control" name="ten" placeholder="nhập tên lại tin" value="{{$loaitin->Ten}}" />
                            </div>
                            
                            <button type="submit" class="btn btn-default">sửa</button>
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