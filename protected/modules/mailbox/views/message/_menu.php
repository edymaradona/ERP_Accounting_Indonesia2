<?php
$newMsgs = $this->module->getNewMsgs();
$action = $this->getAction()->getId();

if ($this->module->authManager) {
    $authNew = Yii::app()->user->checkAccess("Mailbox.Message.New");
    $authInbox = Yii::app()->user->checkAccess("Mailbox.Message.Inbox");
    $authSent = Yii::app()->user->checkAccess("Mailbox.Message.Sent");
    $authTrash = Yii::app()->user->checkAccess("Mailbox.Message.Trash");
} else {
    $authNew = $this->module->sendMsgs && (!$this->module->readOnly || $this->module->isAdmin());
    $authInbox = (!$this->module->readOnly || $this->module->isAdmin());
    $authTrash = $this->module->trashbox && (!$this->module->readOnly || $this->module->isAdmin());
    $authSent = $this->module->sentbox && (!$this->module->readOnly || $this->module->isAdmin());
}
?>
<div class="row">
    <div class="col-md-12">
        <?php if ($authInbox): ?>
            <div id="mailbox-inbox"
                 class="mailbox-menu-item <?php echo ($action == 'inbox') ? 'mailbox-menu-current' : ''; ?>">
                <a href="<?php echo $this->createUrl('message/inbox'); ?>">Inbox <span
                        class="mailbox-new-msgs"><?php echo $newMsgs ? '(' . $newMsgs . ')' : null; ?></span></a>
            </div>
        <?php
        endif;
        if ($authSent) :
            ?>
            <div id="mailbox-sent"
                 class="mailbox-menu-item <?php if ($action == 'sent') echo 'mailbox-menu-current '; ?>">
                <a href="<?php echo $this->createUrl('message/sent'); ?>">Sent Mail</a>
            </div>
        <?php
        endif;
        if ($authTrash) :
            ?>
            <div id="mailbox-trash"
                 class="mailbox-menu-item <?php if ($action == 'trash') echo 'mailbox-menu-current '; ?>">
                <a href="<?php echo $this->createUrl('message/trash'); ?>">Trash </a>
            </div>
        <?php endif; ?>

    </div>
</div>
<br/>

<?php
if ($authNew) :
    ?>
    <div class="row">
        <div class="col-md-12">
            <a href="<?php echo $this->createUrl('message/new'); ?>" class="btn btn-primary btn-large btn-block">New
                Message</a>
        </div>
    </div>
    <br/>
<?php endif; ?>
<br/>

