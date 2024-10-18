@extends('admin.master')
@section('content')
<div class="container mt-5 hunglo0">
    <h1 class="mb-4 hunglo">Employee Details</h1>

    <div class="card hunglo">
        <div class="card-header">
            <h2>{{ $employee->FirstName }} {{ $employee->LastName }}</h2>
        </div>
        <div class="card-body">
            <p><strong>Email:</strong> {{ $employee->Email }}</p>
            <p><strong>Phone Number:</strong> {{ $employee->PhoneNumber }}</p>
            <p><strong>Hire Date:</strong> {{ $employee->HireDate }}</p>
            <p><strong>Role:</strong> {{ $employee->Role }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('employees.edit', $employee->EmployeeID) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('employees.index') }}" class="btn btn-primary">Back to List</a>
        </div>
    </div>
</div>
@endsection
