@extends('layouts.app')

@section('content')
<div class="container">
  <div class="order">
    <div class="title">
      <h1>Order Information</h1>
    </div>
    <div class="order-information">
      <p>{{ $product->name }}</p>
      <p>{{ $product->price }}</p>
      <p>Qty</p>
    </div>
  </div>
  <div class="customer">
    <div class="title">
      <h1>Customer Information</h1>
    </div>
    <form id="form" action="{{ route('order.store')}}" method="POST">
      @csrf
      <div class="form-group">
        <label for="fullname">Full Name</label>
        <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Full Name">
      </div>
      <div class="form-group">
        <label for="phone">Phone</label>
        <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number">
      </div>
      <div class="form-group">
        <label for="address">Address</label>
        <input type="text" class="form-control" id="address" name="address" placeholder="Address">
      </div>
      <input type="hidden" class="form-control" id="product" name="product" value="{{ $product->id }}">
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</div>
</div>
@endsection
