<?php

namespace Lexontech\AuthenticationSystem\app\Facades\AuthenticationSystem;

use Lexontech\AuthenticationSystem\app\Facades\Carbon;
use Lexontech\AuthenticationSystem\app\Facades\Client;
use Lexontech\AuthenticationSystem\app\Facades\OtpUser;

class SMSFacade
{

    public static function CreateSMSCode()
    {
        $SMSCode = rand(3547, 9856);
        $SMSCode = $SMSCode . "";
        return $SMSCode;
    }

    public static function SendWithPattern($patternCode, $phoneNumber,$array)
    {
        return ;

        $client = new Client(env('SMS_TOKEN'));
        $client->sendPattern($patternCode, env('SMS_NUMBER'), $phoneNumber, $array);


    }

    public static function IsExpire($time)
    {
        $timeNow = \Illuminate\Support\Carbon::parse(now());
        $time = new Carbon($time);

        if ($timeNow < $time)
        {
            return false;
        }
        return true;
    }

    public static function SetOtp($phone,$otp)
    {
        OtpUser::DeleteByPhone($phone);
        $otp = OtpUser::create([
            'Phone' => $phone,
            'Otp' => $otp
        ]);
        return $otp->created_at;
    }

    public static function VerifyOtp($data)
    {

        //$otp => Entered by the user
        $result = OtpUser::FindRow($data);
        if(empty($result))
        {
            return [
                'msg' => 'اطلاعات وارد شده مقایرت ندارد.لطفا مجددا اطلاعات را وارد کنید.',
                'status' => 0,
            ];
        }
        $expire = Carbon::make($result->created_at)->addMinutes(3);
        OtpUser::DeleteByPhone($data['Phone']);
        $now = Carbon::now();
        if($now > $expire)
        {//expired
            return [
                'msg' => 'کد شما منقضی شده لطفا دکمه ارسال مجدد کد را کلیک کنید.',
                'status' => 0,
            ];
        }

        return [
            'msg' => 'به سایت خوش آمدید',
            'status' => 1
        ];
    }

    public static function SendOtp($phone)
    {
        $response       = [
            "status"    => 0,
            "message"   => "سرویس پیامکی با مشکل مواجهه شده است، لطفا بعدا امتحان کنید."
        ];
        $otp            = self::CreateSMSCode();
        $smsResponse   = false;
//         self::SendWithPattern(env('SMS_PATTERN_CODE'),$phone,[
//            'code'      => $otp
//        ]);
        if($smsResponse == false)
        {
            $smsResponse = self::SendSMS_WebOne($phone, $otp);

            if($smsResponse == false)
            {
                return $response;
            }
        }
        $response["status"] = 1;
        $response["message"] = "";
        $dateOtp = self::SetOtp($phone,$otp);
        $response['data'] = [
            'dateOtp' => Carbon::make($dateOtp)->addMinutes(3)->format('H:i:s')
        ];
        return $response;
    }
    public static function dateExpire()
    {
        $time2 = "00:03:00";
        $time = Carbon::now();
        $secs = strtotime($time2) - strtotime("00:00:00");
        $result = date("H:i:s", strtotime($time) + $secs);
        return $result;
    }
    private static function SendSMS_WebOne($phone, $code)
    {
        return true;
        $parameters = [];
        $parameters['UserName'] = "09163730208";
        $parameters['Password'] = "Mrc0068719**";
        $parameters['From'] = 10002147;
        $parameters['To'] = $phone;
        $parameters['Message'] = "پی امیتو\r\nکد تایید: {$code}\r\nhttps://pmito.com";

        $jsonData = json_encode($parameters);
        $ch = curl_init("https://webone-sms.ir/SMSInOutBox/Send");
//        curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v4');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if(env('APP_ENV') == 'local')
        {
            curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
            curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData)
        ));
        $result = curl_exec($ch);
        $err = curl_error($ch);
        $result = json_decode($result, true, JSON_PRETTY_PRINT);
        curl_close($ch);

        if(!empty($err))
        {
            return false;
        }

        if($result < 1000)
        {
            return false;
        }

        return true;
    }
}
