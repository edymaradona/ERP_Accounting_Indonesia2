<?php
if ($this->getAction()->getId() != 'inbox')
    $this->breadcrumbs = [
        ucfirst($this->module->id) => ['inbox'],
        ucfirst($this->getAction()->getId())
    ];
else
    $this->breadcrumbs = [$this->module->id];
?>
<div class="row">
    <div class="col-md-2">
        <?php
        $this->renderpartial('_menu');
        ?>
    </div>
    <div class="col-md-10">
        <?php
        if (isset($_GET['Message_sort']))
            $sortby = $_GET['Message_sort'];
        elseif (isset($_GET['Mailbox_sort']))
            $sortby = $_GET['Mailbox_sort'];
        else
            $sortby = '';

        echo '<div sortby="' . $sortby . '">';

        $this->renderpartial('_flash');

        if ($dataProvider->getItemCount() > 0) {
            ?>
            <form id="message-list-form"
                  action="<?php echo $this->createUrl($this->getId() . '/' . $this->getAction()->getId()); ?>"
                  method="post">
                <input type="hidden" class="mailbox-count" name="ui[]"
                       value="<?php echo $dataProvider->getItemCount(); ?>"/>
                <input type="hidden" class="mailbox-sortby" name="ui[]" value="<?php echo $sortby; ?>"/>

                <div class="mailbox-clistview-container ui-helper-clearfix">
                    <?php if ($dataProvider->getItemCount() > 1 && $this->getAction()->getId() != 'sent') : ?>
                        <div class="btn-group mailbox-checkall-buttons">
                            <button class="btn btn-xs btn-default"/>
                            Check All</button>
                            <button class="btn btn-xs btn-default"/>
                            Uncheck All</button>
                        </div>
                    <?php
                    endif;

                    $this->widget('zii.widgets.CListView', [
                        'id' => 'mailbox',
                        'dataProvider' => $dataProvider,
                        'itemView' => '_list',
                        'itemsTagName' => 'table',
                        'template' => '<div class="mailbox-summary"></div>{sorter}<div id="mailbox-items" class="ui-helper-clearfix">{items}</div>{pager}',
                        'sortableAttributes' => $this->getAction()->getId() == 'sent' ?
                                ['created' => 'Date Sent'] :
                                ['modified' => 'Date Received'],
                        'loadingCssClass' => 'mailbox-loading',
                        'ajaxUpdate' => 'mailbox-list',
                        'afterAjaxUpdate' => '$.yiimailbox.updateMailbox',
                        'emptyText' => '<div style="width:100%"><h3>You have no mail in your ' . $this->getAction()->getId() . ' folder.</h3></div>',
                        //'htmlOptions'=>array('class'=>'ui-helper-clearfix'),
                        'sorterHeader' => '',
                        //'sorterCssClass'=>'mailbox-sorter',
                        //'itemsCssClass'=>'mailbox-items-tbl ui-helper-clearfix',
                        //'pagerCssClass'=>'mailbox-pager',
                        //'updateSelector'=>'.inbox',
                    ]);
                    ?>
                    <?php if ($this->getAction()->getId() != 'sent') : ?>
                        <div style="margin-top:5px; clear:left"><span class="btn-minis-label">With selected:</span>
                            <?php if ($this->getAction()->getId() == 'trash') : ?>
                                <input type="submit" id="mailbox-action-restore" class="btn btn-xs btn-default"
                                       name="button[restore]" value="restore"/>
                                <input type="submit" id="mailbox-action-delete" class="btn btn-xs btn-default"
                                       name="button[delete]" value="delete forever"/>
                            <?php else: ?>
                                <?php if (!$this->module->readOnly || ($this->module->readOnly && !$this->module->isAdmin())): ?>
                                    <input type="submit" id="mailbox-action-delete" class="btn btn-xs btn-default"
                                           name="button[delete]" value="delete"/>
                                <?php endif; ?>
                                <input type="submit" id="mailbox-action-read" class="btn btn-xs btn-default"
                                       name="button[read]"
                                       value="read"/>
                                <input type="submit" id="mailbox-action-unread" class="btn btn-xs btn-default"
                                       name="button[unread]" value="unread"/>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </form>

        <?php
        } else {
            $this->renderpartial('_empty');
        }
        ?>
    </div>


</div>
</div>


<script type="text/javascript">
    /*<![CDATA[*/
    jQuery(function ($) {
        $('.message-subject').hide();
    });
    /*]]>*/
</script>