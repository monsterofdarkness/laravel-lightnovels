<div class="col-12 col-lg-9">
    <div class="maincontent-area">
        <div class="container">
            <div class="b_title"><strong>Truyện Đã Hoàn Thành</strong></div>
            <div class="gridlist">
                @foreach($completed_novel as $key => $completed)
                <div class="glitem">
                    <a href="{{ route('novel', ['slug' => $completed->slug_novelname]) }}">
                        <div class="image">
                            <img class="lazy loaded" src="{{ asset('uploads/novel/'.$completed->image) }}" alt="{{$completed->novelname}}" width="100%" height="100%" data-was-processed="true">
                        </div>
                    </a>
                    <a class="series-name" href="{{ route('novel', ['slug' => $completed->slug_novelname]) }}">{{$completed->novelname}}</a>
                </div>
                @endforeach
                <div class="glitem glitem-see-more">
                    <a title="" href="{{ route('AllCompleted') }}">
                        <div class="image lazy" style="">
                            <img class="lazy loaded" src="{{ asset('images/readmore.jpg') }}" alt="" width="100%" height="100%" data-was-processed="true">
                        </div>
                        <div class="see-more"><div class="btn-see-more-icon">
                            <i class="fas fa-angle-double-right"></i>
                        </div>
                    </a>
                </div>
                <a class="series-name" title="Xem Thêm" href="{{ route('AllCompleted') }}">Xem Thêm</a>
            </div>
        </div>
    </div>
</div>
</div>

    