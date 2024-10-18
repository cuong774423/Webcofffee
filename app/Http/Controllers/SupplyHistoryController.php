<?php

namespace App\Http\Controllers;

use App\Models\SupplyHistory;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\Inventory;
use App\Models\Employee; // Thêm model Employee
use Illuminate\Http\Request;

class SupplyHistoryController extends Controller
{
    public function index()
    {
        // Lấy danh sách lịch sử nhập kho với các mối quan hệ
        $supplyHistories = SupplyHistory::all();
        return view('admin.supplierhistory.suphis-list', compact('supplyHistories'));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        $employees = Employee::where('Role', 'WarehouseIn')->get(); // Lấy danh sách nhân viên nhập kho
        $products = Product::all();
        return view('admin.supplierhistory.suphis-add', compact('suppliers', 'employees', 'products'));
    }

    public function store(Request $request)
    {
        // Validate dữ liệu
        $validatedData = $request->validate([
            'SupplierID' => 'required|exists:suppliers,SupplierID',
            'WarehouseInEmployeeID' => 'required|exists:employees,EmployeeID', // Kiểm tra nhân viên nhập kho
            'ProductID' => 'required|exists:products,ProductID',
            'Quantity' => 'required|integer',
            'DeliveryDate' => 'required|date',
            'Status' => 'required|in:Delivered,Pending,Delayed',
        ]);
    
        // Tạo bản ghi mới trong bảng supply_histories
        $supplyHistory = SupplyHistory::create($validatedData);
    
        // Cập nhật số lượng trong bảng products
        $product = Product::findOrFail($request->ProductID);
        $product->Stock += $request->Quantity; // Tăng số lượng hàng trong kho
        $product->save(); // Lưu thay đổi

            // Cập nhật hoặc tạo mới trong bảng inventory
        $inventory = Inventory::firstOrNew(['ProductID' => $request->ProductID]);
        $inventory->Quantity += $request->Quantity; // Cộng thêm số lượng nhập kho vào inventory
        $inventory->save(); // Lưu lại
    
        return redirect()->route('supply-history.index')->with('success', 'Supply added and product stock updated successfully.');
    }
    public function show(SupplyHistory $supplyHistory)
    {
        return view('admin.supplierhistory.suphis-show', compact('supplyHistory'));
    }

    public function edit(SupplyHistory $supplyHistory)
    {
        $suppliers = Supplier::all();
        $employees = Employee::where('Role', 'WarehouseIn')->get(); // Lấy danh sách nhân viên nhập kho
        $products = Product::all();
        return view('admin.supplierhistory.suphis-edit', compact('supplyHistory', 'suppliers', 'employees', 'products'));
    }

    public function update(Request $request, SupplyHistory $supplyHistory)
    {
        // Validate dữ liệu
        $validatedData = $request->validate([
            'SupplierID' => 'required|exists:suppliers,SupplierID',
            'WarehouseOutEmployeeID' => 'required|exists:employees,EmployeeID',
            'ProductID' => 'required|exists:products,ProductID',
            'Quantity' => 'required|integer',
            'DeliveryDate' => 'required|date',
            'Status' => 'required|in:Delivered,Pending,Delayed',
        ]);
    
        // Lấy số lượng cũ
        $oldQuantity = $supplyHistory->Quantity;
    
        // Tìm sản phẩm liên quan
        $product = Product::findOrFail($validatedData['ProductID']);
    
        // Cập nhật số lượng: trừ số lượng cũ và cộng số lượng mới
        $product->Stock = $product->Stock - $oldQuantity + $validatedData['Quantity'];
    
        // Lưu thay đổi trong bảng products
        $product->save();
    
           // Cập nhật inventory
        $inventory = Inventory::firstOrNew(['ProductID' => $validatedData['ProductID']]);
        $inventory->Quantity = $inventory->Quantity - $oldQuantity + $validatedData['Quantity']; // Điều chỉnh theo số lượng mới
        $inventory->save();
        // Cập nhật dữ liệu của SupplyHistory
        $supplyHistory->update($validatedData);
    
        return redirect()->route('supply-history.index')->with('success', 'Supply updated successfully.');
    }
    

    public function destroy(SupplyHistory $supplyHistory)
    {
        // Xóa dữ liệu
        $supplyHistory->delete();

        return redirect()->route('supply-history.index')->with('success', 'Supply history deleted successfully.');
    }
}