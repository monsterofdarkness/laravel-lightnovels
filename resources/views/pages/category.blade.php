@extends('../welcome')

@section('title')
    {{ "Danh sách truyện" }}
@endsection

@section('content')
<div class="container-fluid p-40" id="mainpart" style="margin-bottom: 460px;">
    <div class="container">
        <div class="b_title"><strong>Truyện {{ $category_id->categoryname }}</strong></div>
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
        </div>
    </div>
</div>
    
@endsection