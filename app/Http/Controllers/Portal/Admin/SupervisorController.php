<?php

namespace App\Http\Controllers\Portal\Admin;

use App\User;
use App\Role;
use App\Registration;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
                if($role->name=='student' || $role->name=='supervisor'){ return redirect('/');}            
                return $next($request);
            }
            else{return redirect('/login');}
        });
    }
    public function index(){

        $supervisors = Registration::where('Type','Supervisor')->get();
        return view('portal.admin.supervisors.index')->with('supervisors',$supervisors);
    }
  
    
    public function delete($id){
        Registration::where('ID', $id)->forcedelete(); 
        return redirect()->route('allSupervisor');
    }
}
