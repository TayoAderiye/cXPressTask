<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\Interfaces\IAuthService;
use App\Services\Interfaces\IActivityService;
use App\Contract\Responses\DefaultApiResponse;
use App\Http\Requests\RegisterAdminRequest;
use App\Http\Requests\UserActivityRequest;

class ActivityApiController extends Controller
{
    public DefaultApiResponse $response;
    public IActivityService $iActivityService;
    public IAuthService $iAuthService;
    private $test;
    public function __construct(IActivityService $iActivityService, IAuthService $iAuthService)
    {
        $this->response = new DefaultApiResponse();
        $this->iActivityService = $iActivityService;
        $this->iAuthService = $iAuthService;

    }

    public function register(RegisterRequest $request): JsonResponse
    {
        try {
            $response = $this->iAuthService->register($request);
            if ($response->isSuccessful) {
                return response()->json($response, 200);
            }
            return response()->json($response, 400);
        } catch (\Exception $e) {
            $this->response->message = 'Processing Failed, Contact Support';
            $this->response->error = $e->getMessage();
            return response()->json($this->response, 500);
        }
    }

    public function registerAdmin(RegisterAdminRequest $request): JsonResponse
    {
        try {
            $response = $this->iAuthService->registerAdmin($request);
            if ($response->isSuccessful) {
                return response()->json($response, 200);
            }
            return response()->json($response, 400);
        } catch (\Exception $e) {
            $this->response->message = 'Processing Failed, Contact Support';
            $this->response->error = $e->getMessage();
            return response()->json($this->response, 500);
        }
    }

    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $response = $this->iAuthService->login($request);
            if ($response->isSuccessful) {
                return response()->json($response, 200);
            }
            return response()->json($response, 400);
        } catch (\Exception $e) {
            $this->response->message = 'Processing Failed, Contact Support';
            $this->response->error = $e->getMessage();
            return response()->json($this->response, 500);
        }
    }

    public function getUserActivity(UserActivityRequest $request): JsonResponse
    {
        // try {
            $response = $this->iAuthService->getUserActivity($request);
            if ($response->isSuccessful) {
                return response()->json($response, 200);
            }
            return response()->json($response, 400);
        // } catch (\Exception $e) {
        //     $this->response->message = 'Processing Failed, Contact Support';
        //     $this->response->error = $e->getMessage();
        //     return response()->json($this->response, 500);
        // }
    }
    
}
