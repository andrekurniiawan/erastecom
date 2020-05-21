@extends('layouts.app')

@section('content')
<div class="container">
  <div class="title">
    <h1>Orders</h1>
  </div>
  <table id="dataTables" class="table table-striped table-bordered" style="width:100%">
    <thead>
      <td>Order Code</td>
      <td>Products</td>
      <td>Total</td>
      <td>Action</td>
    </thead>
    <tbody>
      @foreach ($orders as $order)
      <tr>
        <td>{{ $order->number }}</td>
        <td>
          @foreach ($order->products as $product)
          {{ $product->name }}
          @endforeach
        </td>
        <td>
          @foreach ($order->products as $product)
          {{ $product->price }}
          @endforeach
        </td>
        <td>
          <a href="{{ route('order.edit', $order->id) }}">Edit</a>
          <form action="{{ route('order.destroy', $order->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <input type="submit" value="Delete">
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
