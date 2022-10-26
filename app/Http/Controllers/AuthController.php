<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\Interfaces\IAuthService;
use App\Contract\Responses\DefaultApiResponse;

class AuthController extends Controller
{
    public DefaultApiResponse $response;
    public IAuthService $iAuthService;
    public function __construct(IAuthService $iAuthService)
    {
        $this->response = new DefaultApiResponse();
        $this->iAuthService = $iAuthService;
    }

    public function index()
    {
        return view('Auth.register');
    }

    public function index2()
    {
        return view('Auth.login');
    }

    public function register(RegisterRequest $request)
    {
        $response = $this->iAuthService->register($request);
        if ($response->isSuccessful) {
            return redirect('/login')->with('message', $response->message);
        }
        return redirect('/')->with('message', $response->message);
    }

    public function login(LoginRequest $request)
    {
        $response = $this->iAuthService->login($request);
        if ($response->isSuccessful) {
            return redirect('/home')->with('message', $response->message);
        }
        return redirect('/login')->with('message', $response->message);
 
    }
}
