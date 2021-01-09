@extends('back/layouts/master')
@section('title','Tüm Sayfalar')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><Strong>"{{$pages->count()}}" Sayfa bulundu </Strong>
            <a href="{{route('page_trashed')}}" class="btn btn-warning btn-sm float-right "><i class="fa fa-trash"></i> Silinen Sayfalar</a>
        </h6>

    </div>
    <div class="card-body">
        <div id="orderSuccess" class="alert alert-success" style="display:none;">
            Sıralama Başarıyla Güncelleştirildi.
        </div>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Sıralama</th>
                        <th>Fotoğraf</th>
                        <th>Sayfa Başlığı</th>
                        <th>Sayfa İçeriği</th>
                        <th>Durum</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>

                <tbody id='orders'>
                    @foreach($pages as $page)
                    <tr id="page_{{$page->id}}">
                        <td class="text-center"><i class="fa fa-arrows-alt-v fa-2x handle" style="cursor:move"></i></td>
                        <td><img src="{{$page->image}}" width="200"></td>
                        <td>{{$page->title}}</td>
                        <td>{!!Str::limit($page->content,150)!!}</td>

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

                        <td><input class="switch" page_id="{{$page->id}}" type="checkbox" data-off="Pasif " data-on="Aktif " data-style="ios" data-onstyle="primary" data-offstyle="danger" @if($page->status==1) checked @endif data-toggle="toggle"></td>

                        <td>
                            <a target="_blank" 0 href="{{route('page',$page->slug)}}" title="Görüntüle" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                            <a href="{{route('page_edit',$page->id)}}" title="Düzenle" class="btn btn-sm btn-primary"><i class="fa fa-pen"></i></a>
                            <a href="{{route('page_delete',$page->id)}}" title="Sil" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
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
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.12.0/dist/sortable.umd.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script>
    $('#orders').sortable({
        handle: '.handle',
        update: function() {
            var x = $('#orders').sortable('serialize');
            $.get("{{route('page_orders')}}?" + x, function(data, status) { 
                $('#orderSuccess').show();
                setTimeout(function(){
                    $('#orderSuccess').hide();
                },2000);
            });
        }
    });
</script>
<script>
    $(function() {
        $('.switch').change(function() {
            id = $(this)[0].getAttribute('page_id');
            statu = $(this).prop('checked');
            $.get("{{route('page_switch')}}", {
                id: id,
                statu: statu
            }, function(data, status) {});
        })
    })
</script>

@endsection