<!DOCTYPE html>

<html lang="en" class="light">
    <!-- BEGIN: Head -->
    <head>
    @include('layoutsAdmin.header')
    </head>
    <!-- END: Head -->
    <body class="py-5 md:py-0 bg-black/[0.15] dark:bg-transparent">
        <div class="container">
            <!-- BEGIN: Error Page -->
            <div class="error-page flex flex-col lg:flex-row items-center justify-center h-screen text-center lg:text-left">
                <div class="-intro-x lg:mr-20">
                    <img alt="Midone - HTML Admin Template" class="h-48 lg:h-auto" src="{{ asset('template/admin/dist/images/error-illustration.svg') }}">
                </div>
                <div class="text-white mt-10 lg:mt-0 text-center">
                    <div class="intro-x text-8xl font-medium">500</div>
                    <div class="intro-x text-xl lg:text-3xl font-medium mt-5">Oops. Trang này không tồn tại.</div>
                    <div class="intro-x text-lg mt-3">Có thể như bạn đã nhập sai đường dẫn hoặc trang này đã bị chuyển hay xóa mất rồi.</div>
                    <a href="{{ route('home') }}">
                        <button class="intro-x btn py-3 px-4 text-white border-white dark:border-darkmode-400 dark:text-slate-200 mt-10">Về trang chủ nào!</button>
                    </a>
                </div>
            </div>
            <!-- END: Error Page -->
        </div>
        
        <!-- BEGIN: JS Assets-->
        @include('layoutsAdmin.footer')
        <!-- END: JS Assets-->
    </body>
</html>