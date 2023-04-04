<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layouts.header')
        <title> @yield('title') - {{ "Shino Novel" }} </title>
    </head>
    <body>
        <section class="main_all">
            <!------------Navbar------------------>
            @include('layouts.navbar')
            <!-------------Trang Cá Nhân------------------>
            @yield('member')
            <div class="container-fluid" id="main">
                <div class="container">
                    <div class="row">
                        <!---------------------Slide------------------------->
                        @yield('slide')
                        <!---------------Bài viết--------------->
                        @yield('topic')
                        <!------------Chương Mới Nhất------------------->
                        @yield('novel_new_chapter')
                        <!---------Có thể bạn sẽ thích----------------->
                        @yield('maybe')
                        <!------------Truyện Mới Nhất------------------->
                        @yield('content')
                        <!---------Top truyện yêu thích----------------->
                        @yield('favorite')
                        <!---------Truyện Đã Hoàn Thành----------------->
                        @yield('completed')

                    </div>
                </div>
            </div>
                <!-------------Footer------------->
                @include('layouts.footer')
        </section>
    </body>
</html>


