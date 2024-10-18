@extends('admin.master')
@section('content')
<div id="page-wrapper hunglo">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 hunglo">
                <h1 class="page-header hunglo">Edit Employee</h1>
            </div>
        </div>
        <div class="row hunglo">
            <div class="col-lg-12 hunglo">
                <form action="{{ route('employees.update', $employee->EmployeeID) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>First Name</label>
                        <input class="form-control" name="FirstName" value="{{ $employee->FirstName }}" required>
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input class="form-control" name="LastName" value="{{ $employee->LastName }}" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" name="Email" value="{{ $employee->Email }}" type="email" required>
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input class="form-control" name="PhoneNumber" value="{{ $employee->PhoneNumber }}">
                    </div>
                    <div class="form-group">
                        <label>Hire Date</label>
                        <input class="form-control" name="HireDate" value="{{ $employee->HireDate }}" type="date" required>
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <select class="form-control" name="Role" required>
                            <option value="Manager" {{ $employee->Role == 'Manager' ? 'selected' : '' }}>Manager</option>
                            <option value="Sales" {{ $employee->Role == 'Sales' ? 'selected' : '' }}>Sales</option>
                            <option value="Barista" {{ $employee->Role == 'Barista' ? 'selected' : '' }}>Barista</option>
                            <option value="WarehouseIn" {{ $employee->Role == 'WarehouseIn' ? 'selected' : '' }}>Warehouse In</option>
                            <option value="WarehouseOut" {{ $employee->Role == 'WarehouseOut' ? 'selected' : '' }}>Warehouse Out</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Employee</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
