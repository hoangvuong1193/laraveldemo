   @extends('admin.layout.index')
   @section('content')
   <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">tin tức
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
                                <th>tiêu đề</th>
                                <th>Tóm Tắt</th>
                                <th>Thể Loại</th>
                                <th>Loại Tin</th>
                                <th>Xem</th>
                                <th>Nổi Bật</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($tintuc as $tin)
                            <tr class="odd gradeX" align="center">
                                <td>{{$tin->id}}</td>
                                <td><p>{{$tin->TieuDe}}</p>
                                <img src="upload/tintuc/{{$tin->Hinh}}" width="100px"/>
                                </td>
                                <td>{{$tin->TomTat}}</td>
                                <td>{{$tin->loaitin->theloai->Ten}}</td><!-- dựa vào mối liên kết csdl-->
                                <td>{{$tin->loaitin->Ten}}</td>
                                <td>{{$tin->SoLuotXem}}</td>
                                <td>
                                    @if($tin->NoiBat==1)
                                        {{"có"}}
                                    @else
                                        {{"không"}}
                                    @endif
                                </td>
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/tintuc/xoa/{{$tin->id}}"> Delete</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/tintuc/sua/{{$tin->id}}">Edit</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    @endsection