<?php
    
namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Center;
use App\Models\Renter;
use App\Models\Location;
use App\Models\Employee;
use App\Models\Payment_type;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

 
    
class RenterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
         
    }
 
    public function index(Request $request): View
    {
        
        $data = Renter::latest()->paginate(10);
     
        $current_user = User::find(Auth::user()->id) ; 
        return view('renters.index',compact('data','current_user'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }
     
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        
        $current_user = User::find(Auth::user()->id) ; 
       
        return view('renters.create',compact('current_user'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
         
         $img = ''; 
        if($request->has('file'))
        {
            $uploadedFile = $request->file('file');
            $storedName = Str::uuid()->toString() . '.' . $uploadedFile->getClientOriginalExtension();
            $img = $uploadedFile->storeAs('uploads', $storedName, 'public');
        }
         
        $this->validate($request, [
            'name' => 'required',
            'id_no' => 'required',
            'nationality' => 'required',
            'mobile_no' => 'required'
             
        ]);
    
        $input = $request->all();
        $input['img']= $img ; 
        $input['created_by']= Auth::user()->id ;  
      // dd($input) ; 
        $center =  Renter::create($input);
       
    
        return redirect()->route('renters.index')
                        ->with('success','     تم الاضافة  بنجاح');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): View
    {
        $renter = Renter::with('contracts.payments')->find($id);
       
        $contracts =  $renter->contracts ;
        $payments=array() ;
         
         foreach($contracts as $c)
         {
            $payments[]=$c->payments ; 
         }
         $current_user = User::find(Auth::user()->id) ; 
           $emps = Employee::all();
        $payment_types = Payment_type::all();
        return view('renters.show',compact('renter','contracts','payments','current_user','emps','payment_types'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): View
    {
        $renter = Renter::find($id);
        $current_user = User::find(Auth::user()->id) ; 
      
        return view('renters.edit',compact( 'renter','current_user'));
        
        
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
            'id_no' => 'required',
            'nationality' => 'required',
            'mobile_no' => 'required'
             
        ]);
    
        $input = $request->all();
        if($request->has('file'))
        {
            $uploadedFile = $request->file('file');
            $storedName = Str::uuid()->toString() . '.' . $uploadedFile->getClientOriginalExtension();
            $img = $uploadedFile->storeAs('uploads', $storedName, 'public');
            $input['img']= $img ; 
        }
       
        $input['updated_by']= Auth::user()->id ;  
      // dd($input) ; 
        $renter =  Renter::find($id);

       
        $renter->update($input);
       
    
        return redirect()->route('renters.index')
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
        Renter::find($id)->delete();
        return redirect()->route('renters.index')
                        ->with('success','تم الحذف بنجاح');
    }
}