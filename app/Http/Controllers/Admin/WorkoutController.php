<?php

namespace App\Http\Controllers\Admin;

use App\Exercise;
use App\Http\Controllers\Controller;

use App\Mail\NewProgramNotification;
use App\Program;
use App\User;
use App\Patients;
use App\Workout;
use Auth;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use DB;
use Illuminate\Support\Facades\Mail;
class WorkoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('workout_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
//        $exercises = Exercise::all();
        $exercises = Program::all();
        $users = User::where('registered','=',1)->pluck('id','name');
        return view('admin.workouts.index', compact('exercises','users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function created()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Workout  $workout
     * @return \Illuminate\Http\Response
     */
    public function show(Workout $workout)
    {
        //
    }



    public function create()
    {

        abort_if(Gate::denies('patient_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Workout  $workout
     * @return \Illuminate\Http\Response
     */
    public function edit(Workout $workout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Workout  $workout
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Workout $workout)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Workout  $workout
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request){

    }

    public function destroys(Request $request)
    {
        abort_if(Gate::denies('workout_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $user_id = $request->route('user_id');
        $workout_id = $request->route('workout_id');
        $matchThese = ['exercise_id'=> $workout_id,'user_id'=> $user_id];
        DB::table('workouts')
            ->where($matchThese)
        ->delete();
        return redirect()->back() ->withInput()->withStatus(__('Workout successfully deleted.'));


    }

    public function massAdd(Request $request)
    {

        $data = request()->except(['_token','_method']);
        $exercises = $request->exercise_id;
        $user_id = $request->user_id;
        $users =User::findorFail($user_id);
        $name = $users[0]->name;
        $email = $users[0]->email;
        foreach ($exercises as $exercise){
            $data['created_by'] = auth()->user()->name;
            $data['status'] =1;
            $data['exercise_id']=$exercise;
            $data['user_id']=$user_id[0];
            $err=Workout::create($data);

        }
        Mail::to($email)->send(new NewProgramNotification($name));
        return response()->json(array('success' => true,'message' => 'Program successfully Assigned to the patient'), 200);
    }
}
