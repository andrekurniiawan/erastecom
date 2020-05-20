@extends('layouts.app')

@section('content')
<div class="container">
  <div class="order">
    <div class="title">
      <h1>Edit Order</h1>
    </div>
    <div class="order-information">
      <p>Order Number: {{ $order->number }}</p>
      <p>Product Name: {{ $product->name }}</p>
      <p>Price: {{ $product->price }}</p>
      <p>Quantity: 1</p>
    </div>
  </div>
  <div class="customer">
    <div class="title">
      <h1>Edit Customer Information</h1>
    </div>
    <form id="form" action="{{ route('order.update', $order->id)}}" method="POST">
      @csrf
      @method('PATCH')
      <div class="form-group">
        <label for="fullname">Full Name</label>
        <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Full Name" value="{{ $order->fullname }}">
      </div>
      <div class="form-group">
        <label for="phone">Phone</label>
        <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number" value="{{ $order->phone }}">
      </div>
      <div class="form-group">
        <label for="address">Address</label>
        <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="{{ $order->address }}">
      </div>
      <input type="hidden" class="form-control" id="product" name="product" value="{{ $product->id }}">
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</div>
</div>
@endsection
