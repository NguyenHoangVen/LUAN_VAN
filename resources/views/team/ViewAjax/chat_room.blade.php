<div class="card direct-chat direct-chat-primary">
    <div class="card-header ui-sortable-handle" style="cursor: move;background: #f4f6ff;">
        <h3 class="card-title">Phòng chat {{$team_id}}</h3>

        <div class="card-tools">
            <span title="3 New Messages" class="badge badge-primary">3</span>
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" title="Contacts" data-widget="chat-pane-toggle">
                <i class="fas fa-comments"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <!-- Conversations are loaded here -->
        <div class="direct-chat-messages" style="background: #efefef;">
                
                @foreach($messages as $message)
                @if($message->user_id == Auth::user()->id)
                <div class="direct-chat-msg right">
                    <div class="direct-chat-infos clearfix">
                        <span class="direct-chat-name float-right">{{$message->user_send->username}}</span>
                      
                    </div>
                    
                    <img class="direct-chat-img" src="image/image_avatar/{{$message->user_send->avatar}}"
                        alt="message user image">
                   
                    <div class="direct-chat-text">
                        <div>{{$message->content}}</div>
                        <span class="direct-chat-timestamp float-left mt-2">{{Carbon\Carbon::parse($message->created_at)->diffForHumans()}}
                        </span>
                    </div>
                   
                </div>
                @else
                <div class="direct-chat-msg">
                    <div class="direct-chat-infos clearfix">
                        <span class="direct-chat-name float-left">{{$message->user_send->username}}
                        </span>
                       
                    </div>
                    <!-- /.direct-chat-infos -->
                    <img class="direct-chat-img" src="image/image_avatar/{{$message->user_send->avatar}}"
                        alt="message user image">
                    <!-- /.direct-chat-img -->
                    <div class="direct-chat-text">
                        <div class="mb-2">{{$message->content}}</div>
                        <span class="direct-chat-timestamp"> {{Carbon\Carbon::parse($message->created_at)->diffForHumans()}}
                        </span>
                    </div>
                    <!-- /.direct-chat-text -->
                </div>
                @endif
               
                @endforeach


        </div>

    </div>
    <!-- /.card-body -->

    <div class="card-footer">
        @if(isMemberTeam(Auth::user()->id,$team_id))
        <div class="input-group">
            <input type="text" name="message" placeholder="Trò chuyện với nhóm ..." class="form-control send-message">
        </div>
        @endif
    </div>
    <!-- /.card-footer-->
</div>
