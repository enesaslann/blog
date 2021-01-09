<div class="col-md-auto">
    <div class="card">
        <h6 class="card-header bg-dark text-white">Kategoriler</h6>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <ul class="list">
                        @foreach($categories as $cate)
                        <li class="@if(Request::segment(2)==$cate->slug) active  text-info @endif">
                            <a href="{{route('category',$cate->slug)}}"> {{$cate->name}}<span class="badge bg-dark text-white float-right">{{$cate->contentCount()}}</span></a>
                        </li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>
    </div>
</div>