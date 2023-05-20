<?php

namespace App\Http\Controllers\Auth;

use App\Services\ApiService;
use App\Facades\CorporateClientService;
use App\Facades\PersonClientService;
use App\Helpers\General\EndPoints;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\ResetPasswordMail;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function sendEmail(Request $request)
    {
        $email = $request->email;
        // Get reset password Token
        $response = $this->saveToken($email);
        if ($response['hasErrors']) {
            return $this->invalidResponse($response['validationErrors'][0]['errors'][0]);
        }
        $token = $response['result'];
        // store the origin token with session to reuse it with reset password form
        if (!session()->has('resetPasswordToken')) {
            session()->put('resetPasswordToken', $token);
        } else {
            session()->forget('resetPasswordToken');
            session()->put('resetPasswordToken', $token);
        }
        // remove the slash '/' from token to can use it with route only
        $tokenWithoutSlash = str_replace('/', '', $token);
        // Send an email to the user with token that don't have a slash '/'
        $this->send($email, $tokenWithoutSlash);
        return $this->successResponse();
    }

    // Send The Email
    private function send($email, $token) {
        Mail::to($email)->send(new ResetPasswordMail($token));
    }

    // Send Message In Json Type If There Is An Error
    private function failedResponse() {
        return back()->with('error', trans('auth.email-not-exists'));
    }

    // Send Success Message In Json Type
    private function successResponse() {
        return back()->with('success', trans('auth.reset-success-password') );
    }

    // Send Message In Json Type If There Is An Error
    private function failedSaveToken() {
        return back()->with('error', trans('product.server-error-msg'));
    }

    private function invalidResponse($message = null)
    {
        return back()->with('error', is_null($message) ? trans('auth.invalid-data') : trans('validation-messages.' . $message));
    }

    private function generateToken($email) {
        return base64_encode($email . config('app.key') . Carbon::now()->format('Y-m-d h:i:s'));
    }

    // Save The Custom Token We Created Inside DataBase
    private function saveToken($email)
    {
        try {
            $data = [ 'email' => $email ];
            return ApiService::PostDataByEndPoint(EndPoints::saveVerificationCodeApi, $data, session('mainToken'));
        } catch(\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
