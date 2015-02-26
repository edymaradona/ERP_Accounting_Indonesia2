<?php

/*
 *
 * Class : Notification
 * class untuk mengcreate Notification per User Group
 *
 * author: Peter J. Kambey
 * 26 November 2012
 * gratis
 *
 * contoh:
 * echo Notification::create($recepient int,$url string, $message string);
 * 
 * 
 */

Class Notification
{

    public static function create($group, $url, $message, $company = null, $photopath = "")
    {
        $model = new sNotification();
        $model->group_id = $group;
        $model->link = $url;
        $model->content = $message;
        if ($company == null && !Yii::app()->user->isGuest) {
            $model->company_id = sUser::model()->myGroup;
        } else
            $model->company_id = $company;
        $model->photo_path = $photopath;
        if ($model->save(false)) {
            return true;
        } else
            return false;
    }

    public static function newInbox($recipient, $subject, $message)
    {
        $conv = new Mailbox(); //s_mailbox_conversation
        $conv->subject = $subject;
        //$conv->initiator_id = 1;
        $conv->initiator_id = Yii::app()->user->id;
        $conv->interlocutor_id = $recipient;
        $conv->modified = time();
        $conv->bm_read = 1;
        $msg = new Message; //s_mailbox_message
        $msg->text = $message;
        $msg->created = time();
        //$msg->sender_id = 1;
        $msg->sender_id = Yii::app()->user->id;
        $msg->recipient_id = $recipient;
        $msg->crc64 = 0;
        $conv->save(false);
        $msg->conversation_id = $conv->conversation_id;
        $msg->save(false);
        return true;
    }

    public static function getMessageCount()
    {
        $criteria = new CDbCriteria;
        $criteria->with = ['conversation'];
        //$criteria->together=true;
        $criteria->compare('conversation.bm_read', 1);
        $criteria->compare('recipient_id', Yii::app()->user->id);

        $notifiche = Message::model()->count($criteria);

        //return (int) $notifiche;

        return ((int)$notifiche != 0) ? CHtml::tag("span", ['style' => 'font-size:inherit', 'class' => 'badge badge-info'], $notifiche) : "";
    }

    public static function getUserHistory()
    {
        $model = new sUserHistory;
        $model->user_id = Yii::app()->user->id;
        $model->log_time = time();
        $model->ip_address = $_SERVER['REMOTE_ADDR'];
        $model->browser_name = $_SERVER['HTTP_USER_AGENT'];
        $model->save(false);
    }

}

?>
