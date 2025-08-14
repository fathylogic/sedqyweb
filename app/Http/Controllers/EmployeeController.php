<?php
    
namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Center;
use App\Models\Employee;
use App\Models\Payroll;
use App\Models\Sarf;
use App\Models\Vacation;
use App\Models\Notification;
use App\Models\Location;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

 
    
class EmployeeController extends Controller
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
 
    public function check_vac_dates($start_date, $end_date , $emp_id)
    {
      
        $sql = "SELECT count(*) c FROM `vacations` WHERE 
                    start_date BETWEEN '" . $start_date . "' and '" . $end_date . "' 
                   or end_date BETWEEN '" . $start_date . "' and '" . $end_date . "' 
                   and emp_id = ".$emp_id
                   ;
        $res = DB::select($sql)[0];
        if ($res->c > 0)
            return false;
        else
            return true;
    }
    public function index(Request $request): View
    {
        
        $data = Employee::latest()->paginate(10);
     
        $current_user = User::find(Auth::user()->id) ; 
        return view('employees.index',compact('data','current_user'))
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
         $centers = Center::get();
        return view('employees.create',compact('current_user','centers'));
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
            'iban' => 'required',
            'job' => 'required',
            'salary' => 'required',
            'mobile_no' => 'required'
             
        ]);
    
        $input = $request->all();
        $input['img']= $img ; 
        $input['created_by']= Auth::user()->id ;  
      // dd($input) ; 
        $employee =  Employee::create($input);
       
    
        return redirect()->route('employees.index')
                        ->with('success','     تم الاضافة  بنجاح');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
       
    
        if ($request->has('btn_add_vacation')) {


            $this->validate($request, [
                'start_date' => 'required',
                'end_date' => 'required',
                'start_dateh' => 'required',
                'end_dateh' => 'required',
                'emp_id' => 'required' 
            ]);

            $input = $request->all();

            $input['created_by'] = Auth::user()->id;
            $input['no_of_days'] = abs( dateDiff($request->start_date,$request->end_date));

           // dd($input) ; 

            if ($this->check_vac_dates($request->start_date, $request->end_date, $request->emp_id)) {
                if ($vaction =  Vacation::create($input)) {

                    // add Notification
                    $toUsers = User::get()->where('is_admin', 1);
                    foreach ($toUsers as $user) {
                        $n_date['user_id'] = $user->id;
                        $n_date['message'] = "تم تسجيل أجازة للموظف " .$vaction->employee->name;
                        $n_date['url'] = "employees.show" ;
                        $n_date['element_id'] = $request->emp_id ;
                        Notification::create($n_date);
                    }
                }
            } else {
                return redirect()->back()->with('danger', 'يوجد تعارض في تاريخ  الاجازة مع اجازة  أخرى');
            }
        }
       
       
        $employee = Employee::with('vacations')->find($id);
        $current_user = User::find(Auth::user()->id) ; 
        return view('employees.show',compact('employee','current_user'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): View
    {
        $employee = Employee::find($id);
        $current_user = User::find(Auth::user()->id) ; 
         $centers = Center::get();
      
        return view('employees.edit',compact( 'employee','current_user','centers'));
        
        
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
            'iban' => 'required',
            'job' => 'required',
            'salary' => 'required',
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
        $employee =  Employee::find($id);

       
        $employee->update($input);
       
    
        return redirect()->route('employees.index')
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
        Employee::find($id)->delete();
        return redirect()->route('employees.index')
                        ->with('success','تم الحذف بنجاح');
    }
}