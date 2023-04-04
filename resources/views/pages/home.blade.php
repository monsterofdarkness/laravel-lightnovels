@extends('../welcome')

@section('title')
    {{ "Trang Chủ" }}
@endsection

@section('slide')
    @include('pages.slide')
@endsection

@section('topic')
    @include('pages.topic')
@endsection

@section('content')

@section('novel_new_chapter')
    @include('pages.novel_new_chapter')
@endsection

<div class="col-12 col-lg-9">
    <div class="maincontent-area">
        <div class="container">
            <div class="b_title"><strong>Truyện Mới Nhất</strong></div>
            <div class="gridlist">
                @foreach($novel as $key => $value)
                <div class="glitem">
                    <a href="{{ route('novel', ['slug' => $value->slug_novelname]) }}">
                        <div class="image">
                            <img class="lazy loaded" src="{{ asset('uploads/novel/'.$value->image) }}" alt="{{$value->novelname}}" width="100%" height="100%" data-was-processed="true">
                        </div>
                    </a>
                    <a class="series-name" href="{{ route('novel', ['slug' => $value->slug_novelname]) }}">{{$value->novelname}}</a>
                </div>
                @endforeach
                <div class="glitem glitem-see-more">
                    <a title="" href="{{ route('AllNewNovel') }}">
                        <div class="image lazy" style="">
                            <img class="lazy loaded" src="{{ asset('images/readmore.jpg') }}" alt="" width="100%" height="100%" data-was-processed="true">
                        </div>
                        <div class="see-more"><div class="btn-see-more-icon">
                            <i class="fas fa-angle-double-right"></i>
                        </div>
                    </a>
                </div>
                <a class="series-name" title="Xem Thêm" href="{{ route('AllNewNovel') }}">Xem Thêm</a>
            </div>
        </div>
    </div>
</div>
</div>

@endsection

@section('completed')
    @include('pages.completed')
@endsection

@section('maybe')
    @include('pages.maybe_you_will_like')
@endsection

@section('favorite')
    @include('pages.most_novel_favorite')
@endsection