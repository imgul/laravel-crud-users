@extends('user.layouts.app')

@section('content')
    <div class="container pt-4">
        <div class="row py-4">
            <div class="col-6">
                <h1>All Users</h1>
            </div>
            <div class="col-6 d-flex justify-content-end">
                <a href="{{ route('user.create') }}">
                    <button class="btn btn-primary">Create New User</button>
                </a>
            </div>
        </div>
        <div class="row">
            <table class="table table-bordered">
                <thead class="bg-primary text-white">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">User ID</th>
                        <th scope="col">User Name</th>
                        <th scope="col">Email Address</th>
                        <th scope="col">Hobbies</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ @$user->id }}</td>
                            <td>{{ @$user->name }}</td>
                            <td>{{ @$user->email }}</td>
                            <td>{{ @$user->hobbies }}</td>
                            <td>{{ @$user->created_at }}</td>
                            <td>
                                <a href="{{ route('user.edit', $user->id) }}">
                                    <button class="btn btn-sm btn-primary">Edit</button>
                                </a>
                                <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
