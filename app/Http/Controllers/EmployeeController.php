<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        return view('admin.employee.employee-list', compact('employees'));
    }

    public function create()
    {
        return view('admin.employee.employee-add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'FirstName' => 'required',
            'LastName' => 'required',
            'Email' => 'required|email|unique:employees',
            'HireDate' => 'required|date',
            'Role' => 'required|in:Manager,Sales,Barista,WarehouseIn,WarehouseOut', // Cập nhật thêm các vai trò mới
        ]);

        Employee::create($request->all());
        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }

    public function edit($id)
    {
        $employee = Employee::findOrFail($id); // Sử dụng findOrFail để xử lý tốt hơn
        return view('admin.employee.employee-edit', compact('employee'));
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);

        $request->validate([
            'FirstName' => 'required',
            'LastName' => 'required',
            'Email' => 'required|email|unique:employees,Email,' . $id . ',EmployeeID',
            'HireDate' => 'required|date',
            'Role' => 'required|in:Manager,Sales,Barista,WarehouseIn,WarehouseOut', // Cập nhật thêm các vai trò mới
        ]);

        $employee->update($request->all());
        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy($id)
    {
        Employee::findOrFail($id)->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }

    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        return view('admin.employee.employee-show', compact('employee'));
    }
}
