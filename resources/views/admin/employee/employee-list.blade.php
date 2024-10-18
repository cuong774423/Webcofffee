@extends('admin.master')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row ">
            <div class="col-lg-12">
                <h1 class="page-header ">Employees
                    <small>List</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <table class="table table-striped table-bordered table-hover ">
                <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Hire Date</th>
                        <th>Role</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $employee)
                    <tr class="odd gradeX" align="center">
                        <td>{{ $employee->EmployeeID }}</td>
                        <td>{{ $employee->FirstName }}</td>
                        <td>{{ $employee->LastName }}</td>
                        <td>{{ $employee->Email }}</td>
                        <td>{{ $employee->PhoneNumber }}</td>
                        <td>{{ $employee->HireDate }}</td>
                        <td>{{ $employee->Role }}</td>
                        <td class="center">
                            <form action="{{ route('employees.destroy', $employee->EmployeeID) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                        <td class="center"><a href="{{ route('employees.edit', $employee->EmployeeID) }}" class="btn btn-primary">Edit</a></td>
                        <td class="center">
    <a href="{{ route('employees.show', $employee->EmployeeID) }}" class="btn btn-info">View Details</a>
</td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
