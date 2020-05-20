@extends('layouts.app')

@section('content')
<div class="container">
  <div class="title">
    <h1>Edit Product</h1>
  </div>
  <form role="form" id="editProduct" action="{{ route('product.update', $product->id)}}" method="POST">
    @csrf
    @method('PATCH')
    <div class="form-group">
      <label for="name">Name</label>
      <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ $product->name }}">
    </div>
    <div class="form-group">
      <label for="price">Price</label>
      <input type="text" class="form-control" id="price" name="price" placeholder="Price" value="{{ $product->price }}">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
</div>
@endsection
