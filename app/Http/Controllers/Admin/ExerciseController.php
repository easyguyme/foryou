<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Spatie\MediaLibrary\Models\Media;
use App\Exercise;
use App\Http\Requests\StoreExerciseRequest;
use App\Http\Requests\UpdateExeciseRequest;
use App\Patients;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use DB;
use App\Http\Requests\MassDestroyExerciseRequest;
class ExerciseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('exercise_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $exercises = Exercise::all();
        return view('admin.exercises.index', compact('exercises'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('exercise_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.exercises.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $rules = array(
            'name' => 'required|min:3',
            'description' => 'required|min:3',
            'instruction' => 'required|min:3',
            'tags' => 'required|min:1',
            'photo_start' => 'required|image|mimes:jpeg,png,jpg,gif,svg,PNG|max:20480',
            'photo_end' => 'image|mimes:jpeg,png,jpg,gif,svg,PNG|max:20480',
            'video' => 'mimetypes:video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi| max:30000',

        );

        $this->validate($request, $rules);
        $data = request()->except(['_token', '_method']);
        $save = Exercise::create($data);
        $save->addMedia($request->photo_start)->usingName('start')->toMediaCollection('exercises');
        if ($request->has('photo_end')){
            $save->addMedia($request->photo_end)->usingName('end')->toMediaCollection('exercises');
        }
        if ($request->has('video')){
            $save->addMedia($request->video)->usingName('video')->toMediaCollection('exercises');
        }
        return redirect()->route('admin.exercises.index')->withStatus(__('Exercise successfully created.'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Exercise  $exercise
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort_if(Gate::denies('exercise_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $exercise =Exercise::findorFail($id);
                return view('admin.exercises.show',compact('exercise'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Exercise  $exercise
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_if(Gate::denies('exercise_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $exercise =Exercise::findorFail($id);
        return view('admin.exercises.edit', compact( 'exercise'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Exercise  $exercise
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExeciseRequest $request, $id)
    {
        $data = request()->except(['_token', '_method']);
//
        Exercise::whereId($id)->update($data);

        $save= Exercise::find($id);
        if ($request->has('photo_start')){
            try{
            $media = Media::where('model_id',$id)->where('name','start')->firstOrFail();
            $media->delete();
            }catch (\Exception $e){

            }
            $save->addMedia($request->photo_start)->usingName('start')->toMediaCollection('exercises');
        }
        if ($request->has('photo_end')){
            try{
                $media = Media::where('model_id',$id)->where('name','end')->firstOrFail();
                $media->delete();
            }catch (\Exception $e){

            }
            $save->addMedia($request->photo_end)->usingName('end')->toMediaCollection('exercises');
        }
        if ($request->has('video')){
            try{
            $media = Media::where('model_id',$id)->where('name','video')->firstOrFail();
            $media->delete();
        }catch (\Exception $e){

    }
            $save->addMedia($request->video)->usingName('video')->toMediaCollection('exercises');
        }

        return redirect()->route('admin.exercises.index')->withStatus(__('Exercise successfully updated.'));
//return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Exercise  $exercise
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exercise $exercise)
    {
        abort_if(Gate::denies('exercise_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        DB::table('projects')->where('exercise_id',$exercise->id)->delete();
        $exercise->delete();

        return back();
//        return $exercise->id;
    }


    public function massDestroy(MassDestroyExerciseRequest $request)
    {
        Exercise::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
