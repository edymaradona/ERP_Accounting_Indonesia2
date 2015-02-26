<div style="border: 1px #D5D5D5;border-bottom-style: solid;padding:3px 0;margin:10px 0;">
    <h4>Personal Mailbox</h4>
</div>


<?php
Yii::app()->getModule('mailbox')->registerConfig($this->getAction()->getId());

$dependency = new CDbCacheDependency('SELECT MAX(message_id) FROM s_mailbox_message');

//if (!Yii::app()->cache->get('mailbb'.Yii::app()->user->id)) {

$dataProvider = new CActiveDataProvider(Mailbox::model()->inbox(Yii::app()->user->id));
?>

<div class="well">
    <?php
    if (isset($_GET['Message_sort']))
        $sortby = $_GET['Message_sort'];
    elseif (isset($_GET['Mailbox_sort']))
        $sortby = $_GET['Mailbox_sort'];
    else
        $sortby = '';

    //$this->renderpartial('_flash');

    if ($dataProvider->getItemCount() > 0) {

        $this->widget('zii.widgets.CListView', [
            'id' => 'mailbox',
            'dataProvider' => $dataProvider,
            'itemView' => '_mailList',
            'itemsTagName' => 'table',
            'template' => '{items}{pager}',
            'sortableAttributes' => $this->getAction()->getId() == 'sent' ?
                    ['created' => 'Date Sent'] :
                    ['modified' => 'Date Received'],
            'loadingCssClass' => 'mailbox-loading',
            'ajaxUpdate' => 'mailbox-list',
            'afterAjaxUpdate' => '$.yiimailbox.updateMailbox',
            'emptyText' => '<div style="width:100%"><h3>You have no mail in your ' . $this->getAction()->getId() . ' folder.</h3></div>',
            //'htmlOptions'=>[],
            'sorterHeader' => '',
            //'sorterCssClass'=>'mailbox-sorter',
            //'itemsCssClass'=>'mailbox-items-tbl',
            //'pagerCssClass'=>'mailbox-pager',
            //'updateSelector'=>'.inbox',
        ]);
    } else
        $this->renderpartial('_mailEmpty');
    ?>
</div>

<br/>


<script type="text/javascript">
    /*<![CDATA[*/
    jQuery(function ($) {
        $('.message-subject').hide();
    });
    /*]]>*/
</script>


