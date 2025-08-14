<?php
    
namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
 
    
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): View
    {
        
        $data = User::latest()->paginate(5);
        $current_user = User::find(Auth::user()->id) ; 
        return view('users.index',compact('data','current_user'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    public function salahyat($id)
    {
       // dd($id) ; 
        
        $user = User::find($id);
        $current_user = User::find(Auth::user()->id) ; 
        return view('users.permissions',compact('user','current_user'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $roles = Role::pluck('name','name')->all();
        $current_user = User::find(Auth::user()->id) ; 
        return view('users.create',compact('roles','current_user'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        //dd( $request->all()) ; 
        
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'mobile_no' => 'required' 
        ]);
    
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
       
        $user = User::create($input);
       
    
        return redirect()->route('users.index')
                        ->with('success','     تم اضافة المستخدم بنجاح');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): View
    {
        $user = User::find($id);
         $current_user = User::find(Auth::user()->id) ; 
        return view('users.show',compact('user','current_user'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): View
    {
        $user = User::find($id);
      
        $current_user = User::find(Auth::user()->id) ; 
        return view('users.edit',compact('user','current_user'));
    }
    
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id): RedirectResponse
    {
        
       
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
          
            'mobile_no' => 'required' 
        ]);
    
        $input = $request->all();
        if(!isset($input['is_admin']))
            $input['is_admin'] = 0 ; 
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }
    
         
        $user = User::find($id);
        $user->update($input);
       
    
        return redirect()->route('users.index')
                        ->with('success','تم التعديل بنجاح');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): RedirectResponse
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success','تم الحذف بنجاح');
    }
}