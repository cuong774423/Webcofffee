<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.cate-list', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.cate-add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'CategoryName' => 'required',
            'Description' => 'nullable',
        ]);

        Category::create([
            'CategoryName' => $request->input('CategoryName'),
            'Description' => $request->input('Description'),
        ]);

        return redirect()->route('categories.index')->with('success', 'Category added successfully.');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.cate-edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'CategoryName' => 'required',
            'Description' => 'nullable',
        ]);

        $category = Category::findOrFail($id);
        $category->CategoryName = $request->input('CategoryName');
        $category->Description = $request->input('Description');
        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        Category::findOrFail($id)->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
