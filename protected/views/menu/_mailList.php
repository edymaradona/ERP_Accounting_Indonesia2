<?php
$userid = Yii::app()->getModule('mailbox')->getUserId();

if ($this->getAction()->getId() == 'sent') {
    $counterUserId = $data->recipient_id;
} else {
    if (Yii::app()->getModule('mailbox')->getUserId() == $data->initiator_id)
        $counterUserId = $data->interlocutor_id;
    else
        $counterUserId = $data->initiator_id;
}
$username = Yii::app()->getModule('mailbox')->getFromLabel($counterUserId);

if ($username && (Yii::app()->getModule('mailbox')->isAdmin() || Yii::app()->getModule('mailbox')->linkUser)) {
    //$url = Yii::app()->getModule('mailbox')->getUrl($counterUserId);
    $url = Yii::app()->createUrl('/sUser/viewAuthenticated', ["id" => $counterUserId]);
    if ($url)
        $username = '<a href="' . $url . '">' . $username . '</a>';
} elseif (!$username)
    $username = '<span class="mailbox-deleted-user">' . Yii::app()->getModule('mailbox')->deletedUser . '</span>';

$viewLink = $this->createUrl('/mailbox/message/view', ['id' => $data->conversation_id]);

if ($this->getAction()->getId() == 'sent') {
    $received = Yii::app()->getModule('mailbox')->getDate($data->created);
    if (Yii::app()->getModule('mailbox')->recipientRead)
        $itemCssClass = ($data->isRead($userid)) ? 'msg-read' : 'msg-deliver';
    else
        $itemCssClass = 'msg-sent';
} else {
    $received = Yii::app()->getModule('mailbox')->getDate($data->modified);
    $itemCssClass = $data->isNew($userid) ? 'msg-new' : 'msg-read';
}
switch ($itemCssClass) {
    case 'msg-read':
        $status = ($this->getAction()->getId() == 'sent') ? 'Recipient has read your message' : 'Message has been read';
        break;
    case 'msg-deliver':
        $status = 'Recipient has not read your message yet';
        break;
    case 'msg-new':
        $status = ($this->getAction()->getId() == 'sent') ? 'Recipient has not read your message yet' : 'You received a new message';
        break;
    case 'msg-sent':
        $status = "You sent message {$username} a message";
        break;
}
$subject = '<span class="mailbox-subject-text">';
$subject .= '<a class="mailbox-link" title="' . $status . '" href="' . $viewLink . '">';
$subjectSeperator = ' - ';
if (strlen($data->subject) > Yii::app()->getModule('mailbox')->subjectMaxCharsDisplay) {
    $subject .= substr($data->subject, 0, Yii::app()->getModule('mailbox')->subjectMaxCharsDisplay - strlen(Yii::app()->getModule('mailbox')->ellipsis)) . Yii::app()->getModule('mailbox')->ellipsis . '</a></span>';
} else {
    $subject .= $data->subject . '</a></span><span class="mailbox-msg-brief">' . $subjectSeperator
        . substr(strip_tags($data->text), 0, Yii::app()->getModule('mailbox')->subjectMaxCharsDisplay - strlen($data->subject) - strlen($subjectSeperator) - strlen(Yii::app()->getModule('mailbox')->ellipsis));
    if (strlen($data->subject) + strlen($data->text) + strlen($subjectSeperator) > Yii::app()->getModule('mailbox')->subjectMaxCharsDisplay)
        $subject .= Yii::app()->getModule('mailbox')->ellipsis;
}
$subject = preg_replace('/[\n\r]+/', '', $subject);
$subject .= '</span>';
?>
<tr
    class="mailbox-item <?php echo $itemCssClass; ?> <?php if ($this->getAction()->getId() != 'sent') echo 'mailbox-draggable-row'; ?>">
    <td style="width:10%">
        <div class="mailbox-item-wrapper mailbox-from mailbox-ellipsis">
            <?php echo $username; ?>
        </div>
    </td>
    <td style="width:70%" class="mailbox-subject-brief">
        <div class="mailbox-item-wrapper mailbox-item-outer mailbox-subject">
            <div class="mailbox-item-inner mailbox-ellipsis">
                <?php echo $subject; ?>
            </div>
        </div>
    </td>
    <td style="width:20%" class="mailbox-received">
        <div align="right" class="mailbox-item-wrapper" style="width: 80px">
            <?php if ($data->is_replied) : ?>
                <div class="mailbox-replied" title="this message has been replied to">&nbsp;&nbsp;</div>
            <?php endif; ?>
            <?php echo $received; ?>
        </div>

    </td>
</tr>




