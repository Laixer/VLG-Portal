<?php

namespace App\Http\Controllers;

use \Auth;
use \Hash;
use \DB;
use App\Http\Requests;
use App\Faq;
use App\Session;
use App\User;
use App\Company;
use App\Application;
use App\Audit;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth.admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function users()
    {
        return view('admin_users');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function companies()
    {
        return view('admin_organisations');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function sessions()
    {
        return view('admin_sessions');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function applications()
    {
        return view('admin_applications');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function newUser()
    {
        return view('admin_user_new');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function log()
    {
        return view('admin_log');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function editUser(Request $request)
    {
        $user = User::find($request->get('id'));
        return view('admin_user_edit', ['user' => $user]);
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function newCompany()
    {
        return view('admin_organisation_new');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function newApplication()
    {
        return view('admin_application_new');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function editCompany(Request $request)
    {
        $company = Company::find($request->get('id'));
        return view('admin_organisation_edit', ['company' => $company]);
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function AddNewUser(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
            'mobile' => 'required',
            'user_type' => 'required|numeric',
            'user_function' => 'required|numeric',
        ]);

        $user = new User;
        $user->name = $request->input('name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));

        if ($request->input('phone'))
            $user->phone = $request->input('phone');

        $user->mobile = $request->input('mobile');
        $user->user_type_id = $request->input('user_type');
        $user->functions_id = $request->input('user_function');

        if (!$request->input('active'))
            $user->active = false;

        $user->save();

        $audit = new Audit;
        $audit->payload = 'Gebruiker "' . $user->name . '" aangemaakt';
        $audit->user_id = Auth::id();
        $audit->save();

        return back()->with('success', 'Gebruiker is aangemaakt');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function addApplication(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'application' => 'required',
        ]);

        $user = User::find($request->input('id'));
        $application = Application::find($request->input('application'));

        $pivot = array();
        if (!$request->input('permission_read'))
            $pivot['read'] = false;
        else
            $pivot['read'] = true;

        if (!$request->input('permission_write'))
            $pivot['write'] = false;
        else
            $pivot['write'] = true;

        $user->applications()->save($application, $pivot);

        $audit = new Audit;
        $audit->payload = 'Applicatie "' . $application->name . '" aangemaakt';
        $audit->user_id = Auth::id();
        $audit->save();

        return back()->with('success', 'Applicatie aan gebruiker toegevoegd');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function deleteFaq(Request $request)
    {
        Faq::destroy($request->input('id'));

        return back()->with('success', 'Faq item verwijderd');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function removeApplication(Request $request)
    {
        DB::table('application_user')->where('id', $request->get('id'))->delete();

        $audit = new Audit;
        $audit->payload = 'Applicatierechten verwijderd';
        $audit->user_id = Auth::id();
        $audit->save();

        return back()->with('success', 'Applicatie van gebruiker verwijderd');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function deleteApplication(Request $request)
    {
        $this->validate($request, [
            'application' => 'required',
        ]);

        $application = Application::find($request->input('application'));
        $application->active = false;

        $application->save();

        $audit = new Audit;
        $audit->payload = 'Applicatie "' . $application->name . '" gedecativeerd';
        $audit->user_id = Auth::id();
        $audit->save();

        return back()->with('success', 'Applicatie gedecativeerd');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function updateUser(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required',
            'user_type' => 'required|numeric',
            'user_function' => 'required|numeric',
        ]);

        $user = User::find($request->input('id'));
        $user->name = $request->input('name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');

        if ($request->input('password'))
            $user->password = Hash::make($request->input('password'));

        if ($request->input('phone'))
            $user->phone = $request->input('phone');

        $user->mobile = $request->input('mobile');
        $user->user_type_id = $request->input('user_type');
        $user->functions_id = $request->input('user_function');

        if (!$request->input('active'))
            $user->active = false;
        else
            $user->active = true;

        if ($request->input('company') > 0)
            $user->companies_id = $request->input('company');
        else
            $user->companies_id = null;

        $user->save();

        $audit = new Audit;
        $audit->payload = 'Gebruiker "' . $user->name . '" aangepast';
        $audit->user_id = Auth::id();
        $audit->save();

        return back()->with('success', 'Instellingen opgeslagen');
    }


    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function newFaqItem(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
        ]);

        $faq = new Faq;
        $faq->name = $request->input('name');
        $faq->description = $request->input('description');

        $faq->save();

        $audit = new Audit;
        $audit->payload = 'FAQ item "' . $faq->name . '" toegevoegd';
        $audit->user_id = Auth::id();
        $audit->save();

        return back();
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function terminateSession(Request $request)
    {
        $this->validate($request, [
            'session' => 'required',
        ]);

        Session::destroy($request->input('session'));

        $audit = new Audit;
        $audit->payload = 'SessieID "' . $request->input('session') . '" verwijderd';
        $audit->user_id = Auth::id();
        $audit->save();

        return back();
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function AddNewCompany(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'post_address' => 'required',
            'post_address_number' => 'required',
            'post_postal' => 'required',
            'website' => 'required|url',
            'email' => 'required|email',
        ]);

        $company = new Company;
        $company->name = $request->input('name');

        if ($request->input('visit_address'))
            $company->visit_address = $request->input('visit_address');
        if ($request->input('visit_address_number'))
            $company->visit_address_number = $request->input('visit_address_number');
        if ($request->input('visit_postal'))
            $company->visit_postal = $request->input('visit_postal');

        $company->post_address = $request->input('post_address');
        $company->post_address_number = $request->input('post_address_number');
        $company->post_postal = $request->input('post_postal');

        if ($request->input('postbox'))
            $company->postbox = $request->input('postbox');

        if ($request->input('phone'))
            $company->phone = $request->input('phone');

        $company->website = $request->input('website');
        $company->email = $request->input('email');

        if (!$request->input('active'))
            $company->active = false;

        $company->save();

        $audit = new Audit;
        $audit->payload = 'Organisatie "' . $company->name . '" toegevoegd';
        $audit->user_id = Auth::id();
        $audit->save();

        return back()->with('success', 'Organisatie is aangemaakt');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function updateCompany(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'name' => 'required',
            'post_address' => 'required',
            'post_address_number' => 'required',
            'post_postal' => 'required',
            'website' => 'required|url',
            'email' => 'required|email',
        ]);

        $company = Company::find($request->input('id'));
        $company->name = $request->input('name');

        if ($request->input('visit_address'))
            $company->visit_address = $request->input('visit_address');
        if ($request->input('visit_address_number'))
            $company->visit_address_number = $request->input('visit_address_number');
        if ($request->input('visit_postal'))
            $company->visit_postal = $request->input('visit_postal');

        $company->post_address = $request->input('post_address');
        $company->post_address_number = $request->input('post_address_number');
        $company->post_postal = $request->input('post_postal');

        if ($request->input('postbox'))
            $company->postbox = $request->input('postbox');

        if ($request->input('phone'))
            $company->phone = $request->input('phone');

        $company->website = $request->input('website');
        $company->email = $request->input('email');

        if (!$request->input('active'))
            $company->active = false;
        else
            $company->active = true;

        $company->save();

        $audit = new Audit;
        $audit->payload = 'Organisatie "' . $company->name . '" aangepast';
        $audit->user_id = Auth::id();
        $audit->save();

        return back()->with('success', 'Organisatie aangepast');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function AddNewApplication(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'domain' => 'required',
            'icon' => 'required',
            'color' => 'required',
            'private_token' => 'required|size:40',
        ]);

        $application = new Application;
        $application->name = $request->input('name');
        $application->domain = $request->input('domain');
        $application->icon = $request->input('icon');
        $application->color = $request->input('color');
        $application->private_token = $request->input('private_token');

        if (!$request->input('active'))
            $application->active = false;

        $application->save();

        $audit = new Audit;
        $audit->payload = 'Applicatie "' . $application->name . '" toegevoegd';
        $audit->user_id = Auth::id();
        $audit->save();

        return back()->with('success', 'Applicatie is aangemaakt');
    }

}
