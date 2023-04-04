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

class ReportController extends Controller
{
    public function report(Request $request) {
        $data = $request->validate(
            [
                'reason' => 'required',
            ],
            [
                'reason.required' => 'Báo cáo phải có lý do!',
            ]
        );
        $report = new Report();
        $report->novel_id = $request->novel_id;
        $report->user_id = Auth::user()->id;
        $report->reason = $data['reason'];
        
        $report->created_at = Carbon::now('Asia/Ho_Chi_Minh');

        $report->save();        
        return redirect()->back()->with('status', 'Đã báo cáo truyện thành công!');
    }

    public function management_report_index() {
        $list_report = Report::with('user', 'novel')->where('approved_at', NULL)->orderBy('created_at', 'DESC')->paginate(40);
        return view('admin_cpanel.report.report_index')->with(compact('list_report'));
    }

    public function management_report_keep($report_id, Request $request) {
        $report = Report::find($report_id);
        $report->approved_at = Carbon::now('Asia/Ho_Chi_Minh');
        $report->save();        
        return redirect()->back()->with('status', 'Quyết định giữ truyện!');
    }

    public function management_report_hide($report_id, Request $request) {
        $novel = Novel::find($request->novel_id);
        $novel->status = 1;
        $novel->save();
        
        $report = Report::find($report_id);
        $report->approved_at = Carbon::now('Asia/Ho_Chi_Minh');
        $report->save();        
        return redirect()->back()->with('status', 'Quyết định ẩn truyện!');
    }

    public function management_report_search() {

        $keywords = $_GET['keywords'];
        $keywords_convert = '';
        if($keywords == "spam" || $keywords == "Spam") {
            $keywords_convert = 1;
        } elseif ($keywords == "lỗi font" || $keywords == "Lỗi font") {
            $keywords_convert = 2;
        } elseif ($keywords == "sai nội dung" || $keywords == "Sai nội dung") {
            $keywords_convert = 3;
        } elseif ($keywords == "nội dung không phù hợp" || $keywords == "Nội dung không phù hợp") {
            $keywords_convert = 4;
        }
        $reports = Report::where('reason', 'LIKE', '%'.$keywords_convert.'%')->get();
        
        return view('admin_cpanel.report.search_report')->with(compact('keywords', 'reports'));
    }
}
