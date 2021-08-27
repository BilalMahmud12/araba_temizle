<?php


namespace App\Services;


class SmsMessage
{
    public function createPassword(): string
    {
        return str_pad(mt_rand(1,999999),6,'0',STR_PAD_LEFT);
    }

    public function sendSMS($sentTo, $text, $lang)
    {
        $api_url = 'https://www.turkeysms.com.tr/api/v3/gonder/add-content';
        $api_key  = env('SMS_API_KEY');
        $sender_id = env('SMS_SENDER_ID');
        $response_type = "json";
        $report = 1;

        $request_body = array(
            "api_key" => $api_key,
            "title"=>$sender_id,
            "text"=>$text,
            "sentto"=>$sentTo,
            "sms_lang"=>$lang,
            "report"=>$report,
            "response_type"=>$response_type
        );

        function sendRequest($site, $data)
        {
            $json = json_encode($data);
            $ch = curl_init($site);
            $header = array('Content-Type: application/json');
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
            $result = curl_exec($ch);
            curl_close($ch);
            return $result;
        }

        return sendRequest($api_url, $request_body);
    }
}
