@extends('layouts.app')

@section('content')
<div class="container">
  <div class="title">
    <h1>Deleted Orders</h1>
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
      "url": "{{ route('order.trash') }}",
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
          return '<div class="d-flex flex-row"><form action="order/' + row.id + '/restore" method="POST"> @csrf <input type="submit" class="btn btn-success btn-sm mx-1" value="Restore"></form><form action="order/' + row.id + '/kill" method="POST"> @csrf @method("DELETE") <input type="submit" onClick="actionConfirm()" class="btn btn-danger btn-sm mx-1" value="Delete Permanently"></form></div>';
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
