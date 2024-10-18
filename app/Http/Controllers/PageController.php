<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Discount;
use App\Models\Order_detail;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;




class PageController extends Controller
{
    use ValidatesRequests;
    public function index()
    {
        $products = Product::all();
        return view('pages.index', compact('products'));
    }
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('pages.product-detail', compact('product'));
    }
    public function showCategory($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return redirect()->back()->with('error', 'Category not found');
        }

        $products = Product::where('CategoryID', $id)->get();

        return view('pages.category', compact('category', 'products'));
    }
    public function addToCart(Request $request,$id){
        $product=Product::find($id);
        $oldCart=Session('cart')?Session::get('cart'):null;
        $cart=new Cart($oldCart);
        $cart->add($product,$id);
        $request->session()->put('cart',$cart);
        return redirect()->back();
     }
    
     public function delCartItem($id){
        $oldCart=Session::has('cart')?Session::get('cart'):null;
        $cart=new Cart($oldCart);
        $cart->removeItem($id);
        if(count($cart->items)>0){
            Session::put('cart',$cart);
        }else Session::forget('cart');
        return redirect()->back();
    }

    public function getCheckout(){
        return view('pages.checkout');
    }
    
    public function postCheckout(Request $request)
{
    $cart = Session::get('cart');
    if (!$cart) {
        return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống.');
    }

    foreach ($cart->items as $key => $value) {
        $product = Product::find($key);
        if ($product && $value['qty'] > $product->Stock) {
            // Nếu số lượng sản phẩm trong giỏ lớn hơn số lượng trong kho, báo lỗi
            return redirect()->route('cart.index')->with('error', 'Sản phẩm ' . $product->ProductName . ' chỉ còn ' . $product->Stock . ' sản phẩm trong kho.');
        }
    }
    // Tạo mới khách hàng
    $customer = new Customer();
    $customer->name = $request->input('name');
    $customer->gender = $request->input('gender');
    $customer->email = $request->input('email');
    $customer->address = $request->input('address');
    $customer->phone_number = $request->input('phone_number');
    $customer->note = $request->input('notes');
    $customer->save();

    // Tạo mới đơn hàng
    $bill = new Order();
    $bill->customer_id = $customer->id;
    $bill->OrderDate = date('Y-m-d');
    $bill->TotalAmount = $cart->totalPrice;
    $bill->save();

    // Tạo chi tiết đơn hàng và giảm số lượng stock
    foreach ($cart->items as $key => $value) {
        $bill_detail = new Order_detail();
        $bill_detail->OrderID = $bill->OrderID;
        $bill_detail->ProductID = $key;
        $bill_detail->Quantity = $value['qty'];
        $bill_detail->UnitPrice = $value['price'] / $value['qty'];
        $bill_detail->save();

        // Cập nhật stock sản phẩm
        $product = Product::find($key);
        if ($product) {
            $product->Stock = $product->Stock - $value['qty']; // Giảm số lượng Stock
            $product->save();
        }
    }

    // Kiểm tra và cập nhật UsageCount cho mã giảm giá nếu có
    if (Session::has('DiscountCode')) {
        $discountCode = Session::get('DiscountCode');
        $discount = Discount::where('DiscountCode', $discountCode)->first();
        if ($discount) {
            $discount->UsageCount += 1;
            $discount->save();
        }
    }

    // Xóa giỏ hàng sau khi đặt hàng thành công
    Session::forget('cart');
    Session::forget('DiscountCode'); // Xóa mã giảm giá khỏi session sau khi hoàn tất thanh toán

    return redirect()->route('pages.index')->with('success', 'Đặt hàng thành công!');
}

    
    

    public function getSignup(){
       
        return view('pages.dangky');
    }
    
    public function postSignup(Request $req){
        $validated = $req->validate(
            [
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6|max:20',
                'phone' => 'required',
                'name' => 'required',
                'repassword' => 'required|same:password'
            ],
            [
                'email.required' => 'Vui lòng nhập email',
                'email.email' => 'Không đúng định dạng email',
                'email.unique' => 'Email đã có người sử dụng',
                'password.required' => 'Vui lòng nhập mật khẩu',
                'repassword.same' => 'Mật khẩu không giống nhau',
                'password.min' => 'Mật khẩu ít nhất 6 ký tự'
            ]
        );
    
        $user = new User();
        $user->UserName = $req->name;
        $user->Email = $req->email;
        $user->Password =Hash::make ($req->password); 
        $user->PhoneNumber = $req->phone;
        $user->Address = $req->address;
        $user->Role = 'Staff';
        $user->save();
    
        return redirect('dangnhap')->back()->with('success', 'Tạo tài khoản thành công');
    }
    
    public function getLogin(){
        return view('pages.dangnhap');
    }
    public function postLogin(Request $req) {
        // Validate the request
        $this->validate($req, [
            'email' => 'required|email',
            'password' => 'required|min:6|max:20'
        ], [
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Không đúng định dạng email',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu ít nhất 6 ký tự'
        ]);
    
        // Tìm người dùng theo email
        $user = User::where('Email', $req->email)->first(); // Lấy người dùng qua email
    
        if (!$user) {
            // Nếu không tìm thấy email trong cơ sở dữ liệu
            return redirect()->back()->with(['flag' => 'danger', 'message' => 'Email không tồn tại ']);
        } elseif (!Hash::check($req->password, $user->Password)) {
            // Nếu email tồn tại nhưng mật khẩu sai
            return redirect()->back()->with(['flag' => 'danger', 'message' => 'Mật khẩu không đúng']);
        } else {
            // Nếu cả email và mật khẩu đều đúng, đăng nhập người dùng
            $remember = $req->has('remember'); // Kiểm tra xem checkbox "remember" có được tick hay không
            Auth::login($user, $remember); // Đăng nhập người dùng
    
            return redirect()->route('pages.index')->with(['flag' => 'alert', 'message' => 'Đăng nhập thành công']);
        }
    }
    
    
    
    public function getLogout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('pages.index');
    }
    public function getInputEmail(){
        return view('emails.input-email');
    }
    public function postInputEmail(Request $req){
        $email=$req->txtEmail;
        //validate

        // kiểm tra có user có email như vậy không
        $user=User::where('Email',$email)->get();
        //dd($user);
        if($user->count()!=0){
            //gửi mật khẩu reset tới email
            $sentData = [   
                'title' => 'Mật khẩu mới của bạn là:',
                'body' => '123456'
            ];
            Mail::to($email)->send(new \App\Mail\SendMail($sentData));
            Session::flash('message', 'Send email successfully!');
            return view('pages.dangnhap');  //về lại trang đăng nhập của khách
        }
        else {
              return redirect()->route('getInputEmail')->with('message','Your email is not right');
        }
    }//hết postInputEmail
}
