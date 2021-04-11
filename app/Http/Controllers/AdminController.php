<?php

namespace App\Http\Controllers;


use App\Models\Admin;
use App\Models\Admin_accounts_verification;
use App\Http\Controllers\send;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\mail;
use App\Mail\SendMail;
use App\Models\Admin_password_reset;

class AdminController extends Controller
{
    function login()
    {
        return view('admin.login');
    }
    function registration()
    {
        return view('admin.registration');
    }
    function save(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:5|max:10',
            'confirmPassword' => 'required|min:5|max:10',
            'TermsAndConditions' => 'required',
        ]);
        if ($request->password == $request->confirmPassword) {
            $admin = new Admin();
            $admin->name = $request->name;
            $admin->password = Hash::make($request->password);
            $admin->email = $request->email;
            $verification_slug = time() . '-' . date("Y.m.d") . '-varification-of-' . $request->name;
            $save = $admin->save();

            $admin_accounts_verification = new Admin_accounts_verification();
            $admin_accounts_verification->verification_slug = $verification_slug;
            $admin_accounts_verification->admin_id = $admin->id;
            $admin_accounts_verification->save();

            $data = array(
                'name' => $request->name,
                'email' => $request->email,
                'verification_slug' => $verification_slug,
            );
            $Template = 'admin.email-verification';
            Mail::to($request->email)->send(new SendMail($data,$Template));

            if ($save) {
                return redirect('admin/login')->with('success', 'Hello! ' . $request->name . ' - A verification link is send on your email. Please verify your id first');
            } else {
                return back()->with('fails', $request->name . ' your details is failed to insert');
            }
        }
        if ($request->password != $request->confirmPassword) {
            return view('admin.registration', ['wrongpassword' => 'Password didt match']);
        }
    }
    function check(Request $request)
    {
        $request->validate([

            'email' => 'required|email',
            'password' => 'required|min:5|max:10',

        ]);
        $adminInfo = Admin::where([['email', '=', $request->email], ['email_verification', '=', 1]])->first();
        if (!$adminInfo) {
            return back()->with("EmailNotRecognize", "We don't recognize your email");
        } else {
            if (Hash::check($request->password, $adminInfo->password)) {
                $request->session()->put('LoggedAdmin', $adminInfo->id);
                return redirect('admin/dashboard');
            } else {
                return back()->with('IncorrctPassword', 'Your password Is Incorrect');
            }
        }
    }
    function logout()
    {
        if (session()->has('LoggedAdmin')) {
            session()->pull('LoggedAdmin');
            return redirect('admin/login');
        }
    }
    function dashboard()
    {
        // dd(session('LoggedAdmin'));
        $adminData = ['LoggedAdminInfo' => Admin::where('id', '=', session('LoggedAdmin'))->first()];
        return view('admin/dashboard', $adminData);
    }
    function send($name, $email)
    {
        $data = array(
            'name' => $name,
            'name' => $email,
        );
        $Template = 'dynamicTemplate';
        #Mail::to($email)->send(new SendMail($data,$Template));
    }
    function account_verification($slug)
    {
        $Admin_accounts_verification_Info = Admin_accounts_verification::where('verification_slug', '=', $slug)->first();
        if ($Admin_accounts_verification_Info) {
            session()->put('LoggedAdmin', $Admin_accounts_verification_Info->admin_id);
            $adminInfo = Admin::where('id', '=', $Admin_accounts_verification_Info->admin_id)->first();
            $adminInfo->email_verification = 1;
            $adminInfo->save();
            $Admin_accounts_verification_Info->delete();
            return redirect('admin/dashboard');
        }
        if (!$Admin_accounts_verification_Info) {
            return redirect('admin/dashboard');
        }
    }

    function reset_request_get(Request $request)
    {

        return view('admin.forgot-password');
    }

    function reset_request_post(Request $request)
    {

        $request->validate([

            'email' => 'required|email',

        ]);
        $adminInfo = Admin::where([['email', '=', $request->email], ['email_verification', '=', 1]])->first();
        if (!$adminInfo) {
            return back()->with("EmailNotRecognize", "We don't recognize your email");
        }
        if ($adminInfo) {
            $admin_password_reset = new Admin_password_reset();
            $admin_password_reset->admin_id = $adminInfo->id;
            $password_reset_slug = time() . '-' . date("Y.m.d") . '-password-reset-link-of-' . $request->email;
            $admin_password_reset->password_reset_slug = $password_reset_slug;
            $admin_password_reset->save();
            $data = array(

                'email' => $request->email,
                'password_reset_slug' => $password_reset_slug,
            );
            $Template = 'admin.password-reset-link';
            Mail::to($request->email)->send(new SendMail($data,$Template));
            return back()->with('link-send', 'link is send on your email account. ');
        }
        // return view('admin.forgot-password');
    }

    function reset_form($slug)
    {
        $Admin_password_reset_Info = Admin_password_reset::where('password_reset_slug', '=', $slug)->first();
        if ($Admin_password_reset_Info) {


            return view('admin.password-reset', ['slug' => $slug]);
        }
        if (!$Admin_password_reset_Info) {
            return redirect('admin/login')->with('invalidlink', 'Dont enter any kind of invalid link');
        }
    }

    function reset(Request $request, $slug)
    {
        $request->validate([

            'password' => 'required|min:5|max:10',
            'confirmPassword' => 'required|min:5|max:10',

        ]);
        if ($request->password == $request->confirmPassword) {
            $Admin_password_reset_Info = Admin_password_reset::where('password_reset_slug', '=', $slug)->first();
            session()->put('ResetAdminPassword', $Admin_password_reset_Info->admin_id);
            $Admin_password_reset_Info->delete();

            $adminInfo = Admin::where('id', '=', session('ResetAdminPassword'))->first();
            $adminInfo->password =  Hash::make($request->password);
            $adminInfo->save();
            session()->put('LoggedAdmin', session('ResetAdminPassword'));
            session()->pull('ResetAdminPassword');
            return redirect('admin/dashboard');
        }
        if ($request->password != $request->confirmPassword) {
            return view('admin.password-reset', ['slug' => $slug, 'wrongpassword' => 'Password didt match']);
        }
    }
}
