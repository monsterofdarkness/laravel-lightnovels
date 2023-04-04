<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\InCategory;
use App\Models\Novel;
use App\Models\Report;
use App\Models\Chapter;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $novel = Novel::get()->count();
        $novel_views = Novel::sum('novel_views');
        $chapter = Chapter::get()->count();
        $report = Report::get()->count();
        return view('admin_cpanel.dashboard.dashboard_index')->with(compact('novel', 'report', 'novel_views', 'chapter'));
    }
}
