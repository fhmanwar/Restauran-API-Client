@extends('admin.layout.main')
@section('title','Transaction')

@section('page')
<li class="separator">
    <i class="flaticon-right-arrow"></i>
</li>
<li class="nav-item">
    <a href="#">Transaction</a>
</li>
<li class="separator">
    <i class="flaticon-right-arrow"></i>
</li>
<li class="nav-item">
    <a href="#">Data Transaksi</a>
</li>

@endsection

@section('content')

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Belum Bayar</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="order" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th></th>
                                <th>No. Meja</th>
                                <th>Nama</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Generate Laporan</h4>
            </div>
            <div class="card-body">

            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Transaksi Terdahulu</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="transaction" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Nama Pemesan</th>
                                <th>No Meja</th>
                                <th>Total Harga</th>
                                <th>Waktu Pesan</th>
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
<div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                    <input type="text" id="UserId" class="form-control" hidden>
                    <input type="text" id="OrderId" class="form-control" hidden>
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <div class="row flex-row justify-content-center">
                                <div class="form-group col-lg-3">
                                    <label class="placeholder">Waktu</label>
                                    <input type="text" class="form-control" id="Waktu" readonly placeholder="Waktu">
                                </div>
                                <div class="form-group col-lg-2">
                                    <label class="placeholder">No Meja</label>
                                    <input type="number" class="form-control" id="noMeja" readonly placeholder="No Meja">
                                </div>
                                <div class="form-group col-lg-7">
                                    <label class="placeholder">Nama Pelanggan</label>
                                    <input type="text" class="form-control" id="CustName" placeholder="Customer Name">
                                </div>
                            </div>
                            <div class="row flex-row justify-content-center">
                                <div class="form-group col-lg-4">
                                    <label class="placeholder">Total</label>
                                    <input type="number" class="form-control" id="Total" readonly placeholder="Total">
                                </div>
                                <div class="form-group col-lg-4">
                                    <label class="placeholder">Bayar</label>
                                    <input type="number" class="form-control" id="Bayar" required placeholder="Bayar">
                                </div>
                                <div class="form-group col-lg-4">
                                    <label class="placeholder">Kembali</label>
                                    <input type="number" class="form-control" id="Kembali" readonly placeholder="Kembali">
                                </div>
                            </div>
                        </div>
                        <table id="orderDetail" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Product</th>
                                    <th>Harga</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" id="printBtn" class="btn btn-secondary btn-sm btn-border btn-round" data-dismiss="modal" onclick="Print();"><i class="fas fa-print"></i> Print</button>
                    <button type="button" id="OrderBtn" class="btn btn-success btn-sm btn-border btn-round" data-dismiss="modal" onclick="addTransaction();"><i class="fas fa-save"></i> Submit</button>
                    <button type="button" class="btn btn-danger btn-sm btn-border btn-round" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                </div>
            </form>

        </div>
    </div>
</div>
{{-- end modal --}}

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
                    <input type="text" id="Id" class="form-control" hidden>

                    <div class="col-md-12">
                        <table class="display table table-striped table-hover">
                            <tbody>
                                <tr>
                                    <th>Product Image:</th>
                                    <th><img src="" class="img-thumbnail rounded" id="img" height="40%" width="60%"></th>
                                </tr>
                                <tr>
                                    <th>Product Name:</th>
                                    <th><input type="text" class="form-control" id="prodName" readonly placeholder="Product Name"></th>
                                </tr>
                                <tr>
                                    <th>Price:</th>
                                    <th><input type="number" class="form-control" id="price" readonly placeholder="Price"></th>
                                </tr>
                                <tr>
                                    <th>Quantity:</th>
                                    <th><input type="number" class="form-control" id="qty" required placeholder="Quantity"></th>
                                </tr>
                                <tr>
                                    <th>Subtotal:</th>
                                    <th><input type="number" class="form-control" id="subtotal" readonly placeholder="SubTotal"></th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="modal-footer">
                    <input type="button" id="upd" class="btn btn-warning btn-sm btn-border btn-round" value="Update" data-dismiss="modal" onclick="UpdOrderDetail();">
                    <button type="button" class="btn btn-danger btn-sm btn-border btn-round" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                </div>
            </form>

        </div>
    </div>
</div>
{{-- end modal --}}

{{-- Print Preview --}}
{{-- <div id='IdToPrint'>
    <center>
        <h4> PIEZO PONDOK KELAPA </h4>
        <span>
            Jl. Pd. Kelapa Raya, RT.11/RW.9, Pd. Kopi, Kec. Duren Sawit, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13450<br>
            Telp. +62822 1814 2820  || E-mail piezocoffe00@gmail.com
        </span>
    </center>
    <hr>
    <table style="width: 100%" class="">
        <tr>
            <td> Nama Pelanggan &nbsp;&nbsp; </td>
            <td> : Hendro </td>
        </tr>
        <tr>
            <td style="width: 15%"> Nama Kasir </td>
            <td style="width: 80%"> : Moh Taofik RR </td>
        </tr>
        <tr>
            <td> Time Order </td>
            <td> : 2019-08-04 18:04:22 </td>
        </tr>
        <tr>
            <td> table number </td>
            <td> : 8 </td>
        </tr>
    </table>

    <hr>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="head0">No.</th>
                <th class="head1">Menu</th>
                <th class="head0 right">Jumlah</th>
                <th class="head1 right">Harga</th>
                <th class="head0 right">Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><center>1. </center></td>
                <td>Sate Ayam</td>
                <td class="right"><center>2</center></td>
                <td class="right">Rp. 11000,-</td>
                <td class="right"> <strong> Rp. 22000,- </strong> </td>
            </tr>
            <tr>
                <td><center>2. </center></td>
                <td>Sayur Asem</td>
                <td class="right"><center>1</center></td>
                <td class="right">Rp. 7500,-</td>
                <td class="right"> <strong> Rp. 7500,- </strong> </td>
            </tr>
            <tr>
                <td></td>
                <td><strong><center>Total</center></strong></td>
                <td class="right"></td>
                <td class="right"></td>
                <td class="right"><strong>Rp. 29500,-</strong></td>
            </tr>
            <tr>
                <td></td>
                <td><strong><center>Uang Bayar</center></strong></td>
                <td class="right"></td>
                <td class="right"></td>
                <td class="right"><strong>Rp. 50000,-</strong></td>
            </tr>
            <tr>
                <td></td>
                <td><strong><center>Uang Kembalian</center></strong></td>
                <td class="right"></td>
                <td class="right"></td>
                <td class="right"><strong>Rp. 20500,-</strong></td>
            </tr>
        </tbody>
    </table>

    <hr>
    <center> <h5> THANKS FOR YOUR VISIT </h5> </center>
    <hr>
</div> --}}
{{-- End Print Preview --}}
@endsection
@section('script')
<script>
    var table = null;

    $(document).ready(function(){

        table = $('#order').DataTable({
            "processing": true,
            "responsive": true,
            "pagination": true,
            "stateSave": true,
            "ajax": {
                url: "/api/transaction/order",
                type: "GET",
                dataType: "json",
                dataSrc: "",
            },
            "columns": [
                {
                    render: function (data, type, row, meta) {
                        return meta.row + 1;
                        console.log(data);
                    }
                },
                { data: "noMeja" },
                { data: "Name" },
                {
                    data: "Total",
                    render: $.fn.dataTable.render.number(',', '.', 2, 'Rp '),
                },
                {
                    sortable: false,
                    render: function (data, type, row, meta) {
                        //console.log(row);
                        $('[data-toggle="tooltip"]').tooltip();
                        return '<div class="form-button-action">'
                            + '<button class="btn btn-info btn-sm btn-border btn-round" data-placement="left" data-toggle="tooltip" data-animation="false" title="Bayar" onclick="return modalOrder(' + meta.row + ')" ><i class="fas fa-lg fa-check"></i> Bayar</button>'
                            + '&nbsp;'
                            + '<button class="btn btn-danger btn-sm btn-border btn-round" data-placement="right" data-toggle="tooltip" data-animation="false" title="Delete" onclick="return DelOrder(' + meta.row + ')" ><i class="fas fa-lg fa-trash-alt"></i></button>'
                            + '</div>'
                    }
                }
            ],
        });
        // + '<button class="btn btn-warning btn-sm btn-border btn-round" data-placement="left" data-toggle="tooltip" data-animation="false" title="Edit" onclick="return GetIdOrder(' + meta.row + ')" ><i class="fas fa-lg fa-edit"></i></button>'
                            // + '&nbsp;'

        $('#transaction').DataTable({
            "processing": true,
            "responsive": true,
            "pagination": true,
            "stateSave": true,
            "ajax": {
                url: "/api/transaction/",
                type: "GET",
                dataType: "json",
                dataSrc: "",
            },
            "columns": [
                {
                    render: function (data, type, row, meta) {
                        return meta.row + 1;
                        console.log(data);
                    }
                },
                { data: "Name" },
                { data: "noMeja" },
                {
                    data: "Total",
                    render: $.fn.dataTable.render.number(',', '.', 2, 'Rp '),
                },
                {
                    "data": "OrderTime",
                    'render': function (jsonDate) {
                        var date = new Date(jsonDate);
                        if (jsonDate != null) {
                            return moment(date).format('DD MMMM YYYY') + '<br> Time : ' + moment(date).format('HH: mm');
                        }
                        return 'Date Not Define';
                    }
                },
                {
                    sortable: false,
                    render: function (data, type, row, meta) {
                        //console.log(row);
                        $('[data-toggle="tooltip"]').tooltip();
                        return '<div class="form-button-action">'
                            + '<button class="btn btn-info btn-sm btn-border btn-round" data-placement="left" data-toggle="tooltip" data-animation="false" title="Detail" onclick="return GetTransactionInfo(' + meta.row + ')" ><i class="fas fa-lg fa-info"></i></button>'
                            + '&nbsp;'
                            + '</div>'
                    }
                }
            ],
        });

        $('#qty').on('change', function () {
            var getHarga = $('#price').val();
            var getQty = $('#qty').val();
            $('#subtotal').val(getHarga * getQty);
        });

        $('#Bayar').on('change', function () {
            var getTotal = $('#Total').val();
            $('#Kembali').val($('#Bayar').val() - getTotal);
        });

        $('#IdToPrint').hide();

    });

    function displayTime() {
        var time = moment().format('DD MMM YYYY HH:mm:ss');
        $('#Waktu').val(time);
        setTimeout(displayTime, 1000);
    }

    function ClearScreen() {
        $('#Id').val('');
        $('#img').val('');
        $('#noMeja').val('');
        $('#CustName').val('');
        $('#Total').val('');
        $('#Bayar').val('');
        $('#Kembali').val('');
        $('#subtotal').val('');
        $('#upd').hide();
        $('#add').show();
    }

    function modalOrder(number) {
        // debugger;
        var getId = table.row(number).data().OrderId;
        // console.log(getId);
        $.ajax({
            url: "/api/transaction/order/" + getId,
        }).then((result) => {
            var resData = result.data;
            $.ajax({
                url: "/api/transaction/orderdet/" + resData.OrderId,
            }).then((resTbl) => {
                var resDataTbl = resTbl.data;
                $('#orderDetail').DataTable({
                    "processing": true,
                    "responsive": true,
                    "pagination": true,
                    "stateSave": true,
                    destroy: true,
                    data: resDataTbl,
                    "columns": [
                        {
                            render: function (data, type, row, meta) {
                                return meta.row + 1;
                            }
                        },
                        { data: "nama_masakan" },
                        {
                            data: "harga",
                            render: $.fn.dataTable.render.number(',', '.', 2, 'Rp '),
                        },
                        { data: "Qty" },
                        {
                            data: "SubTotal",
                            render: $.fn.dataTable.render.number(',', '.', 2, 'Rp '),
                        },
                        {
                            sortable: false,
                            render: function (data, type, row, meta) {
                                //console.log(row);
                                $('[data-toggle="tooltip"]').tooltip();
                                return '<div class="form-button-action">'
                                    + '<button class="btn btn-warning btn-sm btn-border btn-round" data-placement="left" data-toggle="tooltip" data-animation="false" title="Edit" onclick="return GetIdOrderDetail(' + meta.row + ')" ><i class="fas fa-lg fa-edit"></i></button>'
                                    + '&nbsp;'
                                    + '<button class="btn btn-danger btn-sm btn-border btn-round" data-placement="right" data-toggle="tooltip" data-animation="false" title="Delete" onclick="return DelOrderDetail(' + meta.row + ')" ><i class="fas fa-lg fa-trash-alt"></i></button>'
                                    + '</div>'
                            }
                        }
                    ],
                });
            });

            $('#orderDetail').DataTable().columns( [5] ).visible( true );
            $('#UserId').val(resData.UserId);
            $('#OrderId').val(resData.OrderId);
            $('#noMeja').val(resData.noMeja);
            $('#CustName').val(resData.Name);
            $('#Total').val(resData.Total);
            $('#printBtn').hide();
            $('#OrderBtn').show();
            displayTime();

            // $('#dataModal').modal('show');
            $('#orderModal').modal('show');
        });
    }

    function DelOrder(number) {
        var getid = $('#order').DataTable().row(number).data().OrderId;
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
                    url: "/api/transaction/order/del/" + getid,
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

    function GetIdOrderDetail(number) {
        // debugger;
        $('#orderModal').modal('hide');
        var getId = $('#orderDetail').DataTable().row(number).data().OrderDetId;
        // console.log(getId);
        $.ajax({
            url: "/api/transaction/order/det/" + getId,
            type: 'GET',
        }).then((result) => {
            // debugger;
            var resData = result.data;
            $('#Id').val(resData.OrderDetId);
            $('#img').attr('src', '/img/product/' + resData.gambar_masakan);
            $('#prodName').val(resData.nama_masakan);
            $('#price').val(resData.harga);
            $('#qty').val(resData.Qty);
            // var calc = resData.harga * resData.Qty;
            $('#subtotal').val(resData.SubTotal);
            $('#upd').show();
            $('#dataModal').modal('show');
        })
    }

    function UpdOrderDetail() {
        var Data = new Object();
        Data.OrderDetailId = $('#Id').val();
        Data.UserId = $('#UserId').val();
        // Data.UserId = '1';
        Data.productName = $('#prodName').val();
        Data.qty = $('#qty').val();
        // console.log(Data);
        $.ajax({
            type: 'POST',
            url: '/api/transaction/order/det',
            cache: false,
            dataType: "JSON",
            data: Data
        }).then((result) => {
            // debugger;
            // console.log(result.data);
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
                Swal.fire('Error', result.msg, 'error');
                ClearScreen();
            }
        })
    }

    function DelOrderDetail(number) {
        //debugger;
        var getid = $('#orderDetail').DataTable().row(number).data().OrderDetId;
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
                    url: "/api/transaction/order/det/" + getid,
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

    function addTransaction() {
        var Data = new Object();
        Data.orderId = $('#OrderId').val();
        Data.userId = $('#UserId').val();
        Data.bayar = $('#Bayar').val();
        Data.kembali = $('#Kembali').val();

        console.log(Data);

        $.ajax({
            type: 'POST',
            url: "/api/transaction",
            cache: false,
            dataType: "JSON",
            data: Data
        }).then((result) => {
            // debugger;
            if (result.statusCode == true) {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: result.msg,
                    text: result.data,
                    showConfirmButton: false,
                    timer: 1500,
                })
                // console.log(result.data);
                table.ajax.reload(null, false);
                $('#transaction').DataTable().ajax.reload(null, false);
            } else {
                Swal.fire('Error', result.msg, 'error');
                // console.log(result.data);
                ClearScreen();
            }
        })
    }

    function GetTransactionInfo(number) {
        var getId = $('#transaction').DataTable().row(number).data().OrderId;
        // console.log(getId);
        $.ajax({
            url: "/api/transaction/det/" + getId,
        }).then((result) => {
            var resData = result.data;
            $.ajax({
                url: "/api/transaction/orderdet/" + resData.OrderId,
            }).then((resTbl) => {
                var resDataTbl = resTbl.data;
                $('#orderDetail').DataTable({
                    "processing": true,
                    "responsive": true,
                    "pagination": true,
                    "stateSave": true,
                    destroy: true,
                    data: resDataTbl,
                    "columns": [
                        {
                            render: function (data, type, row, meta) {
                                return meta.row + 1;
                            }
                        },
                        { data: "nama_masakan" },
                        {
                            data: "harga",
                            render: $.fn.dataTable.render.number(',', '.', 2, 'Rp '),
                        },
                        { data: "Qty" },
                        {
                            data: "SubTotal",
                            render: $.fn.dataTable.render.number(',', '.', 2, 'Rp '),
                        },
                        {
                            sortable: false,
                            render: function (data, type, row, meta) {
                                //console.log(row);
                                $('[data-toggle="tooltip"]').tooltip();
                                return '<div class="form-button-action">'
                                    + '<button class="btn btn-warning btn-sm btn-border btn-round" data-placement="left" data-toggle="tooltip" data-animation="false" title="Edit" onclick="return GetIdOrderDetail(' + meta.row + ')" ><i class="fas fa-lg fa-edit"></i></button>'
                                    + '&nbsp;'
                                    + '<button class="btn btn-danger btn-sm btn-border btn-round" data-placement="right" data-toggle="tooltip" data-animation="false" title="Delete" onclick="return DelOrderDetail(' + meta.row + ')" ><i class="fas fa-lg fa-trash-alt"></i></button>'
                                    + '</div>'
                            }
                        }
                    ],
                });
            });

            $('#orderDetail').DataTable().columns( [5] ).visible( false );
            $('#Waktu').val(resData.OrderTime);
            $('#UserId').val(resData.UserId);
            $('#OrderId').val(resData.OrderId);
            $('#noMeja').val(resData.noMeja);
            $('#CustName').val(resData.Name).prop("readonly", true);
            $('#Total').val(resData.Total);
            $('#Bayar').val(resData.Bayar).prop("readonly", true);;
            $('#Kembali').val(resData.Kembali);
            $('#OrderBtn').hide();
            $('#printBtn').show();
            $('#orderModal').modal('show');
        });
    }

    function Print() {
        var getId = $('#OrderId').val();
        $("#printBtn").click(function() {
            $("<a>").prop({
                target: "_blank",
                href: "print/"+getId
            })[0].click();
        });
        // $("#printBtn").print();
        // var divToPrint=document.getElementById('IdToPrint');
        // var newWin=window.open('','Print-Window');

        // newWin.document.open();
        // newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
        // newWin.document.close();

        // setTimeout(function(){newWin.close();},10);
    }

</script>

@endsection
