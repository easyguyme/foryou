<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Exercise;
use App\Patients;
use App\Workout;
use Gate;
class HomeController
{
    public function index()
    {
                abort_if(Gate::denies('patient_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $role =auth()->user()->roles->implode('title',', ');
        if ($role=='User'){
            $patient =Patients::findorFail(auth()->user()->patient->id);
            $exercise_ids =Auth::user()->workouts()->get();//Workout::where('user_id',$patient->user->id)->get(['status','exercise_id']);
            $exercises = array();
            foreach($exercise_ids as $patien){
                $response = Exercise::where('id',$patien->exercise_id)->get();

                array_push($exercises,$response[0]);
            }


            return view('admin.workouts.show',compact('exercises','patient'));

        }else {
            return view('home');
        }
    }
}
