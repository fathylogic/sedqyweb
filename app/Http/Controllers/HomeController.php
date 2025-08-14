<?php

namespace App\Http\Controllers;
use app\models\User ;
use Illuminate\Http\Request;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Center;
use App\Models\Location;
use App\Models\Unit;

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
        
       $current_user = User::find(Auth::user()->id) ; 
       // dd($user) ; 
        $sql = "select * from users_permissions p inner join apps a on a.id = p.app_id where p.user_id = ".Auth::user()->id ; 
        $apps = DB::select($sql) ; 
        $centers = Center::with('location')->latest()->paginate(10);
       //  dd($apps) ; 
         return view('home', compact('current_user','centers'));
    }
}
