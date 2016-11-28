<?php

namespace App\Http\Controllers;

use \Auth;
use App\User;
use App\Audit;
use App\Application;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'doLogout']);
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function loginForm(Request $request)
    {
        if ($request->session()->has('sso')) {
            $request->session()->forget('sso');
        }

        if ($request->get('token')
                && $request->get('endpoint')
                && $request->get('timestamp')
                && $request->get('auth')) {
            if ($request->get('timestamp') > (time()-900) && $request->get('timestamp') < (time()+2) && $request->get('auth') == 'jwtgssauth') {
                $app = Application::where('public_token', $request->get('token'))->where('domain', $request->get('endpoint'))->first();
                if ($app) {
                    $request->session()->put('sso', $app);
                }
            }
        }

        return view('auth.login');
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  bool  $throttles
     * @return \Illuminate\Http\Response
     */
    protected function handleRedirect(Request $request, $throttles = null)
    {
        if ($request->session()->has('sso')) {
            $endpoint = $request->session()->get('sso')->getEndpointUrl();

            $audit = new Audit;
            $audit->payload = 'SSO via ' . $request->session()->get('sso')->domain;
            $audit->user_id = Auth::id();
            $audit->save();

            $request->session()->forget('sso');
            return redirect($endpoint);
        }

        return redirect()->intended($this->redirectPath());
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function doLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials['email'] = $request->get('email');
        $credentials['password'] = $request->get('password');
        $credentials['active'] = true;

        if (Auth::attempt($credentials, $request->has('remember'))) {

            $audit = new Audit;
            $audit->payload = 'Login';
            $audit->user_id = Auth::id();
            $audit->save();

            return $this->handleRedirect($request);
        }

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Log the user out of the application
     *
     * @return Response
     */
    public function doLogout()
    {
        $audit = new Audit;
        $audit->payload = 'Logout';
        $audit->user_id = Auth::user()->id;
        $audit->save();

        Auth::logout();

        return redirect('/login');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

}
