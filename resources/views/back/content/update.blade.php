@extends('back/layouts/master')
@section('title','Makale Güncelle')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
    </div>
    <div class="card-body">
        @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
            <li> {{$error}} </li>
            @endforeach
        </div>
        @endif
        <form method="post" action="{{route('makale_update',$content->id)}}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="">Makale Başlığı</label>
                <input type="text" name="title" class="form-control" value="{{$content->title}}" required>
            </div>
            <div class="form-group">
                <label for="">Makale Kategori</label>
                <select name="category" class="form-control" required>
                    <option value="">Seçim Yapınız</option>
                    @foreach($category as $cate)
                    <option @if($content->category_id==$cate->id) selected @endif  value="{{$cate->id}}">{{$cate->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">Makale Fotoğrafı</label><br>
                <img src="{{asset($content->image)}}" class="img-thumbnail rounded" width="300" >
                <input type="file" name="image" class="form-control" >
            </div>
            <div class="form-group">
                <label for="">Makale İçeriği</label>
                <textarea id="editor" rows="4" name="content" class="form-control" required>{!!$content->content!!}</textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Makaleyi Güncelle</button>
            </div>
        </form>
    </div>
</div>


@endsection
@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
    $(document).ready(function() {
        $('#editor').summernote({
            'height': 300
        });
    });
</script>
@endsection 