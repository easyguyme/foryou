<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class StoreExerciseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        abort_if(Gate::denies('exercise_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=> ['required','min:3'],
            'description'=>['required','min:3'],
            'instruction'=>['required','min:1'],
            'tags'=>['required','min:3'],
            'photo_start'=>['required','image','mimes:jpeg,png,jpg,gif,svg,PNG','max:20480'],
            'photo_end'=>['image','mimes:jpeg,png,jpg,gif,svg,PNG','max:20480'],
            'video'=>['mimetypes:video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi','max:30000'],
        ];
    }
}
