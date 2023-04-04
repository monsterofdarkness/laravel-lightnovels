@extends('admin.management')

@section('title')
    {{ "Quản lý truyện" }}
@endsection

@section('content')
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <a href="{{ route('novel_create') }}">
                <button class="btn btn-primary shadow-md mr-2">+ Thêm truyện</button>
            </a>
            <div class="hidden md:block mx-auto text-slate-500">
                <h2 class="intro-y text-lg font-medium mt-10">
                    Danh sách truyện
                </h2>
            </div>
            <form autocomplete="off" method="GET" action="{{ route('novel_search') }}" accept-charset="UTF-8" class="navbar-form navbar-right">
                @csrf
                <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                    <div class="w-56 relative text-slate-500">
                        <input type="search" id="keywords" name="keywords" class="form-control w-56 box pr-10" placeholder="Tìm kiếm truyện...">
                        <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search"></i> 
                    </div>
                </div>
            </form>
        </div>
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">ẢNH BÌA</th>
                        <th class="whitespace-nowrap">TÊN TRUYỆN</th>
                        <th class="whitespace-nowrap">TÁC GIẢ</th>
                        <th class="whitespace-nowrap">THỂ LOẠI</th>
                        <th class="text-center whitespace-nowrap">TÌNH TRẠNG</th>
                        <th class="text-center whitespace-nowrap">TRẠNG THÁI</th>
                        <th class="text-center whitespace-nowrap">HÀNH ĐỘNG</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($novels as $key => $novel)
                        <tr class="intro-x">
                            <td class="w-40">
                                <div class="flex">
                                    <div class="w-20 h-20 image-fit zoom-in">
                                        <img class="tooltip rounded-full" src="{{asset('uploads/novel/'.$novel->image)}}" title="{{$novel->novelname}}">
                                    </div>
                                </div>
                            </td>
                            <td>
                                {{$novel->novelname}}
                            </td>
                            <td>{{$novel->author}}</td>
                            <td>
                                @foreach($novel->belongstomanycategory as $incategories)
                                    <span class="badge badge-dark">{{$incategories->categoryname}}</span>
                                @endforeach
                            </td>
                            <td class="text-center">
                                @if($novel->state==0)
                                    <div class="flex items-center justify-center text-primary"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> Đang tiến hành </div>
                                @elseif($novel->state==1)
                                    <div class="flex items-center justify-center text-success"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> Đã hoàn thành </div>
                                @else
                                    <div class="flex items-center justify-center text-warning"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> Tạm ngưng </div>
                                @endif
                            </td>
                            <td class="w-40">
                                @if($novel->status==0)
                                    <div class="flex items-center justify-center text-success"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> Kích hoạt </div>
                                @else
                                    <div class="flex items-center justify-center text-danger"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> Không kích hoạt </div>
                                @endif
                            </td>
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <a class="flex items-center mr-3 text-primary" href="{{ route('chapter_index', ['novel_id' => $novel->id]) }}"> <i data-lucide="list" class="w-4 h-4 mr-1"></i> Chương </a>
                                    <a class="flex items-center mr-3 text-primary" href="{{ route('novel_edit', ['id' => $novel->id]) }}"> <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> Sửa </a>
                                    <form action="{{route('truyen.destroy', [$novel->id])}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button onclick="return confirm('Bạn có chắc là muốn xóa truyện này không?');">
                                            <a class="flex items-center text-danger" data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal"> <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> Xóa </a>
                                        </button>
                                    </form>
                                    <!-- <a class="flex items-center text-danger" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal"> <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> Xóa </a> -->
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr class="intro-x">
                            <td class="w-40"></td>
                            <td>Không tìm thấy truyện...</td>
                            <td class="text-center"></td>
                            <td class="text-center"></td>
                            <td class="text-center"></td>
                            <td class="text-center"></td>
                            <td class="table-report__action w-56"></td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- END: Data List -->       
    </div>
<!-- BEGIN: Pagination -->

 <!-- END: Pagination -->
@endsection
            