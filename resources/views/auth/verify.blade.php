@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Xác thực địa chỉ email của bạn!') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Một đường dẫn xác thực đã được gửi đến email đăng ký của bạn.') }}
                        </div>
                    @endif

                    {{ __('Trước khi tiếp tục, vui lòng hãy kiểm tra email của bạn để vào đường dẫn xác thực.') }}
                    {{ __('Nếu chưa nhận được') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('hãy bấm vào đây để gửi lại.') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
