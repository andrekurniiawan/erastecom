@extends('layouts.app')

@section('content')
<div class="container">
  <div class="title">
    <h1>Products</h1>
  </div>
  <table id="dataTables" class="table table-striped table-bordered" style="width:100%">
    <thead>
      <td>Name</td>
      <td>Price</td>
      {{-- <td>Action</td> --}}
    </thead>
    {{-- <tbody>
      @foreach ($products as $product)
      <tr>
        <td>{{ $product->name }}</td>
    <td>{{ $product->price }}</td>
    <td>
      <a href="{{ route('product.edit', $product->id) }}">Edit</a>
      <form action="{{ route('product.destroy', $product->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <input type="submit" onClick="actionConfirm()" value="Delete">
      </form>
    </td>
    </tr>
    @endforeach
    </tbody> --}}
  </table>
</div>
@endsection

@section('script')
<script type="text/javascript">
$(document).ready(function() {
  $('#dataTables').DataTable({
    "paging": true,
    "lengthChange": true,
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": true,
    "processing": true,
    "serverSide": true,
    "ajax": {
      "url": "{{ route('product.index') }}",
      "type": 'GET',
    },
    "columns": [{
        data: 'name',
        name: 'name'
      },
      {
        data: 'price',
        name: 'price'
      },
    ],
    "order": [
      [0, 'asc']
    ]
  });
});

</script>
@endsection
