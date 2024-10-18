@extends('admin.master')
@section('content')
<div id="page-wrapper ">
    <div class="container-fluid hunglo0">
        <div class="row">
            <div class="col-lg-12 ">
                <h1 class="page-header ">Add Employee</h1>
            </div>
        </div>
        <div class="row hunglo">
            <div class="col-lg-12 hunglo">
                <form action="{{ route('employees.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>First Name</label>
                        <input class="form-control" name="FirstName" placeholder="Enter first name" required>
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input class="form-control" name="LastName" placeholder="Enter last name" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" name="Email" placeholder="Enter email" type="email" required>
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input class="form-control" name="PhoneNumber" placeholder="Enter phone number" type="tel">
                    </div>
                    <div class="form-group">
                        <label>Hire Date</label>
                        <input class="form-control" name="HireDate" placeholder="Enter hire date" type="date" required>
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <select class="form-control" name="Role" required>
                            <option value="Manager">Manager</option>
                            <option value="Sales">Sales</option>
                            <option value="Barista">Barista</option>
                            <option value="WarehouseIn">Warehouse In</option> <!-- Vai trò nhập kho -->
                            <option value="WarehouseOut">Warehouse Out</option> <!-- Vai trò xuất kho -->
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Add Employee</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
