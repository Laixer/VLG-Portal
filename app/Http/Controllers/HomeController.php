<?php

namespace App\Http\Controllers;

use \Auth;
use \Hash;
use \Mail;
use App\Http\Requests;
use App\Audit;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
/*        Mail::send('auth.emails.password', [], function ($m) {
            $m->from('no-reply@rotterdam-vlg.com', 'RotterdamPortal');

            $m->to('yorick17@outlook.com', 'Woei')->subject('Your Reminder!');
        });
*/
        return view('dashboard');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function faq()
    {
        return view('faq');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function account()
    {
        return view('account');
    }

    /**
     * Log the user out of the application
     *
     * @return Response
     */
    public function logout()
    {
        $audit = new Audit;
        $audit->payload = 'Logout';
        $audit->user_id = Auth::user()->id;
        $audit->save();

        Auth::logout();

        return back();
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function accountUpdate(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'password' => 'confirmed',
            'mobile' => 'required',
        ]);

        $user = Auth::user();
        $user->name = $request->input('name');
        $user->last_name = $request->input('last_name');
        
        if ($request->input('password')) {
            if (Auth::validate(['email' => $user->email, 'password' => $request->input('current_password')])) {
                $user->password = Hash::make($request->input('password'));
            } else {
                return back()->withErrors(['current_password' => 'Huidige wachtwoord klopt niet']);
            }
        }

        $user->email = $request->input('email');
        if ($request->input('phone'))
            $user->phone = $request->input('phone');
        $user->mobile = $request->input('mobile');

        $user->save();

        $audit = new Audit;
        $audit->payload = 'Accountgegevens aangepast';
        $audit->user_id = $user->id;
        $audit->save();

        return back()->with('success', 'Account gegevens opgeslagen');
    }
}
