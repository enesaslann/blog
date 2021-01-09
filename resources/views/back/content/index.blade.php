@extends('back/layouts/master')
@section('title','Tüm Makaleler')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><Strong>"{{$content->count()}}" Makale bulundu </Strong>
            <a href="{{route('makale_trashed')}}" class="btn btn-warning btn-sm float-right "><i class="fa fa-trash"></i> Silinen Makaleler</a>
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
                        <th>Oluşturma Tarihi</th>
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

                        <style>
                            .toggle.ios,
                            .toggle-on.ios,
                            .toggle-off.ios {
                                border-radius: 20px;
                            }

                            .toggle.ios .toggle-handle {
                                border-radius: 20px;
                            }
                        </style>

                        <td><input class="switch" content_id="{{$cont->id}}" type="checkbox" data-off="Pasif" data-on="Aktif" data-style="ios" data-onstyle="primary" data-offstyle="danger" @if($cont->status==1) checked @endif data-toggle="toggle"></td>

                        <td>
                            <a target="_blank" href="{{route('post',[$cont->getCategory->slug,$cont->slug])}}" title="Görüntüle" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                            <a href="{{route('makale_edit',$cont->id)}}" title="Düzenle" class="btn btn-sm btn-primary"><i class="fa fa-pen"></i></a>
                            <a href="{{route('makale_delete',$cont->id)}}" title="Sil" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>
@endsection
@section('css')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection

@section('js')
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script>
    $(function() {
        $('.switch').change(function() {
            id = $(this)[0].getAttribute('content_id');
            statu = $(this).prop('checked');
            $.get("{{route('switch')}}", {
                id: id,
                statu: statu
            }, function(data, status) {});
        })
    })
</script>

@endsection