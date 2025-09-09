<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin.auth');
    }
    public function index(){
        $user=User::latest()->count();
        return view('admin.index',compact('user'));
    }
}
