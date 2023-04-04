@extends('../welcome')

@section('title')
    {{ "Tìm kiếm theo tác giả" }}
@endsection

@section('content')


<div class="container-fluid p-40" id="mainpart">
    <div class="container">
        <div class="b_title"><strong>Truyện của tác giả: {{ $novel_author_name->author }}</strong></div>
            <div class="gridlist">
                @foreach($novel_author as $key => $value)
                <div class="glitem">
                    <a href="{{route('novel', ['slug' => $value->slug_novelname] )}}">
                        <div class="image">
                            <img class="lazy loaded" src="{{ asset('uploads/novel/'.$value->image) }}" alt="{{$value->novelname}}" width="100%" height="100%" data-was-processed="true">
                        </div>
                    </a>
                    <a class="series-name" href="{{route('novel', ['slug' => $value->slug_novelname] )}}">{{$value->novelname}}</a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>



<div class="text-center center-pagination">
    {{ $novel_author->links() }}
</div>

@endsection