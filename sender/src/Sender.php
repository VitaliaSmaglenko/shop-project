<?php

namespace Sender;

class Sender
{
    public function send($view, $config)
    {
        $params = $view;
        $config = $config;
        $mailer = new SwiftMailerTransport();
        $mailer = $mailer->getMailer($config);
        $message = new SwiftMailerTransport();
        $message = $message->getMessage($params);

        try {
            $result = $mailer->send($message);

        } catch (\Swift_SwiftException $e){
            die ("You have errors: {$e->getMessage()}\n");


        }
    }
}