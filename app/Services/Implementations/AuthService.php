<?php
namespace App\Services\Implementations;

use App\Models\User;
use App\Helpers\HelperFunctions;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Session;
use App\Services\Interfaces\IAuthService;
use App\Http\Requests\UserActivityRequest;
use App\Http\Requests\RegisterAdminRequest;
use App\Contract\Responses\DefaultApiResponse;
use App\Models\Activity;

class AuthService implements IAuthService
{
    public DefaultApiResponse $response;
    public function __construct()
    {
        $this->response = new DefaultApiResponse();
    }

    public function register(RegisterRequest $request): DefaultApiResponse
    {
        $encryptPassword = HelperFunctions::encryptValue($request->password);
        $userInstance = new User();
        $userInstance->AddUser($request, $encryptPassword);
        $this->response->responseCode = '0';
        $this->response->message = "New User Created";
        $this->response->isSuccessful = true;
        return $this->response;
    }

    public function login(LoginRequest $request): DefaultApiResponse
    {
        $user = User::where('email', $request->email)->first();
        if (empty($user)) {
            $this->response->responseCode = '1';
            $this->response->message = "Invalid Credentials";
            $x = 1;
            return $this->response;
        }
        //check password
        $decryptedPassFromDB = HelperFunctions::decryptValue($user->password);
        
        $isPasswordValid = HelperFunctions::compareValues($decryptedPassFromDB, $request->password);
        if (!$isPasswordValid) {
            $this->response->responseCode = '1';
            $this->response->message = "Invalid Credentials";
            return $this->response;
        }
        $token = $user->createToken('myapptoken')->plainTextToken;

        HelperFunctions::saveToSession($token, $user);

        $this->response->responseCode = '0';
        $this->response->message = "Welcome " . $request->email;
        $this->response->isSuccessful = true;
        $this->response->data = [
            'token' => $token
        ];
        return $this->response;
    }

    public function registerAdmin(RegisterAdminRequest $request): DefaultApiResponse
    {
        $encryptPassword = HelperFunctions::encryptValue($request->password);
        $userInstance = new User();
        $userInstance->AddAdminUser($request, $encryptPassword);
        $this->response->responseCode = '0';
        $this->response->message = "New Admin Created";
        $this->response->isSuccessful = true;
        return $this->response;
    }

    public function getUserActivity(UserActivityRequest $request): DefaultApiResponse
    {
        $userObject = HelperFunctions::getLoggedInUser($request);
        if (empty($userObject)) {
            $this->response->responseCode = '1';
            $this->response->message = "No Auth Header";
            return $this->response;
        }
        $allActivites = [];
        $strtDate = date($request->startDate);
        $endDate = date($request->endDate);
        $globalActivity = Activity::whereBetween('date', [$strtDate, $endDate])->where('type', 'G')->get();
        $privateActForUser = Activity::whereBetween('date', [$strtDate, $endDate])->where('user_id', $userObject->id)->get();
        // $privateActForUser = Activity::where('user_id', $userObject->id)->get();
        //loop through the private and find user and task 
        foreach ($globalActivity as $value) {
            array_push($allActivites, $value);
        }
        foreach ($privateActForUser as $value) {
            array_push($allActivites, $value);
        }
        $this->response->responseCode = '0';
        $this->response->message = "Retrieved";
        $this->response->data = $allActivites;
        $this->response->isSuccessful = true;
        return $this->response;

    }

    // public function logout(LoginRequest $request): DefaultApiResponse
    // {
    //     auth()->user()->tokens()->delete();

    //     return [
    //         'message' => 'Logged Out'
    //     ];
    // }
}