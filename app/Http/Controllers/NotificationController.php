<?php
    
namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Note;
use App\Models\Notes_file;
use App\Models\Location;
use App\Models\Unit;
use App\Models\Notification;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

 
    
class NotificationController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
         
    }
 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) 
    {
        $data = Notification::where ('user_id',Auth::user()->id)
        ->latest()->paginate(10);
        
        $current_user = User::find(Auth::user()->id) ; 
        return view('notifications.index',compact('data','current_user'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }
     
    public function show($id)
    {
        $current_user = User::find(Auth::user()->id) ; 
        $note = Notification::find($id);
        $note->status = 1 ; 
        $note->save() ; 

         return redirect()->route($note->url , $note->element_id)  ;
    }
    
    
   
}