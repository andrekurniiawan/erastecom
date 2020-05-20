@extends('layouts.app')

@section('content')
<div class="container">
  <div class="title">
    <h1>Users</h1>
  </div>
  <div class="user-information">
    @foreach ($users as $user)
    <div class="user-item">
      <p>User Name: {{ $user->name }}</p>
      <p>Email: {{ $user->email }}</p>
      <a href="{{ route('user.edit', $user->id) }}">Edit</a>
      <form action="{{ route('user.destroy', $user->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <input type="submit" value="Delete">
      </form>
    </div>
    @endforeach
  </div>
</div>
@endsection
