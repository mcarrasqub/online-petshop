<?php
 
namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
 
class HomeController extends Controller
{
    public function index(): View|RedirectResponse 
    {

        if (Auth::user()?->is_admin) {

        return redirect()->route('admin.home.index');

        }
        return view('home.index');
    }

}