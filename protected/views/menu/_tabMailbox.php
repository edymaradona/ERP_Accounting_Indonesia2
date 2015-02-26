<?php
Yii::app()->getModule('mailbox')->registerConfig($this->getAction()->getId());

$dependency = new CDbCacheDependency('SELECT MAX(message_id) FROM s_mailbox_message where sender_id = ' . Yii::app()->user->id);

if (!Yii::app()->cache->get('menumailbox' . Yii::app()->user->id)) {
    $dataProvider = new CActiveDataProvider(Mailbox::model()->inbox(Yii::app()->user->id));
    Yii::app()->cache->set('menumailbox' . Yii::app()->user->id, $dataProvider, 3600, $dependency);
} else
    $dataProvider = Yii::app()->cache->get('menumailbox' . Yii::app()->user->id);
?>

<div style="border: 1px #D5D5D5;border-bottom-style: solid;padding:3px 0;margin:10px 0;">
    <ul class="nav nav-list">
        <li class="nav-header"><i class="fa fa-envelope fa-fw"></i><?php echo Yii::t('basic', ' Personal Mailbox') ?>
        </li>
    </ul>
</div>

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
            'template' => '{items}',
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


<script type="text/javascript">
    /*<![CDATA[*/
    jQuery(function ($) {
        $('.message-subject').hide();
    });
    /*]]>*/
</script>
