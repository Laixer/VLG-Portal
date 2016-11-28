<?php

namespace App\Http\Controllers;

use \Mail;
use \DB;
use \Hash;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\Audit;
use App\Http\Controllers\Controller;

class ResetController extends Controller
{

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function forgotPassword()
    {
        return view('auth.forgot');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function doNewPassword(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'password' => 'required|confirmed|min:5',
        ]);

        $user = User::find($request->input('id'));
        $user->password = Hash::make($request->input('password'));

        $user->save();

        $audit = new Audit;
        $audit->payload = 'Nieuw wachtwoord via reset mail';
        $audit->user_id = $user->id;
        $audit->save();

        DB::table('password_resets')->where('email', $user->email)->delete();

        return redirect('/login')->with('success', 'Nieuw wachtwoord ingesteld');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function passwordResetForm(Request $request, $token)
    {
    	$users = DB::table('password_resets')->select('email')->where('token', $token)->get();
    	if (count($users) < 1) {
    		return redirect('/');
    	}

        $user = User::where('email', $users[0]->email)->first();

        return view('auth.reset', ['user' => $user, 'token' => $token]);
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function sendResetMail(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->input('email'))->first();
        if (!$user) {
        	return back()->with('success', 'Wachtwoord reset email verstuurd');
        }

        $user->save();

        $token = md5(mt_rand());
		DB::table('password_resets')->insert(
		    ['email' => $user->email, 'token' => $token]
		);

        Mail::send('auth.emails.password', ['user' => $user, 'token' => $token], function ($message) use ($user) {
            $message->subject('Wachtwoord reset');
            $message->from('no-reply@rotterdam-vlg.com', 'VLG Portal');
            $message->to($user->email, $user->formalName());
        });

        $audit = new Audit;
        $audit->payload = 'Wachtwoord reset mail verstuurd';
        $audit->user_id = $user->id;
        $audit->save();

        return back()->with('success', 'Wachtwoord reset email verstuurd');
    }

}
