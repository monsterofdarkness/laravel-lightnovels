@extends('admin.management')

@section('title')
    {{ "Quản lý chương" }}
@endsection

@section('content')
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <a href="{{ route('chapter_create', ['novel_id' => $novel->id]) }}">
                <button class="btn btn-primary shadow-md mr-2">+ Thêm chương</button>
            </a>
            <div class="hidden md:block mx-auto text-slate-500">
                <h2 class="intro-y text-lg font-medium mt-10">
                   {{ $novel->novelname }}
                </h2>
            </div>
            <form autocomplete="off" method="GET" action="{{ route('chapter_search', ['novel_id' => $novel->id]) }}" accept-charset="UTF-8" class="navbar-form navbar-right">
                @csrf
                <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                    <div class="w-56 relative text-slate-500">
                        <input type="search" id="keywords" name="keywords" class="form-control w-56 box pr-10" placeholder="Tìm kiếm chương truyện...">
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
                        <th class="whitespace-nowrap">TÊN CHƯƠNG</th>
                        <th class="text-center whitespace-nowrap">TRẠNG THÁI</th>
                        <th class="text-center whitespace-nowrap">NGÀY ĐĂNG</th>
                        <th class="text-center whitespace-nowrap">LẦN CUỐI CẬP NHẬT</th>
                        <th class="text-center whitespace-nowrap">HÀNH ĐỘNG</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($chapter as $chap)
                        <tr class="intro-x">
                            <td>{{ $chap->title }}</td>
                            <td class="text-center">
                                @if($chap->status==0)
                                    <div class="flex items-center justify-center text-success"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> Kích hoạt </div>
                                @else
                                    <div class="flex items-center justify-center text-danger"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> Không kích hoạt </div>
                                @endif
                            </td>
                            <td class="text-center">
                                {{ $chap->created_at }}
                            </td>
                            <td class="text-center">
                                {{ $chap->updated_at }}
                            </td>
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <a class="flex items-center mr-3 text-primary" href="{{ route('chapter_edit', ['id' => $chap->id]) }}"> <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> Sửa </a>
                                    <form action="{{route('chuong.destroy', [$chap->id])}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button onclick="return confirm('Bạn có chắc là muốn xóa chương này không?');">
                                            <a class="flex items-center text-danger" data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal"> <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> Xóa </a>
                                        </button>
                                    </form>
                                    <!-- <a class="flex items-center text-danger" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal"> <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> Xóa </a> -->
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr class="intro-x">
                            <td>Truyện chưa có chương nào hết...</td>
                            <td class="w-40"></td>
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
    <div class="mt-4 text-center center-pagination">
        {{ $chapter->links() }}
    </div>
@endsection
            