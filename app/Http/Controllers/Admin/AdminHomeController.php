<?php

//edited by Sofia Gallo

namespace App\Http\Controllers\Admin;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;

class AdminHomeController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = 'Admin Page - Admin - Online Store';

        return view('admin.home.index')->with('viewData', $viewData);
    }
}
