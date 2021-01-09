@extends('back/layouts/master')
@section('title','Silinen Makaleler')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><Strong>"{{$content->count()}}" Makale bulundu </Strong>
            <a href="{{route('makale')}}" class="btn btn-primary btn-sm float-right"><i class="fa fa-arrow-circle-left"></i> Geri</a>
        </h6>

    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Fotoğraf</th>
                        <th>Makale Başlığı</th>
                        <th>Kategori</th>
                        <th>Görüntülenme </th>
                        <th>Oluşturulma Tarihi</th>
                        <th>Durum</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($content as $cont)
                    <tr>
                        <td><img src="{{$cont->image}}" width="200"></td>
                        <td>{{$cont->title}}</td>
                        <td> {{$cont->getCategory->name}}</td>
                        <td>{{$cont->hit}}</td>
                        <td>{{$cont->created_at->diffForHumans()}}</td>
                        <td></td>
                        <td>
                            <a href="{{route('makale_recover',$cont->id)}}" title="Silinenlerden Kaldır" class="btn btn-sm btn-primary"><i class="fa fa-recycle"></i></a>
                            <a href="{{route('makale_hardDelete',$cont->id)}}" title="Sil" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>
@endsection
