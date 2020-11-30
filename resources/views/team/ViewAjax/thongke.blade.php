@foreach($team->tools as $tool)
<div class="row mb-2">
    <div class="col-12">
        <div class="card-title w-100 bg-light p-2" style="font-weight:bold">{{$tool->name}}</div>
    </div>
    @foreach($tool->comfirm_tool as $binhchon)
    <div class="col-lg-6 col-md-12">
        <div class="team-item d-flex">
            <div class="avatar d-block mr-3"><img class="img-50"
                    src="image/image_avatar/{{$binhchon->user->avatar}}" alt=""></div>
            <div class="info-desc">
                <div class="topic-title">
                    <div class="title">{{$binhchon->user->username}}</div>
                </div>
                <div class="time mt-2"><b>Số lượng:{{$binhchon->quaty}}</b>
                </div>

            </div>
        </div>
    </div>
    @endforeach


</div>
@endforeach