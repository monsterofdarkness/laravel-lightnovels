@extends('../welcome')

@section('title')
    {{ "Danh sách bài viết" }}
@endsection

@section('content')
<div class="container-fluid" id="mainpart" style="margin-bottom: 200px;">
    <div class="container">
        <div class="b_title"><strong><i class="far fa-newspaper"></i> Danh sách bài viết</strong></div>
        <div>
            <a class="button-newpost button-green" href="{{ route('create_topic') }}"><i class="fas fa-plus"></i> Tạo bài viết</a>
        </div>
        <section class="board-list">
            <table class="board-table table table-borderless">
                <thead>
                    <tr class="d-flex">
                        <th class="col-8 col-md-4 col-lg-5 col-xl-5">Tiêu đề</th>
                        <th class="col-md-5 col-lg-2 d-none d-md-block">Chuyên mục</th>
                        <th class="col-md-4 col-lg-2 d-none d-md-block text-center">Thời gian đăng</th>
                        <th class="col-4 col-md-5 col-lg-3 text-right">Người đăng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($list_topic as $key => $topic)
                        <tr class="d-flex">
                            <td class="col-8 col-md-4 col-lg-5 col-xl-5">
                                <a class="topic-title" href="{{ route('detail_topic', ['id' => $topic->id, 'slug' => $topic->slug_title]) }}">
                                    <i class="fas fa-star"></i> {{ $topic->title }}
                                </a>
                            </td>
                            <td class="col-md-5 col-lg-2 d-none d-md-block">
                                @if($topic->type_topic == 1)
                                    <span class="category-circle">
                                        <i class="fas fa-circle" aria-hidden="true" style="color: #eb1d57; margin-right: 4px;"></i>
                                    </span>
                                    <a href="#" class="topic_type">Thông báo</a>
                                @elseif($topic->type_topic == 2)
                                    <span class="category-circle">
                                        <i class="fas fa-circle" aria-hidden="true" style="color: #e01bb4; margin-right: 4px;"></i>
                                    </span>
                                    <a href="#" class="topic_type">Tin tức</a>
                                @elseif($topic->type_topic == 3)
                                    <span class="category-circle">
                                        <i class="fas fa-circle" aria-hidden="true" style="color: #252eef; margin-right: 4px;"></i>
                                    </span>
                                    <a href="#" class="topic_type">Hỏi đáp</a>
                                @elseif($topic->type_topic == 4)
                                    <span class="category-circle">
                                        <i class="fas fa-circle" aria-hidden="true" style="color: #28e1e8; margin-right: 4px;"></i>
                                    </span>
                                    <a href="#" class="topic_type">Đánh giá</a>
                                @else
                                    <span class="category-circle">
                                        <i class="fas fa-circle" aria-hidden="true" style="color: #1ee865; margin-right: 4px;"></i>
                                    </span>
                                    <a href="#" class="topic_type">Thảo luận</a>
                                @endif
                            </td>
                            <td class="col-md-4 col-lg-2 d-none d-md-block text-center">
                                <time class="topic-time timeago">{{ $topic->created_at }}</time>
                            </td>
                            <td class="col-4 col-md-5 col-lg-3 text-right">
                                <div class="topic-avatar none block-m">
                                    <img src="{{ asset('uploads/user/'.$topic->user->avatar) }}">
                                </div>
                                <div class="topic-username block-m">
                                    <a href="{{ route('member_wall', ['id' => $topic->user->id]) }}">{{ $topic->user->name }}</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="text-center center-pagination">
                {{ $list_topic->links() }}
            </div>
        </section>
    </div>
</div>
@endsection