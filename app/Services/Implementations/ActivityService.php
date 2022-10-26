<?php
namespace App\Services\Implementations;

use App\Http\Requests\CreateActivityRequest;
use App\Services\Interfaces\IActivityService;
use App\Contract\Responses\DefaultApiResponse;
use App\Helpers\HelperFunctions;
use App\Http\Requests\UpdateActivityRequest;
use App\Models\Activity;
use App\Models\PrivateActivity;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class ActivityService implements IActivityService
{
    public DefaultApiResponse $response;
    public function __construct()
    {
        $this->response = new DefaultApiResponse();
    }
    
    public function create(CreateActivityRequest $request): DefaultApiResponse
    {
        // $userEmail[2] = HelperFunctions::returnAllInSession();
        // $userId = HelperFunctions::getUserIdbyEmail($userEmail[2]);
        $activityInstance = new Activity();
        if ($request->hasFile('image') || $request->image !== null || $request->image !== "") {
            $request->image = $request->file('image')->store('image', 'public');
        }else{
            $request->image = "";
        }
        //check if logged in User has created more than 4 activities for global
        if ($request->type == "G") {
            //get all activities of the user for the day
            $count = HelperFunctions::getAllActivitiesForTheDay($request->date);
            Log::info('count ' . $count);
            if ($count > 4) {
                $this->response->responseCode = '1';
                $this->response->message = "Number of count is more than 4";
                return $this->response;
            }else{
                $activityInstance->AddActivity($request);
                $this->response->responseCode = '0';
                $this->response->message = "New Activity Created";
                $this->response->isSuccessful = true;
                return $this->response;
            }
        }
        else{
            $activityInstance->AddActivity2($request);
            // $privateActivityInstance->AddPrivateActivity($activitySaved->task_id, $userId);
            $this->response->responseCode = '0';
            $this->response->message = "New Activity Created";
            $this->response->isSuccessful = true;
            return $this->response;
        }
        
    }

    public function getAllGlobalActivities()
    {
        return Activity::where('type', 'G')->get();
    }

    public function deleteActivity($id)
    {
        $activity = Activity::find($id);
        $activity->delete();
    }

    public function getActivityForUser($userId)
    {
        $allActivites = [];
        $globalActivity = Activity::where('type', 'G')->get();
        $privateActForUser = Activity::where('user_id', $userId)->get();
        //loop through the private and find user and task 
        foreach ($globalActivity as $value) {
            array_push($allActivites, $value);
        }
        foreach ($privateActForUser as $value) {
            array_push($allActivites, $value);
        }
        return $allActivites;

    }
    public function getById($id)
    {
        return Activity::where('id', $id)->first();
    }

    public function findNameByID($userID)
    {
        $user = User::where('id', $userID)->first();
        return $user->email;
    }

    public function updateGlobalActivity(UpdateActivityRequest $request, $id)
    {
        $activityInstance = new Activity();
        Log::info($id);
        $fromDb = Activity::where('id', $id)->first();
        Log::info($fromDb);
        $activityInstance->UpdateActivity($fromDb , $request);

    }
    public function assignGlobalToIndividual($id, $userId)
    {
        $fromDb = Activity::where('id', $id)->first();
        $activityInstance = new Activity();
        $activityInstance->AssignToUser($fromDb, $userId);
    }
}