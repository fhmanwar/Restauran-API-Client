@extends('admin.layout.main')
@section('title','Dashboard')
@section('head-title','Welcome to Dashboard')

@section('page')
<li class="separator">
    <i class="flaticon-right-arrow"></i>
</li>
<li class="nav-item">
    <a href="#">User</a>
</li>
<li class="separator">
    <i class="flaticon-right-arrow"></i>
</li>
<li class="nav-item">
    <a href="#">Data Level</a>
</li>

@endsection

@section('content')

@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

<p>
    <div class="col-md-1">
        <div data-toggle="modal" data-target="#roleModal" onclick="ClearScreen();">
            <button class="btn btn-secondary btn-md " data-toggle="tooltip" data-placement="top" title="" data-original-title="Add">
                <span class="btn-label">
                    <i class="fas fa-plus"></i>
                    Tambah
                </span>
            </button>
        </div>
    </div>
</p>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Data Level</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="item" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Product</th>
                                <th>Harga</th>
                                <th>Stock</th>
                                <th>status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- modal --}}
<div class="modal fade" id="roleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLongTitle" aria-hidden="true">Fill Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <form method="POST" action="#">
                @csrf
                <div class="modal-body">
                    <div id="error_add"></div>
                    <input type="text" id="Id" class="form-control" hidden>

                    <div class="col-md-12">
                        <div class="row flex-row justify-content-center">
                            <div class="form-group col-lg-6">
                                <label class="placeholder">Product</label>
                                <input type="text" class="form-control" name="prodName" id="prodName" required="" placeholder="Product Name">
                            </div>
                            <div class="form-group col-lg-4">
                                <label class="placeholder">Status</label>
                                <input type="text" class="form-control" name="status" id="status" required="" placeholder="Status Product">
                            </div>
                        </div>
                        <div class="row flex-row justify-content-center">
                            <div class="form-group col-lg-4">
                                <label class="placeholder">Price</label>
                                <input type="number" class="form-control" name="price" id="price" required="" placeholder="Price">
                            </div>
                            <div class="form-group col-lg-4">
                                <label class="placeholder">Stock</label>
                                <input type="number" class="form-control" name="stock" id="stock" required="" placeholder="Stock">
                            </div>
                            <div class="form-group col-lg-4">
                                <label class="placeholder">Product Image</label>
                                <input type="file" class="form-control" id="img" required="" placeholder="Imag">
                                <img src="#" id="previewImg" class="rounded border p-1" style="width:110px; height:70px;">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <input type="button" id="add" class="btn btn-success" value="Save" data-dismiss="modal" onclick="Save();">
                    <input type="button" id="upd" class="btn btn-warning" value="Update" data-dismiss="modal" onclick="Upd();">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                </div>
            </form>

        </div>
    </div>
</div>
{{-- end modal --}}
@endsection
@section('script')
<script>
    var table = null;

    $(document).ready(function(){
        table = $('#item').DataTable({
            "processing": true,
            "responsive": true,
            "pagination": true,
            "stateSave": true,
            "ajax": {
                url: "/api/product",
                type: "GET",
                dataType: "json",
                dataSrc: "",
            },
            "columns": [
                {
                    render: function (data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                {
                    "data": "gambar_masakan",
                    'render': function (jsonData) {
                        if (jsonData != null) {
                            return '<img src="/img/'+ jsonData +'" alt="myPic" width="60%">';
                        }
                        return 'Not Available';
                    }
                },
                { "data": "nama_masakan" },
                {
                    "data": "harga",
                    'render': $.fn.dataTable.render.number(',', '.', 2, 'Rp '),
                },

                { "data": "stok" },
                { "data": "status_masakan" },
                {
                    "sortable": false,
                    "render": function (data, type, row, meta) {
                        //console.log(row);
                        $('[data-toggle="tooltip"]').tooltip();
                        return '<div class="form-button-action">'
                            + '<button class="btn btn-warning btn-sm btn-circle" data-placement="left" data-toggle="tooltip" data-animation="false" title="Edit" onclick="return GetById(' + meta.row + ')" ><i class="fas fa-lg fa-edit"></i></button>'
                            + '&nbsp;'
                            + '<button class="btn btn-danger btn-sm btn-circle" data-placement="right" data-toggle="tooltip" data-animation="false" title="Delete" onclick="return Del(' + meta.row + ')" ><i class="fas fa-lg fa-trash-alt"></i></button>'
                            + '</div>'
                    }
                }
            ],
        });

    });

    function ClearScreen() {
        $('#Id').val('');
        $('#prodName').val('');
        $('#price').val('');
        $('#stock').val('');
        $('#status').val('');
        $('#img').val('');
        $('#upd').hide();
        $('#add').show();
    }

    function GetById(number) {
        debugger;
        var getId = table.row(number).data().id_masakan;
        $.ajax({
            url: "/api/product/"+getId,
        }).then((result) => {
            debugger;
            var resData = result.data;
            $('#Id').val(resData.id_masakan);
            $('#prodName').val(resData.nama_masakan);
            $('#price').val(resData.harga);
            $('#stock').val(resData.stock);
            $('#status').val(resData.status_masakan);
            $('#previewImg').src = '/img/'+resData.gambar_masakan;
            $('#add').hide();
            $('#upd').show();
            $('#roleModal').modal('show');
        })
    }

    function Save() {
        // debugger;
        var formData = new FormData();
        // formData.append('_token', $("input[name=_token]").val());
        formData.append('prodName', $('#prodName').val());
        formData.append('price', $('#price').val());
        formData.append('stock', $('#stock').val());
        formData.append('status', $('#status').val());
        if ($('#img').val() != "") {
            formData.append('img', $('#img')[0].files[0]);
        }
        $.ajax({
            type: 'POST',
            url: "/api/product",
            enctype: 'multipart/form-data',
            cache: false,
            processData: false,
            contentType: false,
            dataType: "JSON",
            data: formData
        }).then((result) => {
            // debugger;
            if (result.statusCode == true) {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Data inserted Successfully',
                    showConfirmButton: false,
                    timer: 1500,
                })
                table.ajax.reload(null, false);
            } else {
                Swal.fire('Error', 'Failed to Input', 'error');
                ClearScreen();
            }
        })
    }

    function Upd() {
        // debugger;
        var Data = new Object();
        Data.id = $('#IdRole').val();
        Data.role = $('#Role').val();
        $.ajax({
            type: 'PUT',
            url: "/api/level/" + Data.id,
            cache: false,
            dataType: "JSON",
            data: Data
        }).then((result) => {
            // debugger;
            if (result.statusCode == true) {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Data Updated Successfully',
                    showConfirmButton: false,
                    timer: 1500,
                });
                table.ajax.reload(null, false);
            } else {
                Swal.fire('Error', 'Failed to Input', 'error');
                ClearScreen();
            }
        })
    }

    function Del(number) {
        //debugger;
        var getid = table.row(number).data().id_masakan;
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
        }).then((resultSwal) => {
            if (resultSwal.value) {
                // debugger;
                var Data = new Object();
                Data.id = getid;
                Data._method = 'DELETE';
                $.ajax({
                    type: 'POST',
                    url: "/api/product/" + getid,
                    cache: false,
                    dataType: "JSON",
                    data: Data,
                }).then((result) => {
                    // debugger;
                    // console.log(result);
                    if (result.statusCode == true) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Delete Successfully',
                            showConfirmButton: false,
                            timer: 1500,
                        });
                        table.ajax.reload(null, false);
                    } else {
                        Swal.fire('Error', 'Failed to Delete', 'error');
                        ClearScreen();
                    }
                });
            };
        });
    }
</script>

@endsection
