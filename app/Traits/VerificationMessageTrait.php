<?php

namespace App\Traits;

use App\Models\UserOtp;
use Exception;
use Twilio\Rest\Client;

trait VerificationMessageTrait
{
    public function sendSmsOtp($user_id, $phone)
    {

        $otp = rand(123456, 999999);
        $expire_at = now()->addMinutes(10);
        $result = UserOtp::create([
            'user_id' => $user_id,
            'otp' => $otp,
            'expire_at' => $expire_at,
        ]);

        return $this->message($phone, $result->otp);
    }

    public function message($phone, $otp)
    {

        try {
            $message = env('OTP_MESSAGE').$otp;
            $account_sid = env('TWILIO_SID');
            $auth_token = env('TWILIO_AUTH_TOKEN');
            $twilio_number = env('TWILIO_NUMBER');
            $client = new Client($account_sid, $auth_token);
            $client->messages->create($phone, [
                'from' => $twilio_number,
                'body' => $message,
            ]);
            info('SMS Sent Successfully.');

            return true;
        } catch (Exception $e) {
            info('Error: '.$e->getMessage());

            return false;
        }
    }

    public function verficationOtpFun($otp, $user_id)
    {
        $result = UserOtp::where([['user_id', $user_id], ['otp', $otp]])->first();
        if ($result) {
            if ($result->expire_at <= now()) {
                return 'timeout';
            } else {
                return 'success';
            }
        } else {
            return 'not match';
        }
    }
}
