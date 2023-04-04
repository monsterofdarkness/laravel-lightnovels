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
use App\Models\Comment;
use App\Models\Report;
use Carbon\Carbon;

class UserController extends Controller
{
    public function logIn(Request $request)
    {
        // dd($request);
        $data = $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required|min:6',
            ],
            [
                'email.required' => 'Bạn chưa nhập email!',
                'email.email' => 'Phải nhập đúng định dạng email!',
                'email.exists' => 'Email chưa được đăng ký!',
                'password.required' => 'Bạn chưa nhập mật khẩu!',
                'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự!',
            ]
        );
        if (Auth::attempt(['email' => $request->email, 'password' =>
        $request->password], $request->remember)) {
            if(auth()->user()->role == 1){
                return redirect()->route('homeAdmin');
            }
            return redirect()->route('home');
        } else {
            return redirect()->back()->withErrors(['msg' => 'Sai mật khẩu hoặc tài khoản chưa được đăng ký!']);
        }
    }

    // public function signUp(Request $request)  {
    //     $checkEmail = User::where('email', $request->email);
    //     if(empty($checkEmail)) {
    //         $account = new User(); 
    //         $account->name = $request->name;
    //         $account->email = $request->email;
    //         if(empty($request->avatar)) {
    //             $account->avatar = 'avatar.jpg';
    //         } else {
    //             $file->storeAs('uploads/user', $request->avatar);
    //             $account->avatar = $request->avatar;
    //         }
    //         $account->password = $request->password;
    //         $account->save();

    //         if (Auth::attempt(['email' => $request->email, 'password' =>
    //         $request->password])) {
    //             return redirect()->route('home');
    //         } else {
    //             echo ("fail");
    //         }
    //     }
    // }

    public function ViewsignUp(Request $request)  {
        return view('auth.sign-up');
    }

    public function logOut()
    {
       $user= Auth::logout();
       return redirect()->route('home');
    }

    public function viewLogin() {
        return view('auth.log-in');
    }

    public function member_wall($id) {
        $member = User::where('id', $id)->first();
        $category = Category::orderBy('id', 'DESC')->where('status', 0)->get();
        $novel_uploaded = Novel::where('user_id', $id)->orderBy('created_at', 'DESC')->get();

        
        return view('pages.member.wall')->with(compact('member', 'category', 'novel_uploaded'));
    }


    public function update(Request $request, $id) {

        $data = $request->validate(
            [
                'name' => 'required|max:255',
                'birthday' => 'max:255',
                'favorite' => 'max:255',
                'about' => 'max:255',
                'cover' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:width=1110, height=300',
            ],
            [
                'name.required' => 'Phải có tên thành viên truyện!',
                'cover.image' => 'Phải là file ảnh!',
                'cover.dimensions' => 'Ảnh bìa phải có kích thước là 1110 x 300!',
            ]
        );

        $member = User::find($id);
        $member->name = $data['name'];
        $member->birthday = $data['birthday'];
        $member->favorite = $data['favorite'];
        $member->about = $data['about'];


        $get_image = $request->avatar;
        if($get_image) {
            $path = 'uploads/user/'.$member->avatar;
            if(file_exists($path)) {
                if($path != 'uploads/user/default.png') {
                    unlink($path);
                }
            }
            $path = 'uploads/user/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.'-'.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);
            $member->avatar = $new_image;
        }

        $get_cover = $request->cover;
        if($get_cover) {
            $path = 'uploads/user/'.$member->cover;
            if(file_exists($path)) {
                if($path != 'uploads/user/cover-default.jpg') {
                    unlink($path);
                }
            }
            $path = 'uploads/user/';
            $get_name_cover = $get_cover->getClientOriginalName();
            $name_cover = current(explode('.',$get_name_cover));
            $new_cover = $name_cover.'-'.rand(0,99).'.'.$get_cover->getClientOriginalExtension();
            $get_cover->move($path, $new_cover);
            $member->cover = $new_cover;
        }



        $member->save();
        return redirect()->back()->with('status', 'Cập nhật thông tin thành công!');
    }


    public function index()
    {
        $user = User::orderBy('id', 'DESC')->paginate(10);
        return view('admin_cpanel.user.member_index')->with(compact('user'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('admin_cpanel.user.member_edit')->with(compact('user'));
    }

    public function admin_update(Request $request, $id) {
        $data = $request->validate(
            [
                'role' => 'required',
            ],
        );

        $member = User::find($id);
        $member->role = $data['role'];

        $member->save();
        return redirect()->route('member_index')->with('status', 'Cập nhật thành viên thành công!');
    }

    public function destroy($id)
    {
        $user = User::find($id)->destroy();
        return redirect()->back()->with('status', 'Xóa thành viên thành công!');
    }

    public function rating(Request $request)
    {
        $model = Rating::where($request->only('novel_id', 'user_id'))->first();
        if($model) {    
            Rating::where($request->only('novel_id', 'user_id'))
            ->update($request->only('rating_star'));
        } else {
            Rating::create($request->only('novel_id', 'user_id', 'rating_star'));

        }
        return redirect()->back()->with('status', 'Đánh giá truyện thành công!');
    }

    public function favorite(Request $request)
    {
        $model = Favorite::where($request->only('novel_id', 'user_id'))->first();
        if($model) {    
            Favorite::where($request->only('novel_id', 'user_id'))->delete();
            return redirect()->back()->with('status', 'Đã xóa truyện ra khỏi danh sách yêu thích!');
        } else {
            Favorite::create($request->only('novel_id', 'user_id'));
        }
        return redirect()->back()->with('status', 'Đã thêm vào danh sách yêu thích!');
    }


    public function remove_favorite_list($favoriteID)
    {
        Favorite::find($favoriteID)->delete();
        return redirect()->back()->with('status', 'Đã xóa truyện ra khỏi danh sách yêu thích!');
    }



    public function favorite_page() {
        $category = Category::orderBy('id', 'DESC')->where('status', 0)->get();
        $listFavorite = Favorite::where('user_id', Auth::user()->id)->paginate(10);
        
        return view('pages.member.favorite')->with(compact('category', 'listFavorite'));
    }


    public function comment($novel_id, Request $request) {

        $data = $request->validate(
            [
                'content' => 'required',
            ],
            [
                'content.required' => 'Nội dung bình luận không được để trống!',
            ]
        );
        $comment = new Comment();
        $comment->novel_id = $novel_id;
        $comment->user_id = Auth::user()->id;
        $comment->content = $request->content;
        $comment->comment_parent_id = $request->comment_parent_id ? $request->comment_parent_id : 0;
        
        $comment->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $comment->updated_at = Carbon::now('Asia/Ho_Chi_Minh');

        $comment->save();        
        return redirect()->back();
    }

    public function updatecomment($cmt_id, Request $request) {

        $data = $request->validate(
            [
                'content' => 'required',
            ],
            [
                'content.required' => 'Nội dung bình luận không được để trống!',
            ]
        );
        $comment = Comment::find($cmt_id);
        $comment->content = $request->content;
        
        $comment->updated_at = Carbon::now('Asia/Ho_Chi_Minh');

        $comment->save();        
        return redirect()->back();
    }

    public function deletecomment($cmt_id)
    {
        $name = Auth::user()->name;
        $comment = Comment::find($cmt_id);
        $comment->content = "Bình luận đã bị xóa bởi $name";
        $comment->status = 1;
        $comment->save();
        return redirect()->back();
    }

    public function change_role($id) {

        $user = User::find($id);
        if($user->role == 0) {
            $user->role = 1;
            $user->save();
            return redirect('/admin/quan-ly/thanh-vien')->with('status', 'Đổi chức vụ thành công!');
        }
        if($user->role == 1) {
            $user->role = 0;
            $user->save();
            return redirect('/admin/quan-ly/thanh-vien')->with('status', 'Đổi chức vụ thành công!');
        }
    }

    public function search() {

        $keywords = $_GET['keywords'];
        $member = User::where('name', 'LIKE', '%'.$keywords.'%')->get();
        
        return view('admin_cpanel.user.search_member')->with(compact('keywords', 'member'));
    }

    public function change_member_status($id) {

        $user = User::find($id);
        if($user->status == 0) {
            $user->status = 1;
            $user->save();
            return redirect('/admin/quan-ly/thanh-vien')->with('status', 'Đổi trạng thái thành công!');
        }
        if($user->status == 1) {
            $user->status = 0;
            $user->save();
            return redirect('/admin/quan-ly/thanh-vien')->with('status', 'Đổi trạng thái thành công!');
        }
        
    }

    

}
