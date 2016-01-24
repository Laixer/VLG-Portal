<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Application;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class EndpointController extends Controller
{

	public function __construct() {
	   // Apply the jwt.auth middleware to all methods in this controller
	   // except for the authenticate method. We don't want to prevent
	   // the user from retrieving their token if they don't already have it
	   $this->middleware('jwt.auth');
	}

    public function getTokenRefresh(Request $request)
    {
        try {

            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }

        if (!$request->get('privkey')) {
            return response()->json(['application_invalid']);
        }

        $app = Application::where('private_token', $request->get('privkey'))->first();
        if (!$app) {
            return response()->json(['application_invalid']);
        }

        $token = JWTAuth::refresh(JWTAuth::getToken());
        return response()->json(compact('token'));
    }

    public function getUser(Request $request)
    {
        try {

            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }

        if (!$request->get('privkey')) {
            return response()->json(['application_invalid']);
        }

        $app = Application::where('private_token', $request->get('privkey'))->first();
        if (!$app) {
            return response()->json(['application_invalid']);
        }

        return response()->json(compact('user'));
    }

    public function getUserType(Request $request)
    {
        try {

            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }

        if (!$request->get('privkey')) {
            return response()->json(['application_invalid']);
        }

        $app = Application::where('private_token', $request->get('privkey'))->first();
        if (!$app) {
            return response()->json(['application_invalid']);
        }

        $type = $user->type;
        return response()->json(compact('type'));
    }

    public function getUserCompany(Request $request)
    {
        try {

            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }

        if (!$request->get('privkey')) {
            return response()->json(['application_invalid']);
        }

        $app = Application::where('private_token', $request->get('privkey'))->first();
        if (!$app) {
            return response()->json(['application_invalid']);
        }

        $company = $user->company;
        return response()->json(compact('company'));
    }

    public function getUserIsAdmin(Request $request)
    {
        try {

            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }

        if (!$request->get('privkey')) {
            return response()->json(['application_invalid']);
        }

        $app = Application::where('private_token', $request->get('privkey'))->first();
        if (!$app) {
            return response()->json(['application_invalid']);
        }

        $isadmin = $user->isAdmin();
        return response()->json(compact('isadmin'));
    }

}
