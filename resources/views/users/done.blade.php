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


<div class="row">
    <div class="col-md-10 col-md-offset-1 text-center">
        <span class="icon"><i class="icon-shopping-cart"></i></span>
        <h2>Your order is being processed</h2>
    </div>
</div>

@endsection
