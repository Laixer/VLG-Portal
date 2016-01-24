<?php

namespace App\Http\Controllers;

use \Auth;
use \Hash;
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
     * Show the application dashboard.
     *
     * @return Response
     */
    public function log()
    {
        return view('log');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function company()
    {
        if (!Auth::user()->company) {
            return redirect('/');
        }

        return view('company');
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
            'password' => 'confirmed|min:5',
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
