@extends('layouts.app')

@section('content')
<div class="container">
  <div class="title">
    <h1>Success</h1>
  </div>
  <div class="order-information">
    <p>Order No.: {{ $order->number }}</p>
    @foreach ($order->products as $product)
    <div class="product-information">
      <p>Product Name: {{ $product->name }}</p>
      <p>Qty: 1</p>
      <p>Total: {{ $product->price }}</p>
    </div>
    @endforeach
  </div>
</div>
@endsection
