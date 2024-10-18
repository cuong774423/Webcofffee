<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;

class UserController extends Controller
{   
    use ValidatesRequests;
    public function index()
    {
        $users = User::all();
        return view('admin.user.user-list', compact('users'));
    }

    public function create()
    {
        return view('admin.user.user-add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Username' => 'required',
            'Password' => 'required|min:6',
            'Email' => 'required|email|unique:users',
            'PhoneNumber' => 'nullable',
            'Address' => 'nullable',
            'Role' => 'required|in:Admin,Staff,Customer',
        ]);

        User::create([
            'Username' => $request->Username,
            'Password' => Hash::make($request->Password),
            'Email' => $request->Email,
            'PhoneNumber' => $request->PhoneNumber,
            'Address' => $request->Address,
            'Role' => $request->Role,
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.user-edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Username' => 'required',
            'Password' => 'nullable|min:6',
            'Email' => 'required|email|unique:users,Email,' . $id . ',UserID',
            'PhoneNumber' => 'nullable',
            'Address' => 'nullable',
            'Role' => 'required|in:Admin,Staff,Customer',
        ]);

        $user = User::findOrFail($id);

        $user->Username = $request->Username;
        $user->Email = $request->Email;
        $user->PhoneNumber = $request->PhoneNumber;
        $user->Address = $request->Address;
        $user->Role = $request->Role;

        if ($request->Password) {
            $user->Password = Hash::make($request->Password);
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
  

    public function getLogin(){
            return view('admin.login.admin-login');
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
        
            // Attempt login with remember option
            $credentials = ['Email' => $req->email, 'Password' => $req->password];
            $remember = $req->has('remember'); // Check if "remember" checkbox is checked
        
            // Use Hash::check to compare the password
            $user = User::where('Email', $req->email)->first(); // Get the user by email
        
            if ($user && Hash::check($req->password, $user->Password)) {
                Auth::login($user, $remember); // Log in the user
                return redirect()->route('products.index')->with(['flag' => 'alert', 'message' => 'Đăng nhập thành công']);
            } else {
                return redirect()->back()->with(['flag' => 'danger', 'message' => 'Đăng nhập không thành công']);
            }
        }

    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('admin.getLogin');
    }
}
