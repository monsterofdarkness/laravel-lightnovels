@extends('admin.management')

@section('title')
    {{ "Chỉnh sửa thành viên" }}
@endsection

@section('content')

    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Chỉnh sửa thành viên
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
            <form method="POST" action="{{ route('member_update', ['id' => $user->id]) }}">
                    @method('PUT')
                    @csrf
                    <div>
                        <label for="crud-form-1" class="form-label">Avatar</label></br>
                        <img src="{{asset('uploads/user/'.$user->avatar)}}" height="250" width="180">
                    </div>
                    <div class="mt-3">
                        <label for="crud-form-1" class="form-label">Tên</label></br>
                        <label>{{$user->name}}</label>
                    </div>
                    <div class="mt-3">
                        <label for="crud-form-1" class="form-label">Chức vụ</label>
                        <select name="role" class="custom-select">
                            @if($user->role==0)
                                <option selected value="0">Thành viên</option>
                                <option value="1">Admin</option>
                            @else
                                <option value="0">Thành viên</option>
                                <option selected value="1">Admin</option>
                            @endif
                        </select>
                    </div>
                    <div class="text-right mt-5">
                        <a href="{{ route('member_index') }}">
                            <button type="button" class="btn btn-outline-secondary w-24 mr-1">Hủy</button>
                        </a>
                        <button type="submit" class="btn btn-primary w-24">Cập nhật</button>
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