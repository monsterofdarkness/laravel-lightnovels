
<div class="col-xs-12 col-sm-12 col-md-3">
    <div class="maincontent-area">    
        <div class="container">   
            <div class="tin-tuc">
                <div class="b_title"><strong><i class="far fa-newspaper"></i> Tin Tức</strong></div>
                    <main>
                        @foreach($list_topic as $key => $topic)
                        <div class="topic-item">
                            <div class="row">
                                <div class="line-ellipsis">
                                    @if($topic->type_topic == 1)
                                        <i class="fas fa-circle" style="color: #eb1d57; margin-right: 4px;"></i>
                                    @elseif($topic->type_topic == 2)
                                        <i class="fas fa-circle" style="color: #e01bb4; margin-right: 4px;"></i>
                                    @elseif($topic->type_topic == 3)
                                        <i class="fas fa-circle" style="color: #252eef; margin-right: 4px;"></i>
                                    @elseif($topic->type_topic == 4)
                                        <i class="fas fa-circle" style="color: #28e1e8; margin-right: 4px;"></i>
                                    @else
                                        <i class="fas fa-circle" style="color: #1ee865; margin-right: 4px;"></i>
                                    @endif
                                    <a href="{{ route('detail_topic', ['id' => $topic->id, 'slug' => $topic->slug_title]) }}" title="{{$topic->title}}">
                                        {{$topic->title}}
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </main>
                    <div class="note">
                        <a href="{{ route('index_topic') }}">Xem Thêm &gt;&gt;</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
