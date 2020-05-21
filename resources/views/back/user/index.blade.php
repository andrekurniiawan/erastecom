@extends('layouts.app')

@section('content')
<div class="container">
  <div class="title">
    <h1>Users</h1>
  </div>
  <table id="dataTables" class="table table-striped table-bordered" style="width:100%">
    <thead>
      <td>Name</td>
      <td>Email</td>
      <td>Action</td>
    </thead>
    <tbody>
      @foreach ($users as $user)
      <tr>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>
          <a href="{{ route('user.edit', $user->id) }}">Edit</a>
          <form action="{{ route('user.destroy', $user->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <input type="submit" onClick="deleteConfirm()" value="Delete">
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
