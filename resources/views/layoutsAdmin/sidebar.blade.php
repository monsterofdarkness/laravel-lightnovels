            <!-- BEGIN: Side Menu -->
            <nav class="side-nav">
                <a href="{{ route('home') }}" class="intro-x flex items-center pl-5 pt-4 mt-3">
                    <img  class="" src="{{ asset('images/ShinoNovelLogo.png') }}">
                </a>
                <div class="side-nav__devider my-6"></div>
                <ul>
                    <li>
                        <a href="{{ route('homeAdmin') }}" class="side-menu side-menu{{ Request::is('admin/trang-quan-ly') ? '--active' : '' }}">
                            <div class="side-menu__icon"> <i data-lucide="layout-dashboard"></i> </div>
                            <div class="side-menu__title">
                                Thống kê 
                            </div>
                        </a>
                    </li>
                    <li class="side-nav__devider my-6"></li>
                    <li>
                        <a href="{{ route('member_index') }}" class="side-menu side-menu{{ Request::is('admin/quan-ly/thanh-vien') ? '--active' : '' }}">
                            <div class="side-menu__icon"> <i data-lucide="users"></i> </div>
                            <div class="side-menu__title">
                                Thành viên 
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('novel_index') }}" class="side-menu side-menu{{ Request::is('admin/quan-ly/truyen') ? '--active' : '' }}">
                            <div class="side-menu__icon"> <i data-lucide="library"></i> </div>
                            <div class="side-menu__title">
                                Truyện
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('category_index') }}" class="side-menu side-menu{{ Request::is('admin/quan-ly/the-loai') ? '--active' : '' }}">
                            <div class="side-menu__icon"> <i data-lucide="clipboard-list"></i> </div>
                            <div class="side-menu__title">
                                Thể loại 
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('topic_index') }}" class="side-menu side-menu{{ Request::is('admin/quan-ly/bai-viet') ? '--active' : '' }}">
                            <div class="side-menu__icon"> <i data-lucide="send"></i> </div>
                            <div class="side-menu__title">
                                Bài viết
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('report_index') }}" class="side-menu side-menu{{ Request::is('admin/quan-ly/bao-cao') ? '--active' : '' }}">
                            <div class="side-menu__icon"> <i data-lucide="flag"></i> </div>
                            <div class="side-menu__title">
                                Báo cáo
                            </div>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- END: Side Menu -->