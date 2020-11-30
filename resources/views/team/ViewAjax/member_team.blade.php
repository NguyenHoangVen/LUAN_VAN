<div class="row">
    @foreach($team->members as $member)
    <div class="col-lg-6 col-md-12">
        <div class="team-item d-flex">
            <a href="" class="avatar d-block mr-3"><img class="img-50"
                    src="image/image_avatar/{{$member->user->avatar}}" alt=""></a>
            <div class="info-desc">
                <div class="topic-title">
                    @if($member->level == 1)
                    <span class="topic">[Nhóm trưởng]</span>
                    @else
                    <span class="topic">[Thành viên]</span>
                    @endif
                    <a href="team/8" class="title">{{$member->user->username}}</a>
                </div>
                <div class="time mt-2"><i class="fas fa-calendar-alt mr-1"></i>
                    {{$member->created_at->format('d-m-Y')}}</div>
                <div class="time mt-2"><i class="fas fa-user mr-1"></i>
                    {{$member->fullname}}</div>
                <div class="time mt-2"><i class="fas fa-phone mr-1"></i>
                    0{{$member->phone}}</div>
            </div>
        </div>
    </div>
    @endforeach


</div>