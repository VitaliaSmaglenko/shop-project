<?php
/**
 * Controller FeedbackController
 */

use Base\Controller;
use Sender\Sender;
use App\Request;

class FeedbackController extends Controller
{
    /**
     * Action for page for send message
     * @return bool
     */
    public function actionSender():bool
    {

       $config = include('config/configSender.php');
       $send = false;
       $request = new Request();
        if (null !== $request->post('submitSend')) {
            $data = array(
                'fromEmail' => $request->post('email'),
                'subject' => $request->post('theme'),
                'fromName' => $request->post('name'),
                'name' => $request->post('name'),
                'email'=> 'vitaliasmaglenko@gmail.com',
                'msg' => $request->post('message'),
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