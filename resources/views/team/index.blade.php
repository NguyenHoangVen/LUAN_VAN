@extends('layouts.index')
@section('content')

<div id="content">
	
	<div class="container" id="team">
		<!-- require header team -->
		@include('team.header_team')
        <!-- danh sach cac team phuot -->
        <div class="row">
        	<div class="col-12">
        		<div class="card card-primary card-outline">
	              	<div class="card-header">
	                <h3 class="card-title">Team phượt tạo gần đây</h3>
	                  
	                
	              	</div>
	              
	              <!-- /.card-body-->
	            </div>
        	</div>
        </div>
        <div class="card p-2">
			<div class="row">
				@foreach($teams as $team)
				<div class="col-lg-6 col-md-12">
	        		<div class="team-item d-flex">
	        			<a href="" class="avatar d-block mr-3"><img class="img-50" src="image/image_avatar/{{$team->user->avatar}}" alt=""></a>
					<div class="info-desc">
						<div class="topic-title">
							@if($team->status == 0)
							<span class="topic">[chưa chốt đoàn]</span>
							@else
							<span class="topic">[đã chốt đoàn]</span>
							@endif
							<a href="team/{{$team->id}}" class="title">{{ucwords($team->title)}}</a>
						</div>
						<div class="time mt-2"><i class="fas fa-calendar-alt mr-1"></i> {{$team->created_at->format('d-m-Y')}}</div>
					</div>
	        		</div>
				</div>
				@endforeach
				@for($i=1;$i<=10;$i++)
				<div class="col-lg-6 col-md-12">
	        		<div class="team-item d-flex">
	        			<a href="" class="avatar d-block mr-3"><img class="img-50" src="https://img3.thuthuatphanmem.vn/uploads/2019/06/08/hinh-nen-hotgirl-duyen-dang_125438813.jpg" alt=""></a>
					<div class="info-desc">
						<div class="topic-title">
							<span class="topic">[chưa chốt đoàn]</span>
							<a href="?page=detail_post_forum" class="title">Mien Nam than thuong Lập team, tìm bạn đồng hành trên mọi nẽo đường</a>
						</div>
						<div class="time mt-2"><i class="fas fa-calendar-alt mr-1"></i> 10/13/2020</div>
					</div>
	        		</div>
				</div>
				@endfor
				
			</div>
        </div>
	</div>
	
</div>

@endsection
