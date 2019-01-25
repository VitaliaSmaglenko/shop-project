<?php
use Base\Controller;
use Sender\Sender;

class FeedbackController extends Controller
{
    public function actionSender()
    {

       $config = include('config/configSender.php');
       $send = false;
        if (isset ($_POST['submitSend'])) {
            $data = array(
                'fromEmail' => $_POST['email'],
                'subject' => $_POST['theme'],
                'fromName' => $_POST['name'],
                'name' => $_POST['name'],
                'email'=> 'vitaliasmaglenko@gmail.com',
                'msg' => $_POST['message'],
                'path' =>'sender/src/view/letter.php'
            );
            $sender = new Sender;
            $sender->send($data, $config);
            $send = true;
        }

        $dataPage['send'] = $send;
        if ($send == true) {
            unset($_POST);

        }

        $this->view->render('feedback.php', $dataPage);
        return true;
    }
}