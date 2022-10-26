<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\HelperFunctions;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Services\Interfaces\IActivityService;
use App\Contract\Responses\DefaultApiResponse;
use App\Http\Requests\AssignActivityRequest;
use App\Http\Requests\CreateActivityRequest;
use App\Http\Requests\GetUserActivityRequest;
use App\Http\Requests\UpdateActivityRequest;
use App\Models\Activity;
use App\Models\User;

class ActivityController extends Controller
{
    public DefaultApiResponse $response;
    public IActivityService $iActivityService;
    public function __construct(IActivityService $iActivityService)
    {
        $this->response = new DefaultApiResponse();
        $this->iActivityService = $iActivityService;
    }
    //
    public function index()
    {
        return view('activity.activities', [
            'activities' => $this->iActivityService->getAllGlobalActivities(),
            'users' => User::where('role','user')->get()
        ]);
    }

    public function delete($id)
    {
        $arrayInSession = HelperFunctions::returnAllInSession();
        if ($arrayInSession[1] !== 'admin') {
            return redirect('/')->with('message', "Only Admin is Allowed");

        }
        $this->iActivityService->deleteActivity($id);
        return redirect('/home')->with('message', "Activity Deleted");
    }

    public function getById($id)
    {
        $value = $this->iActivityService->getById($id);
        return view('activity.edit', [
            'activity' => $value,
            'users' => User::where('role','user')->get()
        ]);
    }
    
    public function updateActivity(UpdateActivityRequest $request)
    {
        $arrayInSession = HelperFunctions::returnAllInSession();
        if ($arrayInSession[1] !== 'admin') {
            return redirect('/')->with('message', "Only Admin is Allowed");

        }
        $id = $request->id;
        Log::info($request->all());
        $this->iActivityService->updateGlobalActivity($request,$id);
        return redirect('/home')->with('message', "Successful");
    }

    public function getUserActivities(GetUserActivityRequest $request)
    {
        $activities = $this->iActivityService->getActivityForUser($request->userId);
        return view('activity.userActivities', [
            'activities' => $activities,
            'users' => User::where('role','user')->get()
        ]);
    }

    public function assignActivity(AssignActivityRequest $request)
    {
        $arrayInSession = HelperFunctions::returnAllInSession();
        if ($arrayInSession[1] !== 'admin') {
            return redirect('/')->with('message', "Only Admin is Allowed");

        }
        $this->iActivityService->assignGlobalToIndividual($request->id,$request->userId);
        return redirect('/home')->with('message', "Successful");
    }

    public function store(CreateActivityRequest $request)
    {
        $arrayInSession = HelperFunctions::returnAllInSession();
        if ($arrayInSession[1] !== 'admin') {
            return redirect('/')->with('message', "Only Admin is Allowed");

        }
        $request->date = date('d/m/Y', strtotime($request->date));

        $response = $this->iActivityService->create($request);
        Log::info(json_encode($response));

        if ($response->isSuccessful) {
            return redirect('/home')->with('message', $response->message);
        }
        return redirect('/home')->with('message', $response->message);
    }
}

