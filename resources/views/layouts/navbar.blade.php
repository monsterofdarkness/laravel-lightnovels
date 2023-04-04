
                <nav class="navbar navbar-expand-lg navbar-light mainmenu-area">
                    <div class="container">
                    <a class="navbar-brand" href="{{ route('home') }}"><div class="logo"></div></a>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link" style="color: var(--lightgreen);" href="{{ route('AllNewNovel') }}">
                                Danh Sách Truyện
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link" style="color: var(--lightgreen);" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Thể Loại
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    @foreach($category as $key => $categories)
                                    <a class="dropdown-item" href="{{route('category', ['slug' => $categories->slug_category] )}}">{{$categories->categoryname}}</a>
                                    @endforeach
                                </div>
                            </li>
                        </ul>
                        <form autocomplete="off" method="GET" action="{{ route('search') }}" accept-charset="UTF-8" class="navbar-form navbar-right">
                            @csrf
                            <div class="input-group">
                                <input type="search" id="keywords" class="search-input search_input form-control" placeholder="Tìm kiếm..." name="keywords">
                                <div class="input-group-btn searchbutton">
                                    <button class="btn btn-default" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>                        
                        <li class="ml-4">
                            <div class="toggle"></div>
                        </li>

                        @if(!(Auth::check()))
                            <li class="ml-12" style="font-size: 18px; padding: 15px; color: #799a19; font-weight: 700;"><a href="{{ route('log-in') }}">Đăng Nhập</a></li>
                        @else
                            <li class="nav-item dropdown ml-12">
                                <a id="navbarDropdown" class="nav-link usernamelogin" style="color: var(--lightgreen);" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <img src="/uploads/user/{{ Auth::user()->avatar }}" style="width: 32px; height: 32px; position: absolute; bottom: 5px; left: -20px; border-radius: 50%;">
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    @php
                                        $role = Auth::user()->role
                                    @endphp
                                    @if($role == 1)
                                        <a class="dropdown-item" href="{{ route('homeAdmin') }}">
                                            <i class="fa-solid fa-house-chimney-user mr-2 w-4 h-4 text-center"></i>
                                            Trang quản lý
                                        </a>
                                        <a class="dropdown-item" href="{{ route('member_wall', ['id' => Auth::user()->id ] ) }}">
                                            <i class="fa fa-btn fa-user mr-2 w-4 h-4 text-center"></i>
                                            Trang cá nhân
                                        </a>
                                        <a class="dropdown-item" href="{{ route('favorite_page') }}">
                                            <i class="fas fa-heart mr-2 w-4 h-4 text-center" style="font-weight: 900!important;"></i>
                                            Yêu thích
                                        </a>
                                        <a>
                                            <hr class="dropdown-divider border-white/[0.08]">
                                        </a>
                                        <a class="dropdown-item" href="{{ route('log-out') }}">
                                            <i class="fa fa-btn fa-sign-out mr-2 w-4 h-4 text-center"></i>
                                            Đăng xuất
                                        </a>
                                    @else
                                        </a>
                                        <a class="dropdown-item" href="{{ route('member_wall', ['id' => Auth::user()->id ] ) }}">
                                            <i class="fa fa-btn fa-user mr-2 w-4 h-4 text-center"></i>
                                            Trang cá nhân
                                        </a>
                                        <a class="dropdown-item" href="{{ route('favorite_page') }}">
                                            <i class="fas fa-heart mr-2 w-4 h-4 text-center" style="font-weight: 900!important;"></i>
                                            Yêu thích
                                        </a>
                                        <a>
                                            <hr class="dropdown-divider border-white/[0.08]">
                                        </a>
                                        <a class="dropdown-item" href="{{ route('log-out') }}">
                                            <i class="fa fa-btn fa-sign-out mr-2 w-4 h-4 text-center"></i>
                                            Đăng xuất
                                        </a>
                                    @endif
                                </div>
                            </li>
                        @endif
                    </div>
                    </div>
                </nav>
