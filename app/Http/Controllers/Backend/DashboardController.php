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

        $total_product = \App\Models\Product::count();
        $total_message = \App\Models\ContactUsMessage::count();
        $total_blogs = \App\Models\Blog::count();
        $total_page = \App\Models\Page::count();

        $latest_messages = \App\Models\ContactUsMessage::latest()->take(5)->get();
        $latest_products = \App\Models\Product::with(['product_translations', 'category'])->latest()->take(5)->get();

        return view('backend.modules.dashboard.index', [
            'total_product' => $total_product,
            'total_message' => $total_message,
            'total_blogs' => $total_blogs,
            'total_page' => $total_page,
            'latest_messages' => $latest_messages,
            'latest_products' => $latest_products
        ]);
    }
}
