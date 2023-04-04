@extends('../welcome')

@section('title')
    {{ $novel->novelname }}
@endsection


@section('content')

<style type="text/css">

.collapse.in {
    display: block;
}

</style>

    <div class="container">
    <div class="row d-block clearfix mt-4 novelpage">
        <div class="col-xs-12 col-sm-12 col-md-9 float-left feature-section">
            <section>
                <main>
                    <div class="top-part" >
                        <div class="row">
                            <div class="left-column col-12 col-md-3">
                                <img class="card-img-top" src="{{ asset('uploads/novel/'.$novel->image) }}">
                            </div>
                            <div class="col-12 col-md-9">
                                <div class="series-name-group" >
                                    <span class="series-name" >
                                        <a href="#">
                                            {{ $novel->novelname }}
                                        </a>
                                    </span>
                                </div>
                                <div class="series-information" >
                                    <div class="series-categories">
                                        @foreach($novel->belongstomanycategory as $incategories)
                                        <a class="series-gerne-item"  href="{{ route('category', ['slug' => $incategories->slug_category]) }}">{{ $incategories->categoryname }}</a>
                                        @endforeach
                                    </div>
                                    <div class="info-item" >
                                    <i class="fa fa-user"></i>
                                        <span class="info-name" >Tác giả:</span>
                                        <span class="info-value ">
                                            <a href="{{ route('ListNovelAuthor', ['author' => $novel->slug_author]) }}">
                                            {{ $novel->author }}
                                            </a>
                                        </span>
                                    </div>
                                    <div class="info-item" >
                                        <i class="fa fa-rss"></i>
                                        <span class="info-name" >Tình trạng:</span>
                                        <span class="info-value ">
                                            @if($novel->state==0)
                                                Đang tiến hành
                                            @elseif($novel->state==1)
                                                Đã hoàn thành
                                            @else
                                                Tạm ngưng
                                            @endif
                                        </span>
                                    </div>
                                    @if(Auth::check())
                                        @if(isset($ratingUser) || $ratingUser>0)
                                            <div class="info-item" >
                                                <i class="fa fa-star"></i>
                                                <span class="info-name" >Đánh giá của bạn:</span>
                                                <span class="info-value ">
                                                    <div class='starrr'>
                                                        @for($i = 1; $i <= $ratingUser->rating_star; $i++)
                                                            <a class="fa-star fa"></a>      
                                                        @endfor
                                                        <!-- @for($j = $ratingUser->rating_star+1; $j <= 5; $j++)
                                                            <a class="fa-star-o fa"></a>
                                                        @endfor -->
                                                    </div>
                                                </span>
                                            </div>
                                        @endif
                                    @endif
                                    <div class="info-item" >
                                        <i class="fa fa-star"></i>
                                        <span class="info-name" >Tổng đánh giá của truyện:</span>
                                        <span class="info-value ">
                                            @if($rating->count() > 0)
                                                {{ number_format($ratingAvg, 1) }} / 5 ({{ $rating->count() }} lượt đánh giá)
                                            @else
                                                Truyện chưa được đánh giá bởi ai cả... 
                                            @endif
                                        </span>
                                    </div>
                                    <div class="info-item" >
                                        <i class="fa fa-calendar"></i>
                                        <span class="info-name" >Ngày đăng truyện:</span>
                                        <span class="info-value ">
                                            {{ $novel->created_at->toDateString() }}
                                        </span>
                                    </div>
                                    <div class="info-item" >
                                        <i class="fa fa-calendar"></i>
                                        <span class="info-name" >Lần cuối cập nhật:</span>
                                        <span class="info-value ">
                                            {{ $novel->updated_at->toDateString()}}
                                        </span>
                                    </div>
                                </div>
                                <div class="side-features">
                                    <div class="row">
                                        <div class="col-4 col-md feature-item width-auto-x1">
                                            <div class="side-feature-button button-rate wishlist">
                                                <span class="block feature-value">
                                                    @if(Auth::check())
                                                        @if($favoritedUser)
                                                            <i class="fas fa-heart" style="font-weight: 900!important;" onclick="submitFavorite()">
                                                        @else
                                                            <i class="fas fa-heart" style="font-weight: 400!important;" onclick="submitFavorite()">
                                                        @endif
                                                            <form action="{{ route('favorite') }}" method="POST" class="form-inline" id="formFavorite">
                                                                @csrf
                                                                <div class="form-group">
                                                                    <input type="hidden" class="form-control" name="novel_id" value="{{ $novel->id }}">
                                                                    <input type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->id }}">
                                                                </div>
                                                            </form>
                                                        </i>
                                                    @else
                                                        <i class="fas fa-heart" style="font-weight: 400!important;" onclick="submitFavoriteFail()"></i>
                                                    @endif
                                                </span>
                                                <span class="block feature-name">{{ $favorite->count() }}</span>
                                            </div>
                                        </div>
                                        <div class="col-4 col-md feature-item width-auto-x1">
                                            <div class="series-rating rated">
                                                <label for="open-rating" class="side-feature-button button-rate">
                                                    <span class="block feature-value">
                                                        @if($ratingUser)
                                                            <i class="fa-solid fa-star"></i>
                                                        @else
                                                            <i class="far fa-star" style="font-weight: 400!important;"></i>
                                                        @endif
                                                    </span>
                                                    <span class="block feature-name">Đánh giá</span>
                                                </label>
                                                <input type="checkbox" id="open-rating">
                                                    <div class="series-evaluation clear">
                                                        @if(Auth::check())
                                                            <div class="rating text-center">
                                                                <div class='starrr' id='star1'></div>
                                                            </div>
                                                            <form action="{{ route('rating-novel') }}" method="POST" class="form-inline" id="formRating">
                                                                @csrf
                                                                <div class="form-group">
                                                                    <input type="hidden" class="form-control" name="rating_star" id="rating_star">
                                                                    <input type="hidden" class="form-control" name="novel_id" value="{{ $novel->id }}">
                                                                    <input type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->id }}">
                                                                </div>
                                                            </form>
                                                        @else
                                                            <div class="rating text-center">
                                                                <div class='starrr' id='star2'></div>
                                                            </div>
                                                        @endif
                                                    </div>     
                                            </div>
                                        </div>
                                        <div class="col-4 col-md feature-item width-auto-x1">
                                            <div class="side-feature-button button-rate viewed">
                                                <span class="block feature-value">
                                                        <i class="fa fa-eye"></i>
                                                </span>
                                                <span class="block feature-name">{{ $novel->novel_views }} lượt xem</span>
                                            </div>
                                        </div>
                                        <div class="col-4 col-md feature-item width-auto-x1">
                                            <div class="side-feature-button button-rate viewed">
                                                <span class="block feature-value">
                                                    @if(Auth::check())
                                                        <button class="btn-report" type="button" data-toggle="modal" data-target="#report_novel">
                                                            <i class="fa-solid fa-flag"></i>
                                                        </button>
                                                        <div class="modal fade" id="report_novel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-body">
                                                                        <div class="dialog-container">
                                                                            <div class="dialog-content">
                                                                                <form class="eIoQdo" method="POST" action="{{ route('report') }}" enctype='multipart/form-data'>
                                                                                    @csrf
                                                                                    <div class="Heading___Heading-sc-1wdsv8o-0 cfRHkz modal-header">
                                                                                        <a class="navbar-brand"><div class="logo"></div></a>
                                                                                    </div>
                                                                                    <div class="modal-headline">
                                                                                        <h2><b>Báo cáo</b> truyện này</b>.</h2>
                                                                                    </div>
                                                                                    <div class="modal-fields">

                                                                                    <div class="avatar-dialog">
                                                                                        <div class="report-img">
                                                                                            <img src="{{ url('/uploads/novel/'.$novel->image) }}">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="field has-icon-left">
                                                                                        <label class="label" >Lý do</label>
                                                                                        <div class="control">
                                                                                            <input type="hidden" class="form-control" name="novel_id" value="{{ $novel->id }}">
                                                                                            <p class="font-weight-bold mt-4">Vui lòng chọn lý do báo cáo</p>
                                                                                            <select name="reason" class="selectpicker mt-2">
                                                                                                <option value="1">Spam</option>
                                                                                                <option value="2">Lỗi font</option>
                                                                                                <option value="3">Sai nội dung</option>
                                                                                                <option value="4">Nội dung không phù hợp</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="Modal___ModalFooter-sc-1657dip-5 kGCHZn dialog-footer">
                                                                                        <div class="options">
                                                                                        <button type="submit" class="button to-contact button-save-dialog" data-toggle="modal">
                                                                                            <i class="fa-solid fa-paper-plane" style="font-size: 20px;"></i>
                                                                                            Gửi báo cáo
                                                                                        </button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <i class="fa-solid fa-flag" onclick="submitReportFail()"></i>
                                                    @endif
                                                </span>
                                                <span class="block feature-name">Báo cáo</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bottom-part" >
                        <div class="summary-wrapper col-12" >
                            <div class="series-summary" >
                                <h4>Tóm tắt</h4>
                            </div>
                            <div class="summary-content">
                                <p>{!! $novel->summary !!}</p>
                            </div>
                        </div>
                    </div>
                </main>
            </section>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-3 float-right">
            <div class="row top-group">
                <div class="col-12 no-push push-3-m col-md-6 no-push-l col-lg-12">
                    <section class="series-users">
                        <main>
                            <div class="series-owner group-mem">
                                <img src="{{ asset('uploads/user/'.$user->avatar) }}" alt="Poster's avatar">
                                    <div class="series-owner-title">
                                        <span class="series-owner_name"><a href="{{ route('member_wall', ['id' => $user->id] ) }}">{{ $user->name }}</a></span>
                                    </div>
                            </div>
                        </main>
                    </section>
                </div>
            </div>
            @php
                $count_novel_uploaded = count($novel_uploaded);
            @endphp
            @if($count_novel_uploaded>0)
                <section class="basic-section">
                    <header class="sect-header">
                        <span class="sect-title">Truyện cùng người đăng</span>
                    </header>
                    <main class="d-lg-block">
                        <ul class="others-list">
                            @foreach($novel_uploaded as $novel_up)
                                <li>
                                    <div class="others-img no-padding">
                                        <div class="a6-ratio">
                                            <div class="content img-in-ratio"> 
                                                <img  src="{{ asset('uploads/novel/'.$novel_up->image) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="others-info">
                                        <h5 class="others-name"><a href="{{ route('novel', ['slug' => $novel_up->slug_novelname]) }}">{{ $novel_up->novelname }}</a></h5>
                                        <small class="series-summary-2">{!! $novel_up->summary !!}</small>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </main>
                </section>
            @endif
            <section class="basic-section">
                <header class="sect-header">
                    <span class="sect-title">Truyện nổi bật</span>
                </header>
                <main class="d-lg-block">
                    <ul class="others-list">
                        @foreach($top4_novel as $top4)
                            <li>
                                <div class="others-img no-padding">
                                    <div class="a6-ratio">
                                        <div class="content img-in-ratio"> 
                                            <img  src="{{ asset('uploads/novel/'.$top4->image) }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="others-info">                                        
                                    <h5 class="others-name"><a href="{{ route('novel', ['slug' => $top4->slug_novelname]) }}">{{ $top4->novelname }}</a></h5>
                                    <i class="fa fa-eye"></i>
                                        <span>Lượt xem:</span>
                                        <span>
                                            {{ $top4->novel_views }}
                                        </span>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </main>
            </section>
        </div>
        <div class="col-12 col-lg-9 float-left" style="padding: 0;">
        @php
            $mucluc = count($chapter);
        @endphp
        @if($mucluc>0)
            <section class="volume-list at-series basic-section">
                <header class="sect-header">
                    <span class="sect-title"> Mục Lục </span>
                </header>
                <main class="d-lg-block">
                    <div class="row">
                        <div class="col-xs-4 col-offset-xs-4 col-md-2 col-sm-2 collapse in img-cover-small">
                            <img style="padding: 10px;" width="150px" src="{{ asset('uploads/novel/'.$novel->image) }}" alt="{{ $novel->novelname }}">
                        </div>
                        <div class="col-12 col-md-10">
                            <ul class="list-chapters at-series">
                                @foreach($chapter as $key => $chapters)
                                    <li>
                                        <div class="chapter-name">
                                            <a href="{{ route('chapter', ['id' => $chapters->id, 'slug' => $chapters->slug_chapter]) }}">{{ $chapters->title }}</a>
                                        </div>
                                        <div class="chapter-time">{{ $chapters->created_at->toDateString() }}</div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </main>
            </section>
        @else
            <section class="volume-list at-series basic-section disabled">
                <header class="sect-header">
                    <a style="margin-left: 10px; float: right; font-size: 20px;" class="edit-icon" href=""><i class="fas fa-edit"></i></a>
                    <span class="sect-title"> Mục Lục </span>
                </header>
                <main class="d-lg-block">
                    <div class="row">
                        <div class="col-xs-4 col-offset-xs-4 col-md-2 col-sm-2 collapse in">
                            <img style="padding: 10px;" width="150px" src="{{ asset('uploads/novel/'.$novel->image) }}" alt="{{ $novel->novelname }}">
                        </div>
                        <div class="col-12 col-md-10">
                            <ul class="list-chapters at-series">
                                @foreach($chapter as $key => $chapters)
                                    <li>
                                        <div class="chapter-name">
                                            <a href="{{ route('chapter', ['id' => $chapters->id, 'slug' => $chapters->slug_chapter]) }}">{{ $chapters->title }}</a>
                                        </div>
                                        <div class="chapter-time">{{ $chapters->created_at->toDateString() }}</div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </main>
            </section>
        @endif

            <section class="basic-section">
                <header class="sect-header tab-list">
                    <span class="sect-title tab-title">Bình luận <span class="comments-count">({{$comment->count()}})</span></span>
                </header>
                <main class="comment-wrapper d-lg-block clear">
                    <div class="tab-content clear">
                        <section class="ln-comment">
                            <main class="ln-comment-body">
                                @if(Auth::check())
                                <div class="ln-commemt-form">
                                    <form class="comment_form" action="{{ route('comment', $novel->id) }}" method="POST">
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
                                                            <i class="fas fa-flag" style="color: white;"></i> Chủ post
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
                                                        <form class="comment_form" action="{{ route('updatecomment', [$com->id]) }}" method="POST">
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
                                                    <form action="{{route('deletecomment', [$com->id])}}" method="POST">
                                                        @method('PUT')
                                                        @csrf
                                                        <!-- <span onclick="return confirm('Bạn có chắc là muốn xóa bình luận này không?');" class="ln-comment-toolkit-item span-delete"><i class="fas fa-times"></i> Xóa</span> -->
                                                        <button onclick="return confirm('Bạn có chắc là muốn xóa bình luận này không?');" class="ln-comment-toolkit-item span-delete">
                                                        <i class="fas fa-times"></i>
                                                        Xóa
                                                        </button>
                                                    </form>
                                                    @elseif(Auth::user()->id == $user->id)
                                                    <form action="{{route('deletecomment', [$com->id])}}" method="POST">
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
                                                        <form class="comment_form" action="{{ route('updatecomment', [$com->id]) }}" method="POST">
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
                                                <form class="replyForm reply-form-{{$com->id}}" style="display: none;" action="{{ route('comment', $novel->id) }}" method="POST">
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
                                                                <form class="comment_form" action="{{ route('updatecomment', [$child->id]) }}" method="POST">
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
                                                            <form action="{{route('deletecomment', [$child->id])}}" method="POST">
                                                                @method('PUT')
                                                                @csrf
                                                                <button onclick="return confirm('Bạn có chắc là muốn xóa bình luận này không?');" class="ln-comment-toolkit-item span-delete">
                                                                <i class="fas fa-times"></i>
                                                                Xóa
                                                                </button>                                                        </form>
                                                            @elseif(Auth::user()->id == $user->id)
                                                            <form action="{{route('deletecomment', [$child->id])}}" method="POST">
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
                                                                <form class="comment_form" action="{{ route('updatecomment', [$child->id]) }}" method="POST">
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
                    </div>
                </main>
            </section>
        </div>
    </div>
</div>



@if ($errors->any())
<script>
    alert('Nội dung bình luận không được để trống!')
</script>
@endif

@endsection