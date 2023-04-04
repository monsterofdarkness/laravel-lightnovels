<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Novel;
use App\Models\Category;
use App\Models\InCategory;
use App\Models\Chapter;
use Illuminate\Support\Facades\Auth;

class NovelController extends Controller
{

    // public function index()
    // {
    //     $listnovel = Novel::with('belongstomanycategory')->orderBy('id', 'DESC')->get();
    //     return view('admin_cpanel.novel.index')->with(compact('listnovel'));
    // }

    // public function create()
    // {
    //     $category = Category::orderBy('id', 'DESC')->get();
    //     return view('admin_cpanel.novel.create')->with(compact('category'));
    // }

    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'novelname' => 'required|unique:novel|max:255',
                'slug_novelname' => 'required|unique:novel|max:255',
                'author' => 'required|max:255',
                'slug_author' => 'required|max:255',
                'summary' =>  'required',
                'category' => 'required',
                'state' => 'required',
                'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100, min_height=100, max_width=3000, max_height=3000',
                'status' => 'required',
            ],
            [
                'novelname.unique' => 'Tên truyện này đã có!',
                'slug_novelname.unique' => 'Slug truyện này đã có!',
                'novelname.required' => 'Phải có tên truyện!',
                'slug_novelname.required' => 'Phải có slug truyện!',
                'author.required' => 'Phải có tên tác giả truyện!',
                'slug_author.required' => 'Phải có slug tác giả!',
                'summary.required' => 'Phải có tóm tắt truyện!',
                'category.required' => 'Truyện phải có ít nhất 1 thể loại!',
                'image.required' => 'Phải có ảnh bìa truyện!',
            ]
        );
        $novel = new Novel();
        $novel->user_id = Auth::user()->id;
        $novel->novelname = $data['novelname'];
        $novel->slug_novelname = $data['slug_novelname'];
        $novel->author = $data['author'];
        $novel->slug_author = $data['slug_author'];
        $novel->summary = $data['summary'];
        $novel->state = $data['state'];
        $novel->status = $data['status'];

        $novel->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $novel->updated_at = Carbon::now('Asia/Ho_Chi_Minh');

        // add a new image into folder
        $get_image = $request->image;
        $path = 'uploads/novel/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.',$get_name_image));
        $new_image = $name_image.'-'.rand(0,99).'.'.$get_image->getClientOriginalExtension();
        $get_image->move($path, $new_image);
        $novel->image = $new_image;

        $novel->save();

        $novel->belongstomanycategory()->attach($data['category']);

        return redirect()->route('novel_index')->with('status', 'Thêm truyện thành công!');
    }


    // public function show($id)
    // {
        
    // }


    // public function edit($id)
    // {
    //     $novel = Novel::find($id);

    //     $incategory = $novel->belongstomanycategory;

    //     $category = Category::orderBy('id', 'DESC')->get();

    //     return view('admin_cpanel.novel.edit')->with(compact('novel', 'category', 'incategory'));
    // }


    public function update(Request $request, $id)
    {
        $data = $request->validate(
            [
                'novelname' => 'required|max:255',
                'slug_novelname' => 'required|max:255',
                'author' => 'required|max:255',
                'slug_author' => 'required|max:255',
                'summary' =>  'required',
                'category' => 'required',
                'state' => 'required',
                'status' => 'required',
            ],
            [
                'novelname.required' => 'Phải có tên truyện!',
                'slug_novelname.required' => 'Phải có slug truyện!',
                'author.required' => 'Phải có tên tác giả truyện!',
                'slug_author.required' => 'Phải có slug tác giả!',
                'summary.required' => 'Phải có tóm tắt truyện!',
                'category.required' => 'Truyện phải có ít nhất 1 thể loại!',
            ]
        );
        $novel = Novel::find($id);
        $novel->novelname = $data['novelname'];
        $novel->slug_novelname = $data['slug_novelname'];
        $novel->author = $data['author'];
        $novel->slug_author = $data['slug_author'];
        $novel->summary = $data['summary'];
        $novel->state = $data['state'];
        $novel->status = $data['status'];

        $novel->updated_at = Carbon::now('Asia/Ho_Chi_Minh');

        $novel->belongstomanycategory()->sync($data['category']);

        // add a new image into folder
        $get_image = $request->image;
        if($get_image) {
            $path = 'uploads/novel/'.$novel->image;
            if(file_exists($path)) {
                unlink($path);
            }
            $path = 'uploads/novel/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.'-'.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);
            $novel->image = $new_image;
        }
        
        $novel->save();
        return redirect()->route('novel_index')->with('status', 'Cập nhật truyện thành công!');
    }

    public function destroy($id)
    {
        $novel = Novel::find($id);
        $path = 'uploads/novel/'.$novel->image;
        
        //Xóa ảnh bìa
        if(file_exists($path)) {
            unlink($path);
        }

        //Xóa thể loại
        InCategory::whereIn('novel_id', [$novel->id])->delete();

        //Xóa Chapter
        Chapter::whereIn('novel_id', [$novel->id])->delete();

        $novel->delete();
        return redirect()->back()->with('status', 'Xóa truyện thành công!');
    }

    // public function showListChapter($novel_id) {
    //     $category = Category::orderBy('id', 'DESC')->get();
    //     $novel = Novel::find($novel_id);
    //     $chapter = Chapter::with('novel')->orderBy('created_at', 'ASC')->where('novel_id', $novel_id)->get();
        
    //     return view('admin_cpanel.novel.list_chapter')->with(compact('category', 'novel', 'chapter'));
    // }

    // public function showAddChapter($novel_id) {
    //     $category = Category::orderBy('id', 'DESC')->get();
    //     $novel = Novel::find($novel_id);
    //     return view('admin_cpanel.novel.index_add_chapter')->with(compact('category', 'novel'));
    // }


    public function management_index()
    {
        $listnovel = Novel::with('belongstomanycategory')->orderBy('id', 'DESC')->paginate(10);
        return view('admin_cpanel.novel.novel_index')->with(compact('listnovel'));
    }

    

    public function management_create()
    {
        $category = Category::where('status', 0)->orderBy('id', 'DESC')->get();
        return view('admin_cpanel.novel.novel_create')->with(compact('category'));
    }

    public function management_edit($id)
    {
        $novel = Novel::find($id);
        $category = Category::where('status', 0)->orderBy('id', 'DESC')->get();

        $incategory = $novel->belongstomanycategory;

        return view('admin_cpanel.novel.novel_edit')->with(compact('novel', 'incategory', 'category'));
    }

    public function management_search() {

        $keywords = $_GET['keywords'];
        $novels = Novel::where('novelname', 'LIKE', '%'.$keywords.'%')->orWhere('author', 'LIKE', '%'.$keywords.'%')->get();
        
        return view('admin_cpanel.novel.search_novel')->with(compact('keywords', 'novels'));
    }

}
