<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminLoginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    /**
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function index()
    {
        return view('auth.admin.login');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        // $user=User::find(1);
        // $user->update(["password"=>Hash::make("password")]);
        // return 'done';

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
            // 'g-recaptcha-response' => 'required|captcha'
        ]);
        // return $request->all();

        if (Auth::guard('admin')->attempt(
            [
                'email' => $request->email,
                'password' => $request->password
            ],
            $request->get('remember'))) {

            return redirect()->intended('/admin-ui');
        }

        return back()->withErrors(['password' => [trans('auth.failed')]])->withInput($request->only('email', 'remember'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::guard('admin')->logout();
        return redirect()->intended('/admin-ui');
    }
}
