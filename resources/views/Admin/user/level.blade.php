@extends('admin.layout.main')
@section('title','Level')

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

@if (session('status') == null)
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

<p>
    <div data-toggle="modal" data-target="#roleModal" onclick="ClearScreen();">
        <button class="btn btn-secondary btn-md " data-toggle="tooltip" data-placement="top" title="" data-original-title="Add">
            <span class="btn-label">
                <i class="fas fa-plus"></i>
                Tambah
            </span>
        </button>
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
                    <table id="role" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Level</th>
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

                    <div class="row flex-row justify-content-center">
                        <input type="text" id="IdRole" class="form-control" hidden>
                        <div class="form-group col-lg-6">
                            <label class="placeholder">Role</label>
                            <input type="text" class="form-control" id="Role" required="" placeholder="Role Name" name="role" value="{{ old('role') }}">
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
        table = $('#role').DataTable({
            "processing": true,
            "responsive": true,
            "pagination": true,
            "stateSave": true,
            "ajax": {
                url: "/api/level/",
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
                { "data": "nama_level" },
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
        $('#IdRole').val('');
        $('#Role').val('');
        $('#upd').hide();
        $('#add').show();
    }

    function GetById(number) {
        // debugger;
        var getidRole = table.row(number).data().id;
        $.ajax({
            url: "/api/level/"+getidRole,
            // data: { id: getidRole }
        }).then((result) => {
            // debugger;
            var data = result.data;
            $('#IdRole').val(data.id);
            $('#Role').val(data.nama_level);
            $('#add').hide();
            $('#upd').show();
            $('#roleModal').modal('show');
        })
    }

    function Save() {
        // debugger;
        var Data = new Object();
        Data.role = $('#Role').val();
        $.ajax({
            type: 'POST',
            url: "/api/level",
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
        var getid = table.row(number).data().id;
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
                    url: "/api/level/" + getid,
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
