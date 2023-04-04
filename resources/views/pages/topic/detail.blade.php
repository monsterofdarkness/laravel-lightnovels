@extends('../welcome')

@section('title')
    {{ $topic->title }}
@endsection

@section('content')

<div class="container-fluid" id="mainpart">
    <div class="container">
        <div class="b_title"><strong><i class="far fa-newspaper"></i> Chi tiết bài viết</strong></div>
        <section class="page-content basic-section">
            <header class="sect-header">
                <span class="sect-title">{{ $topic->title }}</span>
                @if(Auth::check() && Auth::user()->id == $user->id)
                <a style="margin-left: 10px; float: right; font-size: 20px;" class="edit-icon" href="{{ route('edit_topic', ['topic_id' => $topic->id] ) }}"><i class="fas fa-edit"></i></a>
                @endif
            </header>
            <main class="sect-body">
                <div class="row">
                    <div class="col-8">
                        <div class="page-author">
                            <div class="author_ava">
                                <img src="{{ asset('uploads/user/'.$user->avatar) }}">
                            </div>
                            <div class="author-info">
                                <div class="author_name"><a href="{{ route('member_wall', ['id' => $user->id]) }}">{{ $user->name }}</a></div>
                                @if($user->role == 1)
                                <div class="author_role_admin"><span>Quản trị viên</span></div>
                                @else
                                <div class="author_role_member"><span>Thành viên</span></div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <time class="topic-time timeago">{{ $topic->updated_at }}</time>
                    </div>
                </div>
                <div class="forum-page-content long-text">
                    {!! $topic->content !!}
                </div>
            </main>
        </section>

        <section class="page-content basic-section">
            <header class="sect-header tab-list">
                <span class="sect-title tab-title">Bình luận <span class="comments-count">({{$comment->count()}})</span></span>
            </header>
            <main>
                <section class="ln-comment">
                    <main class="ln-comment-body">
                        @if(Auth::check())
                        <div class="ln-commemt-form">
                            <form class="comment_form" action="{{ route('comment_topic', ['topic_id' => $topic->id ]) }}" method="POST">
                                @csrf
                                <textarea class="form-control" id="comment_content" name="content" rows="5" style="resize: none"></textarea>
                                <div class="comment_toolkit clear">
                                    <input id="btn-comment" class="button comment-button" type="submit" value="Đăng bình luận">
                                </div>
                            </form>
                        </div>
                        @else
                        Bạn cần <a href="{{route('log-in')}}" style="color: #007bff;">đăng nhập</a> để tham gia bình luận.
                        @endif
                                <!-- Bình luận -->
                        @foreach($comment as $key => $com)
                            <div class="ln-comment-group">
                                @if($com->status == 0)
                                    <div class="ln-comment-item">
                                        <div class="ln-comment-user_ava">
                                            <img src="{{ asset('uploads/user/'.$com->user->avatar) }}">
                                        </div>
                                        <div class="ln-comment-info">
                                            <div class="ln-comment-wrapper">
                                                <div class="ln-comment-user_name">
                                                    <a href="{{ route('member_wall', ['id' => $com->user->id] ) }}" class="strong">{{$com->user->name}}</a>
                                                    @if($com->user->id == $user->id)
                                                    <div class="ln-comment-user_badge comment-owner">
                                                        <i class="fas fa-flag" style="font-weight: 900!important;"></i> Chủ post
                                                    </div>
                                                    @endif
                                                </div>
                                                <div id="content-{{$com->id}}" class="ln-comment-content long-text">
                                                    <p>{!! $com->content !!}<p>
                                                    <div class="visible-toolkit">
                                                    <a class="visible-toolkit-item do-reply" data-id="{{$com->id}}">Trả lời</a>
                                                    <span class="ln-comment-time" style="float: right;">
                                                        <a href="#">
                                                            <time  class="timeago" title="" datetime="">{{ $com->created_at->format('H:i:s - d/m/Y') }}</time>
                                                        </a>
                                                    </span>
                                                    </div>
                                                </div>
                                                <div id="edit-{{$com->id}}" class="edit-ln-comment-content long-text" style="display: none;">
                                                    <form class="comment_form" action="{{ route('updatecomment_topic', [$com->id]) }}" method="POST">
                                                        @method('PUT')
                                                        @csrf
                                                        <textarea class="form-control" id="edit_comment_content_{{$com->id}}" name="content" rows="5" style="resize: none">{!! $com->content !!}</textarea>
                                                        <div class="comment_toolkit clear">
                                                            <input id="btn-comment" class="button comment-button" type="submit" value="Sửa">
                                                        </div>
                                                    </form>
                                                    <div class="visible-toolkit">
                                                    <a class="visible-toolkit-item do-reply" data-id="{{$com->id}}">Trả lời</a>
                                                    <span class="ln-comment-time" style="float: right;">
                                                        <a href="#">
                                                            <time  class="timeago" title="" datetime="">{{ $com->updated_at->format('H:i:s - d/m/Y') }}</time>
                                                        </a>
                                                    </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="ln-comment-menu" x-data="{ show: false }">
                                            <div onclick="$(this).next('div').slideToggle(200);return false;" id="toggleCmt" class="ln-comment-toolkit-icon" @click="show = !show">
                                                <i class="fas fa-angle-down"></i>
                                            </div>
                                            <div class="ln-comment-toolkit" x-show="show" @click.outside="show = false" style="display: none;">            
                                            @if(Auth::check())    
                                                @if(Auth::user()->id == $com->user_id)
                                                <span onclick="formEditComment{{$com->id}}()" class="ln-comment-toolkit-item span-edit"><i class="fas fa-edit"></i> Chỉnh sửa</span>
                                                <form action="{{route('deletecomment_topic', [$com->id])}}" method="POST">
                                                    @method('PUT')
                                                    @csrf
                                                    <button onclick="return confirm('Bạn có chắc là muốn xóa bình luận này không?');" class="ln-comment-toolkit-item span-delete">
                                                    <i class="fas fa-times"></i>
                                                    Xóa
                                                    </button>
                                                </form>
                                                @elseif(Auth::user()->id == $user->id)
                                                <form action="{{route('deletecomment_topic', [$com->id])}}" method="POST">
                                                    @method('PUT')
                                                    @csrf
                                                    <button onclick="return confirm('Bạn có chắc là muốn xóa bình luận này không?');" class="ln-comment-toolkit-item span-delete">
                                                    <i class="fas fa-times"></i>
                                                    Xóa
                                                    </button>
                                                </form>
                                                @endif
                                            @endif
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="ln-comment-item deleted">
                                        <div class="ln-comment-user_ava">
                                            <img src="{{ asset('uploads/user/'.$com->user->avatar) }}">
                                        </div>
                                        <div class="ln-comment-info">
                                            <div class="ln-comment-wrapper">
                                                <div class="ln-comment-user_name">
                                                    <a href="{{ route('member_wall', ['id' => $com->user->id] ) }}" class="strong">{{$com->user->name}}</a>
                                                    @if($com->user->id == $user->id)
                                                    <div class="ln-comment-user_badge comment-owner">
                                                        <i class="fas fa-flag" style="font-weight: 900!important;"></i> Chủ post
                                                    </div>
                                                    @endif
                                                </div>
                                                <div id="content-{{$com->id}}" class="ln-comment-content long-text">
                                                    <p>{!! $com->content !!}<p>
                                                    <div class="visible-toolkit">
                                                    <a class="visible-toolkit-item do-reply" data-id="{{$com->id}}">Trả lời</a>
                                                    <span class="ln-comment-time" style="float: right;">
                                                        <a href="#">
                                                            <time  class="timeago" title="" datetime="">{{ $com->created_at->format('H:i:s - d/m/Y') }}</time>
                                                        </a>
                                                    </span>
                                                    </div>
                                                </div>
                                                <div id="edit-{{$com->id}}" class="edit-ln-comment-content long-text" style="display: none;">
                                                    <form class="comment_form" action="{{ route('updatecomment_topic', [$com->id]) }}" method="POST">
                                                        @method('PUT')
                                                        @csrf
                                                        <textarea class="form-control" id="edit_comment_content_{{$com->id}}" name="content" rows="5" style="resize: none">{!! $com->content !!}</textarea>
                                                        <div class="comment_toolkit clear">
                                                            <input id="btn-comment" class="button comment-button" type="submit" value="Sửa">
                                                        </div>
                                                    </form>
                                                    <div class="visible-toolkit">
                                                    <a class="visible-toolkit-item do-reply" data-id="{{$com->id}}">Trả lời</a>
                                                    <span class="ln-comment-time" style="float: right;">
                                                        <a href="#">
                                                            <time  class="timeago" title="" datetime="">{{ $com->updated_at->format('H:i:s - d/m/Y') }}</time>
                                                        </a>
                                                    </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="ln-comment-reply reply-form">
                                    <div class="ln-comment-form">
                                        <form class="replyForm reply-form-{{$com->id}}" style="display: none;" action="{{ route('comment_topic', ['topic_id' => $topic->id]) }}" method="POST">
                                            @csrf
                                            <textarea class="form-control" id="comment_reply_content_{{$com->id}}" name="content" rows="5" style="resize: none"></textarea>
                                            <div class="comment_toolkit clear">
                                                <input type="hidden" class="form-control" name="comment_parent_id" value="{{ $com->id }}">
                                                <input class="button comment-button" type="submit" value="Trả lời bình luận">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                

                                <!-- Trả lời bình luận -->
                                @foreach($com->replies as $key => $child)
                                <div class="ln-comment-reply">
                                    @if($child->status == 0)
                                        <div class="ln-comment-item">
                                            <div class="ln-comment-user_ava">
                                                <img src="{{ asset('uploads/user/'.$child->user->avatar) }}">
                                            </div>
                                            <div class="ln-comment-info">
                                                <div class="ln-comment-wrapper">
                                                    <div class="ln-comment-user_name">
                                                        <a href="{{ route('member_wall', ['id' => $child->user->id] ) }}" class="strong">{{$child->user->name}}</a>
                                                        @if($child->user->id == $user->id)
                                                        <div class="ln-comment-user_badge comment-owner">
                                                            <i class="fas fa-flag" style="font-weight: 900!important;"></i> Chủ post
                                                        </div>
                                                        @endif
                                                    </div>
                                                    <div id="content-{{$child->id}}" class="ln-comment-content long-text">
                                                        <p>{!! $child->content !!}<p>
                                                        <div class="visible-toolkit">
                                                            <span class="ln-comment-time" style="float: right;">
                                                                <a href="#">
                                                                    <time  class="timeago" title="" datetime="">{{ $child->updated_at->format('H:i:s - d/m/Y') }}</time>
                                                                </a>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div id="edit-{{$child->id}}" class="edit-ln-comment-content long-text" style="display: none;">
                                                        <form class="comment_form" action="{{ route('updatecomment_topic', [$child->id]) }}" method="POST">
                                                            @method('PUT')
                                                            @csrf
                                                            <textarea class="form-control" id="edit_comment_content_{{$child->id}}" name="content" rows="5" style="resize: none">{!! $child->content !!}</textarea>
                                                            <div class="comment_toolkit clear">
                                                                <input id="btn-comment" class="button comment-button" type="submit" value="Sửa">
                                                            </div>
                                                        </form>
                                                        <div class="visible-toolkit">
                                                            <span class="ln-comment-time" style="float: right;">
                                                                <a href="#">
                                                                    <time  class="timeago" title="" datetime="">{{ $com->created_at->format('H:i:s - d/m/Y') }}</time>
                                                                </a>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ln-comment-menu" x-data="{ show: false }">
                                                <div onclick="$(this).next('div').slideToggle(200);return false;" id="toggleCmt" class="ln-comment-toolkit-icon" @click="show = !show">
                                                    <i class="fas fa-angle-down"></i>
                                                </div>
                                                <div class="ln-comment-toolkit" x-show="show" @click.outside="show = false" style="display: none;">            
                                                @if(Auth::check())
                                                    @if(Auth::user()->id == $child->user_id)
                                                    <span onclick="formEditCommentChild{{$child->id}}()" class="ln-comment-toolkit-item span-edit"><i class="fas fa-edit"></i> Chỉnh sửa</span>
                                                    <form action="{{route('deletecomment_topic', [$child->id])}}" method="POST">
                                                        @method('PUT')
                                                        @csrf
                                                        <button onclick="return confirm('Bạn có chắc là muốn xóa bình luận này không?');" class="ln-comment-toolkit-item span-delete">
                                                        <i class="fas fa-times"></i>
                                                        Xóa
                                                        </button>                                                        </form>
                                                    @elseif(Auth::user()->id == $user->id)
                                                    <form action="{{route('deletecomment_topic', [$child->id])}}" method="POST">
                                                        @method('PUT')
                                                        @csrf
                                                        <button onclick="return confirm('Bạn có chắc là muốn xóa bình luận này không?');" class="ln-comment-toolkit-item span-delete">
                                                        <i class="fas fa-times"></i>
                                                        Xóa
                                                        </button>                                                        </form>
                                                    @endif
                                                @endif
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="ln-comment-item deleted">
                                            <div class="ln-comment-user_ava">
                                                <img src="{{ asset('uploads/user/'.$child->user->avatar) }}">
                                            </div>
                                            <div class="ln-comment-info">
                                                <div class="ln-comment-wrapper">
                                                    <div class="ln-comment-user_name">
                                                        <a href="{{ route('member_wall', ['id' => $child->user->id] ) }}" class="strong">{{$child->user->name}}</a>
                                                        @if($child->user->id == $user->id)
                                                        <div class="ln-comment-user_badge comment-owner">
                                                            <i class="fas fa-flag" style="color: white;"></i> Chủ post
                                                        </div>
                                                        @endif
                                                    </div>
                                                    <div id="content-{{$child->id}}" class="ln-comment-content long-text">
                                                        <p>{!! $child->content !!}<p>
                                                        <div class="visible-toolkit">
                                                            <span class="ln-comment-time" style="float: right;">
                                                                <a href="#">
                                                                    <time  class="timeago" title="" datetime="">{{ $child->updated_at->format('H:i:s - d/m/Y') }}</time>
                                                                </a>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div id="edit-{{$child->id}}" class="edit-ln-comment-content long-text" style="display: none;">
                                                        <form class="comment_form" action="{{ route('updatecomment_topic', [$child->id]) }}" method="POST">
                                                            @method('PUT')
                                                            @csrf
                                                            <textarea class="form-control" id="edit_comment_content_{{$child->id}}" name="content" rows="5" style="resize: none">{!! $child->content !!}</textarea>
                                                            <div class="comment_toolkit clear">
                                                                <input id="btn-comment" class="button comment-button" type="submit" value="Sửa">
                                                            </div>
                                                        </form>
                                                        <div class="visible-toolkit">
                                                            <span class="ln-comment-time" style="float: right;">
                                                                <a href="#">
                                                                    <time  class="timeago" title="" datetime="">{{ $com->created_at->format('H:i:s - d/m/Y') }}</time>
                                                                </a>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <!-- <script type="text/javascript">
                                    CKEDITOR.replace('edit_comment_content_{{$child->id}}');
                                </script> -->
                                <script>
                                    let isShow{{$child->id}} = true;
                                    function formEditCommentChild{{$child->id}}() {
                                        if(isShow{{$child->id}}) {
                                            $('#content-{{ $child->id }}').hide();
                                            $('#edit-{{ $child->id }}').show();
                                            isShow{{$child->id}} = false;
                                        }
                                        else {
                                            $('#content-{{ $child->id }}').show();
                                            $('#edit-{{ $child->id }}').hide();
                                            isShow{{$child->id}} = true;
                                        }
                                    }
                                </script>
                                @endforeach
                                <!-- <script type="text/javascript">
                                    CKEDITOR.replace('comment_reply_content_{{$com->id}}');
                                    CKEDITOR.replace('edit_comment_content_{{$com->id}}');
                                </script> -->
                                <script>
                                    let isShow{{$com->id}} = true;
                                    function formEditComment{{$com->id}}() {
                                        if(isShow{{$com->id}}) {
                                            $('#content-{{ $com->id }}').hide();
                                            $('#edit-{{ $com->id }}').show();
                                            isShow{{$com->id}} = false;
                                        }
                                        else {
                                            $('#content-{{ $com->id }}').show();
                                            $('#edit-{{ $com->id }}').hide();
                                            isShow{{$com->id}} = true;
                                        }
                                    }
                                </script>
                            </div>
                        @endforeach
                    </main>
                </section>
            </main>
        </section>

    </div>
</div>

@endsection