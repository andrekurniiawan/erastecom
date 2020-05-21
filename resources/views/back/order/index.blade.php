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
          <ul>
            @foreach ($order->products as $product)
            <li>{{ $product->name }}</li>
            @endforeach
          </ul>
        </td>
        <td>
          <ul>
            @foreach ($order->products as $product)
            <li>{{ $product->price }}</li>
            @endforeach
          </ul>
        </td>
        <td>
          <a href="{{ route('order.edit', $order->id) }}">Edit</a>
          <form action="{{ route('order.destroy', $order->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <input type="submit" onClick="actionConfirm()" value="Delete">
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection

@section('script')
<script>
$(document).ready(function() {
  $('#dataTables').DataTable({
    "paging": true,
    "lengthChange": true,
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": true,
  });
});

</script>
@endsection
