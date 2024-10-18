@extends('admin.master')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">User
                    <small>List</small>
                </h1>
            </div>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Address</th>
                        <th>Role</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr class="odd gradeX" align="center">
                        <td>{{ $user->UserID }}</td>
                        <td>{{ $user->Username }}</td>
                        <td>{{ $user->Email }}</td>
                        <td>{{ $user->PhoneNumber }}</td>
                        <td>{{ $user->Address }}</td>
                        <td>{{ $user->Role }}</td>
                        <td><a href="{{ route('users.edit', $user->UserID) }}">Edit</a></td>
                        <td>
                            <form action="{{ route('users.destroy', $user->UserID) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
