 @extends('layout.index')
 @section('content')
 <!-- Page Content -->
    <div class="container">

    	<!-- slider -->
    		@include('layout.slide')
        <!-- end slide -->

        <div class="space20"></div>


        <div class="row main-left">
			<!--menu-->
            	@include('layout.menu')
			<!--end menu-->
            <div class="col-md-9">
	            <div class="panel panel-default">            
	            	<div class="panel-heading" style="background-color:#337AB7; color:white;" >
	            		<h2 style="margin-top:0px; margin-bottom:0px;">Laravel Tin Tức</h2>
	            	</div>

	            	<div class="panel-body">
	            		<!-- item -->
						<!--lấy ra thể loại có loại tin-->
						@foreach($theloai as $tl)
							@if(count($tl->loaitin))
								<div class="row-item row">
									<h3>
										<a href="category.html">{{$tl->Ten}}</a> | 	
										<!--lấy ra loại tin thuộc thể loại đó-->
										@foreach($tl->loaitin as $lt)
											<small><a href="loaitin/{{$lt->id}}/{{$lt->TenKhongDau}}.html"><i>{{$lt->Ten}}</i></a>/</small>
										@endforeach
									</h3>

									<?php 	
										// lấy 5 tin tức nổi bật mới nhất
										$data=$tl->tintuc->where('NoiBat',1)->sortByDesc('created_at')->take(5);
 										$tintuc1=$data->shift();// lấy 1 tin
									?>
									<!--tin nổi bật đầu tiên-->
									<div class="col-md-8 border-right">
										<div class="col-md-5">
											<a href="tintuc/{{$tintuc1['id']}}/{{$tintuc1['TieuDeKhongDau']}}.html">
												<img class="img-responsive" src="upload/tintuc/{{$tintuc1->Hinh}}" alt="{{$tintuc1->NoiDung}}">
											</a>
										</div>

										<div class="col-md-7">
											<h3>{{$tintuc1->TieuDe}}</h3>
											<p>{{$tintuc1->TomTat}}</p>
											<a class="btn btn-primary" href="tintuc/{{$tintuc1['id']}}/{{$tintuc1['TieuDeKhongDau']}}.html">xem thêm<span class="glyphicon glyphicon-chevron-right"></span></a>
										</div>

									</div>
									
 									<!--4 tin nổi bật bên trái trang chủ-->
									 @foreach($data as $tintuc)
									<div class="col-md-4">
										<a href="tintuc/{{$tintuc['id']}}/{{$tintuc['TieuDeKhongDau']}}.html">
											<h4>
												<span class="glyphicon glyphicon-list-alt"></span>
												{{$tintuc->TieuDe}}
											</h4>
										</a>
									</div>
									@endforeach
									<div class="break"></div>
								</div>
							@endif
						@endforeach
		                <!-- end item -->
		               

					</div>
	            </div>
        	</div>
        </div>
        <!-- /.row -->
    </div>
    <!-- end Page Content -->

@endsection
