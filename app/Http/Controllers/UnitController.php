<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Center;
use App\Models\Renter;
use App\Models\Employee;
use App\Models\Payment_type;
use App\Models\Unit;
use App\Models\Unit_type;
use App\Models\All_file;
use App\Models\Contract;
use App\Models\Payment;
use App\Models\Sarf;
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
use Alkoumi\LaravelHijriDate\Hijri;
use Illuminate\Support\Carbon;
use App\Models\Notification;
// use Alkoumi\LaravelArabicTafqeet\Tafqeet;
use AliAbdalla\Tafqeet\Core\Tafqeet;
use Illuminate\Contracts\Database\Eloquent\Builder;







class UnitController extends Controller
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
        $amount = 7587;
        $arablic = Tafqeet::arablic($amount);

        $data = Unit::with('center', 'unitType', 'renter')
            ->orderby('center_id')
            ->latest()->paginate(10);

        $current_user = User::find(Auth::user()->id);
        return view('units.index', compact('data', 'current_user'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {

        $current_user = User::find(Auth::user()->id);
        $centers = Center::get();
        $types = Unit_type::get();
        $renters = Renter::get();
        return view('units.create', compact('current_user', 'centers', 'types', 'renters'));
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
            'unit_description' => 'required',
            'unit_type' => 'required',
            'center_id' => 'required',
            'maincenter_id' => 'required',
            'electric_no' => 'required'
        ]);

        $input = $request->all();
        $input['img'] = $img;
        $input['created_by'] = Auth::user()->id;
        // dd($input) ; 
        $unit =  Unit::create($input);


        return redirect()->route('centers.show' ,$unit->center_id )
            ->with('success', '     تم الاضافة  بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function check_contract_dates($start_date, $end_date , $unit_id)
    {
      
        $sql = "SELECT count(*) c FROM `contracts` WHERE 
         unit_id = ".$unit_id . " and 
                    (start_date BETWEEN '" . $start_date . "' and '" . $end_date . "' 
                   or end_date BETWEEN '" . $start_date . "' and '" . $end_date . "' )     "     ;
        $res = DB::select($sql)[0];
        if ($res->c > 0)
            return false;
        else
            return true;
    }

    public function show($id, Request $request)
    {
        // Request $request

          
        if ($request->has('btn_savePayment')) {

           

            $payment = Payment::find($request->payment_id) ;
            if($request->amount>0) 
            {
                $payment->amount_txt =    Tafqeet::arablic($request->amount);
                $payment->status =   1;
              //  dd(substr($request->actual_date,0,4)) ;
                $payment->year_m = substr($request->actual_date,2,2);

                $payment->year_h = substr($request->actual_dateh,2,2);
                 $sql = "SELECT nvl(max(sereal),0)+1 as sereal from payments where year_m = '".$payment->year_m."'" ; 
                
                $res = DB::select($sql)[0];
                $payment->sereal = $res->sereal;
                 $payment->notes =  $request->notes;
                 $payment->emp_id = $request->emp_id;
                 $payment->payment_type = $request->payment_type;
                 $payment->actual_dateh = $request->actual_dateh;
                 $payment->actual_date = $request->actual_date;
                 $payment->updated_by = Auth::user()->id;
                 $payment->updated_at =  Carbon::now();


                 $payment->payment_type = $request->payment_type;
                  
                 if($payment->save())
                    {
                          // add Notification
                    $toUsers = User::get()->where('is_admin', 1);
                    foreach ($toUsers as $user) {
                        $n_date['user_id'] = $user->id;
                        $n_date['message'] = "تم استلام مبلغ نقدي";
                        $n_date['url'] = "payments.show" ;
                        $n_date['element_id'] = $payment->id ;
                        Notification::create($n_date);
                    }
                    } 



            }

        }

        if ($request->has('btn_add_contract')) {

            $this->validate($request, [
                'start_date' => 'required',
                'end_date' => 'required',
                'start_dateh' => 'required',
                'end_dateh' => 'required',
                'no_of_payments' => 'required',
                'year_amount' => 'required',
                'renter_id' => 'required',
                'unit_id' => 'required',
                'maincenter_id' => 'required',
                'center_id' => 'required'
            ]);

            $input = $request->all();

            $input['created_by'] = Auth::user()->id;


            if ($this->check_contract_dates($request->start_date, $request->end_date, $request->unit_id)) {
                if ($contract =  Contract::create($input)) {

                    // add Notification
                    $toUsers = User::get()->where('is_admin', 1);
                    foreach ($toUsers as $user) {
                        $n_date['user_id'] = $user->id;
                        $n_date['message'] = "تم تحرير عقد جديد ";
                        $n_date['url'] = "contracts.show" ;
                        $n_date['element_id'] = $contract->id ;
                        Notification::create($n_date);
                    }


                    // SELECT DATEDIFF('2025/08/31', '2024/08/30');

                    $start_date = $request->start_date;
                    $end_date = $request->end_date;

                    $date1 = date_create($start_date);
                    $date2 = date_create($end_date);

                    $no_of_all_days = date_diff($date1, $date2)->format('%a');
                    $no_of_section_days = (int) floor($no_of_all_days / $request->no_of_payments);
                    $payment_data['contract_id'] = $contract->id;
                    $payment_data['status'] = 0;
                     $payment_data['maincenter_id'] = $request->maincenter_id;
                     $payment_data['center_id'] = $request->center_id;
                     $payment_data['unit_id'] = $request->unit_id;
                    $payment_data['created_by'] = Auth::user()->id;
                    $payment_data['p_date'] = $start_date;
                    $payment_data['p_dateh'] =  Hijri::ShortDate($start_date);
                    if ($request->insurance_amount > 0) {
                        $payment_data['amount'] = $request->insurance_amount;
                        $payment_data['payment_no'] = 0;
                        $payment_data['notes'] = 'مبلغ التأمين';
                        Payment::create($payment_data);
                    }
                    if ($request->services_amount > 0) {
                        $payment_data['amount'] = $request->services_amount;
                        $payment_data['payment_no'] = 0;
                        $payment_data['notes'] = ' الخدمات  ';
                        Payment::create($payment_data);
                    }

                    $payment_data['notes'] = '';
                    $payment_data['amount'] = $request->year_amount / $request->no_of_payments;
                    for ($i = 0; $i < $request->no_of_payments; $i++) {
                        $payment_data['payment_no'] = $i + 1;
                        Payment::create($payment_data);
                        $payment_data['p_date'] = new Carbon($payment_data['p_date'])->addDays($no_of_section_days)->format('Y/m/d');
                        $payment_data['p_dateh'] =  Hijri::ShortDate($payment_data['p_date']);
                    }
                }
            } else {
                return redirect()->back()->with('danger', 'يوجد تعارض في تاريخ العقد مع عقد أخر');
            }
        }

        $unit = Unit::with('center', 'unitType', 'renter', 'contracts')->find($id);
        $contracts = Contract::with('renter')->get()->where('unit_id', $unit->id);

        // $payments = Payment::with(['contract' => function (Builder $query )use($unit->id) {
        // $query->where('unit_id','=', $unit->id);
        //     }])->get();

        $payments = Payment::with(['contract.renter', 'paymentType', 'employee'])
            ->wherehas('contract', fn($sql) => $sql->where('unit_id', $unit->id))
            ->get();

          $sarfs = Sarf::with(['sarfType','serviceType', 'payrool.employee', 'recipient', 'paymentType', 'sourceType', 'fromOhda.employee', 'toOhda.employee'])
            ->where('unit_id',$unit->id)
            ->orderByDesc('id')
            ->get();

       

        $renters = Renter::all();
        $emps = Employee::all();
        $payment_types = Payment_type::all();

          $types = Unit_type::get();
        $renters = Renter::get();
 $files = All_file::where('object_name','units')
                ->where('object_id',$id)
                ->get() ; 

        $current_user = User::find(Auth::user()->id);
        return view('units.show', compact('unit','files','sarfs','types','renters', 'emps','payment_types', 'current_user', 'renters', 'contracts', 'payments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): View
    {
        $unit = Unit::find($id);
        $current_user = User::find(Auth::user()->id);
        $centers = Center::get();
        $types = Unit_type::get();
        $renters = Renter::get();

        return view('units.edit', compact('unit', 'current_user', 'centers', 'types', 'renters'));
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
            'unit_description' => 'required',
            'unit_type' => 'required',
            'center_id' => 'required',
            'maincenter_id' => 'required',
            'electric_no' => 'required'
        ]);

        $input = $request->all();
        if ($request->has('file')) {
            $uploadedFile = $request->file('file');
            $storedName = Str::uuid()->toString() . '.' . $uploadedFile->getClientOriginalExtension();
            $img = $uploadedFile->storeAs('uploads', $storedName, 'public');
            $input['img'] = $img;
        }

        $input['updated_by'] = Auth::user()->id;
     
        $unit =  Unit::find($id);


        $unit->update($input);


        return redirect()->route('units.show',$id)
            ->with('success', 'تم التعديل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): RedirectResponse
    {
        Unit::find($id)->delete();
        return redirect()->route('units.index')
            ->with('success', 'تم الحذف بنجاح');
    }
}
