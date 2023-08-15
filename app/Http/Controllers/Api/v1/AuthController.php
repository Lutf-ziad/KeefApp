<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserOtp;
use App\Traits\MyResponseTrait;
use App\Traits\VerificationMessageTrait;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use MyResponseTrait, VerificationMessageTrait;

    public function login(Request $request)
    {
        $request->validate([
            'phone' => ['required'],
        ]);
        $user = User::where('phone', $request->phone)->first();
        if ($user->status != 1) {
            return $this->ErrorResponse("This user's account has been suspended");
        }
        if ($user->phone_verified != 1) {
            return $this->ErrorResponse("This user's account not verification", [], 10);
        }
        if ($user != null) {
            if ($this->sendSmsOtp($user->id, $user->phone)) {
                return $this->SuccessResponse($user, 'Verification code has been sent to the number : '.$user->phone);
            } else {
                return $this->ErrorResponse('Verification code was not sent !');
            }
        } else {
            return $this->ErrorResponse('The data you entered is incorrect');
        }
    }

    public function loginWithSocial(Request $request)
    {
    }

    public function loginVerificationOtp(Request $request)
    {
        $request->validate([
            'otp' => ['required', 'integer', 'digits:6'],
            'user_id' => ['required', 'exists:users,id'],
        ]);

        $result = $this->verficationOtpFun($request->otp, $request->user_id);
        switch ($result) {
            case 'not match':
                return $this->ErrorResponse('The verification code does not match', null, 5);
                break;
            case 'timeout':
                return $this->ErrorResponse('The verification code timeout has expired', null, 6);
                break;
            case 'success':
                $user = User::find($request->user_id);
                $user->tokens()->delete();
                $result = [
                    'token' => $user->createToken('mobile')->accessToken,
                    'user' => $user,
                ];
                // UserOtp::where("user_id", $user->id)->delete();
                return $this->SuccessResponse($result);
        }
    }

    public function Register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:5', 'regex:/^[A-Za-z. -_]+$/'],
            'phone' => ['required', 'unique:users,phone'],
            'email' => ['nullable', 'email', 'unique:users,email'],
            'picture' => ['nullable', 'file', 'mimes:jpg,png,jpeg,gif,svg'],
            'birthday' => ['nullable', 'date_format:m-d'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'picture' => $request->picture,
            'birthday' => $request->birthday,
        ]);
        if ($user != null) {
            if ($this->sendSmsOtp($user->id, $user->phone)) {
                return $this->SuccessResponse($user, 'Verification code has been sent to the number : '.$user->phone);
            } else {
                return $this->ErrorResponse('Verification code was not sent !');
            }
        } else {
            return $this->ErrorResponse('The account has not been created');
        }
    }

    public function RegisterWithSocial(Request $request)
    {
    }

    public function registerVerificationOtp(Request $request)
    {
        $request->validate([
            'otp' => ['required', 'integer', 'digits:6'],
            'user_id' => ['required', 'exists:users,id'],
        ]);

        $result = $this->verficationOtpFun($request->otp, $request->user_id);
        switch ($result) {
            case 'not match':
                return $this->ErrorResponse('The verification code does not match', null, 5);
                break;
            case 'timeout':
                return $this->ErrorResponse('The verification code timeout has expired', null, 6);
                break;
            case 'success':
                $user = User::find($request->user_id);
                $user->update(['phone_verified' => 1]);
                $user->tokens()->delete();
                $result = [
                    'token' => $user->createToken('mobile')->accessToken,
                    'user' => $user,
                ];
                UserOtp::where('user_id', $user->id)->delete();

                return $this->SuccessResponse($result);
        }
    }

    public function userInfo()
    {
        $result = User::with(['orders', 'packages'])->find(auth()->id());

        return $this->SuccessResponse($result);
    }

    public function sendAnyVerificationOtp(Request $request)
    {
        $request->validate([
            'phone' => ['required'],
        ]);
        $user = User::where('phone', $request->phone)->first();
        if ($user) {
            if ($request->user_id != null) {
                if ($this->sendSmsOtp($user->id, $user->phone)) {
                    return $this->SuccessResponse(null, 'Verification code has been sent to the number : '.$request->phone);
                } else {
                    return $this->ErrorResponse('Verification code was not sent !');
                }
            }
        } else {
            return $this->ErrorResponse('The data you entered is incorrect');
        }
    }

    public function anyVerificationOtp(Request $request)
    {
        $request->validate([
            'otp' => ['required', 'integer', 'digits:6'],
            'user_id' => ['required', 'exists:users,id'],
        ]);

        $result = $this->verficationOtpFun($request->otp, $request->user_id);
        switch ($result) {
            case 'not match':
                return $this->ErrorResponse('The verification code does not match', null, 5);
                break;
            case 'timeout':
                return $this->ErrorResponse('The verification code timeout has expired', null, 6);
                break;
            case 'success':
                $user = User::find($request->user_id);
                $user->tokens()->delete();
                $result = [
                    'token' => $user->createToken('mobile')->accessToken,
                    'user' => $user,
                ];
                UserOtp::where('user_id', $user->id)->delete();

                return $this->SuccessResponse($result);
        }
    }
}
