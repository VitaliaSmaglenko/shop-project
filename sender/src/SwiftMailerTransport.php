<?php
/**
 * Class SwiftMailerTransport
 */

namespace Sender;

use Swift_Mailer;
use Swift_SmtpTransport;
use Swift_Message;

class SwiftMailerTransport implements TransportInterface
{
    /**
     * @var
     */
    private $mailer;
    private $message;

    /**
     * @param $config
     * @return Swift_SmtpTransport
     */
    public function createTransport($config)
    {
        $transport = (new Swift_SmtpTransport($config['host'], $config['port']))
            ->setUsername($config['username'])
            ->setPassword($config['password'])
            -> setEncryption($config['encryption']);
        ;
        return $transport;
    }

    /**
     * @param $config
     * @return Swift_SmtpTransport
     */
    public function getTransport($config)
    {
        $transport = $this->createTransport($config);
        return $transport;
    }

    /**
     * @param $config
     * @return Swift_Mailer
     */
    protected function createMailer($config)
    {
        $transport = $this->getTransport($config);
        $mailer = new Swift_Mailer($transport);
        return $mailer;
    }

    /**
     * @param $config
     * @return Swift_Mailer
     */
    public function getMailer($config)
    {
        if (null == $this->mailer) {
            $this->mailer = $this->createMailer($config);
        }
        return $this->mailer;
    }

    /**
     * @param $params
     * @return Swift_Message
     */
    public function getMessage($params)
    {
        if (null == $this->message) {
            $this->message = $this->createMessage($params);
        }
        return $this->message;
    }

    /**
     * @param $params
     * @return Swift_Message
     */
    public function createMessage($params)
    {
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
