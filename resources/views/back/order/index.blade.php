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
      <td width="1%">Action</td>
    </thead>
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
    "processing": true,
    "serverSide": true,
    "ajax": {
      "url": "{{ route('order.index') }}",
      "type": 'GET',
    },
    "columns": [{
        data: 'number',
        name: 'number'
      },
      {
        data: 'name',
        name: 'name'
      },
      {
        data: 'price',
        name: 'price'
      },
      {
        data: 'action',
        name: 'action',
        render: function(data, type, row) {
          return '<div class="d-flex flex-row"><a href="order/' + row.id + '/edit" class="btn btn-success btn-sm mx-1">Edit</a><form action="order/' + row.id + '" method="POST"> @csrf @method("DELETE") <input type="submit" onClick="actionConfirm()" class="btn btn-danger btn-sm mx-1" value="Delete"></form></div>';
        }
      },
    ],
    "order": [
      [0, 'asc']
    ]
  });
});

</script>
@endsection
