@extends('layouts.app')

@section('content')
<div class="container">
  <div class="title">
    <h1>Orders</h1>
  </div>
  <div class="order-information">
    @foreach ($orders as $order)
    <div class="order-item">
      <p>Order No.: {{ $order->number }}</p>
      @foreach ($order->products as $product)
      <p>Product Name: {{ $product->name }}</p>
      <p>Total: {{ $product->price }}</p>
      @endforeach
      <a href="{{ route('order.edit', $order->id) }}">Edit</a>
      <form action="{{ route('order.destroy', $order->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <input type="submit" value="Delete">
      </form>
    </div>
    @endforeach
  </div>
</div>
@endsection
