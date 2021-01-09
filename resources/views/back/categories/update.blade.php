@extends('back/layouts/master')
@section('title','Kategori Güncelle')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Yeni Kategori Oluştur</h6>
            </div>
            <div class="card-body">
                @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                    <li> {{$error}} </li>
                    @endforeach
                </div>
                @endif
                <form method="post" action="{{route('category_update',$category->id)}}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="">Kategori Adı</label>
                        <input type="text" name="name" class="form-control" required value="{{$category->name}}">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Kategoriyi Oluştur</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection