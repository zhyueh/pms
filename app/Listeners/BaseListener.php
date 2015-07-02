<?php

namespace App\Listeners;
use Mail;
use Log;

class BaseListener
{

    protected function sendMail($template, $to_user, $data)
    {
        Mail::send($template, $data, function($message) use ($to_user, $data){
            $message->from($_ENV['MAIL_USERNAME']);
            $message->to($to_user->email);

            $message->subject(array_get($data, 'subject', 'unknow subject' ));
            $cc = array_get($data, 'cc', []);
            Log::info($cc);
            foreach ($cc as $c)
            {
                $message->cc($c->email);
            }
        });

    }


}
