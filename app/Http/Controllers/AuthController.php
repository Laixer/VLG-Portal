<?php

namespace App\Http\Controllers;

use \Auth;
use App\User;
use App\Audit;
use App\Application;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

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
        // ?endpoint=<domain>&token=<public_key>&timestamp=<time()>&auth=jwtgssauth
        if ($request->session()->has('sso')) {
            $request->session()->forget('sso');
        }

        if ($request->get('token') && $request->get('endpoint') && $request->get('timestamp') && $request->get('auth')) {
            if ($request->get('timestamp') > (time()-900) && $request->get('timestamp') < time() && $request->get('auth') == 'jwtgssauth') {
                $app = Application::where('public_token', $request->get('token'))->where('domain', $request->get('endpoint'))->first();
                $request->session()->put('sso', $app);
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
    protected function handleRedirect(Request $request, $throttles)
    {
        if ($throttles) {
            $this->clearLoginAttempts($request);
        }

        if (method_exists($this, 'authenticated')) {
            return $this->authenticated($request, Auth::guard($this->getGuard())->user());
        }

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
            $this->loginUsername() => 'required', 'password' => 'required',
        ]);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $this->hasTooManyLoginAttempts($request)) {
            return $this->sendLockoutResponse($request);
        }

        $credentials = $this->getCredentials($request);
        $credentials['active'] = true;

        if (Auth::guard($this->getGuard())->attempt($credentials, $request->has('remember'))) {

            $audit = new Audit;
            $audit->payload = 'Login';
            $audit->user_id = Auth::id();
            $audit->save();

            return $this->handleRedirect($request, $throttles);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        if ($throttles) {
            $this->incrementLoginAttempts($request);
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
