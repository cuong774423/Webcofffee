<?php


namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Inventory;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();
    
        // Tìm kiếm theo từ khóa
        if ($request->has('search') && $request->search != '') {
            $query->where('ProductName', 'like', '%' . $request->search . '%')
                  ->orWhere('Description', 'like', '%' . $request->search . '%');
        }
    
        // Lọc theo danh mục
        if ($request->has('category') && $request->category != '') {
            $query->where('CategoryID', $request->category);
        }
    
        // Lấy danh sách sản phẩm và danh mục
        $products = $query->paginate(10);
        $categories = Category::all(); // Lấy tất cả danh mục
    
        return view('admin.product.product-list', compact('products', 'categories'));
    }
    



    public function create()
    {
        $suppliers = Supplier::all();
        $categories = Category::all();
        return view('admin.product.product-add', compact('categories','suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'ProductName' => 'required',
            'Description' => 'nullable',
            'Price' => 'required|numeric|min:0',
            'ImageURL' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'CategoryID' => 'required|exists:categories,CategoryID',
            'Stock' => 'required|integer|min:0',
            'SupplierID' => 'required|exists:suppliers,SupplierID', // Đảm bảo có SupplierID
        ]);

        // Handle file upload
        $imageName = time() . '.' . $request->ImageURL->getClientOriginalExtension();
        $request->ImageURL->move(public_path('images'), $imageName);

        // Create a new Product instance
        $product = new Product();
        $product->ProductName = $request->ProductName;
        $product->Description = $request->Description;
        $product->Price = $request->Price;
        $product->CategoryID = $request->CategoryID;
        $product->Stock = $request->Stock;
        $product->ImageURL = $imageName;
        $product->save();

        // if (!$product->ProductID) {
        //     return redirect()->back()->with('error', 'Product ID is null. Cannot insert into inventory.');
        // }
        //  // Tạo bảng Inventory
        // $inventory = new Inventory();
        // $inventory->ProductID = $product->ProductID;
        // $inventory->Quantity = $request->Stock; // Số lượng sản phẩm được lưu vào Inventory
        // $inventory->SupplierID = $request->SupplierID;
        // $inventory->save();

        // Redirect back to the list of products
        return redirect()->route('products.index')->with('success', 'Thêm mới sản phẩm thành công.');
    }


    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.product.product-edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        // Tìm sản phẩm cần cập nhật thông tin
        $product = Product::findOrFail($id);

        // Lưu số lượng sản phẩm hiện tại trước khi cập nhật
        $oldStock = $product->Stock;


        // Validate the form data
        $request->validate([
            'ProductName' => 'required',
            'Description' => 'nullable',
            'Price' => 'required|numeric|min:0',
            'ImageURL' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'CategoryID' => 'required|exists:categories,CategoryID',
            'Stock' => 'required|integer|min:0',
        ]);

        // Update product information
        $product->ProductName = $request->ProductName;
        $product->Description = $request->Description;
        $product->Price = $request->Price;
        $product->CategoryID = $request->CategoryID;
        $product->Stock = $request->Stock;

        // Kiểm tra nếu có file ảnh mới được gửi lên
        if ($request->hasFile('ImageURL')) {
            // Xóa ảnh cũ nếu có
            if ($product->ImageURL) {
                $oldImagePath = public_path('images/' . $product->ImageURL);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Lưu ảnh mới
            $imageName = time() . '.' . $request->ImageURL->getClientOriginalExtension();
            $request->ImageURL->move(public_path('images'), $imageName);
            $product->ImageURL = $imageName;
        }

        // Kiểm tra nếu checkbox "Xóa ảnh" được chọn
        if ($request->has('delete_image')) {
            if ($product->ImageURL) {
                $imagePath = public_path('images/' . $product->ImageURL);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
                $product->ImageURL = null;
            }
        }

        // Save updated product information
        $product->save();

         // Cập nhật kho Inventory nếu số lượng thay đổi
    if ($oldStock != $request->Stock) {
        $inventory = Inventory::where('ProductID', $product->ProductID)->first();
        if ($inventory) {
            $inventory->Quantity = $product->Stock; // Cập nhật số lượng trong Inventory
            $inventory->save();
        }
    }

        // Redirect về danh sách sản phẩm sau khi cập nhật thành công
        return redirect()->route('products.index')->with('success', 'Thông tin sản phẩm đã được cập nhật thành công.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Xóa ảnh nếu có
        if ($product->ImageURL) {
            $imagePath = public_path('images/' . $product->ImageURL);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // Xóa sản phẩm
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Sản phẩm đã được xóa thành công.');
    }
    public function show($id, Request $request)
    {
        $product = Product::findOrFail($id);
    
        // Kiểm tra URL hoặc route để xác định truy cập từ admin hay trang chủ
        if ($request->is('admin/*')) {
            // Hiển thị trang chi tiết trong admin
            return view('admin.product.product-details', compact('product'));
        } else {
            // Hiển thị trang chi tiết trên trang chủ
            return view('pages.product-details', compact('product'));
        }
    }

}
