<?php
/**
 * Created by PhpStorm.
 * User: phpstudent
 * Date: 25.01.19
 * Time: 15:31
 */

namespace Sender;
use Swift_Mailer;
use Swift_SmtpTransport;
use Swift_Message;

class SwiftMailerTransport implements TransportInterface
{
    private $mailer;
    private $message;

    public function createTransport($config){
        $transport = (new Swift_SmtpTransport($config['host'], $config['port']))
            ->setUsername($config['username'])
            ->setPassword($config['password'])
            -> setEncryption($config['encryption']);
        ;
        return $transport;
    }

    public function getTransport($config)
    {
        $transport = $this->createTransport($config);
        return $transport;
    }
    protected function createMailer($config)
    {
        $transport = $this->getTransport($config);
        $mailer = new Swift_Mailer($transport);
        return $mailer;
    }
    public function getMailer($config)
    {
        if (null == $this->mailer) {
            $this->mailer = $this->createMailer($config);
        }
        return $this->mailer;
    }
    public function getMessage($params)
    {
        if (null == $this->message) {
            $this->message = $this->createMessage( $params);
        }
        return $this->message;
    }
    public function createMessage($params){
        $page = new Render();
        $page = $page->renderPhpFile($params);
        $message = (new Swift_Message($params['subject']))
            ->setFrom([$params['fromEmail'] => $params['fromName']])
            ->setTo([$params['email'], $params['email'] =>$params['name']])
            ->setBody($page, 'text/html')
        ;
        return $message;
    }
}