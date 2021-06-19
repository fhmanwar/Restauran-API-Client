@extends('admins.layouts.main')
@section('title','Order')

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
    <a href="#">Data Order</a>
</li>

@endsection

@section('content')

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Keranjang</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="cart" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Image</th>
                                <th>Product</th>
                                <th>Stok</th>
                                <th>Harga</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                {{-- <th colspan="7"><a href="#" class="btn btn-warning" data-toggle="modal" data-target="#orderModal" >Order</a></th> --}}
                                <th colspan="7"><a href="#" class="btn btn-warning" onclick="modalOrder();" >Order</a></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Pesan Makanan</h4>
            </div>
            <div class="card-body">
                <div class="row" id="orderList">
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
                    <input type="text" id="Id" class="form-control" hidden>

                    <div class="col-md-12">
                        <table class="display table table-striped table-hover">
                            <tbody>
                                <tr>
                                    <th>Product Image:</th>
                                    <th><img src="" class="rounded border p-1" id="img" style="width:110px; height:70px;"></th>
                                </tr>
                                <tr>
                                    <th>Product Name:</th>
                                    <th><input type="text" class="form-control" id="prodName" readonly placeholder="Product Name"></th>
                                </tr>
                                <tr>
                                    <th>Stock:</th>
                                    <th><input type="number" class="form-control" id="stock" readonly placeholder="Stock"></th>
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
                    <input type="button" id="add" class="btn btn-success" value="Save" data-dismiss="modal" onclick="Save();">
                    <input type="button" id="upd" class="btn btn-warning" value="Update" data-dismiss="modal" onclick="Upd();">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                </div>
            </form>

        </div>
    </div>
</div>
{{-- end modal --}}

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
                    <input type="text" id="UserId" value="{{ session('userId') }}" class="form-control" hidden>
                    {{-- <input type="text" id="UserId" value="" class="form-control" hidden> --}}
                    <div class="col-md-12">
                        <table class="display table table-striped table-hover">
                            <tbody>
                                <tr>
                                    <th>Waktu:</th>
                                    <th><input type="text" class="form-control" id="Waktu" readonly placeholder="Waktu"></th>
                                </tr>
                                <tr>
                                    <th>No Meja:</th>
                                    <th><input type="number" class="form-control" id="noMeja" placeholder="No Meja"></th>
                                </tr>
                                <tr>
                                    <th>Nama Pelanggan:</th>
                                    <th><input type="text" class="form-control" id="CustName" placeholder="CustName"></th>
                                </tr>
                                <tr>
                                    <th>Total:</th>
                                    <th><input type="number" class="form-control" id="Total" readonly placeholder="Total"></th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="modal-footer">
                    <input type="button" id="AddToOrder" class="btn btn-success" value="Save" data-dismiss="modal" onclick="addOrder();">
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
        table = $('#cart').DataTable({
            "processing": true,
            "responsive": true,
            "pagination": true,
            "stateSave": true,
            "ajax": {
                url: "/api/cart/"+ $('#UserId').val(),
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
                {
                    data: "gambar_masakan",
                    render: function (jsonData) {
                        if (jsonData != null) {
                            return '<img src="/img/product/'+ jsonData +'" alt="myPic" width="60%">';
                        }
                        return 'Not Available';
                    }
                },
                { data: "nama_masakan" },
                { data: "stok" },
                {
                    data: "harga",
                    render: $.fn.dataTable.render.number(',', '.', 2, 'Rp '),
                },
                { data: "Qty" },
                {
                    render: function (data, type, row, meta) {
                        return row.harga * row.Qty;
                    }
                },
                {
                    sortable: false,
                    render: function (data, type, row, meta) {
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


        $.ajax({
            type: 'GET',
            url: "/api/product",
            cache: false,
            dataType: "JSON",
        }).then((result) => {
            // debugger;
            $.each( result, function( i, val ) {
                // console.log(i);
                $('#orderList').append(
                    '<div class="col-md-3">' +
                        '<div class="card">' +
                            '<div class="card-body">' +
                                '<input type="text" name="addProducName'+i+'" value="'+val.nama_masakan+'" class="form-control" hidden>' +
                                '<img class="card-img-top" src="/img/product/'+ val.gambar_masakan +'" alt="Card image cap" width="60%">' +
                                '<h5 class="card-title mb-2 fw-mediumbold">'+ val.nama_masakan +'</h5>' +
                                '<p class="card-text"> Harga: '+ val.harga +'<br/>Tersedia '+ val.stok +' Stock<br/></p>' +
                                '<a href="#" class="btn btn-warning" onclick="addCart('+i+');">Pesan</a>'+
                            '</div>' +
                        '</div>' +
                    '</div>'
                );
            });
        });

        $('#qty').on('change', function () {
            var getHarga = $('#price').val();
            var getQty = $('#qty').val();
            $.ajax({
               url: "/api/cart/cartid/1",
               type: "Get",
            //    data: { name: getZip },
               success: function (result) {
                   //debugger;
                   $('#subtotal').val(getHarga * getQty);
               }
            });
        });

        $('#Bayar').on('change', function () {
            var getTotal = $('#Total').val();
            $('#Kembali').val($('#Bayar').val() - getTotal);
        });



    });

    function displayTime() {
        var time = moment().format('DD MMM YYYY HH:mm:ss');
        $('#Waktu').val(time);
        setTimeout(displayTime, 1000);
    }

    function ClearScreen() {
        $('#Id').val('');
        $('#img').val('');
        $('#prodName').val('');
        $('#productId').val('');
        $('#price').val('');
        $('#stock').val('');
        $('#qty').val('');
        $('#subtotal').val('');
        $('#upd').hide();
        $('#add').show();
    }

    function GetById(number) {
        // debugger;
        var getId = table.row(number).data().id;
        // console.log(getId);
        $.ajax({
            url: "/api/cart/cartid/" + getId,
        }).then((result) => {
            // debugger;
            var resData = result.data;
            $('#img').attr("src", '/img/product/'+resData.gambar_masakan);
            $('#Id').val(resData.id);
            $('#prodName').val(resData.nama_masakan);
            $('#price').val(resData.harga);
            $('#stock').val(resData.stok);
            $('#status').val(resData.status_masakan);
            $('#qty').val(resData.Qty);
            var calc = resData.harga * resData.Qty;
            $('#subtotal').val(calc);
            // $('#img').src = '/img/'+resData.gambar_masakan;
            $('#add').hide();
            $('#upd').show();
            $('#dataModal').modal('show');
        })
    }

    function addCart(number) {
        var Data = new Object();
        Data.UserId = $('#UserId').val();
        Data.noMeja = '0';
        Data.productName = $('input[name*="addProducName'+number+'"]').val();
        // console.log(Data);
        $.ajax({
            type: 'POST',
            url: '/api/cart/',
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
                    title: 'Add To Cart Successfully',
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

    function Upd() {
        var Data = new Object();
        Data.IdCart = $('#Id').val();
        Data.UserId = $('#UserId').val();
        // Data.UserId = '1';
        Data.productName = $('#prodName').val();
        Data.qty = $('#qty').val();
        // console.log(Data);
        $.ajax({
            type: 'POST',
            url: '/api/cart/updCart/',
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
                    url: "/api/cart/" + getid,
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

    function modalOrder() {
        var tot = 0;
        var dataTable = table.rows().data().toArray();
        $.each(dataTable, function name( i, val ) {
            var getsubtotal = val.harga * val.Qty;
            tot = tot + getsubtotal;
            // console.log(val);
        });
        console.log(dataTable);
        // console.log(tot);
        if ($('#UserId').val() != null || $('#noMeja').val() != null) {
            $.ajax({
            url: "/api/cart/cartid/" + $('#UserId').val(),
            }).then((result) => {
                // debugger;
                var resData = result.data;
                $('#CustName').val(resData.nama_user).prop('readonly',true);
                $('#noMeja').val(resData.NoMeja);
            })
        } else {
            $('#CustName').val();
            $('#noMeja').val();
        }
        $('#Total').val(tot);
        displayTime();
        $('#orderModal').modal('show');
    }

    function addOrder() {
        var dataTable = table.rows().data().toArray();

        var dataCart=null;
        $.each(dataTable, function name( i, val ) {
            dataCart =  val.id +'|'+ val.nama_masakan +'|'+ val.Qty + '~' + dataCart;
        });

        if (dataCart == null) {
            Swal.fire({
                position: 'center',
                icon: 'info',
                title: 'Keranjang Masih Kosong',
                showConfirmButton: false,
                timerProgressBar: true,
                timer: 1500,
            });
        } else {
            var Data = new Object();
            Data.userId = $('#UserId').val();
            Data.name =  $('#CustName').val();
            Data.total = $('#Total').val();
            Data.noMeja = $('#noMeja').val();
            Data.orderDet = dataCart;
            $.ajax({
                type: 'POST',
                url: "/api/order",
                cache: false,
                dataType: "JSON",
                data: Data
            }).then((result) => {
                if (result.statusCode) {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Order Successfully',
                        showConfirmButton: false,
                        timer: 1500,
                    });
                    // location.reload();
                    // location.href = '/complete/'+$('input[name="noMeja"]').val();
                    table.ajax.reload(null, false);
                } else {
                    Swal.fire('Error', 'Failed to Input', 'error');
                    ClearScreen();
                }
            })
        }

        // var orderDetail = new Array();
        // console.log(dataTable);
        // $.each(dataTable, function name( i, val ) {
        //     var getsubtotal = val.harga * val.Qty;
        //     orderDetail.push({cartId: val.id, productId: val.id_masakan, Qty: val.Qty, Subtotal: getsubtotal});
        //     // orderDetail[i] = {};
        //     // orderDetail[i].productId = val.id_masakan;
        //     // orderDetail[i].Qty = val.Qty;
        //     // orderDetail[i].Subtotal = val.getsubtotal;

        //     // console.log(val);
        // });
        // // console.log(orderDetail);
        // Data.orderDet = orderDetail;

        // $.ajax({
        //     type: 'POST',
        //     url: "/api/order",
        //     cache: false,
        //     dataType: "JSON",
        //     data: Data
        // }).then((result) => {
        //     // debugger;
        //     if (result.statusCode == true) {
        //         Swal.fire({
        //             position: 'center',
        //             icon: 'success',
        //             title: 'Data inserted Successfully',
        //             showConfirmButton: false,
        //             timer: 1500,
        //         })
        //         // console.log(result.data);
        //         table.ajax.reload(null, false);
        //     } else {
        //         Swal.fire('Error', 'Failed to Input', 'error');
        //         // console.log(result.data);
        //         ClearScreen();
        //     }
        // })
    }


</script>

@endsection
