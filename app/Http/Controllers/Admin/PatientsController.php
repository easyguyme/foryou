<?php

namespace App\Http\Controllers\Admin;

use App\Exercise;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPatientRequest;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Program;
use App\Role;
use App\Patients;
use App\User;
use App\Workout;
use DB;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PatientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('patient_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $patients = Patients::all();
        return view('admin.patients.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('patient_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $users = User::where('registered','=',0)->pluck('id','name');
        return view('admin.patients.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePatientRequest $request)
    {

        $data = request()->except(['_token', '_method']);
        $data['created_by'] = auth()->user()->name;
        $pat = Patients::where('user_id','=',$request->user_id)->exists();
        if ($pat){
            return redirect()->back() ->withInput()->withErrors(['error' => 'Patient Already exists']);
        }else{
        $patient = Patients::create($data);
            DB::table('users')
                ->where('id', $request->user_id)
                ->update(['registered' => true]);
            return redirect()->route('admin.patients.index')->withStatus(__('Patient successfully created.'));
        }

//        return $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Patients  $patients
     * @return \Illuminate\Http\Response
     */
    public function show($patients)
    {
        abort_if(Gate::denies('patient_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $patient =Patients::findorFail($patients);
        $exercise_ids =Workout::where('user_id',$patient->user->id)->get(['status','exercise_id']);
        $exercises = array();
        foreach($exercise_ids as $patien){
            $response = Program::where('id',$patien->exercise_id)->get();
//            $exercises = $response;
            array_push($exercises,$response[0]);
        }
//return $exercises;

        return view('admin.patients.show', compact('patient','exercises'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Patients  $patients
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_if(Gate::denies('patient_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $patients =Patients::findorFail($id);
        return view('admin.patients.edit', compact( 'patients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Patients  $patients
     * @return \Illuminate\Http\Response
     */

    public function update(UpdatePatientRequest $request, $id)
    {
        $data = request()->except(['_token', '_method']);
        $data['created_by'] = auth()->user()->name;

        Patients::whereId($id)->update($data);
        return redirect()->route('admin.patients.index')->withStatus(__('Patient successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Patients  $patients
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        abort_if(Gate::denies('patient_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patient =Patients::findOrFail($id);

        $user_id = DB::table('patients')->where('id',$id)->get('user_id');
        DB::table('users')
            ->where('id', $user_id[0]->user_id)
            ->update(['registered' => false]);
        $patient->delete();
//        return dd();
        return redirect()->route('admin.patients.index')->withStatus(__('Patient successfully deleted.'));

    }

    public function massDestroy(MassDestroyPatientRequest $request)
    {
        Patients::whereIn('id', request('ids'))->delete();
        $user_ids = DB::table('patients')->whereIn('id', request('ids'))->get('user_id');
        foreach ($user_ids as $user_id){
            DB::table('users')
                ->where('id', $user_id->user_id)
                ->update(['registered' => false]);

        }


        return response(null, Response::HTTP_NO_CONTENT);

    }

}
