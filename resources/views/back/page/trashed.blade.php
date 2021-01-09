@extends('back/layouts/master')
@section('title','Silinen Sayfalar')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><Strong>"{{$pages->count()}}" Sayfa bulundu </Strong>
            <a href="{{route('page_index')}}" class="btn btn-primary btn-sm float-right"><i class="fa fa-arrow-circle-left"></i> Geri</a>
        </h6>

    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Fotoğraf</th>
                        <th>Sayfa Başlığı</th>
                        <th>Sayfa İçeriği</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($pages as $page)
                    <tr>
                        <td><img src="{{$page->image}}" width="200"></td>
                        <td>{{$page->title}}</td>
                        <td>{!!Str::limit($page->content,300)!!}</td>
                        <td>
                            <a href="{{route('page_recover',$page->id)}}" title="Silinenlerden Kaldır" class="btn btn-sm btn-primary"><i class="fa fa-recycle"></i></a>
                            <a href="{{route('page_hardDelete',$page->id)}}" title="Sil" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>
@endsection