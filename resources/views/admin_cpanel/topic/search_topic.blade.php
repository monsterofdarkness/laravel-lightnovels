@extends('admin.management')

@section('title')
    {{ "Quản lý bài viết" }}
@endsection

@section('content')
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <div class="hidden md:block mx-auto text-slate-500">
                <h2 class="intro-y text-lg font-medium mt-10">
                   Danh sách bài viết
                </h2>
            </div>
            <form autocomplete="off" method="GET" action="{{ route('topic_search') }}" accept-charset="UTF-8" class="navbar-form navbar-right">
                @csrf
                <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                    <div class="w-56 relative text-slate-500">
                        <input type="search" id="keywords" name="keywords" class="form-control w-56 box pr-10" placeholder="Tìm kiếm bài viết...">
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
                        <th class="whitespace-nowrap">NGƯỜI ĐĂNG</th>
                        <th class="whitespace-nowrap">TIÊU ĐỂ</th>
                        <th class="text-center whitespace-nowrap">CHUYÊN MỤC</th>
                        <th class="text-center whitespace-nowrap">THỜI GIAN ĐĂNG</th>
                        <th class="text-center whitespace-nowrap">LẦN CUỐI CẬP NHẬT</th>
                        <th class="text-center whitespace-nowrap">TRẠNG THÁI</th>
                        <th class="text-center whitespace-nowrap">HÀNH ĐỘNG</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($topics as $key => $topic)
                        <tr class="intro-x">
                            <td class="w-40">
                                <div class="flex">
                                    <div class="w-20 h-20 image-fit zoom-in">
                                        <img class="tooltip rounded-full" src="{{ asset('uploads/user/'.$topic->user->avatar) }}" title="{{$topic->user->name}}">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('detail_topic', ['id' => $topic->id, 'slug' => $topic->slug_title]) }}">
                                    <i class="fas fa-star"></i> {{ $topic->title }}
                                </a>
                            </td>
                            <td class="text-center">
                                @if($topic->type_topic == 1)
                                    <span class="category-circle">
                                        <i class="fas fa-circle" aria-hidden="true" style="color: #eb1d57; margin-right: 4px;"></i>
                                    </span>
                                    <a href="#" class="topic_type">Thông báo</a>
                                @elseif($topic->type_topic == 2)
                                    <span class="category-circle">
                                        <i class="fas fa-circle" aria-hidden="true" style="color: #e01bb4; margin-right: 4px;"></i>
                                    </span>
                                    <a href="#" class="topic_type">Tin tức</a>
                                @elseif($topic->type_topic == 3)
                                    <span class="category-circle">
                                        <i class="fas fa-circle" aria-hidden="true" style="color: #252eef; margin-right: 4px;"></i>
                                    </span>
                                    <a href="#" class="topic_type">Hỏi đáp</a>
                                @elseif($topic->type_topic == 4)
                                    <span class="category-circle">
                                        <i class="fas fa-circle" aria-hidden="true" style="color: #28e1e8; margin-right: 4px;"></i>
                                    </span>
                                    <a href="#" class="topic_type">Đánh giá</a>
                                @else
                                    <span class="category-circle">
                                        <i class="fas fa-circle" aria-hidden="true" style="color: #1ee865; margin-right: 4px;"></i>
                                    </span>
                                    <a href="#" class="topic_type">Thảo luận</a>
                                @endif
                            </td>
                            <td class="text-center">
                                {{ $topic->created_at }}
                            </td>
                            <td class="text-center">
                                {{ $topic->updated_at }}
                            </td>
                            <td class="text-center">
                                @if($topic->status==0)
                                    <div class="flex items-center justify-center text-success"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> Kích hoạt </div>
                                @else
                                    <div class="flex items-center justify-center text-danger"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> Không kích hoạt </div>
                                @endif
                            </td>
                            <td class="table-report__action w-56">
                                @if($topic->status == 0)
                                <form id="changeStatus{{ $topic->id }}" method="GET" action="{{ route('change_status',['topic_id' => $topic->id]) }}">
                                    <div class="form-check form-switch switch-hide">
                                        <input id="checkbox-switch-7" class="form-check-input" type="checkbox" onclick="submitChangeStatus{{ $topic->id }}()">
                                        <label class="form-check-label" for="checkbox-switch-7">Ẩn bài viết</label>
                                    </div>
                                </form>
                                @else
                                <form id="changeStatus{{ $topic->id }}" method="GET" action="{{ route('change_status',['topic_id' => $topic->id]) }}">
                                    <div class="form-check form-switch switch-hide">
                                        <input id="checkbox-switch-7" class="form-check-input" type="checkbox" checked onclick="submitChangeStatus{{ $topic->id }}()">
                                        <label class="form-check-label" for="checkbox-switch-7">Ẩn bài viết</label>
                                    </div>
                                </form>
                                @endif
                            </td>
                        </tr>
                        <script>
                            function submitChangeStatus{{ $topic->id }}() {
                                $('#changeStatus{{ $topic->id }}').submit();
                            }
                        </script>
                    @empty
                        <tr class="intro-x">
                            <td class="w-40"></td>
                            <td>Không tìm thấy bài viết</td>
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
            