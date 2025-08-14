<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Center;
use App\Models\Employee;
use App\Models\Ohda;
use App\Models\Ohdas_operation;
use App\Models\Location;
use Spatie\Permission\Models\Role;

use Hash;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;




class OhdaController extends Controller
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

        $emps = Employee::get();
        $ohdas = Ohda::with('operatios')->latest()->paginate(10);
       
        $current_user = User::find(Auth::user()->id);
        return view('ohdas.index', compact('ohdas', 'emps', 'current_user'))
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
        $emps = Employee::get();
        return view('ohdas.create', compact('current_user', 'emps'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {

        $this->validate($request, [
            'emp_id' => 'required',
            'purpose' => 'required',
            'raseed' => 'required'

        ]);

        DB::transaction(function () use ($request) {
            $ohda = Ohda::create([
                'emp_id'  => $request->emp_id,
                'purpose' => $request->purpose,
                'raseed'  => $request->raseed,
            ]);

            
        });

        return redirect()->route('ohdas.index')->with('success', 'تم الاضافة بنجاح.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): View
    {
      
        $current_user = User::find(Auth::user()->id);
        
        $current_user = User::find(Auth::user()->id);
       
        $ohda = Ohda::with('operatios')->findOrFail($id);
 
        return view('ohdas.show', compact('ohda', 'current_user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): View
    {
        $emps = Employee::get();
        $current_user = User::find(Auth::user()->id);
        $centers = Center::get();
        $ohda = Ohda::with('operatios')->findOrFail($id);

        return view('ohdas.edit', compact('ohda', 'emps', 'current_user'));
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
            'emp_id' => 'required',
            'purpose' => 'required',
            'raseed' => 'required'

        ]);

        DB::transaction(function () use ($request, $id) {
            $ohda = Ohda::findOrFail($id);
            $ohda->update([
                'emp_id'  => $request->emp_id,
                'purpose' => $request->purpose,
                'raseed'  => $request->raseed,
            ]);

            // Remove old operatios
            $ohda->operatios()->delete();

            // Insert new
            foreach ($request->operatios as $op) {
                $ohda->operatios()->create($op);
            }
        });


        return redirect()->route('ohdas.index')
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
        Ohda::findOrFail($id)->delete();
        return redirect()->route('ohdas.index')->with('success', 'تم الحذف بنجاح');
    }
}
