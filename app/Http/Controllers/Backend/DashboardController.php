<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Will redirect admin dashboard
     */
    public function adminDashboard(): View
    {
        $total_blogs = \App\Models\Blog::count();
        $total_page = \App\Models\Page::count();
        return view('backend.modules.dashboard.index', [
            'total_blogs' => $total_blogs,
            'total_page' => $total_page,
        ]);
    }
}
