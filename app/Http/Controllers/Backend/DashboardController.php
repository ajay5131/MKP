<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;


class DashboardController extends Controller
{

    /* 
    Display admin dashboard page
    */
    public function index()
    {
        // print_r("hello in dashboard");exit;

        $breadcrumbs = [
            'page_title' => 'MKP Admin',
            'breadcrumb' => '<li> <span>MKP Admin</span> </li>',
            'active_page' => 'Dashboard'
        ];
        return view('backend.dashboard.index')->with('breadcrumbs', $breadcrumbs);
    }  
}

