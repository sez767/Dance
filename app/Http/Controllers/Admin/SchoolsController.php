<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Image;
use App\Invite;
use App\Role;
use App\User;
use App\School;
use App\Agegroup;
use App\Dance;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Mail\InviteCreated;
use App\Invitetrait;
use App\Times;
use App\Weekdays;
use \Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;




class SchoolsController extends Controller
{
    public function __construct(){
        $this->authorizeResource(School::class, 'school');
    }
    /*
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $schools = School::where('title', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->orWhere('address', 'LIKE', "%$keyword%")
                ->orWhere('contact', 'LIKE', "%$keyword%")
                ->orWhere('time_work', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $schools = School::latest()->paginate($perPage);
        }

        return view('admin.schools.index', compact('schools'));
    }

    /*
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $users=User::all();

        $i=0;
        foreach ($users as $item){
            $email[$i]=$item['email'];
            $i++;
        }
        $supervisors = $teachers = $users->pluck('name','id');
        $days=['Понеділок', 'Вівторок','Середа','Четвер','П\'ятниця','Субота','Неділя'];
        $data=null;
        $dances = Dance::all();
        return view('admin.schools.create',compact(['teachers','supervisors','dances']),compact('email'))->with('data', $data);

    }

    /*
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {   
        $this->validate(
            $request,
          [
                'title' => 'required|regex:/^[\w\- \p{Cyrillic}]*$/u|min:3|max:300',
                'school_type' => 'required|regex:/^[\w\- \p{Cyrillic}]*$/u|min:3|max:300',
                'description' => 'required|string|min:3|max:10000',
                'contact' => 'required|numeric|digits_between:6,20',
                'email' => 'required|string|max:300|email|unique:users',
                'select_day.*'  => 'required',
                'age_title.*' => 'required',
                'age_begin.*' => 'required|digits_between:1,2',
                'age_end.*' => 'required|digits_between:1,2',
                'age_price.*' => 'required|numeric',
            ]
        );
        $school = School::create($request->except('supervisors','teachers'));
        $days = $request->input('select_day');
        $count = count($days);
            for($j=0; $j<$count; $j++){
                if($days[$j]){
        $weekdays = Weekdays::where('dayable_id',$school->id)
                            ->where('dayable_type', 'App\School')
                            ->create([
             'day' => $days[$j++],
             'start_time' => $days[$j++],
             'finish_time' => $days[$j],
             'dayable_id' => $school->id,
             'dayable_type'=> 'App\School'
             ]);                 
            }
        } 
        if($request->email_user){
            $invite = new Invite();
            $invite->makeInvite($request->email_user, $school);
        }
        if($request->email_user[0]){
            $school->teachers()->sync($request->teachers);
        }
        else if($request->new_user=='Enter'){

        }
        else if(!$request->email_user[0]){
            $supervisor=$school->supervisors()->sync($request->supervisors);
            $school->teachers()->sync($request->teachers);
        }
        $school->storeImage($request);
        $school->dances()->sync($request->dance_style);
        $count = count($request->age_title);
        for ($i=0; $i < $count; $i++) { 
            $ag = new Agegroup();
            $ag->school_id = $school->id;
            $ag->title = $request->age_title[$i];
            $ag->begin = $request->age_begin[$i];
            $ag->end = $request->age_end[$i];
            $ag->price = $request->age_price[$i];
            $ag->save();
            $school->agegroups()->attach($ag->id);
        }
        return redirect('admin/schools')->with('flash_message', 'School added!');
    }

    /*
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show(School $school)
    {
        if($school->teachers->first()){
        $teacher=$school->teachers->toArray();
        $j=0;
        $a=$teacher[$j];
        $name=$teacher[0]['name'];}
        else{$name='no teachers';}
        $id=$school->id;
        $school_path= $school->images()->get(['path'])->first();
        if(!$school_path==null){
            $image1 = Image::where([
                ['imageable_id', '=', $id],
                ['imageable_type', 'App\School'],
            ])->get();
            $image=$image1[0];
        }
        else {$image=null;}

        return view('admin.schools.show', compact('image'),compact('school'))->with('name', $name);
    }

    /*
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit(School $school)
    {
        $users=User::all();
        $dances = Dance::all();
        $supervisors = $teachers = $users->pluck('name','id');
        $id=$school->id;

        $weekdays= Weekdays::where([
            ['dayable_id', '=', $id],
            ['dayable_type', 'App\School']
        ])->get();
       $data= DB::table('weekdays')
    ->select(array('day', 'start_time', 'finish_time', 'dayable_id', 'dayable_type'))->where([
        ['dayable_id', '=', $id],
        ['dayable_type', 'App\School']
    ])
    ->get();
    
        $weekdays_start=$weekdays->pluck('day', 'start_time');
        $week = ['mon', 'tue', 'wed','thu', 'fri','sat','sun'];

        $school_path= $school->images()->get(['path'])->first();
        if(!$school_path==null) {
            $image1 = Image::where([
                ['imageable_id', '=', $id],
                ['imageable_type', 'App\School'],
            ])->get();
        }
        else {$image1=null;}
        if($image1){
            $image=$image1[0];
            $image_path = $image1[0]->path;
        }
        else {$image=null;}

        $user=User::all();
        $i=0;
        foreach ($user as $item) {
            $email[$i] = $item['email'];
            $i++;
        }

        return view('admin.schools.edit', compact(['school','teachers','supervisors','dances']),compact('image'))->with('data', $data)->with('week', $week);
    }

    /*
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, School $school)
    {
        $this->validate(
            $request,
            [
                'title' => 'required|regex:/^[\w\- \p{Cyrillic}]*$/u|min:3|max:300',
                'school_type' => 'required|regex:/^[\w\- \p{Cyrillic}]*$/u|min:3|max:300',
                'description' => 'required|string|min:3|max:10000',
                'contact' => 'required|numeric|digits_between:6,20',
                'email' => 'required|string|max:300|email|unique:users',
                'select_day.*'  => 'required',
                'changed_day.*'  => 'required',
                'age_title.*' => 'required',
                'age_begin.*' => 'required|digits_between:1,2',
                'age_end.*' => 'required|digits_between:1,2',
                'age_price.*' => 'required|numeric',
            ]
        );
        Weekdays::where('dayable_id', $school->id)
        ->where('dayable_type', 'App\School')->delete();

        $days1 = $request->input('changed_day');
        if($days1){
            $count1 = count($days1);
        for($i=0; $i<$count1; $i++){
            if($days1[$i]){
         $weekdays1 = Weekdays::where('dayable_id',$school->id)
                        ->where('dayable_type', 'App\School')
                        ->create([
         'day' => Lang::get('abbreviation.'.$days1[$i++]),
         'start_time' => $days1[$i++],
         'finish_time' => $days1[$i],
         'dayable_id' => $school->id,
         'dayable_type'=> 'App\School'
         ]);                 
        }
    } 
        }
        

        $days= $request->input('select_day');
        if($days){
           $count = count($days);
        for($j=0; $j<$count; $j++){
            if($days[$j]){
    $weekdays = Weekdays::where('dayable_id',$school->id)
                        ->where('dayable_type', 'App\School')
                        ->create([
         'day' => $days[$j++],
         'start_time' => $days[$j++],
         'finish_time' => $days[$j],
         'dayable_id' => $school->id,
         'dayable_type'=> 'App\School'
         ]);                 
        }
    }  
        }
        if($request->email_user){
            $invite = new Invite();
            $invite->makeInvite($request->email_user, $school);
        }
        
        $school_path= $school->images()->get(['path'])->first();
        $id=$school->id;
        if(!$school_path==null) {
            $image1 = Image::where([
                ['imageable_id', '=', $id],
                ['imageable_type', 'App\School'],
            ])->get();
            $image2=$image1[0];
            $image_path2 = $image1[0]->path;
        }else {$image1=null;}

        $data = $request->except('supervisors','teachers');
        $school1 = School::findOrFail($id);
        $school1->update($data);
        if($request->email_user[0]){
            $school->teachers()->sync($request->teachers);
        }
        else if($request->new_user=='Enter'){
        }
        else if (!$request->email_user[0]){
            $supervisor=$school->supervisors()->sync($request->supervisors);
            $school->teachers()->sync($request->teachers);
        }
        $school->storeImage($request);
        $school->dances()->sync($request->dance_style);
        
        $ag_id_array=[];
        $count = count($request->age_title);
        for ($i=0; $i < $count; $i++){ 
            $ag = Agegroup::firstOrCreate(
                [   'school_id' => $school->id,
                    'title' => $request->age_title[$i],
                    'begin' => $request->age_begin[$i],
                    'end' => $request->age_end[$i],
                    'price' => $request->age_price[$i],
                ]
            );
           $ag_id_array[] = $ag->id;
        }
        $school->agegroups()->sync($ag_id_array);
        
        return redirect('admin/schools')->with('flash_message', 'School updated!');
    }


    /*
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(School $school)
    {
        //ТУТ ПОТРІБНО ДОБАВИТИ ВСЕ ЩО ПОВЯЗАНЕ З ШКОЛАМИИ !!!
        Weekdays::where('dayable_id', $school->id)
        ->where('dayable_type', 'App\School')->delete();
        $school->deleteImage();
        $school->delete();

        return redirect('admin/schools')->with('flash_message', 'School deleted!');
    }

}
