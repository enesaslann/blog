@extends('back/layouts/master')
@section('title','Kategoriler')
@section('content')

<div class="row">
    <div class="col-md-4">
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
                <form method="post" action="{{route('category_save')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Kategori Adı</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Kategoriyi Oluştur</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">

                <h6 class="m-0 font-weight-bold text-primary"><Strong>"{{$category->count()}}" Kategori bulundu </Strong>
                </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Kategori Adı</th>
                                <th>Makale Sayısı</th>
                                <th>Durum</th>
                                <th>İşlemler</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($category as $cate)
                            <tr>
                                <td>{{$cate->name}}</td>
                                <td> {{$cate->contentCount()}}</td>

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

                                <td><input class="switch" category_id="{{$cate->id}}" type="checkbox" data-off="Pasif " data-on="Aktif " data-style="ios" data-onstyle="primary" data-offstyle="danger" @if($cate->status==1) checked @endif data-toggle="toggle"></td>

                                <td>
                                    <a category_id="{{$cate->id}}" title="Düzenle" class="btn btn-sm btn-primary cate_edit"><i class="fa fa-pen"></i></a>
                                    <a category_id="{{$cate->id}}" category_name="{{$cate->name}}" category_count="{{$cate->contentCount()}}" title="Sil" class="btn btn-sm btn-danger cate_delete"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="editModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Kategoriyi Düzenle</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('category_update')}}">
                    @csrf
                    <div class="form-group">
                        <label for="">Kategori Adı</label>
                        <input id="cate_name" type="text" name="name" class="form-control" required>
                        <input type="hidden" name="id" id="cate_id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">İptal</button>
                        <button type="submit" class="btn btn-primary ">Kategoriyi Güncelle</button>
                    </div>
            </div>

            </form>
        </div>

    </div>
</div>

<!-- Modal -->
<div id="deleteModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Kategoriyi Sil</h4>
            </div>
            <div class="modal-body" id="body">
                <div class="alert alert-danger" id="contentalert">

                </div>
            </div>
            <div class="modal-body float-right">
                <form method="post" action="{{route('category_delete')}}">
                    @csrf
                    <input type="hidden" name="id" id="deleteId">

                    <div class="modal-footer">
                        <button type="submit" id="deleteButton" class="btn btn-primary">Kategoriyi Sil</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">İptal</button>
                    </div>
            </div>

            </form>
        </div>

    </div>
</div>
@endsection
@section('css')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script>
    $(function() {
        $('.cate_delete').click(function() {
            id = $(this)[0].getAttribute('category_id');
            count = $(this)[0].getAttribute('category_count');
            name = $(this)[0].getAttribute('category_name');
            if (id == 1) {
                $('#contentalert').html(name + ' kategorisi sabit kategoridir. Silinen diğer kategorilere ait makaleler buraya eklenecektir.');
                $('#body').show();
                $('#deleteButton').hide();
                $('#deleteModal').modal();
                return;
            }
            $('#deleteButton').show();
            $('#deleteId').val(id);
            $('#contentalert').html('');
            $('#body').hide();
            if (count > 0) {
                $('#contentalert').html('Bu kategoriye ait ' + count + ' makale bulunmaktadır. Silmek istediğinizden emin misiniz?');
                $('#body').show();
            }
            $('#deleteModal').modal();
        })

        $('.cate_edit').click(function(e) {
            id = $(this)[0].getAttribute('category_id');
            Swal.fire({
                title: 'Kategori Adı',
                input: 'text',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonText: 'Kaydet',
                showLoaderOnConfirm: true,
                preConfirm: (name) => {
                    $.ajax({
                        type: 'POST',
                        url: "{{route('category_update')}}",
                        data: {
                            id: id,
                            name: name
                        },
                        success: function(data) {
                            toastr[data.status](data.data);
                        }
                    })
                },
                allowOutsideClick: () => !Swal.isLoading()
            });

        })

        $('.switch').change(function() {
            id = $(this)[0].getAttribute('category_id');
            statu = $(this).prop('checked');
            $.get("{{route('category_switch')}}", {
                id: id,
                statu: statu
            }, function(data, status) {});
        })
    })
</script>
@endsection