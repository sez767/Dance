<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Role;
use App\School;
use App\User;
use App\Contact;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class AdminHomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $supervisor_schools=User::find(Auth::user()->id)->supervisor_schools;
        session(['supervisor_schools'=>$supervisor_schools]);
        if(!empty(app('supervisors_school')[0])) {
            if(is_null(session('current_school_id'))){
            session(['current_school_id'=>session('supervisor_schools')[0]->id]);
             }
        }

        $user1=User::get('type')[0]['type'];
        $id=Auth::user()->id;
        if($id==1){
            $type=Auth::user()->type='admin';

        }
        $user2=Auth::user()['type'];
        return view('admin.home')->with('user1', $user1)->with('user2', $user2);
    }
    public function role() {
        $user1=User::get('type')[0]['type'];
        $id=Auth::user()->id;

        $user=User::get('id')[0];

        $users=User::get('id');
        $user_id=$user->id;
        $user_real=Session::get(User::find('name'))['login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d'];
        if($id==$user_id) {
            $user_real=null;
        }
        else  $user_real=1;
        $type=app('adminUser');
        $id=Auth::user()->id;
        $user2=Auth::user()['type'];
        return $user2;
    }

    public function changeSchool($id)
    {
        session(['current_school_id'=>$id]);
        $school=School::findorfail($id);
        return view('admin.home')->with('school',$school);
    }
    public static function chooseSchool()
    {
        $supervisor_schools=User::find(Auth::user()->id)->supervisor_schools;
        session(['supervisor_schools'=>$supervisor_schools]);
        if(!empty(app('supervisors_school')[0])) {
            if(is_null(session('current_school_id'))) {
                session(['current_school_id' => session('supervisor_schools')[0]->id]);
            }
        }
        $id=Session::get('current_school_id');
        return $id;
    }

}
