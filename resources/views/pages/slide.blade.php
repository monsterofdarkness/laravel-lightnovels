
<div class="col-xs-12 col-sm-12 col-md-9">
    <div class="maincontent-area">    
        <div class="container">    
            <div class="b_title"><strong><i class="fas fa-trophy" style="font-weight: 900!important;"></i>    Truyện Nổi Bật</strong></div>
            <div class="owl-carousel owl-theme mt-5">
                @foreach($top8_novel as $key => $top)
                    <div class="slide-item">
                        <a href="{{ route('novel', ['slug' => $top->slug_novelname]) }}" title="">
                            <div class="item">
                                <img class="image lazy" src="{{ asset('uploads/novel/'.$top->image) }}">
                            </div>
                            <div class="series-info">
                                <div class="series">
                                {{ $top->novelname }}
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

                