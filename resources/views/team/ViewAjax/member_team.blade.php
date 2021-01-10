<div class="row">
    @foreach($team->members as $member)
    <div class="col-lg-6 col-md-12">
        <div class="team-item member-{{$member->user_id}} d-flex">
            <a href="user/{{$member->user->id}}/info" class="avatar d-block mr-3"><img class="img-50"
                    src="image/image_avatar/{{$member->user->avatar}}" alt=""></a>
            <div class="info-desc">
                <div class="topic-title">
                    @if($member->level == 1)
                    <span class="topic">[Nhóm trưởng]</span>
                    @else
                    <span class="topic">[Thành viên]</span>
                    @endif
                    <a href="user/{{$member->user->id}}/info" class="title">{{$member->user->username}}</a>
                </div>
                <div class="time mt-2"><i class="fas fa-calendar-alt mr-1"></i>
                    {{$member->created_at->format('d-m-Y')}}</div>
                <div class="time mt-2"><i class="fas fa-user mr-1"></i>
                    {{$member->fullname}}</div>
                <div class="time mt-2"><i class="fas fa-phone mr-1"></i>
                    0{{$member->phone}}</div>
            </div>
            @if(isLeader(Auth::user()->id,$team->id))
            @if($member->level != 1)
            <div class="ml-auto dropdown dropleft"><i class="fas fa-ellipsis-h" data-toggle="dropdown"></i>
                <div class="dropdown-menu ">
                    <a href="team/change-leader/{{$member->user_id}}/{{$team->id}}" class="dropdown-item"
                        onclick="return confirm('Bạn có chắc muốn chọn người này làm nhóm trưởng?');">Chọn làm nhóm trưởng</a>
                    <a href="" class="dropdown-item delete-member-team"
                    >Mời ra khỏi nhóm
                    <input type="hidden" class='member_id' value="{{$member->user_id}}">
                    </a>
                </div>
            </div>
            @endif
            @endif
        </div>
    </div>
    @endforeach


</div>

