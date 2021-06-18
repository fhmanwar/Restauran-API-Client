@extends('user.layout.main')
@section('title','Dashboard')
@section('head-title','Welcome to Dashboard')

@section('page')
    <span>Product</span>
@endsection

@section('content')

@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<div class="row">
    <div class="col-md-10 col-md-push-2">
        <div class="row row-pb-lg">
            @foreach ($product as $row)
            <div class="col-md-4 text-center">
                <div class="product-entry">
                    <div class="product-img" style="background-image: url({{ asset('img/product/'.$row->gambar_masakan) }} );"> </div>
                    <div class="desc">
                        <div class="col-md-8">
                            <h3><a href="product-detail.html">{{ $row->nama_masakan }}</a></h3>
                            <p class="price"><span>{{ $row->harga }}</span></p>
                        </div>
                        <div class="col-md-4">
                            <form action="{{ route('addCart') }}" method="post" >
                                @csrf
                                <input type="hidden" name="noMeja" value="{{ session('noMeja') }}">
                                <input type="hidden" name="productName" value="{{ $row->nama_masakan }}">
                                <button type="submit" class="btn btn-warning btn-outline"><i class="icon-shopping-cart"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            @endforeach

        </div>
    </div>
</div>
@endsection
