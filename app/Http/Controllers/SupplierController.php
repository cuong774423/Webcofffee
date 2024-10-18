<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::all();
        return view('admin.supplier.supplier-list', compact('suppliers'));
    }

    public function create()
    {
        return view('admin.supplier.supplier-add');
    }

    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'SupplierName' => 'required',
            'ContactName' => 'nullable',
            'Address' => 'nullable',
            'PhoneNumber' => 'nullable',
            'Email' => 'nullable|email',
        ]);

        // Create a new Supplier instance
        Supplier::create($request->all());

        // Redirect back to the list of suppliers
        return redirect()->route('suppliers.index')->with('success', 'Thêm mới nhà cung cấp thành công.');
    }

    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('admin.supplier.supplier-edit', compact('supplier'));
    }

    public function update(Request $request, $id)
    {
        // Validate the form data
        $request->validate([
            'SupplierName' => 'required',
            'ContactName' => 'nullable',
            'Address' => 'nullable',
            'PhoneNumber' => 'nullable',
            'Email' => 'nullable|email',
        ]);

        // Find the supplier to update
        $supplier = Supplier::findOrFail($id);

        // Update the supplier information
        $supplier->update($request->all());

        // Redirect back to the list of suppliers
        return redirect()->route('suppliers.index')->with('success', 'Thông tin nhà cung cấp đã được cập nhật thành công.');
    }

    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();

        return redirect()->route('suppliers.index')->with('success', 'Nhà cung cấp đã được xóa thành công.');
    }
}
