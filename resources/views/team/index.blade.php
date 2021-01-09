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
							<span class="topic">[{{$status[$team->status]}}]</span>
							<a href="team/{{$team->id}}" class="title">{{ucwords($team->title)}}</a>
						</div>
						<div class="time mt-2"><i class="fas fa-calendar-alt mr-1"></i> {{$team->created_at->format('d-m-Y')}}</div>
					</div>
	        		</div>
				</div>
				@endforeach
			
				
			</div>
        </div>
	</div>
	
</div>

@endsection
@section('script')
<script>
var topic_comment = '{{Session::has('delete_team_success')}}';
if (topic_comment) {
    toastr.success('Đã xóa team phượt', '', {
        timeOut: 1800
    })
}
// main.js ->tao team
</script>
@endsection
