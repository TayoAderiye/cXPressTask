<?php
namespace App\Services\Interfaces;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Contract\Responses\DefaultApiResponse;
use App\Http\Requests\RegisterAdminRequest;
use App\Http\Requests\UserActivityRequest;

interface IAuthService 
{
    public function register(RegisterRequest $request): DefaultApiResponse;
    public function login(LoginRequest $request): DefaultApiResponse;
    public function registerAdmin(RegisterAdminRequest $request): DefaultApiResponse;
    public function getUserActivity(UserActivityRequest $request): DefaultApiResponse;


    //public function logout(LoginRequest $request): DefaultApiResponse;
}