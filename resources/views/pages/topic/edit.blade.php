@extends('../welcome')

@section('title')
    {{ "Chỉnh sửa bài viết" }}
@endsection

@section('content')
<div class="container">
    <div style="padding-bottom: 40px;">
        <div class="shino-logo">
            <img src="{{ asset('images/ShinoNovelLogo.png') }}">
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Chỉnh sửa bài viết
                    </div>
                    <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                        <form method="POST" action="{{route('update_topic', ['topic_id' => $topic->id] )}}">
                            @method('PUT')
                            @csrf
                            <div class="row mb-4 required">
                                <label for="password" class="col-md-2 col-form-label text-md-end">Chọn chuyên mục</label>
                                <div class="col-md-10">
                                    <select class="input-sm" name="type_topic">
                                        @if($topic->type_topic == 1)
                                            <option selected value="1">Thông báo</option>
                                            <option value="2">Tin tức</option>
                                            <option value="3">Hỏi đáp</option>
                                            <option value="4">Đánh giá</option>
                                            <option value="5">Thảo luận</option>
                                        @elseif($topic->type_topic == 2)
                                            <option value="1">Thông báo</option>
                                            <option selected value="2">Tin tức</option>
                                            <option value="3">Hỏi đáp</option>
                                            <option value="4">Đánh giá</option>
                                            <option value="5">Thảo luận</option>
                                        @elseif($topic->type_topic == 3)
                                            <option value="1">Thông báo</option>
                                            <option value="2">Tin tức</option>
                                            <option selected value="3">Hỏi đáp</option>
                                            <option value="4">Đánh giá</option>
                                            <option value="5">Thảo luận</option>
                                        @elseif($topic->type_topic == 4)
                                            <option value="1">Thông báo</option>
                                            <option value="2">Tin tức</option>
                                            <option value="3">Hỏi đáp</option>
                                            <option selected value="4">Đánh giá</option>
                                            <option value="5">Thảo luận</option>
                                        @else
                                            <option value="1">Thông báo</option>
                                            <option value="2">Tin tức</option>
                                            <option value="3">Hỏi đáp</option>
                                            <option value="4">Đánh giá</option>
                                            <option selected value="5">Thảo luận</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-4 required">
                                <label class="col-md-2 col-form-label text-md-end">Tiêu đề</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="title" value="{{$topic->title}}" onkeyup="ChangeToSlugTopicTitle();" id="slug_title" placeholder="Tiêu đề bài viết...">
                                </div>
                            </div>
                            <div class="row mb-4 required">
                                <div class="col-md-10">
                                    <input type="hidden" class="form-control" value="{{$topic->slug_title}}" name="slug_title" id="convert_slug_title"  placeholder="Slug tiêu đề bài viết...">
                                </div>
                            </div>
                            <div class="row mb-4 required">
                                <label class="col-md-2 col-form-label text-md-end">Nội dung</label>
                                <div class="col-md-10">
                                    <textarea class="form-control" id="topic_content" name="content" rows="20" style="resize: none">{!! $topic->content !!}</textarea>
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-2 offset-md-2">
                                    <button type="submit" class="btn btn-primary">
                                        Cập nhật bài viết
                                    </button>
                                </div>
                        </form>
                                <div class="col-md-3">
                                    <form action="{{ route('delete_topic', ['topic_id' => $topic->id] ) }}" method="POST">
                                        @method('PUT')
                                        @csrf
                                        <button onclick="return confirm('Bạn có chắc là muốn xóa bài viết này không?');" type="submit" class="btn btn-danger">
                                            Xóa bài viết
                                        </button>
                                    </form>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection