<?php
    
namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Employee;
use App\Models\Center;
use App\Models\Ohda;
use App\Models\Location;
use App\Models\Unit;
use App\Models\All_file;
use App\Models\Payment_type;
use App\Models\Source_type;
use App\Models\Sarf_type;
use App\Models\Service_type;
use App\Models\Recipient;
use App\Models\Payroll;

use App\Models\Unit_type;
use App\Models\Contract;
use App\Models\Payment;
use App\Models\Renter;
use App\Models\Sarf;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Hash;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

 
    
class CenterController extends Controller
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
    public function index(Request $request): View
    {
        
        $data = Center::with('location')->latest()->paginate(10);
       // dd($data[0]->location->name) ; 
        $current_user = User::find(Auth::user()->id) ; 
        return view('centers.index',compact('data','current_user'))
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
        $locations = Location::get();
        return view('centers.create',compact( 'locations','current_user'));
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
        


            if ($request->has('file')) {
                $uploadedFile = $request->file('file');
                $storedName = Str::uuid()->toString() . '.' . $uploadedFile->getClientOriginalExtension();
                $img = $uploadedFile->storeAs('uploads', $storedName, 'public');
            }

            $this->validate($request, [
                'center_name' => 'required',
                'center_location' => 'required',
                'woter_no' => 'required',
                'electric_no' => 'required',
                'maincenter_id'   =>  'required'
            ]);

            $input = $request->all();
            $input['img'] = $img;
            $input['created_by'] = Auth::user()->id;
            // dd($input) ; 
            $center =  Center::create($input);
    
        return redirect()->route('centers.show',$center->maincenter_id)
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
        $center = Center::with('maincenter','location')->find($id);
         $current_user = User::find(Auth::user()->id) ; 


        if($request->has('btn_add_ohda'))
        {
            $this->validate($request, [
            'emp_id' => 'required',
            'purpose' => 'required',
            'center_id' => 'required',
            'maincenter_id' => 'required',
            'raseed' => 'required'

        ]);

        DB::transaction(function () use ($request) {
            $ohda = Ohda::create([
                'emp_id'  => $request->emp_id,
                'purpose' => $request->purpose,
                'raseed'  => $request->raseed,
                'maincenter_id'  => $request->maincenter_id,
                'center_id'  => $request->center_id,
            ]);

            
        });
        }


         $units =   Unit::with('center','unitType','renter')
         ->where('center_id',$id)
        ->orderby('id')
        ->latest()->paginate(10);


 $payments = Payment::with(['contract.renter', 'paymentType', 'employee'])
            ->wherehas('contract', fn($sql) => $sql->where('center_id', $id))
            ->where('status',1)
              ->orderByDesc('id')
            ->get();

          $sarfs = Sarf::with(['sarfType','serviceType', 'payrool.employee', 'recipient', 'paymentType', 'sourceType', 'fromOhda.employee', 'toOhda.employee'])
            ->where('center_id', $id)
            ->orderByDesc('id')
            ->get();

             $files = All_file::where('object_name','centers')
                ->where('object_id',$id)
                ->get() ; 

             $locations = Location::get();
              $types = Unit_type::get();
            $renters = Renter::get();

             $ohdas = Ohda::with(['employee','operatios'])
            ->where('center_id', $id)
            ->orderByDesc('id')
            ->get();
          //  dd( $ohdas->count()) ;

        $sourceTypes = Source_type::get();
        $sarfTypes = Sarf_type::get();
        $payment_types = Payment_type::get();
        $serviceTypes = Service_type::get();
        $recipients = Recipient::get();
       
        $payrolls = Payroll::with(['employee'])
            ->where('payment_status', 0)
            ->get();

           $emps = Employee::get();
        return view('centers.show',compact('payrolls','recipients','serviceTypes','payment_types','sarfTypes','sourceTypes','center','emps','ohdas','files','renters','types','locations','payments','sarfs','current_user','units'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): View
    {
        $center = Center::find($id);
        $current_user = User::find(Auth::user()->id) ; 
        $locations = Location::get();
        return view('centers.edit',compact( 'center','locations','current_user'));
        
        
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
            'center_name' => 'required',
            'center_location' => 'required',
            'woter_no' => 'required',
            'electric_no' => 'required'
             
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
        $center =  Center::find($id);

       
        $center->update($input);
       
    
        return redirect()->route('centers.show',$id)
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
       
       $main_center_id = Center::find($id)->maincenter_id ; 
        Center::find($id)->delete();
        return redirect()->route('maincenters.show',$main_center_id)
                        ->with('success','تم الحذف بنجاح');
    }
}