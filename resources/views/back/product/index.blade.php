@extends('layouts.app')

@section('content')
<div class="container">
  <div class="title">
    <h1>Products</h1>
  </div>
  @foreach ($products as $product)
  <div class="card" style="width: 18rem;">
    <img src="https://via.placeholder.com/300" class="card-img-top" alt="">
    <div class="card-body">
      <h5 class="card-title">{{ $product->name }}</h5>
      <p class="card-text">{{ $product->price }}</p>
      <a href="{{ route('product.edit', $product->id) }}">Edit</a>
      <form action="{{ route('product.destroy', $product->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <input type="submit" value="Delete">
      </form>
    </div>
  </div>
  @endforeach
</div>
@endsection
