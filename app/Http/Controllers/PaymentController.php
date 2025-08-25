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
use App\Models\Maincenter;
use App\Models\Unit_type;
use App\Models\Contract;
use App\Models\Payment;
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







class PaymentController extends Controller
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
        $amount = 7587;
        $arablic = Tafqeet::arablic($amount);

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



            $payments_payed = Payment::with(['contract.renter','contract.unit','unit','center','maincenter','contract.center', 'paymentType', 'employee'])
                    ->where('status',1)
                    ->orderByDesc('id') 
                     ->get();  
            $payments_un_payed = Payment::with(['contract.renter','contract.unit','unit','center','maincenter','contract.center', 'paymentType', 'employee'])
                    ->where('status',0)
                    ->orderBy('p_date') 
                     ->get(); 
        // dd($payments_payed , $payments_un_payed) ;
        // dd( $data) ;

        $renters = Renter::all();
        $centers = Center::all();
        $emps = Employee::all();
        $payment_types = Payment_type::all();

        
            

        $current_user = User::find(Auth::user()->id);
        return view('payments.index', compact('payments_payed','payments_un_payed','renters','centers','emps','payment_types', 'current_user'))
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
        return view('payments.create', compact('current_user', 'centers', 'types', 'renters'));
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
            'electric_no' => 'required'
        ]);

        $input = $request->all();
        $input['img'] = $img;
        $input['created_by'] = Auth::user()->id;
        // dd($input) ; 
        $unit =  Unit::create($input);


        return redirect()->route('payments.index')
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

         $payment = Payment::with(['contract.renter','contract.unit','contract.center', 'paymentType', 'employee'])
                    ->find($id); 
        //dd($payment) ; 
       

        $current_user = User::find(Auth::user()->id);
        return view('payments.show', compact('payment', 'current_user'));
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

        return view('payments.edit', compact('unit', 'current_user', 'centers', 'types', 'renters'));
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


        return redirect()->route('payments.index')
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
        return redirect()->route('payments.index')
            ->with('success', 'تم الحذف بنجاح');
    }
}
