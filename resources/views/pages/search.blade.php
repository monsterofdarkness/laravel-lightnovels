@extends('../welcome')

@section('title')
    {{ "Tìm kiếm" }}
@endsection

@section('content')
    <div class="container p-40" style="margin-bottom: 460px;">
        <div class="b_title"><strong>Kết quả tìm kiếm: {{ $keywords }}</strong></div>
        <div class="gridlist">
            @php
                $count = count($novel);
            @endphp

            @if($count == 0)
                <p style="color: var(--black);">Không tìm thấy truyện nào...</p>
            @else
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
            @endif
        </div>
    </div>
@endsection