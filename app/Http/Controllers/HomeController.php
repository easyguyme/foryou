<?php

namespace App\Http\Controllers;

use App\Exercise;
use App\Patients;
use App\Workout;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
//        abort_if(Gate::denies('patient_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $patient =Patients::findorFail(auth()->user()->id);
        $exercise_ids =Workout::where('user_id',$patient->user->id)->get(['status','exercise_id']);
        $exercises = array();
        foreach($exercise_ids as $patien){
            $response = Exercise::where('id',$patien->exercise_id)->get();
//            $exercises = $response;
            array_push($exercises,$response[0]);
        }

        return view('home',compact('patient','exercises'));
    }
}
