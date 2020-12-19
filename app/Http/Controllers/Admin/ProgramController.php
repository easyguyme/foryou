<?php

namespace App\Http\Controllers\Admin;

use App\Exercise;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDeleteProgramRequest;
use App\Http\Requests\MassDestroyProgramRequest;

use App\Program;
use App\Project;
use DB;
use Gate;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\DocBlock\Tags\Property;
use Symfony\Component\HttpFoundation\Response;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('project_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $projects = Program::all();
//        return $projects;
        return view('admin.programs.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('program_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $exercises = Exercise::all();

        return view('admin.programs.create', compact('exercises'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $program = Program::find($id);
        $exercise_ids = Project::where('program_id',$id)->get('exercise_id');
        $exercises = array();
        foreach($exercise_ids as $exercise){
            $response = Exercise::where('id',$exercise->exercise_id)->get();
//            $exercises = $response;
            array_push($exercises,$response[0]);
        }
        return view('admin.programs.show', compact('exercises','program'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_if(Gate::denies('program_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $programs =Program::findorFail($id);
        return view('admin.programs.edit', compact( 'programs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $data = request()->except(['_token', '_method']);
        Program::whereId($id)->update($data);
        return redirect()->route('admin.programs.index')->withStatus(__('Program successfully updated.'));
    }




    public function massAdd(Request $request)
    {

        $datas = request()->except(['_token', '_method']);

        $exercises = $request->exercise_id;
        $data = new Program;
        $data->name = $request->name;
        $data->description = $request->description;
        $data->tags = $request->tags;
        $data->save();
        $datas['created_by'] = auth()->user()->name;
        $datas['program_id']=$data->id;
        //now attach the program to the projects to create workouts
        foreach ($exercises as $exercise){

            $datas['exercise_id']=$exercise;
//
                Project::create($datas);

        }
        return response()->json(array('success' => true,'message' => "Added successfully!"), 200);



    }

    public function destroy($id)
    {
        abort_if(Gate::denies('program_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patient =Program::findOrFail($id);


        $patient->delete();
//        return dd();
        return redirect()->route('admin.programs.index')->withStatus(__('Program successfully deleted.'));

    }

    public function massDestroy(MassDestroyProgramRequest $request)
    {
        Program::whereIn('id', request('ids'))->delete();


        return response(null, Response::HTTP_NO_CONTENT);

    }

    public function getId($id){
        abort_if(Gate::denies('program_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $program =Program::findorFail($id);
        $exercises = Exercise::all();
        return view('admin.programs.update', compact('exercises','program'));
    }


    public function massUpdate(Request $request)
    {

        $datas = request()->except(['_token', '_method']);

        $exercises = $request->exercise_id;

        $datas['created_by'] = auth()->user()->name;
        $datas['program_id']=$request->program_id;
        //now attach the program to the projects to create workouts
        foreach ($exercises as $exercise){

            $datas['exercise_id']=$exercise;

            Project::firstOrCreate($datas
            );


        }
        return response()->json(array('success' => true,'message' => "Added successfully!"), 200);



    }

    public function massDelete(MassDeleteProgramRequest $request)
    {
        Project::whereIn('exercise_id', request('id'))->delete();
//
//
//        return response(null, Response::HTTP_NO_CONTENT);
        return response()->json(array('success' => true,'message' => "Deleted successfully!"), 200);
    }

}
