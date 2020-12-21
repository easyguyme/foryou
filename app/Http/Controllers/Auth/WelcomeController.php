<?php

namespace App\Http\Controllers\Auth;
use App\Patients;
use App\Program;
use Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\WelcomeNotification\WelcomeController as BaseWelcomeController;
class WelcomeController extends BaseWelcomeController
{
    public function sendPasswordSavedResponse(): Response

    {

        $id = auth()->user()->id;
//        return redirect()->route('admin.workouts.show');
        return redirect()->route('admin.profile.edit',$id);
    }
}
