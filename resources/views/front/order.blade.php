@extends('layouts.app')

@section('content')
<div class="container">
  <div class="order">
    <div class="title">
      <h1>Order Information</h1>
    </div>
    <div class="order-information">
      <p>Name</p>
      <p>Price</p>
      <p>Qty</p>
    </div>
  </div>
  <div class="customer">
    <div class="title">
      <h1>Customer Information</h1>
    </div>
    <form>
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" placeholder="Name">
      </div>
      <div class="form-group">
        <label for="phone">Phone</label>
        <input type="text" class="form-control" id="phone" placeholder="Phone Number">
      </div>
      <div class="form-group">
        <label for="address">Address</label>
        <input type="text" class="form-control" id="Address" placeholder="Address">
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</div>
</div>
@endsection
