@extends('../welcome')

@section('title')
    {{ "Tường nhà " }}  {{ $member->name }}
@endsection

@section('member')

<main id="mainpart" class="profile-page" style="padding-bottom: 104px;">
    <div class="profile-feature-wrapper">
        <div class="container">
            <div class="profile-feature">
                <div class="profile-cover">
                    <div class="fourone-ratio">
                        <div class="content img-in-ratio">
                            <img src="{{ url('/uploads/user/'.$member->cover) }}">
                        </div>
                    </div>
                </div>
                <div class="profile-nav">
                    <div class="profile-ava-wrapper">
                        <div class="profile-ava">
                            <img src="{{ url('/uploads/user/'.$member->avatar) }}">
                        </div>
                    </div>
                    <div class="profile-function at-desktop none block-m">
                        @if(Auth::check()) 
                            @php
                            $id_user = Auth::user()->id
                            @endphp
                            @if($id_user == $member->id)
                                <button type="button" class="button to-contact button-green" data-toggle="modal" data-target="#information_account">
                                    <i class="fas fa-edit" style="font-size: 20px;"></i>
                                    Sửa thông tin
                                </button>
                            @else
                                <!-- <button type="button" class="button to-contact button-green" data-toggle="modal" data-target="#">
                                    <i class="fas fa-edit" style="font-size: 20px;"></i>
                                    Liên lạc
                                </button> -->
                            @endif
                        
                        @else
                                <!-- <button type="button" class="button to-contact button-green" data-toggle="modal" data-target="#">
                                    <i class="fas fa-edit" style="font-size: 20px;"></i>
                                    Liên lạc
                                </button> -->
                        @endif
                        <!------------------------------- Dialog ------------------------------>

                        <div class="modal fade" id="information_account" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="dialog-container">
                                            <div class="dialog-content">
                                                <form class="eIoQdo" method="POST" action="{{ route('update_member', ['id' => $member->id]) }}" enctype='multipart/form-data'>
                                                    @method('PUT')
                                                    @csrf
                                                    <div class="Heading___Heading-sc-1wdsv8o-0 cfRHkz modal-header">
                                                        <!-- <a class="navbar-brand"><div class="logo"></div></a> -->
                                                        <div class="profile-cover" style="overflow: hidden;">
                                                            <div class="fourone-ratio">
                                                                <div class="content img-in-ratio">
                                                                    <img src="{{ url('/uploads/user/'.$member->cover) }}" style="width: 100%">
                                                                </div>
                                                            </div>
                                                                <div id="profile-changer_cover" class="profile-changer none block-m">
                                                                    <div class="cover-change" style="position: initial;">
                                                                        <input name="cover" type="file">
                                                                        <i class="fas fa-camera"></i>
                                                                        <span class="p-c_text">Yêu cầu 1110 x 300 px</span>
                                                                    </div>
                                                                </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-headline">
                                                        <h2>Thay đổi thông tin <b>tài khoản</b> của bạn</b>.</h2>
                                                    </div>
                                                    <div class="modal-fields">

                                                    <div class="avatar-dialog">
                                                        <div class="profile-ava">
                                                            <div id="profile-changer_ava" class="profile-changer">
                                                                <span class="p-c_text">
                                                                    <div class="round">
                                                                        <input name="avatar" type="file">
                                                                        <i class="fa fa-camera" style="color: #fff"></i>
                                                                    </div>
                                                                </span>
                                                            </div>
                                                            <img src="{{ url('/uploads/user/'.$member->avatar) }}">
                                                        </div>
                                                    </div>
                    
                                                    

                                                    <div class="field has-icon-left">
                                                        <label class="label" >Tên</label>
                                                        <div class="control">
                                                            <input name="name" placeholder="Tên" autocomplete="name nickname username" type="text" class="input" value="{{ $member->name }}">
                                                            <label class="icon icon-left" >
                                                                <div class="Basic___TooltipArea-sc-hic7b9-7 jQhXRe">
                                                                    <i class="fa-solid fa-user"></i>
                                                                </div>
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="field has-icon-left">
                                                        <label class="label" >Ngày sinh</label>
                                                        <div class="control">
                                                            <input name="birthday" placeholder="Ngày sinh" id="birthday-pk" type="text" class="input" value="{{ $member->birthday }}">
                                                            <label class="icon icon-left" >
                                                                <div class="Basic___TooltipArea-sc-hic7b9-7 jQhXRe">
                                                                    <i class="fa-solid fa-cake-candles"></i>
                                                                </div>
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="field has-icon-left">
                                                        <label class="lable" >Sở thích</label>
                                                        <div class="control">
                                                            <input name="favorite" placeholder="Sở thích" autocomplete="name nickname username"  type="text" class="input" value="{{ $member->favorite }}">
                                                            <label class="icon icon-left" >
                                                                <div class="Basic___TooltipArea-sc-hic7b9-7 jQhXRe">
                                                                    <i class="fa-solid fa-heart"></i>
                                                                </div>
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="field has-icon-left">
                                                        <label class="label" >Giới thiệu về bản thân</label>
                                                        <div class="control">
                                                            <input name="about" placeholder="Giới thiệu về bản thân" autocomplete="name nickname username" type="text" class="input" value="{{ $member->about }}">
                                                            <label class="icon icon-left" >
                                                                <div class="Basic___TooltipArea-sc-hic7b9-7 jQhXRe">
                                                                    <i class="fa-solid fa-address-card"></i>
                                                                </div>
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="Modal___ModalFooter-sc-1657dip-5 kGCHZn dialog-footer">
                                                        <div class="options">
                                                        <button type="submit" class="button to-contact button-save-dialog" data-toggle="modal">
                                                            <i class="fas fa-edit" style="font-size: 20px;"></i>
                                                            Lưu
                                                        </button>
                                                        </div>
                                                    </div>

                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!------------------------------- End Dialog ------------------------------>

                    </div>
                    <div class="profile-intro">
                        <h3 class="profile-intro_name">
                            {{ $member->name }}
                        </h3>
                        @if($member->role == 1)
                            <span class="profile-intro_role role-mem">Quản trị viên</span>
                        @else
                            <span class="profile-intro_role role-mem">Thành viên</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-3">
                <section class="basic-section clear">
                    <main class="sect-body">
                        <div class="p-s_i-bio">
                            <p>
                            {{ $member->about }}
                            </p>
                        </div>
                        <div class="profile-info-item">
                            <span class="info-name">
                                <i class="fas fa-calendar"></i> Ngày sinh: 
                            </span>
                            <span class="info-value">{{ $member->birthday }}</span>
                        </div>
                        <div class="profile-info-item">
                            <span class="info-name">
                                <i class="fas fa-star"></i> Sở thích: 
                            </span>
                            <span class="info-value">{{ $member->favorite }}</span>
                        </div>
                        <div class="profile-info-item">
                            <span class="info-name">
                                <i class="fas fa-calendar"></i> Tham gia: 
                            </span>
                            <span class="info-value">{{ $member->created_at->toDateString() }}</span>
                        </div>
                    </main>
                </section>
            </div>
            <div class="col-12 col-md-12 col-lg-9 col-xl-9">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @php
                    $count = count($novel_uploaded);
                @endphp
                @if($count > 0)
                    <div class="b_title"><strong>Truyện đã đăng</strong></div>
                    <div class="gridlist">
                        @foreach($novel_uploaded as $key => $value)
                        <div class="glitem">
                            <a href="{{ route('novel', ['slug' => $value->slug_novelname] ) }}">
                                <div class="image">
                                    <img class="lazy loaded" src="{{ asset('uploads/novel/'.$value->image) }}" alt="{{$value->novelname}}" width="100%" height="100%" data-was-processed="true">
                                </div>
                            </a>
                            <a class="series-name" href="{{ route('novel', ['slug' => $value->slug_novelname] ) }}">{{$value->novelname}}</a>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="b_title"><strong>Truyện đã đăng</strong></div>
                    <div class="gridlist">
                       <p style="color: var(--black);">Tài khoản chưa đăng truyện nào...</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</main>

@endsection