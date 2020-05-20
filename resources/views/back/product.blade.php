@extends('layouts.app')

@section('content')
<div class="container">
  <div class="title">
    <h1>Create Product</h1>
  </div>
  <form role="form" id="createProduct" action="{{ route('product.store')}}" method="POST">
    @csrf
    <div class="form-group">
      <label for="name">Name</label>
      <input type="text" class="form-control" id="name" name="name" placeholder="Name">
    </div>
    <div class="form-group">
      <label for="price">Price</label>
      <input type="text" class="form-control" id="price" name="price" placeholder="Price">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
</div>
@endsection
