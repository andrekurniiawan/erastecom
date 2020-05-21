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
      <td width="1%">Action</td>
    </thead>
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
      {
        data: 'action',
        name: 'action',
        render: function(data, type, row) {
          return '<div class="d-flex flex-row"><a href="product/' + row.id + '/edit" class="btn btn-success btn-sm mx-1">Edit</a><form action="product/' + row.id + '" method="POST"> @csrf @method("DELETE") <input type="submit" onClick="actionConfirm()" class="btn btn-danger btn-sm mx-1" value="Delete"></form>';
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
