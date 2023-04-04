<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Novel;
use App\Models\Category;
use App\Models\InCategory;
use App\Models\Chapter;
use App\Models\User;
use App\Models\Rating;
use App\Models\Favorite;
use App\Models\CommentTopic;
use App\Models\Topic;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TopicController extends Controller
{

    public function index() {
        $category = Category::orderBy('id', 'DESC')->where('status', 0)->get();
        $list_topic = Topic::with('user')->where('status', 0)->orderBy('created_at', 'DESC')->paginate(40);
        return view('pages.topic.index')->with(compact('category', 'list_topic'));
    }



    public function create() {
        $category = Category::orderBy('id', 'DESC')->where('status', 0)->get();
        return view('pages.topic.create')->with(compact('category'));
    }

    public function store(Request $request) {
        $data = $request->validate(
            [
                'type_topic' => 'required',
                'title' => 'required',
                'slug_title' => 'required',
                'content' =>  'required',
            ],
            [
                'type_topic.required' => 'Phải chọn mục bài viết!',
                'title.required' => 'Phải có tiêu đề bài viết!',
                'slug_title.required' => 'Phải có slug tiêu đề!',
                'content.required' => 'Bài viết phải có nội dung!',
            ]
        );

        $topic = new Topic();
        $topic->user_id = Auth::user()->id;
        $topic->type_topic = $data['type_topic'];
        $topic->title = $data['title'];
        $topic->slug_title = $data['slug_title'];
        $topic->content = $data['content'];

        $topic->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $topic->updated_at = Carbon::now('Asia/Ho_Chi_Minh');

        $topic->save();

        return redirect()->back()->with('status', 'Thêm bài viết thành công!');
    }


    public function detail($id, $slug) {
        $category = Category::orderBy('id', 'DESC')->where('status', 0)->get();
        $topic = Topic::where('id', $id)->where('slug_title', $slug)->where('status', 0)->first();
        $user = User::with('topic')->where('id', $topic->user_id)->first();
        $comment = CommentTopic::where(['topic_id' => $topic->id, 'comment_parent_id' => 0])->orderBy('created_at', 'DESC')->get();
        return view('pages.topic.detail')->with(compact('category', 'topic', 'user', 'comment'));
    }

    public function edit($id)
    {
        $topic = Topic::find($id);
        $category = Category::orderBy('id', 'DESC')->where('status', 0)->get();

        return view('pages.topic.edit')->with(compact('topic', 'category'));
    }


    public function update(Request $request, $id) {
        $data = $request->validate(
            [
                'type_topic' => 'required',
                'title' => 'required',
                'slug_title' => 'required',
                'content' =>  'required',
            ],
            [
                'type_topic.required' => 'Phải chọn mục bài viết!',
                'title.required' => 'Phải có tiêu đề bài viết!',
                'slug_title.required' => 'Phải có slug tiêu đề!',
                'content.required' => 'Bài viết phải có nội dung!',
            ]
        );

        $topic = Topic::find($id);
        $topic->type_topic = $data['type_topic'];
        $topic->title = $data['title'];
        $topic->slug_title = $data['slug_title'];
        $topic->content = $data['content'];

        $topic->updated_at = Carbon::now('Asia/Ho_Chi_Minh');

        $topic->save();

        return redirect('/bai-viet/chi-tiet/'.$id.'-'.$request->slug_title)->with('status', 'Cập nhật bài viết thành công!');
    }


    public function delete($id) {

        $topic = Topic::find($id);
        $topic->status = 1;

        $topic->save();

        return redirect('/bai-viet')->with('status', 'Xóa bài viết thành công!');
    }

    public function management_topic_index() {
        $list_topic = Topic::with('user')->orderBy('created_at', 'DESC')->paginate(10);
        return view('admin_cpanel.topic.topic_index')->with(compact('list_topic'));
    }

    public function change_status($id) {

        $topic = Topic::find($id);
        if($topic->status == 0) {
            $topic->status = 1;
            $topic->save();
            return redirect('/admin/quan-ly/bai-viet')->with('status', 'Ẩn bài viết thành công!');
        }
        if($topic->status == 1) {
            $topic->status = 0;
            $topic->save();
            return redirect('/admin/quan-ly/bai-viet')->with('status', 'Hiện bài viết thành công!');
        }
        
    }

    public function management_topic_search() {

        $keywords = $_GET['keywords'];
        $topics = Topic::where('title', 'LIKE', '%'.$keywords.'%')->get();
        
        return view('admin_cpanel.topic.search_topic')->with(compact('keywords', 'topics'));
    }

}
