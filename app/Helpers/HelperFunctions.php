<?php
namespace App\Helpers;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Laravel\Sanctum\PersonalAccessToken;


class HelperFunctions
{
    public static function encryptValue($value)
    {
        return encrypt($value);
    }

    public static function decryptValue($value)
    {
        return decrypt($value);
    }

    public static function compareValues($value1, $value2)
    {
        if ($value1 != $value2) {
            return false;
        }
        return true;
    }

    public static function saveToSession($token, $user)
    {
        Session::put('token', $token);
        Session::put('role', $user->role);
        Session::put('email', $user->email);
    }

    public static function returnAllInSession(): array
    {
        $token = Session::get('token');
        $role = Session::get('role');
        $email = Session::get('email');
        return array($token, $role, $email);
    }

    public static function cacheDateNow()
    {
        $expiresAt = Carbon::now()->endOfDay();
        Cache::put('', 'value', $expiresAt);
    }

    public static function getLoggedInUser($request)
    {
        $hashedToken = $request->header('Authorization');
        if (empty($hashedToken)) {
            return "";
        }
        if (str_contains($hashedToken, 'Bearer')) {
            $hashedToken = explode(" ", $hashedToken);
            $token = PersonalAccessToken::findToken($hashedToken[1]);
            $user = $token->tokenable;
            return $user;
        }
        $hashedToken = explode(" ", $hashedToken);
        $token = PersonalAccessToken::findToken($hashedToken[0]);
        $user = $token->tokenable;
        return $user;
    }

    public static function getUserIdbyEmail($email)
    {
        $user = User::where('email', $email)->first();
        return $user->id;
    }

    public static function getAllActivitiesForTheDay($date)
    {
        $activities = Activity::where('type', 'G')->where('date',$date)->get();
        return $activities->count();
    }
}