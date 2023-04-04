@extends('admin.management')

@section('title')
    {{ "Thêm truyện" }}
@endsection

@section('content')

    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Thêm truyện
        </h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
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
                <form method="POST" action="{{route('truyen.store')}}" enctype='multipart/form-data'>
                    @csrf
                    <div>
                        <label for="crud-form-1" class="form-label">Tên truyện</label>
                        <input type="text" class="form-control" value="{{old('novelname')}}" onkeyup="ChangeToSlug();" name="novelname" id="slug" placeholder="Tên truyện...">
                        <input type="hidden" class="form-control" value="{{old('slug_novelname')}}" name="slug_novelname" id="convert_slug"  placeholder="Slug truyện...">
                    </div>
                    <div class="mt-3">
                        <label for="crud-form-1" class="form-label">Tác giả</label>
                        <input type="text" class="form-control" value="{{old('author')}}" onkeyup="ChangeToSlugAuthor();" name="author" id="slug_author" placeholder="Tên tác giả...">
                        <input type="hidden" class="form-control" value="{{old('slug_author')}}" name="slug_author" id="convert_slug_author"  placeholder="Slug author...">
                    </div>
                    <div class="mt-3">
                        <label for="crud-form-1" class="form-label">Tóm tắt</label>
                        <textarea class="form-control" id="summary_content" name="summary" rows="10" style="resize: none"></textarea>
                    </div>
                    <div class="mt-3">
                        <label for="crud-form-1" class="form-label">Thể loại</label></br>
                        @foreach($category as $key => $categories)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="category[]" type="checkbox" id="category_{{$categories->id}}" value="{{$categories->id}}">
                                <label class="form-check-label" for="category_{{$categories->id}}">{{$categories->categoryname}}</label>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-3">
                        <label for="crud-form-1" class="form-label">Tình trạng</label>
                        <select name="state" class="custom-select">
                            <option value="0">Đang tiến hành</option>
                            <option value="1">Đã hoàn thành</option>
                            <option value="2">Tạm ngưng</option>
                        </select>
                    </div>
                    <div class="mt-3">
                        <label for="crud-form-1" class="form-label">Trạng thái</label>
                        <select name="status" class="custom-select">
                            <option value="0">Kích hoạt</option>
                            <option value="1">Không kích hoạt</option>
                        </select>
                    </div>
                    <div class="mt-3">
                        <label for="crud-form-1" class="form-label">Ảnh bìa truyện</label></br>
                        <input type="file" class="form-control-file" name="image">
                    </div>
                    <div class="text-right mt-5">
                        <a href="{{ route('novel_index') }}">
                            <button type="button" class="btn btn-outline-secondary w-24 mr-1">Hủy</button>
                        </a>
                        <button type="submit" class="btn btn-primary w-24">Thêm</button>
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