<!DOCTYPE html>
<html lang="en" class="light">
    <!-- BEGIN: Head -->
    <head>
        @include('layoutsAdmin.header')
    </head>
    <!-- END: Head -->
    <body class="login">
        <div class="container sm:px-10">
            <div class="block xl:grid grid-cols-2 gap-4">
                <!-- BEGIN: Login Info -->
                <div class="hidden xl:flex flex-col min-h-screen">
                    <a href="{{ route('home') }}" class="-intro-x flex items-center pt-5">
                        <img alt="Shino Novel" style="width: 20rem;" src="{{ asset('images/ShinoNovelLogo.png') }}">
                    </a>
                    <div class="my-auto">
                        <img alt="Midone - HTML Admin Template" class="-intro-x w-1/2 -mt-16" src="{{ asset('template/admin/dist/images/illustration.svg') }}">
                        <!-- <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
                            Chào mừng  đến với Shino Novel.
                        </div>
                        <div class="-intro-x mt-5 text-lg text-white text-opacity-70 dark:text-slate-400">Mang đến cho bạn đọc những tác phẩm mới nhất</div> -->
                    </div>
                </div>
                <!-- END: Login Info -->
                <!-- BEGIN: Login Form -->
                <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                    <div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                        <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
                            Đăng Nhập
                        </h2>
                        @if($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger show flex items-center mt-2" role="alert">
                                    <i data-lucide="alert-octagon" class="w-6 h-6 mr-2"></i> {{ $error }}
                                </div>
                            @endforeach
                        @endif
                        <form method="POST" action="{{ route('log-in') }}">
                            @csrf
                            <div class="intro-x mt-8">
                                <input type="text" class="intro-x login__input form-control py-3 px-4 block" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Nhập Email">
                                <input type="password" class="intro-x login__input form-control py-3 px-4 block mt-4" name="password" required autocomplete="current-password" placeholder="Mật khẩu">
                            </div>
                            <div class="intro-x flex text-slate-600 dark:text-slate-500 text-xs sm:text-sm mt-4">
                                <div class="flex items-center mr-auto">
                                    <input id="remember" name="remember" type="checkbox" class="form-check-input border mr-2" value="{{ old('remember') ? 'checked' : '' }}">
                                    <label class="cursor-pointer select-none" for="remember">Ghi nhớ</label>
                                </div>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}">Quên mật khẩu?</a> 
                                @endif
                            </div>
                            <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                                <button type="submit" class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">Đăng nhập</button>
                                <a href="{{ route('sign-up-view') }}">
                                    <button type="button" class="btn btn-outline-secondary py-3 px-4 w-full xl:w-32 mt-3 xl:mt-0 align-top">Đăng ký</button>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- END: Login Form -->
            </div>
        </div>
        
        <!-- BEGIN: JS Assets-->
        @include('layoutsAdmin.footer')
        <!-- END: JS Assets-->
    </body>
</html>