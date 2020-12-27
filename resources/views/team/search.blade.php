@extends('layouts.index')
@section('content')

<div id="content">

    <div class="container" id="team">
        @include('team.header_team')
        <!-- danh sach cac team phuot -->
        <div class="row">
            <div class="col-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Tìm thấy được {{count($teams)}} kết quả từ <b>{{$key}}</b></h3>
                    </div>

                    <!-- /.card-body-->
                </div>
            </div>
        </div>
		@if(count($teams) > 0)
        <div class="card p-2">
		
            <div class="row">
                @foreach($teams as $team)
                <div class="col-lg-6 col-md-12">
                    <div class="team-item d-flex">
                        <a href="user/{{$team->user->id}}/info" class="avatar d-block mr-3"><img class="img-50"
                                src="image/image_avatar/{{$team->user->avatar}}" alt=""></a>
                        <div class="info-desc">
                            <div class="topic-title">
                                @if($team->status == 0)
                                <span class="topic">[chưa chốt đoàn]</span>
                                @else
                                <span class="topic">[đã chốt đoàn]</span>
                                @endif
                                <a href="team/{{$team->id}}" class="title">{{ucwords($team->title)}}</a>
                            </div>
                            <div class="time mt-2"><i class="fas fa-calendar-alt mr-1"></i>
                                {{$team->created_at->format('d-m-Y')}}</div>
                        </div>
                    </div>
                </div>
                @endforeach
               
            </div>
        </div>
		@endif
    </div>
</div>

</div>

@endsection