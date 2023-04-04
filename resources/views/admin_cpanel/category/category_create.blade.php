@extends('admin.management')

@section('title')
    {{ "Thêm thể loại" }}
@endsection

@section('content')

    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Thêm thể loại
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
                <form method="POST" action="{{route('the-loai.store')}}">
                    @csrf
                    <div>
                        <label for="crud-form-1" class="form-label">Tên thể loại</label>
                        <input type="text" class="form-control" value="{{old('categoryname')}}" onkeyup="ChangeToSlug();" name="categoryname" id="slug" placeholder="Tên thể loại...">
                        <input type="hidden" class="form-control" value="{{old('slug_category')}}" name="slug_category" id="convert_slug"  placeholder="Slug thể loại...">
                    </div>
                    <div class="mt-3">
                        <label for="crud-form-1" class="form-label">Trạng thái</label>
                        <select name="status" class="custom-select">
                            <option value="0">Kích hoạt</option>
                            <option value="1">Không kích hoạt</option>
                        </select>
                    </div>
                    <div class="text-right mt-5">
                        <a href="{{ route('category_index') }}">
                            <button type="button" class="btn btn-outline-secondary w-24 mr-1">Hủy</button>
                        </a>
                        <button type="submit" class="btn btn-primary w-24">Thêm</button>
                    </div>
                </form>
            </div>
            <!-- END: Form Layout -->
        </div>
        <div class="intro-y col-span-12 lg:col-span-6">
            <img src="{{ asset('images/ShinoNovelLogo.png') }}">
        </div>
    </div>

@endsection