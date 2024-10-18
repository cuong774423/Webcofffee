<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Inventory;
use App\Models\Supplier;

class InventoryController extends Controller
{
    public function index()
    {
        $inventories = Inventory::paginate(10);
        return view('admin.inventory.inventory-list', compact('inventories',));
    }
    public function create()
    {
        $products = Product::all();
        $inventories = Inventory::all();
        $suppliers = Supplier::all();
        return view('admin.inventory.inventory-add', compact('inventories', 'products', 'suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'ProductID' => 'required',
            'Quantity' => 'required|numeric|min:0',
            'SupplierID' => 'required|exists:suppliers,SupplierID', // Xác thực cho SupplierID
        ]);

        // Create a new Product instance
        $inventory = new Inventory();
        $inventory->ProductID = $request->ProductID;
        $inventory->Quantity = $request->Quantity;
        $inventory->SupplierID = $request->SupplierID;
        $inventory->save();

        // Cập nhật Stock trong bảng Product
        $product = Product::find($request->ProductID);
        $product->Stock = $inventory->Quantity; // Cập nhật Stock với Quantity mới
        $product->save();
        
        // Redirect back to the list of products
        return redirect()->route('inventories.index')->with('success', 'Thêm mới inventory thành công.');
    }
    
    public function edit($id)
    {   
        $products = Product::all();
        $suppliers = Supplier::all();
        $inventory = Inventory::findOrFail($id);
        return view('admin.inventory.inventory-edit', compact('inventory', 'products', 'suppliers'));
    }
    public function update(Request $request, $id)
    {
        // Tìm sản phẩm cần cập nhật thông tin
        $inventory = Inventory::findOrFail($id);

        // Validate the form data
        $request->validate([
            'ProductID' => 'required',
            'Quantity' => 'required',
            'SupplierID' => 'required|exists:suppliers,SupplierID', // Xác thực cho SupplierID
        ]);

        // Update product information
        $inventory->ProductID = $request->ProductID;
        $inventory->Quantity = $request->Quantity;
        $inventory->SupplierID = $request->SupplierID;
        // Save updated inventory information
        $inventory->save();

                // Tìm Product và cập nhật Stock
        $product = Product::find($inventory->ProductID); // Tìm Product dựa vào ProductID trong Inventory
        if ($product) {
            $product->Stock = $inventory->Quantity;  // Cập nhật Stock với Quantity mới từ Inventory
            $product->save();  // Lưu lại thông tin của Product
    }

        // Redirect về danh sách sản phẩm sau khi cập nhật thành công
        return redirect()->route('inventories.index')->with('success', 'Thông tin đã được cập nhật thành công.');
    }
    public function destroy($id)
    {
        $inventory = Inventory::findOrFail($id);

        // Xóa sản phẩm
        $inventory->delete();

        return redirect()->route('inventories.index')->with('success', 'Inventory đã được xóa thành công.');
    }
}
