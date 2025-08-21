<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Center;
use App\Models\Maincenter;
use App\Models\Location;
use App\Models\Unit;
use App\Models\Payment_type;
use App\Models\All_file;

use App\Models\Unit_type;
use App\Models\Contract;
use App\Models\Payment;
use App\Models\Sarf;
use App\Models\Employee;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;



class FilesController extends Controller
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

        
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add_files(Request $request): RedirectResponse
    {
         
       if(!empty($request->file))
           {
                $i = 0  ; 
                foreach($request->file as $uploadedFile)
                {
                    $storedName = Str::uuid()->toString() . '.' . $uploadedFile->getClientOriginalExtension();
                    $url = $uploadedFile->storeAs('uploads', $storedName, 'public');
                    $nf_data['url'] = $url ; 
                    $nf_data['object_id'] = $request->object_id ; 
                    $nf_data['object_name'] = $request->object_name ; 
                    $nf_data['title'] = $request->title[$i]; 
                   
                    $noteFile = All_file::create($nf_data) ;
                    $i++ ;  

                }
           }   



        return redirect()->route($request->object_name.'.show' ,$request->object_id)
            ->with('success', '     تم اضافة الملفات  بنجاح');
    }
    public function delete_file(Request $request): RedirectResponse
    {
       
         



        return redirect()->route($request->object_name.'.show' ,$request->object_id)
            ->with('success', '     تم اضافة الملفات  بنجاح');
    }

    
}
