<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chapter;
use App\Models\Novel;
use Carbon\Carbon;

class ChapterController extends Controller
{

    // public function index()
    // {
    //     $listchapter = Chapter::with('novel')->orderBy('id', 'DESC')->get();
    //     return view('admin_cpanel.chapter.index')->with(compact('listchapter'));
    // }
    
    // public function create()
    // {
    //     $listnovel = Novel::orderBy('id', 'DESC')->get();
    //     return view('admin_cpanel.chapter.create')->with(compact('listnovel'));
    // }


    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'novel_id' => 'required',
                'title' => 'required|max:255',
                'slug_chapter' => 'required|max:255',
                'content' =>  'required',
                'status' => 'required',
            ],
            [
                'title.required' => 'Phải có tên chương truyện!',
                'slug_chapter.required' => 'Phải có slug chương truyện!',
                'content.required' => 'Phải có nội dung chương truyện!',
            ]
        );
        $chapter = new Chapter();
        $chapter->novel_id = $data['novel_id'];
        $chapter->title = $data['title'];
        $chapter->slug_chapter = $data['slug_chapter'];
        $chapter->content = $data['content'];
        $chapter->status = $data['status'];

        $chapter->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $chapter->updated_at = Carbon::now('Asia/Ho_Chi_Minh');

        $chapter->save();
        return redirect()->route('chapter_index', ['novel_id' => $request->novel_id])->with('status', 'Thêm chương thành công!');
    }

    // public function edit($id)
    // {
    //     $chapter = Chapter::with('novel')->find($id);
    //     return view('admin_cpanel.chapter.edit')->with(compact('chapter'));
    // }

    public function update(Request $request, $id)
    {
        $data = $request->validate(
            [
                'title' => 'required|max:255',
                'slug_chapter' => 'required|max:255',
                'content' =>  'required',
                'status' => 'required',
            ],
            [
                'title.required' => 'Phải có tên chương truyện!',
                'slug_chapter.required' => 'Phải có slug chương truyện!',
                'content.required' => 'Phải có nội dung chương truyện!',
            ]
        );
        $chapter = Chapter::find($id);
        $chapter->title = $data['title'];
        $chapter->slug_chapter = $data['slug_chapter'];
        $chapter->content = $data['content'];
        $chapter->status = $data['status'];

        $chapter->updated_at = Carbon::now('Asia/Ho_Chi_Minh');

        $chapter->save();
        return redirect()->route('chapter_index', ['novel_id' => $chapter->novel_id])->with('status', 'Cập nhật chương thành công!');
    }


    public function destroy($id)
    {
        Chapter::find($id)->delete();
        return redirect()->back()->with('status', 'Xóa chương thành công!'); 
    }

    public function management_chapter_index($novel_id)
    {
        $novel = Novel::find($novel_id);
        $chapter = Chapter::with('novel')->orderBy('created_at', 'ASC')->where('novel_id', $novel_id)->paginate(10);
        return view('admin_cpanel.chapter.chapter_index')->with(compact('novel', 'chapter'));
    }
    
    public function management_chapter_create($novel_id)
    {
        $novel = Novel::find($novel_id);
        return view('admin_cpanel.chapter.chapter_create')->with(compact('novel'));
    }

    public function management_chapter_edit($id)
    {
        $chapter = Chapter::with('novel')->find($id);
        return view('admin_cpanel.chapter.chapter_edit')->with(compact('chapter'));
    }

    public function management_chapter_search($novel_id) {
        $novel = Novel::find($novel_id);
        $keywords = $_GET['keywords'];
        $chapters = Chapter::with('novel')->where('novel_id', $novel_id)->where('title', 'LIKE', '%'.$keywords.'%')->get();
        
        return view('admin_cpanel.chapter.search_chapter')->with(compact('keywords', 'chapters', 'novel'));
    }

}
