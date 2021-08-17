@extends('users.layout')
@section('title','Dashboard')
@section('head-title','Welcome to Dashboard')

@section('page')
    <span><a href="{{ route('home') }}">Product</a></span>
    <span>Cart</span>
@endsection

@section('content')

@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

<div class="row row-pb-md">
    <div class="col-md-10 col-md-offset-1">
        <div class="product-name">
            <div class="one-forth text-center">
                <span>Product Details</span>
            </div>
            <div class="one-eight text-center">
                <span>Price</span>
            </div>
            <div class="one-eight text-center">
                <span>Quantity</span>
            </div>
            <div class="one-eight text-center">
                <span>Total</span>
            </div>
            <div class="one-eight text-center">
                <span>Action</span>
            </div>
        </div>
        <div class="product-cart">
            <form action="#" method="post" enctype="multipart/form-data">
            @php
                $total = 0;
                $discount = 200000;
                $shipping = 12000;
            @endphp
            @if (count($cart) > 0)
                @foreach ($cart as $row)
                <div class="dataCart">
                    <input type="hidden" name="id" value="{{ $row->id }}" />
                    <input type="hidden" name="userId" value="{{ $row->userId }}" />
                    <input type="hidden" name="productId" value="{{ $row->nama_masakan }}" />
                    @php
                        $total += ($row->harga*$row->Qty);
                    @endphp
                    <div class="one-forth">
                        <div class="product-img" style="background-image: url({{ asset('img/product/'.$row->gambar_masakan) }} );"> </div>
                        <div class="display-tc">
                            <h3>{{ $row->nama_masakan }}</h3>
                        </div>
                    </div>
                    <div class="one-eight text-center">
                        <div class="display-tc">
                            <span class="price">Rp. {{ number_format($row->harga,'0',',','.') }} </span>
                        </div>
                    </div>
                    <div class="one-eight text-center">
                        <div class="display-tc">
                            <input type="text" id="qty-{{ $row->id }}" name="qty" value="{{ $row->Qty }}" class="form-control input-number text-center" min="1" max="100">
                        </div>
                    </div>
                    <div class="one-eight text-center">
                        <div class="display-tc">
                            <span class="price">Rp {{ number_format(($row->harga*$row->Qty),0,',','.') }}</span>
                        </div>
                    </div>
                    <div class="one-eight text-center">
                        <div class="display-tc">
                            <div class="row">
                                <a href="#" type="button" class="icon-eye" onclick="UpdCart({{ $row->id }});"><i class="fa fa-check"></i></a>
                                <a href="#" type="button" class="closed" onclick="DelCart({{ $row->id }});" ></a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <div class="col-md-12 text-center">
                    <div class="display-tc">
                        <h3>Keranjang Belanja Kosong.</h3>
                    </div>
                </div>
            @endif
                <input type="hidden" name="total" value="{{ $total }}" />
                <input type="hidden" name="noMeja" value="{{ session('noMeja') }}" />
            </form>
        </div>

    </div>
</div>
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="total-wrap">
            <div class="row">
                <div class="col-md-9">
                    <div class="total">
                        <div class="sub">
                            <p><span>Subtotal:</span> <span>Rp. {{ number_format($total,0,',','.') }}</span></p>
                            {{-- <p><span>Shipping:</span> <span>Rp. {{ number_format($shipping,0,',','.') }}</span></p> --}}
                            {{-- <p><span>Discount:</span> <span>Rp. {{ number_format($discount,0,',','.') }}</span></p> --}}
                        </div>
                        <div class="grand-total">
                            <p><span><strong>Total:</strong></span> <span>Rp. {{ number_format($total,0,',','.') }}</span></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 text-center">
                    <form action="#">
                        <div class="row form-group">
                            <div class="col-md-12">
                                <input type="text" class="form-control" id="CustName" placeholder="Customer Name" required>
                            </div>
                            <div class="col-md-3">
                                <a href="#" class="btn btn-primary" onclick="addOrder();">Order <i class="icon-credit-card"></i></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@section('script')
<script>

    function UpdCart(number) {
        var Data = new Object();
        Data.IdCart = number;
        Data.qty = $('#qty-'+number).val();
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
                location.reload();
            } else {
                Swal.fire('Error', result.msg, 'error');
            }
        })
    }

    function DelCart(number) {
        //debugger;
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
                Data.id = number;
                Data._method = 'DELETE';
                $.ajax({
                    type: 'POST',
                    url: "/api/cart/" + number,
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
                        // $('#orderDetail').DataTable().ajax.reload(null, false);
                        location.reload();
                    } else {
                        Swal.fire('Error', 'Failed to Delete', 'error');
                    }
                });
            };
        });
    }

    function addOrder() {
        $('#loader').show();
        var dataCart=null;
        $.each($(".dataCart"), function name( i, val ) {
            dataCart =  $('input[name="id"]')[i].value +'|'+ $('input[name="productId"]')[i].value +'|'+ $('input[name="qty"]')[i].value + '~' + dataCart;
        });
        // console.log(dataCart);
        if (dataCart == null) {
            $('#loader').hide();
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
            Data.name =  $('#CustName').val();
            Data.total =  $('input[name="total"]').val();
            Data.noMeja = $('input[name="noMeja"]').val();
            Data.orderDet = dataCart;
            $.ajax({
                type: 'POST',
                url: "/api/order",
                cache: false,
                dataType: "JSON",
                data: Data
            }).then((result) => {
                $('#loader').hide();
                if (result.statusCode) {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Order Successfully',
                        showConfirmButton: false,
                        timer: 1500,
                    });
                    // location.reload();
                    location.href = '/complete/'+$('input[name="noMeja"]').val();
                } else {
                    Swal.fire('Error', 'Failed to Input', 'error');
                    ClearScreen();
                }
            })
        }
    }
</script>
@endsection
