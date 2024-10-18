<?php

namespace App\Http\Controllers;

use App\Models\Product;  // Import Product model
use App\Models\Employee;
use App\Models\Inventory;
use App\Models\Shipment;
use App\Models\SupplyHistory;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    public function index()
    {
        $shipments = Shipment::with(['product', 'employee'])->get();
        return view('admin.shipments.shipment-list', compact('shipments'));
    }

    public function create()
    {
        $products = Product::all();
        $employees = Employee::where('Role', 'WarehouseOut')->get(); // Lấy danh sách nhân viên nhập kho
        return view('admin.shipments.shipment-add', compact('products', 'employees'));
    }
    
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'ProductID' => 'required|exists:products,ProductID',
            'WarehouseOutEmployeeID' => 'required',
            'Quantity' => 'required|integer|min:0',
            'ShipmentDate' => 'required|date',
            'Notes' => 'nullable|string',
        ]);
    
        // Lưu thông tin vào bảng Shipments
        $shipment = new Shipment();
        $shipment->ProductID = $request->ProductID;
        $shipment->WarehouseOutEmployeeID = $request->WarehouseOutEmployeeID;
        $shipment->Quantity = $request->Quantity;
        $shipment->ShipmentDate = $request->ShipmentDate;
        $shipment->Notes = $request->Notes;
        $shipment->save();
    
        // Cập nhật số lượng trong bảng Products
        $product = Product::find($request->ProductID);
        $product->Stock -= $request->Quantity;
        $product->save();
    
        // Cập nhật số lượng trong bảng Inventory
        $inventory = Inventory::where('ProductID', $request->ProductID)->first();
        if ($inventory) {
            $inventory->Quantity -= $request->Quantity;
            $inventory->save();
        }
    
        // Redirect back to the list of shipments
        return redirect()->route('shipments.index')->with('success', 'Thêm mới lô hàng thành công và đã cập nhật số lượng.');
    }
    
    public function edit(Shipment $shipment)
    {
        // Lấy tất cả các sản phẩm
        $products = Product::all();
    
        // Lấy danh sách nhân viên
        $employees = Employee::where('Role', 'WarehouseOut')->get(); // Lấy danh sách nhân viên nhập kho
    
        // Truyền dữ liệu lô hàng, sản phẩm, và nhân viên vào view
        return view('admin.shipments.shipment-edit', compact('shipment', 'products', 'employees'));
    }
    
    public function update(Request $request, $id)
{
    // Validate form data
    $request->validate([
        'ProductID' => 'required|exists:products,ProductID',
        'Quantity' => 'required|integer|min:1',
        'ShipmentDate' => 'required|date',
        'Notes' => 'nullable|string',
        'WarehouseOutEmployeeID' => 'required|exists:employees,EmployeeID'
    ]);

    // Tìm shipment theo ID
    $shipment = Shipment::findOrFail($id);

    // Lấy thông tin sản phẩm và số lượng cũ
    $oldProductID = $shipment->ProductID;
    $oldQuantity = $shipment->Quantity;

    // Lưu thông tin cập nhật vào bảng shipments
    $shipment->ProductID = $request->ProductID;
    $shipment->Quantity = $request->Quantity;
    $shipment->ShipmentDate = $request->ShipmentDate;
    $shipment->Notes = $request->Notes;
    $shipment->WarehouseOutEmployeeID = $request->WarehouseOutEmployeeID;
    $shipment->save();

    // Cập nhật lại số lượng sản phẩm trong bảng product và inventory

    // Trả lại số lượng cũ vào Product và Inventory
    $oldProduct = Product::findOrFail($oldProductID);
    $oldInventory = Inventory::where('ProductID', $oldProductID)->first();

    // Khôi phục lại số lượng cũ vào bảng product và inventory
    $oldProduct->Stock += $oldQuantity; // Trả lại số lượng vào bảng Product
    $oldInventory->Quantity += $oldQuantity; // Trả lại số lượng vào bảng Inventory
    $oldProduct->save();
    $oldInventory->save();

    // Trừ đi số lượng mới từ Product và Inventory
    $newProduct = Product::findOrFail($request->ProductID);
    $newInventory = Inventory::where('ProductID', $request->ProductID)->first();

    // Cập nhật số lượng sản phẩm mới vào bảng Product và Inventory
    $newProduct->Stock -= $request->Quantity; // Trừ số lượng mới vào Product
    $newInventory->Quantity -= $request->Quantity; // Trừ số lượng mới vào Inventory
    $newProduct->save();
    $newInventory->save();

    // Redirect hoặc trả về thông báo thành công
    return redirect()->route('shipments.index')->with('success', 'Shipment updated successfully.');
}

}
