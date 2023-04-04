<!DOCTYPE html>
<html lang="en" class="light">
    <!-- BEGIN: Head -->
    <head>
        @include('layoutsAdmin.header')
        <title> @yield('title') - {{ "Shino Novel" }} </title>
    </head>
    <!-- END: Head -->
    <body class="py-5 md:py-0 bg-black/[0.15] dark:bg-transparent">
        <div class="flex overflow-hidden">
            @include('layoutsAdmin.sidebar')
            <!-- BEGIN: Content -->
            <div class="content">
                @include('layoutsAdmin.topbar')
                @yield('content')
            </div>
            <!-- END: Content -->
        </div>
        @include('layoutsAdmin.footer')
    </body>
</html>