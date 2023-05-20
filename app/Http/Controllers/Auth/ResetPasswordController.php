<?php

namespace App\Http\Controllers\Auth;

use App\Facades\UserService;
use App\Helpers\General\EndPoints;
use App\Services\ApiService;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showResetForm(Request $request)
    {
        $token = $request->route()->parameter('token');
        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    protected function resetPassword(Request $request)
    {
        try {
            $validator = Validator::make($request->all(),
                [
                    'email' => 'required|email',
                    'password' => ['required', 'confirmed', 'max:20', Password::min(6)],
                    'password_confirmation' => 'required'

                ], [
                    "email.required" => trans('validation.required', ['field' => trans('auth.email')]),
                    "password.required" => trans('validation.required', ['field' => trans('auth.password')]),
                    "password_confirmation.required" => trans('validation.required', ['field' => trans('auth.confirm-password')]),
                    'password.max' => trans('auth.max-password'),
                    'password.min' => trans('auth.min-password'),
                    'password.confirmed' => trans('auth.confirmed-password-msg'),
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator->errors());
            }
            $data = [
                'email' => $request->email,
                'token' => session()->has('resetPasswordToken') ? session('resetPasswordToken') : '',
                'password' => $request->password,
                'confirmPassword' => $request->password_confirmation
            ];
        //    dd($data);
            $response = ApiService::PutDataByEndPoint(EndPoints::ResetPasswordApi, $data, session('mainToken'));
            // dd($response);
            if ($response['hasErrors']) {
                return $this->invalidResponse($response['validationErrors'][0]['errors'][0]);
            }
            if (session()->has('resetPasswordToken')) {
                session()->forget('resetPasswordToken');
            }
            return redirect(App::getLocale() . '/thanks');
        } catch (\Exception $e) {
            return $this->invalidResponse();
        }
    }

    public function thanks($locale = '')
    {
//        $member = UserService::getOne($user_id)->Member;
        $pageInfo['title'] = trans('auth.reset-password');
        return view('auth.passwords.thanks', compact('pageInfo'));
    }


    private function invalidResponse($message = null)
    {
        return back()->with('error', is_null($message) ? trans('auth.invalid-data') : trans('validation-messages.' . $message));
    }


}
