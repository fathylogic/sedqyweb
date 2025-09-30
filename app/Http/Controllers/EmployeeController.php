<?php
    
namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Center;
use App\Models\Maincenter;
use App\Models\Emp_type;
use App\Models\Emp_status;
use App\Models\Emp_period;
use App\Models\Payroll;
use App\Models\Employee;
use App\Models\Payment_type;
 use AliAbdalla\Tafqeet\Core\Tafqeet;
use App\Models\Sarf;
use App\Models\Vacation;
use App\Models\Notification;
use App\Models\Location;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Hash;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use DateTime;

 
    
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

      public function get_vac ($start_date, $end_date , $emp_id)
    {
      
        $sql = "SELECT * FROM `vacations` WHERE 
                   ( start_date BETWEEN '" . $start_date . "' and '" . $end_date . "' 
                   or end_date BETWEEN '" . $start_date . "' and '" . $end_date . "' )
                   and emp_id = ".$emp_id
                   ;
        $res = DB::select($sql);
        
        return $res ; 
    }  

 public   function days_in_month($month, $year)

{

// calculate number of days in a month

return $month == 2 ? ($year % 4 ? 28 : ($year % 100 ? 29 : ($year % 400 ? 28 : 29))) : (($month - 1) % 7 % 2 ? 30 : 31);

}
    public function check_payrol($year, $month , $emp_id)
    {
         
      $salary_year_month = $year."/".$month ; 
        $sql = "SELECT count(*) c FROM `payrolls` WHERE 
                    salary_year_month = '" . $salary_year_month . "' 
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
        
        $data = Employee::with('maincenter','center','employeeType','employeeStatus')->latest()->paginate(10);
     
        $current_user = User::find(Auth::user()->id) ; 
        return view('employees.index',compact('data','current_user'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }
     
    

 public function get_centers($id)
    {
       
        $centers =   Center::
            where('maincenter_id', $id)
            ->orderby('id')
            ->get();

        $op = '<option value="">اختر </option>';
        foreach ($centers as $center) {
            $op .= '<option value="' . $center->id . '"> ' . $center->center_name . '   </option>';
        }
        return $op;
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
         $maincenters = Maincenter::get();
         $empTypes = Emp_type::get();
         $empStatus = Emp_status::get();

        return view('employees.create',compact('current_user','maincenters','centers','empTypes','empStatus'));
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
        
        if($employee->emp_type != 1 && $request->start_date!='')
        {
            $data = [
                    'start_date'=>$request->start_date
                    ,'end_date'=>$request->end_date
                    ,'end_dateh'=>$request->end_dateh
                    ,'start_dateh'=>$request->start_dateh
                    ,'notes'=>$request->notes
                    ,'emp_id'=>$employee->id
                    ,'created_by'=>Auth::user()->id
                    
                    ];
                    $emp_period = Emp_period::create($data) ; 
        }
       
    
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
                    $toUsers = User::where('is_admin', 1)->get();
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
       
      
         $payment_types = Payment_type::all();

        $employee = Employee::with('center.ohdas','maincenter','vacations','payrolls.sarf')->find($id);
         $ohdas = $employee->center->ohdas ;  
        $current_user = User::find(Auth::user()->id) ; 
        return view('employees.show',compact( 'ohdas',  'payment_types','employee','current_user'));
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
    function countLeaveDaysInMonth($leaveStart, $leaveEnd, $month, $year)
{
    // تحويل التواريخ إلى كائنات DateTime
    $leaveStart = new DateTime($leaveStart);
    $leaveEnd   = new DateTime($leaveEnd);

    // بداية ونهاية الشهر المطلوب
    $monthStart = new DateTime("$year-$month-01");
    $monthEnd   = (clone $monthStart)->modify('last day of this month');

    // نحسب التقاطع بين الفترتين
    $periodStart = $leaveStart > $monthStart ? $leaveStart : $monthStart;
    $periodEnd   = $leaveEnd < $monthEnd ? $leaveEnd : $monthEnd;

    if ($periodStart > $periodEnd) {
        return 0; // لا يوجد تقاطع
    }

    // عدد الأيام (مع حساب اليوم الأخير)
    return $periodStart->diff($periodEnd)->days + 1;
}
     public function addPayroll($id,Request $request)  
    {
        $employee = Employee::with('maincenter','center.ohdas','employeeType','vacations')->find($id);
        $current_user = User::find(Auth::user()->id) ; 
        $ohdas = $employee->center->ohdas ;  
        
        if($request->has('btn_save_payroll'))
        {
           // dd($request->all()) ; 
           /*
           "id" => "1"
            "salary_year_month" => "2025/09"
            "deductions" => "0"
            "salary" => "2000"
            "other_d" => "0"
            "other_purpose" => null
            "other_allowance" => "0"
            "other_allowance_purpose" => null
            "net_salary" => "2000"
            */
           $deductions = $request->deductions + $request->other_d ; 
           $input = [
            'emp_id'=>$request->id
            ,'salary_year_month'=>$request->salary_year_month
            ,'basic_salary'=>$request->salary
            ,'other_allowance'=>$request->other_allowance
            ,'other_allowance_purpose'=>$request->other_allowance_purpose
            ,'deductions_purpose'=>$request->deductions_purpose
            ,'net_salary'=>$request->net_salary
            ,'net_salary_txt'=> Tafqeet::arablic($request->net_salary)
            ,'deductions'=>$deductions
            ,'created_by'=>Auth::user()->id
            
            ] ; 

             $input['created_by']= Auth::user()->id ;  
      // dd($input) ; 
        $payroll =  Payroll::create($input);
           // dd($payroll) ;
           // go to show ثم الاستعداد لسند الصرف
            return redirect()->route('employees.show',$id)
                        ->with('success','تم تسجيل الراتب بنجاح ');
            
        }


         if($this->check_payrol($request->year , $request->month,$id))
         {
            
            $days_in_month = $this->days_in_month($request->month ,$request->year ) ; 
            $salary_year_month = $request->year."/".$request->month ; 

           //  هل يوجد اجازة 
           $date1 = '01/'.$request->month.'/'.$request->year ;  
           $date2 =  $days_in_month.'/'.$request->month.'/'.$request->year ;  
           
           $vac = $this->get_vac ($date1, $date2 , $id) ; 
            
           if(!empty($vac))
           {
                $vacation = $vac[0] ; 
                $no_of_leave_dayes = $this->countLeaveDaysInMonth($vacation->start_date, $vacation->end_date, $request->month, $request->year);
                 
           }
           else
           {
                 $no_of_leave_dayes = 0  ; 
           }

           $mony_day = $employee->salary/$days_in_month ; 
           $deductions = abs($mony_day*$no_of_leave_dayes) ; 
           if($deductions>0)
            $deductions_purpose = 'ايام الاجازة ' ; 
        else
            $deductions_purpose = '' ; 


          
         return view('employees.addPayroll',compact( 'employee','ohdas','current_user','deductions_purpose','deductions','no_of_leave_dayes','salary_year_month' ));
         }else
         {
            return redirect()->back()->with('danger', 'هذا الشهر مسجل من قبل');
         }
        
       
        
        
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