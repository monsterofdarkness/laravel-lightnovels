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
                <!-- BEGIN: Register Info -->
                <div class="hidden xl:flex flex-col min-h-screen">
                    <a href="{{ route('home') }}" class="-intro-x flex items-center pt-5">
                        <img alt="Shino Novel" style="width: 20rem;" src="{{ asset('images/ShinoNovelLogo.png') }}">
                    </a>
                    <div class="my-auto">
                        <img alt="Midone - HTML Admin Template" class="-intro-x w-1/2 -mt-16" src="{{ asset('template/admin/dist/images/illustration.svg') }}">
                        <!-- <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
                            A few more clicks to 
                            <br>
                            sign up to your account.
                        </div>
                        <div class="-intro-x mt-5 text-lg text-white text-opacity-70 dark:text-slate-400">Manage all your e-commerce accounts in one place</div> -->
                    </div>
                </div>
                <!-- END: Register Info -->
                <!-- BEGIN: Register Form -->
                <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                    <div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                        <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
                            Đăng ký
                        </h2>
                        @if($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger show flex items-center mt-2" role="alert">
                                    <i data-lucide="alert-octagon" class="w-6 h-6 mr-2"></i> {{ $error }}
                                </div>
                            @endforeach
                        @endif
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="intro-x mt-8">
                                <input id="name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus type="text" class="intro-x login__input form-control py-3 px-4 block mt-4" placeholder="Tên">
                                <input id="email" name="email" value="{{ old('email') }}" required autocomplete="email" type="text" class="intro-x login__input form-control py-3 px-4 block mt-4" placeholder="Email">
                                <input id="password" name="password" required autocomplete="new-password" type="password" class="intro-x login__input form-control py-3 px-4 block mt-4" placeholder="Mật khẩu">
                                <!-- <div class="intro-x w-full grid grid-cols-12 gap-4 h-1 mt-3">
                                    <div class="col-span-3 h-full rounded bg-success"></div>
                                    <div class="col-span-3 h-full rounded bg-success"></div>
                                    <div class="col-span-3 h-full rounded bg-success"></div>
                                    <div class="col-span-3 h-full rounded bg-slate-100 dark:bg-darkmode-800"></div>
                                </div> -->
                                <input id="password-confirm" name="password_confirmation" required autocomplete="new-password" type="password" class="intro-x login__input form-control py-3 px-4 block mt-4" placeholder="Nhập lại mật khẩu">
                            </div>
                            <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                                <button class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">Đăng ký</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- END: Register Form -->
            </div>
        </div>
        
        <!-- BEGIN: JS Assets-->
        @include('layoutsAdmin.footer')
        <!-- END: JS Assets-->
    </body>
</html>