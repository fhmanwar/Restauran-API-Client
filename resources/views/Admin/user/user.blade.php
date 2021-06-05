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
        <div data-toggle="modal" data-target="#dataModal" onclick="ClearScreen();">
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
                    <table id="user" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Level</th>
                                <th>Status</th>
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
<div class="modal fade" id="dataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                    <input type="text" id="IdUser" class="form-control" hidden>
                    <div class="row flex-row justify-content-center">
                        <div class="form-group col-lg-8">
                            <label class="placeholder">Name</label>
                            <input type="text" class="form-control" id="Name" required="" placeholder="Name">
                        </div>
                        <div class="form-group col-lg-4">
                            <label class="placeholder">Role</label>
                            <select class="form-control" id="RoleOption" name="RoleOption"></select>
                        </div>
                    </div>
                    <div class="row flex-row justify-content-center">
                        <div class="form-group col-lg-7">
                            <label class="placeholder">Username</label>
                            <input type="text" class="form-control" id="UserName" required="" placeholder="Name">
                        </div>
                        <div class="form-group col-lg-5">
                            <label class="placeholder">Status</label>
                            <select class="form-control" id="StatusOption" name="StatusOption">
                                <option value="0">-- Select --</option>
                                <option value="aktif">Aktif</option>
                                <option value="tidakAktif">Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="row flex-row justify-content-center">
                        <div class="form-group col-lg-6">
                            <label class="placeholder">Password</label>
                            <input type="password" class="form-control" id="Pass" placeholder="Password">
                        </div>
                        <div class="form-group col-lg-6">
                            <label class="placeholder">Confirm Password</label>
                            <input type="password" class="form-control" id="confPass" placeholder="Confirm Password">
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
        table = $('#user').DataTable({
            "processing": true,
            "responsive": true,
            "pagination": true,
            "stateSave": true,
            "ajax": {
                url: "/api/user/",
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
                { "data": "nama_user" },
                { "data": "username" },
                { "data": "nama_level" },
                { "data": "status" },
                {
                    "sortable": false,
                    "render": function (data, type, row, meta) {
                        //console.log(row);
                        $('[data-toggle="tooltip"]').tooltip();
                        return '<div class="form-button-action">'
                            + '<button class="btn btn-warning btn-sm" data-placement="left" data-toggle="tooltip" data-animation="false" title="Edit" onclick="return GetById(' + meta.row + ')" ><i class="fas fa-lg fa-edit"></i></button>'
                            + '&nbsp;'
                            + '<button class="btn btn-danger btn-sm" data-placement="right" data-toggle="tooltip" data-animation="false" title="Delete" onclick="return Del(' + meta.row + ')" ><i class="fas fa-lg fa-trash-alt"></i></button>'
                            + '</div>'
                    }
                }
            ],
        });
    });

    function ClearScreen() {
        $('#IdUser').val('');
        $('#Name').val('');
        $('#UserName').val('');
        $('#RoleOption').val('0');
        $('#StatusOption').val('0');
        $('#Pass').val('');
        $('#confPass').val('');
        $('#upd').hide();
        $('#add').show();
    }

    var arrData = [];
    function LoadData(element) {
        //debugger;
        if (arrData.length === 0) {
            if (element[0].name == 'RoleOption') {
                $.ajax({
                    url: "/api/level/",
                    type: "Get",
                    dataType: "json",
                    dataSrc: "",
                    success: function (data) {
                        //debugger;
                        arrData = data;
                        renderData(element);
                    }
                });
            }
        }
        else {
            renderData(element);
        }
    }

    function renderData(element) {
        //debugger;
        var $option = $(element);
        $option.empty();
        $option.append($('<option/>').val('0').text('-- Select --'));
        if (element[0].name == 'RoleOption') {
            $.each(arrData, function (i, val) {
                $option.append($('<option/>').val(val.id).text(val.nama_level))
            });
        }
    }

    LoadData($('#RoleOption'))

    function GetById(number) {
        // debugger;
        var getidRole = table.row(number).data().id_user;
        $.ajax({
            url: "/api/user/"+getidRole,
            // data: { id: getidRole }
        }).then((result) => {
            // debugger;
            var data = result.data;
            $('#IdUser').val(data.id_user);
            $('#UserName').val(data.username);
            $('#Name').val(data.nama_user);
            $('#RoleOption').val(data.id_level);
            $('#StatusOption').val(data.status);
            $('#add').hide();
            $('#upd').show();
            $('#dataModal').modal('show');
        })
    }

    function Save() {
        // debugger;
        var Data = new Object();
        Data.username = $('#UserName').val();
        Data.pass = $('#Pass').val();
        Data.name = $('#Name').val();
        Data.levelId = $('#RoleOption').val();
        Data.status = $('#StatusOption').val();
        $.ajax({
            type: 'POST',
            url: "/api/user",
            cache: false,
            dataType: "JSON",
            data: Data
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
                ClearScreen();
            } else {
                Swal.fire('Error', 'Failed to Input', 'error');
                ClearScreen();
            }
        })
    }

    function Upd() {
        // debugger;
        var Data = new Object();
        Data.id_user = $('#IdUser').val();
        Data.username = $('#UserName').val();
        Data.pass = $('#Pass').val();
        Data.name = $('#Name').val();
        Data.levelId = $('#RoleOption').val();
        Data.status = $('#StatusOption').val();
        $.ajax({
            type: 'PUT',
            url: "/api/user/" + Data.id_user,
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
        var getid = table.row(number).data().id_user;
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
                    url: "/api/user/" + getid,
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
                        ClearScreen();
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
