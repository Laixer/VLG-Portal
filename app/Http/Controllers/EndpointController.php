<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Application;
use App\User;
use App\Company;
use App\Faq;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class EndpointController extends Controller
{

	public function __construct() {
        $this->middleware('jwt.auth');
	}

    public function getTokenRefresh(Request $request)
    {
        try {

            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

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

        if (!$user->session) {
            return response()->json(['unauthenticated']);
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

        if (!$user->session) {
            return response()->json(['unauthenticated']);
        }

        $user_app = $user->applications()->where('applications.id', $app->id)->first();

        $user['app_read'] =  ($user_app ? $user_app->pivot->read : 0);
        $user['app_write'] = ($user_app ? $user_app->pivot->write : 0);

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

        if (!$user->session) {
            return response()->json(['unauthenticated']);
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

        if (!$user->session) {
            return response()->json(['unauthenticated']);
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

        if (!$user->session) {
            return response()->json(['unauthenticated']);
        }

        $isadmin = $user->isAdmin();
        return response()->json(compact('isadmin'));
    }

    public function getAllFaqs(Request $request)
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

        if (!$user->session) {
            return response()->json(['unauthenticated']);
        }

        $faqs = Faq::all();
        return response()->json(compact('faqs'));
    }

    public function getAllUsers(Request $request)
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

        if (!$user->session) {
            return response()->json(['unauthenticated']);
        }

        /*if (!$user->isAdmin()) {
            return response()->json(['permissions_invalid']);
        }*/

        $users = User::where('active',true)->get();
        return response()->json(compact('users'));
    }

    public function getAllCompanies(Request $request)
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

        if (!$user->session) {
            return response()->json(['unauthenticated']);
        }

        /*if (!$user->isAdmin()) {
            return response()->json(['permissions_invalid']);
        }*/

        $companies = Company::where('active',true)->get();
        return response()->json(compact('companies'));
    }

}
