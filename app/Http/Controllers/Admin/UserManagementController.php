<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserManagementController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $user=User::all();
        return view('admin.user.index')->withUsers($user);
    }
    public function show($id)
    {
    	// dd($id);
        $user=User::find($id);
        return view('admin.user.show')->withUser($user);
    }


}
