<?php

namespace App\Http\Controllers\Portal\Admin;

use App\Universitie;
use App\User;
use App\Role;
use App\Registration;
use App\Nationalitie;
use App\Countrie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class SupervisorController extends Controller
{
    private $user ;
    public function __construct()
    {
       $this->middleware(function ($request, $next) {
            $this->user= Auth::user();
            if(Auth::user() != null)
            {
                $role=Role::get()->where('id',$this->user->role_id)->first();
                if($role->name=='student' || $role->name=='supervisor'){ return redirect('/portal');}
                return $next($request);
            }
            else{return redirect('/login');}
        });
    }
    public function index(){
    
     // Updated on 26 Jan 2020, to show only active supervisors instead of all.
        $supervisors = Registration::where('type','supervisor')->where('Status', 'yes')->get();

        //$supervisors = Registration::where('Type','supervisor')->get();   this is the old code.
        
        $universities = Universitie::all();
        return view('portal.admin.supervisors.index')->with('supervisors',$supervisors)->with('universities' , $universities );
    }

    public function add(){
        $nationalities = Nationalitie::all();
        $countries = Countrie::all();
        return view('portal.admin.supervisors.add',compact('nationalities','countries'));
    }

    public function addPost(Request $request){

        $user = new User;
        $user->name=$request->input('firstname');
        $user->email =$request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->role_id = Role::where('name','supervisor')->first()->id;
        $user->save();

        $registration = new Registration;
        $registration->PassportNumber = $request->input('PassportNumber');
        $registration->NationalNumber = $request->input('NationalNumber');
        $registration->Fistname = $user->name;
        $registration->Lastname = $request->input('lastname');
        $registration->Gender = $request->input('gender');
        $registration->BirthDate = $request->input('birthdate');
        $registration->BirthCity = $request->input('BirthCity');
        $registration->Nationalitie = $request->input('nationalitie');
        $registration->Countrie = $request->input('countrie');
        $registration->City = $request->input('city1');
        $registration->Location = $request->input('location');
        $registration->University = $request->input('University');
        $registration->Faculty = $request->input('Faculty');
        $registration->CertificateType = $request->input('CertificateType');
        $registration->CertificateDegree = $request->input('CertificateDegree');
        $registration->InscriptionDate = $request->input('InscriptionDate');
        $registration->Phonne1 = $request->input('Phonne1');
        $registration->Phonne2 = $request->input('Phonne2');
        $registration->Type = "supervisor";
        $registration->Status = 'yes';
        $registration->User = $user->id;
        $registration->Email = $request->input('email');
        $profileImage = $request->file('PictureURL');
        $profileImageSaveAsName = time().'.'.$profileImage->getClientOriginalExtension();
        $upload_path = 'public/registrations';
        $profile_image_url = $upload_path . $profileImageSaveAsName;
        $success = $profileImage->storeAs($upload_path, $profileImageSaveAsName);
        $registration->PictureURL = $profileImageSaveAsName;
        $registration->save();
        Session::put('success_edit', 'تم اضافة المشرف بنجاح'); 
        
        return redirect()->route('allSupervisor');
    }
    
    
    
    
    
    
    


// added on 26 January 2020

    public function editPost(Request $request){

        DB::table('registrations')->where('ID',$request->input('id_registration'))
            ->update(array(
                'PassportNumber'=>$request->input('PassportNumber'),
                'NationalNumber'=>$request->input('NationalNumber'),
                'Fistname'=>$request->input('firstname'),
                'Lastname'=>$request->input('lastname'),
                'Gender'=>$request->input('gender'),
                'BirthDate'=>$request->input('birthdate'),
                'BirthCity'=>$request->input('BirthCity'),
                'Nationalitie'=>$request->input('nationalitie'),
                'Countrie'=>$request->input('countrie'),
                'City'=>$request->input('city1'),
                'Location'=>$request->input('location'),
                'University'=>$request->input('University'),
                'Faculty'=>$request->input('Faculty'),
                'CertificateType'=>$request->input('CertificateType'),
                'CertificateDegree'=>$request->input('CertificateDegree'),
                'InscriptionDate'=>$request->input('InscriptionDate'),
                'Phonne1'=>$request->input('Phonne1'),
                'Phonne2'=>$request->input('Phonne2')
            ));
        Session::put('success_edit', 'تم تعديل الحساب بنجاح');
        return redirect()->route('allSupervisor');
    }


    
    
    
    
    

    public function delete($id){
        Registration::where('ID', $id)->forcedelete(); 
        Session::put('success_edit', 'تم حذف المشرف بنجاح'); 
        
        return redirect()->route('allSupervisor');
    }



    public function showProfile($id){

        $supervisor = Registration::where('ID',$id)->get()->first();
        $nationalities = Nationalitie::all();
        $countries = Countrie::all();
       $universities = Universitie::all();


        $searchers = DB::table('theses')
            ->leftJoin('registrations','registrations.ID','=','theses.Searcher')
            ->leftJoin('nationalities','nationalities.ID','=','registrations.Nationalitie')
            ->leftJoin('countries','countries.ID','=','registrations.Countrie')
            ->where('theses.Supervisor',$supervisor->ID)
            ->select('registrations.*','countries.Name as countrieName','nationalities.Name as nationalitieName','theses.Title as thesesTitle')
            ->get();




        return view('portal.admin.supervisors.profile',compact('supervisor' , 'nationalities' , 'countries', 'universities'))->with('searchers',$searchers);


    }





    // now admin can change supervisor's password or reset it
    public function editpassword(Request $request){



        $id = $request->input('id_user');
        $supId = $request->input('supervisor_id');
        $newPassword = bcrypt($request->input('Password'));



        DB::table('users')
            ->where("id", '=',  $id)
            ->update(['password'=> $newPassword]);




        Session::put('success_edit', 'تم تغيير الرقم السري للحساب بنجاح');
        return redirect()->route('adminSupervisorProfile', ['ID'=>$supId]);
    }





}