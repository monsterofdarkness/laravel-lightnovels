<div class="col-12 col-lg-3">
    <div class="maincontent-area">    
        <div class="container">   
            <section class="index-section rank-circle most-favorite">
                <header>
                    <div class="b_title"><strong><i class="fa-solid fa-heart"></i>    Top yêu thích</strong></div>
                </header>
                <main>
                    @foreach($most_favorite as $key => $favorite)
                    <div class="rank-circle-item">
                        <span class="rank-number">{{$key+1}}</span>
                        <div class="series-detail clear">
                            <div class="series-cover">
                                <div class="a6-ratio">
                                    <div class="content img-in-ratio">
                                        <img src="{{ asset('uploads/novel/'.$favorite->novel->image) }}" class="cover-favorite-list">
                                    </div>
                                </div>
                            </div>
                            <a class="title-favorite-list" href="{{ route('novel', ['slug' => $favorite->novel->slug_novelname]) }}" title="{{ $favorite->novel->novelname }}">
                                <h5 class="series-title">{{ $favorite->novel->novelname }}</h5>
                            </a>
                            <small class="rank-count">{{ $favorite->favorites }} lượt yêu thích</small>
                        </div>
                    </div>
                    @endforeach
                </main>
            </section>
        </div>
    </div>
</div>

