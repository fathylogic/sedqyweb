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
use App\Models\Contract;
use App\Models\Payment;
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
use Alkoumi\LaravelHijriDate\Hijri;
use Illuminate\Support\Carbon;
use App\Models\Notification;
use App\Models\Source_type;
use App\Models\Sarf_type;
use App\Models\Service_type;
use App\Models\Recipient;
use App\Models\Ohda;
use App\Models\Ohdas_operation;
use App\Models\Payroll;
use App\Models\Sarf;
// use Alkoumi\LaravelArabicTafqeet\Tafqeet;
use AliAbdalla\Tafqeet\Core\Tafqeet;
use Illuminate\Contracts\Database\Eloquent\Builder;







class SarfController extends Controller
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

    public function get_units($id)
    {
       
        $units =   Unit::with('center', 'unitType', 'renter')
            ->where('center_id', $id)
            ->orderby('id')
            ->get();

        $op = '<option value="">اختر </option>';
        foreach ($units as $unit) {
            $op .= '<option value="' . $unit->id . '"> ' . $unit->unitType->name . ' رقم : ' . $unit->unit_no . '   (' . $unit->renter->name . ')    </option>';
        }
        return $op;
    }
    public function index(Request $request)
    {
        $amount = 7587;
        $arablic = Tafqeet::arablic($amount);

        $sarfs = Sarf::with(['sarfType','serviceType', 'payrool.employee', 'recipient', 'paymentType', 'sourceType', 'fromOhda.employee', 'toOhda.employee'])
            
            ->orderByDesc('id')
            ->get();


        $current_user = User::find(Auth::user()->id);
        return view('sarfs.index', compact('sarfs', 'current_user'))
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
        $sourceTypes = Source_type::get();
        $sarfTypes = Sarf_type::get();
        $payment_types = Payment_type::get();
        $serviceTypes = Service_type::get();
        $recipients = Recipient::get();
        $ohdas = Ohda::with(['employee'])->get();
        $payrolls = Payroll::with(['employee'])
            ->where('payment_status', 0)
            ->get();
        // dd($ohdas) ; 
        return view('sarfs.create', compact('current_user', 'centers', 'sourceTypes', 'sarfTypes', 'payment_types', 'serviceTypes', 'recipients', 'ohdas', 'payrolls'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {



        if ($request->source_type_id == 1) {
            $this->validate($request, [
                'source_type_id' => 'required',
                'sarf_type_id' => 'required',
                'amount' => 'required',
                'p_date' => 'required',
                'payment_type' => 'required'
            ]);
        }
        if ($request->source_type_id == 2) {
            $this->validate($request, [
                'source_type_id' => 'required',
                'sarf_type_id' => 'required',
                'amount' => 'required',
                'p_date' => 'required',
                'payment_type' => 'required',
                'from_ohda_id' => 'required'
            ]);
        }
        if ($request->sarf_type_id == 1) {
            $this->validate($request, [
                'to_ohda_id' => 'required'
            ]);
        }

        if ($request->sarf_type_id == 2) {
            $this->validate($request, [
                'recipient_id' => 'required'
            ]);
        }
        if ($request->sarf_type_id == 3) {
            $this->validate($request, [
                'pay_role_id' => 'required'
            ]);
        }
        if ($request->sarf_type_id == 4) {
            $this->validate($request, [
                'service_type_id' => 'required',
                'center_id' => 'required'
            ]);
        }


        $input = $request->all();
        $input['created_by'] = Auth::user()->id;
       
         if( $input['source_type_id']!=2)
        {
            $input['from_ohda_id']=null ; 
        }
        if( $input['sarf_type_id']!=1)
        {
            $input['to_ohda_id']=null ; 
        }
        if( $input['sarf_type_id']!=2)
        {
            $input['recipient_id']=null ; 
        } 
        if( $input['sarf_type_id']!=3)
        {
            $input['pay_role_id']=null ; 
        } 
        if( $input['sarf_type_id']!=4)
        {
            $input['service_type_id']=null ; 
            $input['center_id']=null ; 
            $input['unit_id']=null ; 
        }

        $input['amount_txt'] =    Tafqeet::arablic($request->amount);

        $input['year_m']  = substr($request->p_date, 2, 2);
        $input['year_h']  = substr($request->p_dateh, 2, 2);


        $sql = "SELECT nvl(max(sereal),0)+1 as sereal from sarfs where year_m = '" . $input['year_m'] . "'";

        $res = DB::select($sql)[0];
        $input['sereal'] = $res->sereal;




//dd($input) ; 
        if ($sarf =  Sarf::create($input)) {
            // dd($sarf) ;
            
             // add Notification
                    $toUsers = User::get()->where('is_admin', 1);
                    foreach ($toUsers as $user) {
                        $n_date['user_id'] = $user->id;
                        $n_date['message'] = "تم صرف مبلغ : ".$sarf->amount;
                        $n_date['url'] = "sarfs.show";
                        $n_date['element_id'] = $sarf->id;
                        Notification::create($n_date);
                    }
            if ($sarf->from_ohda_id != '') {
                $ohda = Ohda::find($sarf->from_ohda_id);
                $last_amount =  $ohda->raseed ; 
                $ohda->raseed = $ohda->raseed - $sarf->amount;
                if ($ohda->save()) {
                    $odata = [
                        'ohda_id' => $sarf->from_ohda_id,
                        'op_type' => '-',
                        'sarf_id' => $sarf->id,
                        'last_amount' => $last_amount,
                        'amount' => $sarf->amount
                    ];
                    $op =  Ohdas_operation::create($odata);
                }
            }

            if ($sarf->to_ohda_id != '') {
                $ohda = Ohda::find($sarf->to_ohda_id);
                  $last_amount =  $ohda->raseed ; 
                $ohda->raseed = $ohda->raseed + $sarf->amount;
                if ($ohda->save()) {
                    $odata = [
                        'ohda_id' => $sarf->to_ohda_id,
                        'op_type' => '+',
                        'sarf_id' => $sarf->id,
                         'last_amount' => $last_amount,
                        'amount' => $sarf->amount
                    ];
                    $op =  Ohdas_operation::create($odata);
                }
            }

            if ($sarf->pay_role_id != '') {
                $payroll = Payroll::find($sarf->pay_role_id);
                $payroll->payment_type = $sarf->payment_type;
                $payroll->p_date = $sarf->p_date;
                $payroll->p_dateh = $sarf->p_dateh;
                $payroll->net_salary = $sarf->amount;
                $payroll->net_salary_txt = $sarf->amount_txt;
                $payroll->updated_at = $sarf->updated_at;
                $payroll->payment_status = 1;
                $payroll->save();
            }
        }

        if($request->has('object_name') && $request->has('object_id') && $request->object_id > 0 && $request->object_name !='' )
        {
              return redirect()->route($request->object_name.'.show' ,$request->object_id)
            ->with('success', '     تم      بنجاح');
        }
        return redirect()->route('sarfs.index')
            ->with('success', '     تم الاضافة  بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function check_contract_dates($start_date, $end_date)
    {

        $sql = "SELECT count(*) c FROM `contracts` WHERE 
                    start_date BETWEEN '" . $start_date . "' and '" . $end_date . "' 
                   or end_date BETWEEN '" . $start_date . "' and '" . $end_date . "' ";
        $res = DB::select($sql)[0];
        if ($res->c > 0)
            return false;
        else
            return true;
    }

    public function show($id, Request $request)
    {
        // Request $request

      
        $sarf = Sarf::with(['maincenter','center','unit','sarfType','serviceType', 'payrool.employee', 'recipient', 'paymentType', 'sourceType', 'fromOhda.employee', 'toOhda.employee'])
            
            ->orderByDesc('id')
            ->find($id);


        $current_user = User::find(Auth::user()->id);
        return view('sarfs.show', compact('sarf', 'current_user'));
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

        return view('sarfs.edit', compact('unit', 'current_user', 'centers', 'types', 'renters'));
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
        // dd($input) ; 
        $unit =  Unit::find($id);


        $unit->update($input);


        return redirect()->route('sarfs.index')
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
        return redirect()->route('sarfs.index')
            ->with('success', 'تم الحذف بنجاح');
    }
}
