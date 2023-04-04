<div class="col-12 col-lg-3">
    <div class="maincontent-area">    
        <div class="container">   
            <section class="index-section">
                <header>
                    <div class="b_title"><strong><i class="fa-solid fa-dice"></i>    Gợi ý ngẫu nhiên</strong></div>
                </header>
                <main class="d-lg-block">
                    <ul class="others-list">
                        @foreach($maybe_you_will_like as $maybe)
                            <li>
                                <div class="others-img no-padding">
                                    <div class="a6-ratio">
                                        <div class="content img-in-ratio"> 
                                            <img  src="{{ asset('uploads/novel/'.$maybe->image) }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="others-info">
                                    <h5 class="others-name"><a href="{{ route('novel', ['slug' => $maybe->slug_novelname]) }}">{{ $maybe->novelname }}</a></h5>
                                    <small class="series-summary-2">{!! $maybe->summary !!}</small>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </main>
            </section>
        </div>
    </div>
</div>



