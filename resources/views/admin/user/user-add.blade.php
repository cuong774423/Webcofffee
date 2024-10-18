@extends('admin.master')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Add User</h1>
            </div>
            <div class="col-lg-12">
                <form role="form" action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Username</label>
                        <input class="form-control" name="Username" placeholder="Enter username" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="Password" placeholder="Enter password" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="Email" placeholder="Enter email" required>
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input class="form-control" name="PhoneNumber" placeholder="Enter phone number">
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <textarea class="form-control" name="Address" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <select class="form-control" name="Role" required>
                            <option value="Admin">Admin</option>
                            <option value="Staff">Staff</option>
                            <option value="Customer">Customer</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
