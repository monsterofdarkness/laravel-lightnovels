<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Chapter;
use App\Models\Novel;

class CategoryController extends Controller
{

    // public function index()
    // {
    //     $category = Category::orderBy('id', 'DESC')->get();
    //     return view('admin_cpanel.category.index')->with(compact('category'));
    // }


    // public function create()
    // {
    //     return view('admin_cpanel.category.create');
    // }


    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'categoryname' => 'required|unique:category|max:255',
                'slug_category' => 'required|unique:category|max:255',
                'status' => 'required',
            ],
            [
                'categoryname.unique' => 'Tên thể loại này đã có!',
                'slug_category.unique' => 'Slug thể loại này đã có!',
                'categoryname.required' => 'Phải có tên thể loại!',
                'slug_category.required' => 'Phải có slug thể loại!',
            ]
        );
        $category = new Category();
        $category->categoryname = $data['categoryname'];
        $category->slug_category = $data['slug_category'];
        $category->status = $data['status'];
        $category->save();
        return redirect()->route('category_index')->with('status', 'Thêm thể loại thành công!');
    }


    // public function edit($id)
    // {
    //     $category = Category::find($id);
    //     return view('admin_cpanel.category.edit')->with(compact('category'));
    // }


    public function update(Request $request, $id)
    {
        $data = $request->validate(
            [
                'categoryname' => 'required|max:255',
                'slug_category' => 'required|max:255',
                'status' => 'required',
            ],
            [
                'categoryname.required' => 'Phải có slug loại truyện!',
                'slug_category.required' => 'Phải có tên loại truyện!',
            ]
        );
        $category = Category::find($id);
        $category->categoryname = $data['categoryname'];
        $category->slug_category = $data['slug_category'];
        $category->status = $data['status'];
        $category->save();
        return redirect()->route('category_index')->with('status', 'Cập nhật thể loại thành công!');
    }


    public function destroy($id)
    {
        Category::find($id)->delete();
        return redirect()->back()->with('status', 'Xóa thể loại thành công!');
    }

    public function management_category_index()
    {
        $category = Category::orderBy('id', 'DESC')->paginate(10);
        return view('admin_cpanel.category.category_index')->with(compact('category'));
    }

    public function management_category_create()
    {
        return view('admin_cpanel.category.category_create');
    }

    public function management_category_edit($id)
    {
        $category = Category::find($id);
        return view('admin_cpanel.category.category_edit')->with(compact('category'));
    }

    public function management_category_search() {

        $keywords = $_GET['keywords'];
        $categories = Category::where('categoryname', 'LIKE', '%'.$keywords.'%')->get();
        
        return view('admin_cpanel.category.search_category')->with(compact('keywords', 'categories'));
    }

}
