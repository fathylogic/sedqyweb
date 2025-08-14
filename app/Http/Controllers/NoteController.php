<?php
    
namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Note;
use App\Models\Notes_file;
use App\Models\Location;
use App\Models\Unit;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

 
    
class NoteController extends Controller
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
       
        if($request->has('message'))
        {
          //  dd($request->file) ; 
           
          
           
            $this->validate($request, [
            'message' => 'required',
            'title' => 'required'
             
        ]);
    
        $input = $request->all();
      
        $input['created_by']= Auth::user()->id ;  
        $input['user_id']= Auth::user()->id ;  
      // dd($input) ; 
        $note =  Note::create($input);

         if(!empty($request->file))
           {
                foreach($request->file as $uploadedFile)
                {
                    $storedName = Str::uuid()->toString() . '.' . $uploadedFile->getClientOriginalExtension();
                    $url = $uploadedFile->storeAs('uploads', $storedName, 'public');
                    $nf_data['url'] = $url ; 
                    $nf_data['note_id'] = $note->id ; 
                    $nf_data['note_id'] = $note->id ; 
                    $noteFile = Notes_file::create($nf_data) ; 

                }
           }


         return redirect()->route('notes.index') ->with('success','     تم الاضافة  بنجاح');
        }
        $data = Note::with('files')
        ->where ('user_id',Auth::user()->id)
        ->latest()->paginate(10);

       // dd($data[0]['files']) ;
        
        $current_user = User::find(Auth::user()->id) ; 
        return view('notes.index',compact('data','current_user'))
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
      
        return view('notes.create',compact( 'current_user'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
         
        //  $img = ''; 
        // if($request->has('file'))
        // {
        //     $uploadedFile = $request->file('file');
        //     $storedName = Str::uuid()->toString() . '.' . $uploadedFile->getClientOriginalExtension();
        //     $img = $uploadedFile->storeAs('uploads', $storedName, 'public');
        // }
         
        $this->validate($request, [
            'message' => 'required',
            'title' => 'required'
             
        ]);
    
        $input = $request->all();
      
        $input['created_by']= Auth::user()->id ;  
      // dd($input) ; 
        $note =  Note::create($input);
       
    
        return redirect()->route('notes.index')
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
        $note = Note::with('files')->find($id);
         $current_user = User::find(Auth::user()->id) ; 

         $units =   Unit::with('note','unitType','renter')
         ->where('center_id',$id)
        ->orderby('id')
        ->latest()->paginate(10);
        return view('notes.show',compact('note','current_user','units'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): View
    {
        $note = Note::with('files')->find($id);
        $current_user = User::find(Auth::user()->id) ; 
       
        return view('notes.edit',compact( 'note','current_user'));
        
        
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
            'message' => 'required',
            'title' => 'required'
             
        ]);
    
        $input = $request->all();
        // if($request->has('file'))
        // {
        //     $uploadedFile = $request->file('file');
        //     $storedName = Str::uuid()->toString() . '.' . $uploadedFile->getClientOriginalExtension();
        //     $img = $uploadedFile->storeAs('uploads', $storedName, 'public');
        //     $input['img']= $img ; 
        // }
       
        $input['updated_by']= Auth::user()->id ;  
      // dd($input) ; 
        $note =  Note::with('files')->find($id);

       
        $note->update($input);
       
    
        return redirect()->route('notes.index')
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
       
       
        Note::with('files')->find($id)->delete();
        return redirect()->route('notes.index')
                        ->with('success','تم الحذف بنجاح');
    }
}