<?php

class EmailComponent
{

    public static function SendEmail($recipient, $subject, $body, $mta = "aphris")
    {
        require_once('Zend/Mail.php');
        require_once('Zend/Mail/Transport/Smtp.php');
        require_once('Zend/Mail/Protocol/Smtp/Auth/Login.php');

        if ($mta == "aphris") {

            $config = [
                'port'     => '587',
                'auth'     => 'login',
                'username' => 'admin@agungpodomoro-aphris.com',
                'password' => Yii::app()->params['peterPassword']
            ];
            $transport = new Zend_Mail_Transport_Smtp('localhost', $config);
    
            Zend_Mail::setDefaultFrom('admin@agungpodomoro-aphris.com', 'Admin APHRIS');

        } else {

            $config = [
                'ssl'      => 'ssl',
                'port'     => '465',
                'auth'     => 'login',
                'username' => 'agungpodomoro.aphris@gmail.com',
                'password' => Yii::app()->params['broadcastPassword']
            ];
            $transport = new Zend_Mail_Transport_Smtp('smtp.gmail.com', $config);

        }

            $mail = new Zend_Mail();
            $mail->addTo($recipient, ' ');
         
            $mail->setSubject(
                $subject
            );

            $mail->setBodyHtml($body);
            $mail->send($transport);

            Zend_Mail::clearDefaultFrom();
            //Zend_Mail::clearDefaultReplyTo();

            return true;

    }

    public static function template($template, $text)
    {

        $filename = Yii::app()->basePath . "/emails/" . $template . ".html";
        $content = file_get_contents($filename);

        $regex1 = "/{text}/i";
        $output = preg_replace($regex1, $text, $content);

        return $output;
    }

}

