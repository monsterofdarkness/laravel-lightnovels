@extends('admin.management')

@section('title')
    {{ "Chỉnh sửa chương" }}
@endsection

@section('content')

    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Chỉnh sửa chương
        </h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5" style="justify-content: center!important;">
        <div class="intro-y col-span-12 lg:col-span-6">
            <!-- BEGIN: Form Layout -->
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger show flex items-center mb-2" role="alert">
                        <i data-lucide="alert-octagon" class="w-6 h-6 mr-2"></i> {{ $error }}
                    </div>
                @endforeach
            @endif
            <div class="intro-y box p-5">
                <form method="POST" action="{{route('chuong.update',[$chapter->id])}}" enctype='multipart/form-data'>
                    @method('PUT')
                    @csrf
                    <div>
                        <label for="crud-form-1" class="form-label">Thuộc truyện: </label>
                        <label>{{ $chapter->novel->novelname }}</label></br>
                    </div>
                    <div class="mt-3"> 
                        <label for="crud-form-1" class="form-label">Tên chương</label>
                        <input type="text" class="form-control" value="{{$chapter->title}}" onkeyup="ChangeToSlug();" name="title" id="slug" placeholder="Tên chương truyện...">
                        <input type="hidden" class="form-control" value="{{$chapter->slug_chapter}}" name="slug_chapter" id="convert_slug"  placeholder="Slug chương truyện...">
                    </div>
                    <div class="mt-3">
                        <label for="crud-form-1" class="form-label">Nội dung</label>
                        <textarea class="form-control" id="chapter_content" name="content" rows="10" style="resize: none">{{$chapter->content}}</textarea>
                    </div>
                    <div class="mt-3">
                        <label for="crud-form-1" class="form-label">Trạng thái</label>
                        <select name="status" class="custom-select">
                            @if($chapter->status==0)
                                <option selected value="0">Kích hoạt</option>
                                <option value="1">Không kích hoạt</option>
                            @else
                                <option value="0">Kích hoạt</option>
                                <option selected value="1">Không kích hoạt</option>
                            @endif
                        </select>
                    </div>
                    <div class="text-right mt-5">
                        <a href="{{ route('chapter_index', ['novel_id' => $chapter->novel->id]) }}">
                            <button type="button" class="btn btn-outline-secondary w-24 mr-1">Hủy</button>
                        </a>
                        <button type="submit" class="btn btn-primary w-24">Cập nhật</button>
                    </div>
                </form>
            </div>
            <!-- END: Form Layout -->
        </div>
        <div class="intro-y col-span-12 lg:col-span-6">
            <img  class="logo-icon-create" src="{{ asset('images/ShinoNovelLogo.png') }}">
        </div>
    </div>

@endsection