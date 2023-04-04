@extends('admin.management')

@section('title')
    {{ "Quản lý thành viên" }}
@endsection

@section('content')
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <div class="hidden md:block mx-auto text-slate-500">
                <h2 class="intro-y text-lg font-medium mt-10">
                    Danh sách thành viên
                </h2>
            </div>
            <form autocomplete="off" method="GET" action="{{ route('member_search') }}" accept-charset="UTF-8" class="navbar-form navbar-right">
                @csrf
                <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                    <div class="w-56 relative text-slate-500">
                        <input type="search" id="keywords" name="keywords" class="form-control w-56 box pr-10" placeholder="Tìm kiếm thành viên...">
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
                        <th class="whitespace-nowrap">AVATAR</th>
                        <th class="whitespace-nowrap">TÊN</th>
                        <th class="whitespace-nowrap">THÔNG TIN VỀ BẢN THÂN</th>
                        <th class="whitespace-nowrap">SỞ THÍCH</th>
                        <th class="text-center whitespace-nowrap">NGÀY SINH</th>
                        <th class="text-center whitespace-nowrap">CHỨC VỤ</th>
                        <th class="text-center whitespace-nowrap">TRẠNG THÁI</th>
                        <th class="text-center whitespace-nowrap">HÀNH ĐỘNG</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($member as $key => $values)
                        <tr class="intro-x">
                            <td class="w-40">
                                <div class="flex">
                                    <div class="w-20 h-20 image-fit zoom-in">
                                        <img class="tooltip rounded-full" src="{{asset('uploads/user/'.$values->avatar)}}" title="{{$values->name}}">
                                    </div>
                                </div>
                            </td>
                            <td>
                                {{$values->name}}
                            </td>
                            <td>
                                {{$values->about}}
                            </td>
                            <td>
                                {{$values->favorite}}
                            </td>
                            <td class="text-center">
                                {{$values->birthday}}
                            </td>
                            <td class="w-40">
                                @if($values->role==1)
                                    <div class="flex items-center justify-center text-success"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> Quản trị viên </div>
                                @else
                                    <div class="flex items-center justify-center text-primary"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> Thành viên </div>
                                @endif
                            </td>
                            <td class="w-40 text-center">
                                @if($values->status==0)
                                    <div class="flex items-center justify-center text-success"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> Kích hoạt </div>
                                @else
                                    <div class="flex items-center justify-center text-danger"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> Không kích hoạt </div>
                                @endif
                            </td>
                            <td class="table-report__action w-56">
                                @if($values->role == 0)
                                <form id="changeRole{{ $values->id }}" method="GET" action="{{ route('change_role',['id' => $values->id]) }}">
                                    <div class="form-check form-switch" style="margin-left: 10px;">
                                        <input id="checkbox-switch-7" class="form-check-input" type="checkbox" onclick="submitChangeRole{{ $values->id }}()">
                                        <label class="form-check-label" for="checkbox-switch-7">Quản trị viên</label>
                                    </div>
                                </form>
                                @else
                                <form id="changeRole{{ $values->id }}" method="GET" action="{{ route('change_role',['id' => $values->id]) }}">
                                    <div class="form-check form-switch" style="margin-left: 10px;">
                                        <input id="checkbox-switch-7" class="form-check-input" type="checkbox" checked onclick="submitChangeRole{{ $values->id }}()">
                                        <label class="form-check-label" for="checkbox-switch-7">Quản trị viên</label>
                                    </div>
                                </form>
                                @endif

                                @if($values->status == 0)
                                <form id="changeStatus{{ $values->id }}" method="GET" action="{{ route('change_member_status',['id' => $values->id]) }}">
                                    <div class="form-check form-switch mt-2" style="margin-left: 10px;">
                                        <input id="checkbox-switch-7" class="form-check-input" type="checkbox" checked onclick="submitChangeStatus{{ $values->id }}()">
                                        <label class="form-check-label" for="checkbox-switch-7">Kích hoạt tài khoản</label>
                                    </div>
                                </form>
                                @else
                                <form id="changeStatus{{ $values->id }}" method="GET" action="{{ route('change_member_status',['id' => $values->id]) }}">
                                    <div class="form-check form-switch mt-2" style="margin-left: 10px;">
                                        <input id="checkbox-switch-7" class="form-check-input" type="checkbox" onclick="submitChangeStatus{{ $values->id }}()">
                                        <label class="form-check-label" for="checkbox-switch-7">Kích hoạt tài khoản</label>
                                    </div>
                                </form>
                                @endif
                            </td>
                        </tr>
                        <script>
                            function submitChangeRole{{ $values->id }}() {
                                $('#changeRole{{ $values->id }}').submit();
                            }

                            function submitChangeStatus{{ $values->id }}() {
                                $('#changeStatus{{ $values->id }}').submit();
                            }
                        </script>
                    @empty
                        <tr class="intro-x">
                            <td class="w-40"></td>
                            <td>Không tìm thấy thành viên...</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="w-40"></td>
                            <td class="w-40"></td>
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
            