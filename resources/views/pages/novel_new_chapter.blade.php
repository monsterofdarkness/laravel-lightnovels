<div class="col-12 col-lg-9">
    <div class="maincontent-area">
        <div class="container">
            <div class="b_title"><strong>Chương mới cập nhật</strong></div>
            <div class="gridlist">
                @foreach($new_chapter as $key => $value)
                @if($value->novel->status == 0)
                <div class="glitem">
                    <a href="{{ route('novel', ['slug' => $value->novel->slug_novelname]) }}">
                        <div class="image">
                            <img class="lazy loaded" src="{{ asset('uploads/novel/'.$value->novel->image) }}" alt="{{$value->novel->novelname}}" width="100%" height="100%" data-was-processed="true">
                        </div>
                    </a>
                    <div class="series-info">
                        <a class="chap" title="{{$value->title}}" href="{{ route('chapter', ['id' => $value->id, 'slug' => $value->slug_chapter]) }}">{{ $value->title }}</a>
                    </div>
                    <a class="series-name" href="{{ route('novel', ['slug' => $value->novel->slug_novelname]) }}">{{$value->novel->novelname}}</a>
                </div>
                @endif
                @endforeach
                <div class="glitem glitem-see-more">
                    <a title="" href="{{ route('AllNewChapter') }}">
                        <div class="image lazy" style="">
                            <img class="lazy loaded" src="{{ asset('images/readmore.jpg') }}" alt="" width="100%" height="100%" data-was-processed="true">
                        </div>
                        <div class="see-more"><div class="btn-see-more-icon">
                            <i class="fas fa-angle-double-right"></i>
                        </div>
                    </a>
                </div>
                <a class="series-name" title="Xem Thêm" href="{{ route('AllNewChapter') }}">Xem Thêm</a>
            </div>
        </div>
    </div>
</div>
</div>