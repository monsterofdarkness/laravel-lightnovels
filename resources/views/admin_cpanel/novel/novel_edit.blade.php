@extends('admin.management')

@section('title')
    {{ "Chỉnh sửa truyện" }}
@endsection

@section('content')

    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Chỉnh sửa truyện
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
                <form method="POST" action="{{route('truyen.update', [$novel->id])}}" enctype='multipart/form-data'>
                    @method('PUT')
                    @csrf
                    <div>
                        <label for="crud-form-1" class="form-label">Tên truyện</label>
                        <input type="text" class="form-control" value="{{$novel->novelname}}" onkeyup="ChangeToSlug();" name="novelname" id="slug" placeholder="Tên truyện...">
                        <input type="hidden" class="form-control" value="{{$novel->slug_novelname}}" name="slug_novelname" id="convert_slug"  placeholder="Slug truyện...">
                    </div>
                    <div class="mt-3">
                        <label for="crud-form-1" class="form-label">Tác giả</label>
                        <input type="text" class="form-control" value="{{$novel->author}}" onkeyup="ChangeToSlugAuthor();" name="author" id="slug_author" placeholder="Tên tác giả...">
                        <input type="hidden" class="form-control" value="{{$novel->slug_author}}" name="slug_author" id="convert_slug_author"  placeholder="Slug author...">
                    </div>
                    <div class="mt-3">
                        <label for="crud-form-1" class="form-label">Tóm tắt</label>
                        <textarea class="form-control" id="summary_content" name="summary" rows="5" style="resize: none">{!!$novel->summary!!}</textarea>
                    </div>
                    <div class="mt-3">
                        <label for="crud-form-1" class="form-label">Thể loại</label></br>
                        @foreach($category as $key => $categories)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" 
                                
                                @if($incategory->contains($categories->id))
                                checked
                                @endif

                                name="category[]" type="checkbox" id="category_{{$categories->id}}" value="{{$categories->id}}">
                                <label class="form-check-label" for="category_{{$categories->id}}">{{$categories->categoryname}}</label>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-3">
                        <label for="crud-form-1" class="form-label">Tình trạng</label>
                        <select name="state" class="custom-select">
                            @if($novel->state==0)
                                <option selected value="0">Đang tiến hành</option>
                                <option value="1">Đã hoàn thành</option>
                                <option value="2">Tạm ngưng</option>
                            @elseif($novel->state==1)
                                <option selected value="1">Đã hoàn thành</option>
                                <option value="0">Đang tiến hành</option>
                                <option value="2">Tạm ngưng</option>
                            @else
                                <option selected value="2">Tạm ngưng</option>
                                <option value="0">Đang tiến hành</option>
                                <option value="1">Đã hoàn thành</option>
                            @endif
                        </select>
                    </div>
                    <div class="mt-3">
                        <label for="crud-form-1" class="form-label">Trạng thái</label>
                        <select name="status" class="custom-select">
                            @if($novel->status==0)
                                <option selected value="0">Kích hoạt</option>
                                <option value="1">Không kích hoạt</option>
                            @else
                                <option value="0">Kích hoạt</option>
                                <option selected value="1">Không kích hoạt</option>
                            @endif
                        </select>
                    </div>
                    <div class="mt-3">
                        <label for="crud-form-1" class="form-label">Ảnh bìa truyện</label></br>
                        <input type="file" class="form-control-file" name="image">
                        <img src="{{asset('uploads/novel/'.$novel->image)}}" height="250" width="180">
                    </div>
                    <div class="text-right mt-5">
                        <a href="{{ route('novel_index') }}">
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