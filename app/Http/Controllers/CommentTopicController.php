<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\InCategory;
use App\Models\Novel;
use App\Models\Chapter;
use App\Models\User;
use App\Models\Rating;
use App\Models\Favorite;
use App\Models\CommentTopic;
use Carbon\Carbon;

class CommentTopicController extends Controller
{
    public function comment_topic($topic_id, Request $request) {

        $data = $request->validate(
            [
                'content' => 'required',
            ],
            [
                'content.required' => 'Nội dung bình luận không được để trống!',
            ]
        );
        $comment_topic = new CommentTopic();
        $comment_topic->topic_id = $topic_id;
        $comment_topic->user_id = Auth::user()->id;
        $comment_topic->content = $request->content;
        $comment_topic->comment_parent_id = $request->comment_parent_id ? $request->comment_parent_id : 0;
        
        $comment_topic->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $comment_topic->updated_at = Carbon::now('Asia/Ho_Chi_Minh');

        $comment_topic->save();        
        return redirect()->back();
    }

    public function updatecomment_topic($cmt_id, Request $request) {

        $data = $request->validate(
            [
                'content' => 'required',
            ],
            [
                'content.required' => 'Nội dung bình luận không được để trống!',
            ]
        );
        $comment_topic = CommentTopic::find($cmt_id);
        $comment_topic->content = $request->content;
        
        $comment_topic->updated_at = Carbon::now('Asia/Ho_Chi_Minh');

        $comment_topic->save();        
        return redirect()->back();
    }

    public function deletecomment_topic($cmt_id)
    {
        $name = Auth::user()->name;
        $comment_topic = CommentTopic::find($cmt_id);
        $comment_topic->content = "Bình luận đã bị xóa bởi $name";
        $comment_topic->status = 1;
        $comment_topic->save();
        return redirect()->back();
    }
}
