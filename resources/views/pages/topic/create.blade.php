@extends('../welcome')

@section('title')
    {{ "Tạo bài viết" }}
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
                    <div class="card-header">Tạo bài viết</div>
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
                        <form method="POST" action="{{route('store_topic')}}">
                            @csrf
                            <div class="row mb-4 required">
                                <label for="password" class="col-md-2 col-form-label text-md-end">Chọn chuyên mục</label>
                                <div class="col-md-10">
                                    <select class="input-sm" name="type_topic">
                                        <option value="1">Thông báo</option>
                                        <option value="2">Tin tức</option>
                                        <option value="3">Hỏi đáp</option>
                                        <option value="4">Đánh giá</option>
                                        <option value="5">Thảo luận</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-4 required">
                                <label class="col-md-2 col-form-label text-md-end">Tiêu đề</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="title"  onkeyup="ChangeToSlugTopicTitle();" id="slug_title" placeholder="Tiêu đề bài viết...">
                                </div>
                            </div>
                            <div class="row mb-4 required">
                                <div class="col-md-10">
                                    <input type="hidden" class="form-control" value="{{old('slug_title')}}" name="slug_title" id="convert_slug_title"  placeholder="Slug tiêu đề bài viết...">
                                </div>
                            </div>
                            <div class="row mb-4 required">
                                <label class="col-md-2 col-form-label text-md-end">Nội dung</label>
                                <div class="col-md-10">
                                    <textarea class="form-control" id="topic_content" name="content" rows="20" style="resize: none"></textarea>
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-2">
                                    <button type="submit" class="btn btn-primary">
                                        Tạo bài viết
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection