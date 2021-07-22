<?php

namespace App\Http\Controllers\Admin;

use App\Hall;
use App\Image;
use App\School;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Weekdays;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class HallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;
        $id=AdminHomeController::chooseSchool();
        
        if (!empty($keyword)) {
            $hall = Hall::where('coating', 'LIKE', "%$keyword%")
                ->orWhere('price', 'LIKE', "%$keyword%")
                ->orWhere('area', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $hall = Hall::where('school_id', 'LIKE', "$id")
                ->latest()->paginate($perPage);
        }

        return view('admin.halls.index', compact('hall'));
    }

    /**
     * Show the form for creating a new resource.
     *
     *
     */
    public function create()
    {
        $days=['Понеділок', 'Вівторок','Середа','Четвер','П\'ятниця','Субота','Неділя'];
        $data=null;
        return view('admin.halls.create', compact('days'))->with('data', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     *
     */
    public function store(Request $request)
    {
        $request->validate(Hall::$VALIDATION_RULES);
       // dd($request);
        $this->validate(
            $request,
          [
            'select_day.*'  => [
                'required',
          ]
            ]
        );
        $id=AdminHomeController::chooseSchool();
        $school=School::findOrFail($id);
        $hall = Hall::create($request->all());
        $hall->title=$school->title;
        $hall->school_id=$id;
        $hall->save();
        
        $days = $request->input('select_day');
        if($days){
            $count = count($days);
            for($j=0; $j<$count; $j++){
                if($days[$j]){
        $weekdays = Weekdays::where('dayable_id',$hall->id)
                            ->where('dayable_type', 'App\Hall')
                            ->create([
             'day' => $days[$j++],
             'start_time' => $days[$j++],
             'finish_time' => $days[$j],
             'dayable_id' => $hall->id,
             'dayable_type'=> 'App\Hall'
             ]);                 
            }
        }   
        }
        $hall->storeImage($request);
       
        return redirect('admin/halls')->with('flash_message', 'Hall added!');
    }

    /**
     * Display the specified resource.
     *
     *
     */
    public function show($id)
    {
        $hall = Hall::findOrFail($id);
        $hall1= $hall->images()->get(['path'])->first();
        if(!$hall1==null){
            $image1 = Image::where([
                ['imageable_id', '=', $id],
                ['imageable_type', 'App\Hall'],
            ])->get();
            $image=$image1[0];
        }
        else {$image=null;}

        return view('admin.halls.show', compact('hall'), compact('image'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     *
     */
    public function edit($id)
    {
        $hall = Hall::findOrFail($id);
        $weekdays= Weekdays::where([
            ['dayable_id', '=', $id],
            ['dayable_type', 'App\Hall']
        ])->get();
       $data= DB::table('weekdays')
    ->select(array('day', 'start_time', 'finish_time', 'dayable_id', 'dayable_type'))->where([
        ['dayable_id', '=', $id],
        ['dayable_type', 'App\Hall']
    ])
    ->get();
    
        $weekdays_start=$weekdays->pluck('day', 'start_time');
        $hall1= $hall->images()->get(['path'])->first();
        if(!$hall1==null) {
            $image1 = Image::where([
                ['imageable_id', '=', $id],
                ['imageable_type', 'App\Hall'],
            ])->get();
        }
        else {$image1=null;}
        if($image1){
            $image=$image1[0];
            $image_path = $image1[0]->path;
        }
        else {$image=null;}
        $week = ['mon', 'tue', 'wed','thu', 'fri','sat','sun'];
        return view('admin.halls.edit', compact('hall'),compact('image'))->with('data', $data)->with('week', $week);
    }

    /**
     * Update the specified resource in storage.
     *
     *
     */
    public function update(Request $request, $id)
    {
        $request->validate(Hall::$VALIDATION_RULES);
        $this->validate(
            $request,
          [
            'select_day.*'  => [
                'required',
            ],
            'changed_day.*'  => [
                'required',
            ],
            ]
        );
        $requestData = $request->all();
        $hall= Hall::findOrFail($id);
        app()->getLocale();
        Weekdays::where('dayable_id', $id)
        ->where('dayable_type', 'App\Hall')->delete();

        $days1 = $request->input('changed_day');
        if($days1){
            $count1 = count($days1);
        for($i=0; $i<$count1; $i++){
            if($days1[$i]){
         $weekdays1 = Weekdays::where('dayable_id',$hall->id)
                        ->where('dayable_type', 'App\Hall')
                        ->create([
         'day' => Lang::get('abbreviation.'.$days1[$i++]),
         'start_time' => $days1[$i++],
         'finish_time' => $days1[$i],
         'dayable_id' => $hall->id,
         'dayable_type'=> 'App\Hall'
         ]);                 
        }
    } 
        }
        

        $days= $request->input('select_day');
        if($days){
           $count = count($days);
        for($j=0; $j<$count; $j++){
            if($days[$j]){
    $weekdays = Weekdays::where('dayable_id',$hall->id)
                        ->where('dayable_type', 'App\Hall')
                        ->create([
         'day' => $days[$j++],
         'start_time' => $days[$j++],
         'finish_time' => $days[$j],
         'dayable_id' => $hall->id,
         'dayable_type'=> 'App\Hall'
         ]);                 
        }
    }  
        }
        
        $hall1= $hall->images()->get(['path'])->first();
        if(!$hall1==null) {
        $image1 = Image::where([
            ['imageable_id', '=', $id],
            ['imageable_type', 'App\Hall'],
        ])->get();
            $image2=$image1[0];
            $image_path2 = $image1[0]->path;

            $hall->update($requestData);
        }
        else {$image1=null;  $hall->update($requestData);}
        $hall->storeImage($request);
        
        return redirect('admin/halls')->with('flash_message', 'Conquer updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     *
     */
    public function destroy(Hall $hall)
    {
        Weekdays::where('dayable_id', $hall->id)
        ->where('dayable_type', 'App\Hall')->delete();
        $hall->deleteImage();
        $hall->delete();

        return redirect('admin/halls')->with('flash_message', 'Conquer deleted!');
    }
}
