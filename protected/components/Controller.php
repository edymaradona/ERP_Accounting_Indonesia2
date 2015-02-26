<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{

    /**
     * @var string the default layout for the controller view. Defaults to 'column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = 'column1';

    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = []; //Operation
    public $menu1 = []; //Recent Updated
    public $menu2 = []; //Recent Added
    public $menu3 = []; //Other Menu
    public $menu4 = [];
    public $menu5 = [];
    public $menu6 = [];
    public $menu7 = []; //Filter Left SideBar Menu
    public $menu8 = []; //Filter Right SideBar Menu
    public $menu9 = []; //Search Box
    public $menu10 = []; //Operation 2
    public $menu11 = []; //Tag Cloud
    public $message = null; //Operation 2
    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = [];

    public function filterRights($filterChain)
    {
        $filter = new RightsFilter;
        $filter->allowedActions = $this->allowedActions();
        $filter->filter($filterChain);
    }

    /**
     * @return string the actions that are always allowed separated by commas.
     */
    public function allowedActions()
    {
        return '';
    }

    /**
     * Denies the access of the user.
     * @param string $message the message to display to the user.
     * This method may be invoked when access check fails.
     * @throws CHttpException when called unless login is required.
     */
    public function accessDenied($message = null)
    {
        if ($message === null)
            //$message = Rights::t('core', 'You are not authorized to perform this action.');
            $message = 'You are not authorized to perform this action.';
        $user = Yii::app()->getUser();
        if ($user->isGuest === true)
            $user->loginRequired();
        else
            throw new CHttpException(403, $message);
    }

    public function newInbox($data)
    {
        if ($data !== null) {

            if (!isset($data['sender'])) 
                $data['sender'] = Yii::app()->user->id; 
            

            $conv = new Mailbox(); //s_mailbox_conversation
            $conv->subject = $data['subject'];
            //$conv->initiator_id = 1;
            $conv->initiator_id = Yii::app()->user->id;
            $conv->interlocutor_id = $data['recipient'];
            $conv->modified = time();
            $conv->bm_read = 1;
            $msg = new Message; //s_mailbox_message
            $msg->text = $data['message'];
            $msg->created = time();
            //$msg->sender_id = 1;
            $msg->sender_id = $data['sender'];
            $msg->recipient_id = $data['recipient'];
            $msg->crc64 = 0;
            $conv->save(false);
            $msg->conversation_id = $conv->conversation_id;
            $msg->save(false);
        }
        return true;
    }

}

?>