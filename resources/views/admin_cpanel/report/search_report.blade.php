@extends('admin.management')

@section('title')
    {{ "Quản lý truyện" }}
@endsection

@section('content')
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <div class="hidden md:block mx-auto text-slate-500">
                <h2 class="intro-y text-lg font-medium mt-10">
                    Danh sách bài báo cáo
                </h2>
            </div>
            <form autocomplete="off" method="GET" action="{{ route('report_search') }}" accept-charset="UTF-8" class="navbar-form navbar-right">
                @csrf
                <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                    <div class="w-56 relative text-slate-500">
                        <input type="search" id="keywords" name="keywords" class="form-control w-56 box pr-10" placeholder="Tìm kiếm báo cáo...">
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
                        <th class="text-center whitespace-nowrap">LÝ DO BÁO CÁO</th>
                        <th class="text-center whitespace-nowrap">NGƯỜI BÁO CÁO</th>
                        <th class="text-center whitespace-nowrap">HÀNH ĐỘNG</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reports as $key => $report)
                        <tr class="intro-x">
                            <td class="w-40">
                                <div class="flex">
                                    <div class="w-20 h-20 image-fit zoom-in">
                                        <img class="tooltip rounded-full" src="{{asset('uploads/novel/'.$report->novel->image)}}" title="{{$report->novel->novelname}}">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('novel', ['slug' => $report->novel->slug_novelname]) }}">
                                    {{$report->novel->novelname}}
                                </a>
                            </td>
                            <td class="text-center">
                                @if($report->reason == 1)
                                    <a class="topic_type">Spam</a>
                                @elseif($report->reason == 2)
                                    <a class="topic_type">Lỗi font</a>
                                @elseif($report->reason == 3)
                                    <a class="topic_type">Sai nội dung</a>
                                @elseif($report->reason == 4)
                                    <a class="topic_type">Nội dung không phù hợp</a>
                                @else
                                    <a class="topic_type">Khác</a>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('member_wall', ['id' => $report->user->id] ) }}">{{ $report->user->name }}</a>
                            </td>
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <form action="{{ route('report_keep', ['report_id' => $report->id]) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="novel_id" value="{{ $report->novel->id }}"></input>
                                        <button>
                                            <a class="flex items-center mr-3 text-primary" href=""> <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> Giữ truyện </a>
                                        </button>
                                    </form>
                                    <form action="{{ route('report_hide', ['report_id' => $report->id]) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="novel_id" value="{{ $report->novel->id }}"></input>
                                        <button onclick="return confirm('Bạn có chắc là muốn ẩn truyện này không?');">
                                            <a class="flex items-center text-danger" data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal"> <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> Ẩn truyện </a>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr class="intro-x">
                            <td class="w-40"></td>
                            <td>Không tìm thấy báo cáo...</td>
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
            