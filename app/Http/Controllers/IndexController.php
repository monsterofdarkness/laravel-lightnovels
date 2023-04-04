<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\InCategory;
use App\Models\Novel;
use App\Models\Chapter;
use App\Models\User;
use App\Models\Rating;
use App\Models\Favorite;
use App\Models\Comment;
use App\Models\Topic;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class IndexController extends Controller
{
    public function home() {
        $category = Category::orderBy('id', 'DESC')->where('status', 0)->get();
        $novel = Novel::orderBy('created_at', 'DESC')->where('status', 0)->take(14)->get();
        $allNovel = Novel::orderBy('created_at', 'DESC')->where('status', 0)->get();
        $top8_novel = Novel::orderBy('novel_views', 'DESC')->where('status', 0)->take(8)->get();
        $completed_novel = Novel::orderBy('id', 'DESC')->where('status', 0)->where('state', 1)->take(6)->get();
        $most_favorite = Favorite::with('novel')->select('novel_id', Favorite::raw('count(*) as favorites'))->groupBy('novel_id')->orderBy('favorites', 'DESC')->take(10)->get();
        // $new_chapter = Chapter::with('novel')->where('status', 0)->groupBy('novel_id')->orderBy(Chapter::raw('MAX(created_at)'), 'DESC')->take(14)->get();
        $maybe_you_will_like = Novel::with('chapter')->where('status', 0)->inRandomOrder()->take(7)->get();
        $a = Chapter::with('novel')->where('status', 0)->orderBy('created_at', 'DESC')->get();
        $new_chapter = $a->unique('novel_id')->take(14);
        $list_topic = Topic::where('status', 0)->orderBy('created_at', 'DESC')->take(8)->get();
        // dd($b);
        
        return view('pages.home')->with(compact('category', 'novel', 'top8_novel', 'completed_novel', 'allNovel', 'most_favorite', 'new_chapter', 'maybe_you_will_like', 'list_topic'));
    }

    public function listnewnovel() {
        $category = Category::orderBy('id', 'DESC')->get();
        $new_novel = Novel::orderBy('created_at', 'DESC')->where('status', 0)->paginate(35);
        
        

        return view('pages.listall.list_all_new_novel')->with(compact('category', 'new_novel'));
    }

    public function listnewchapter() {
        $category = Category::orderBy('id', 'DESC')->where('status', 0)->get();
        // $a = Chapter::with('novel')->where('status', 0)->orderBy('created_at', 'DESC')->get();
        // $new_chapter = Chapter::with('novel')->where('status', 0)->groupBy('novel_id')->orderBy(Chapter::raw('MAX(created_at)'), 'DESC')->paginate(35);
        $a = Chapter::with('novel')->where('status', 0)->orderBy('created_at', 'DESC')->get();
        $new_chapter = $a->unique('novel_id');
        return view('pages.listall.list_all_new_chapter')->with(compact('category', 'new_chapter'));
    }

    public function listcompletednovel() {
        $category = Category::orderBy('id', 'DESC')->where('status', 0)->get();
        $list_completed_novel = Novel::orderBy('created_at', 'DESC')->where('status', 0)->where('state', 1)->paginate(35);
        
        

        return view('pages.listall.list_all_completed')->with(compact('category', 'list_completed_novel'));
    }


    public function category($slug) {
        $category = Category::orderBy('id', 'DESC')->where('status', 0)->get();
        $category_id = Category::where('slug_category', $slug)->first();

        // Nhiều Thể Loại
        $incategories = InCategory::where('category_id', $category_id->id)->get();
        $many_categories = [];
        foreach($incategories as $key => $nov) {
            $many_categories[] = $nov->novel_id;
        }
        

        $novel = Novel::orderBy('id', 'DESC')->where('status', 0)->whereIn('id', $many_categories)->get();

        
        
        return view('pages.category')->with(compact('category', 'novel', 'category_id', 'incategories', 'many_categories'));
    }

    public function novel($slug) {
        $category = Category::orderBy('id', 'DESC')->where('status', 0)->get();
        $novel = Novel::where('slug_novelname', $slug)->where('status', 0)->first();
        $novel->novel_views = $novel->novel_views + 1;
        if(Auth::check()) {
            $ratingUser = Rating::where('novel_id', $novel->id)->where('user_id', Auth::user()->id)->first();
            $favoritedUser = Favorite::where('novel_id', $novel->id)->where('user_id', Auth::user()->id)->first();
        } else {
            $ratingUser = 0;
            $favoritedUser = 0;
        }
        $rating = Rating::where('novel_id', $novel->id)->get();
        $ratingAvg = Rating::where('novel_id', $novel->id)->avg('rating_star');
        $favorite = Favorite::where('novel_id', $novel->id)->get();
        $novel->save();
        $chapter = Chapter::with('novel')->orderBy('id', 'ASC')->where('novel_id', $novel->id)->where('status', 0)->get();
        
        // Người đăng - Truyện đã đăng
        $user = User::with('novel')->where('id', $novel->user_id)->first();
        $novel_uploaded = Novel::where('user_id', $user->id)->where('status', 0)->whereNotIn('id', [$novel->id])->inRandomOrder()->take(4)->get();

        // Top truyện nổi bật
        $top4_novel = Novel::orderBy('novel_views', 'DESC')->where('status', 0)->take(4)->get();

        //Bình luận
        $comment = Comment::where(['novel_id' => $novel->id, 'comment_parent_id' => 0])->orderBy('created_at', 'DESC')->get();


        
        return view('pages.novel')->with(compact('category', 'novel', 'chapter', 'user', 'novel_uploaded', 'top4_novel', 'ratingUser', 'ratingAvg', 'rating', 'favoritedUser', 'favorite', 'comment'));
    }

    public function chapter($id, $slug) {
        $category = Category::orderBy('id', 'DESC')->where('status', 0)->get();
        $novel = Chapter::where('slug_chapter', $slug)->where('id', $id)->first();
        $chapter = Chapter::with('novel')->where('slug_chapter', $slug)->where('novel_id', $novel->novel_id)->first();

        $all_chapter = Chapter::with('novel')->orderBy('id', 'ASC')->where('novel_id', $novel->novel_id)->get();
        $next_chapter = Chapter::where('novel_id', $novel->novel_id)->where('id', '>', $chapter->id)->min('slug_chapter');
        $next_chapter_id = Chapter::where('novel_id', $novel->novel_id)->where('id', '>', $chapter->id)->min('id');

        

        $previous_chapter = Chapter::where('novel_id', $novel->novel_id)->where('id', '<', $chapter->id)->max('slug_chapter');
        $previous_chapter_id = Chapter::where('novel_id', $novel->novel_id)->where('id', '<', $chapter->id)->max('id');


        $max_id = Chapter::where('novel_id', $novel->novel_id)->orderBy('id', 'DESC')->first();
        $min_id = Chapter::where('novel_id', $novel->novel_id)->orderBy('id', 'ASC')->first();

        $next_chapter_slug = Chapter::where('novel_id', $novel->novel_id)->where('id', $next_chapter_id)->first();
        $previous_chapter_slug = Chapter::where('novel_id', $novel->novel_id)->where('id', $previous_chapter_id)->first();

        
        return view('pages.chapter')->with(compact('category','chapter', 'all_chapter', 'next_chapter', 'previous_chapter', 'max_id', 'min_id', 'next_chapter_id', 'previous_chapter_id', 'next_chapter_slug', 'previous_chapter_slug'));
    }

    public function author($author) {
        $category = Category::orderBy('id', 'DESC')->where('status', 0)->get();

        $novel_author = Novel::orderBy('created_at', 'DESC')->where('status', 0)->where('slug_author', $author)->paginate(35);
        $novel_author_name = Novel::orderBy('created_at', 'DESC')->where('status', 0)->where('slug_author', $author)->first();

        
        return view('pages.listall.author')->with(compact('category','novel_author', 'novel_author_name'));
    }

    public function search() {
        $category = Category::orderBy('id', 'DESC')->where('status', 0)->get();
        $keywords = $_GET['keywords'];
        $novel = Novel::where('status', 0)->where('novelname', 'LIKE', '%'.$keywords.'%')->orWhere('author', 'LIKE', '%'.$keywords.'%')->get();
        
        return view('pages.search')->with(compact('category','keywords', 'novel'));
    }

}
