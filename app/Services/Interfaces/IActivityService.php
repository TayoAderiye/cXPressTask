<?php
namespace App\Services\Interfaces;

use App\Contract\Responses\DefaultApiResponse;
use App\Http\Requests\CreateActivityRequest;
use App\Http\Requests\UpdateActivityRequest;

interface IActivityService 
{
    public function create(CreateActivityRequest $request): DefaultApiResponse;
    public function getAllGlobalActivities();
    public function deleteActivity($id);
    public function getById($id);
    public function updateGlobalActivity(UpdateActivityRequest $request,$id);
    public function assignGlobalToIndividual($id, $userId);
    public function getActivityForUser($userId);
    // public function login(LoginRequest $request): DefaultApiResponse;
}