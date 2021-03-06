<?php
$this->breadcrumbs = [
    'Chart of Accounts',
];

$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m2/tAccount']],
    ['label' => 'New Root Account', 'icon' => 'plus', 'url' => ['/m2/tAccount/create']],
    ['label' => 'Print List', 'icon' => 'print', 'url' => ['printList']],
    ['label' => 'Trial Balance', 'icon' => 'random', 'url' => ['reload']],
];


$this->menu1 = tAccount::getTopUpdated();
//$this->menu2=tAccount::getTopCreated();
//$this->menu5=array('Root Account');
?>

<div class="page-header">
    <h1>
        Chart of Accounts
    </h1>
</div>

<div class="row">
    <div class="col-md-2">

        <?php
        $Hierarchy = tAccount::model()->findAll(['condition' => 'parent_id = 0']);

        foreach ($Hierarchy as $Hierarchy) {
            $models = tAccount::model()->findByPk($Hierarchy->id);
            $items[] = $models->getTree();
        }

        $this->beginWidget('CTreeView', [
            'id' => 'module-tree',
            //'data'=>$items,
            'url' => ['/m2/tAccount/ajaxFillTree'],
            //'collapsed'=>true,
            //'unique'=>true,
        ]);
        $this->endWidget();
        ?>

    </div>
    <div class="col-md-7">


        <?php
        $this->renderPartial('_search', [
            'model' => $model,
        ]);
        ?>

        <strong>ACCOUNT LIST</strong>

        <div id="posts">
            <?php foreach ($dataProvider as $data): ?>
                <div class="post">

                    <?php
                    Yii::app()->clientScript->registerScript('search' . $data->id, "
				$('.hide-info'+$data->id).click(function(){
				$('.list'+$data->id).toggle();
				return false;
});
				");
                    ?>

                    <?php
                    if ($data->parent_id == 0) {
                        if ($data->childs)
                            echo CHtml::tag('b', [], CHtml::link($data->account_concat, ['view', 'id' => $data->id]));
                        else
                            echo CHtml::link($data->account_concat, ['view', 'id' => $data->id]) . " | "
                                . CHtml::link('print', ['printList', 'id' => $data->id]);
                    } elseif ($data->getparent->parent_id == 0) {
                        if ($data->childs)
                            echo "--- " . CHtml::tag('b', [], CHtml::link($data->account_concat, ['view', 'id' => $data->id]));
                        else
                            echo "--- " . CHtml::link($data->account_concat, ['view', 'id' => $data->id]) . " | "
                                . CHtml::link('print', ['printList', 'id' => $data->id]);
                    } elseif ($data->getparent->getparent->parent_id == 0) {
                        if ($data->childs)
                            echo "------ " . CHtml::tag('b', [], CHtml::link($data->account_concat, ['view', 'id' => $data->id]));
                        else
                            echo "------ " . CHtml::link($data->account_concat, ['view', 'id' => $data->id]) . " | "
                                . CHtml::link('print', ['printList', 'id' => $data->id]);
                    } elseif ($data->getparent->getparent->getparent->parent_id == 0) {
                        if ($data->childs)
                            echo "--------- " . CHtml::tag('b', [], CHtml::link($data->account_concat, ['view', 'id' => $data->id]));
                        else
                            echo "--------- " . CHtml::link($data->account_concat, ['view', 'id' => $data->id]) . " | "
                                . CHtml::link('print', ['printList', 'id' => $data->id]);
                    } elseif ($data->getparent->getparent->getparent->getparent->parent_id == 0) {
                        if ($data->childs)
                            echo "------------ " . CHtml::tag('b', [], CHtml::link($data->account_concat, ['view', 'id' => $data->id]));
                        else
                            echo "------------ " . CHtml::link($data->account_concat, ['view', 'id' => $data->id]) . " | "
                                . CHtml::link('print', ['printList', 'id' => $data->id]);
                    } elseif ($data->getparent->getparent->getparent->getparent->getparent->parent_id == 0) {
                        if ($data->childs)
                            echo "--------------- " . CHtml::tag('b', [], CHtml::link($data->account_concat, ['view', 'id' => $data->id]));
                        else
                            echo "--------------- " . CHtml::link($data->account_concat, ['view', 'id' => $data->id]) . " | "
                                . CHtml::link('print', ['printList', 'id' => $data->id]);
                    } else {
                        if ($data->childs)
                            echo "------------------ " . CHtml::tag('b', [], CHtml::link($data->account_concat, ['view', 'id' => $data->id]));
                        else
                            echo "------------------ " . CHtml::link($data->account_concat, ['view', 'id' => $data->id]) . " | "
                                . CHtml::link('print', ['printList', 'id' => $data->id]);
                    }
                    ?>

                    <?php /*
                      <?php echo CHtml::link('<i class="icon-fa-chevron-right"></i>','#',array('class'=>'hide-info'.$data->id)); ?>

                      <div class="list<?php echo $data->id ?>" style="display:none">

                      <?php
                      //$this->widget('booster.widgets.TbDetailView', array(
                      $this->widget('ext.XDetailView', array(
                      'ItemColumns' => 2,
                      'data'=>array(
                      'id'=>1, 'account_type'=>$data->getRoot(),
                      'currency'=>$data->getCurrency(),
                      'state'=>$data->getState(),
                      'has_child'=>(isset($data->haschild)) ? $data->haschild->childName->name : "Not Set",
                      'cash_bank'=>(isset($data->cashbank)) ? $data->cashbank->mtext : "Not Set",
                      'hutang'=>(isset($data->hutang)) ? $data->hutang->setMvalue() : "Not Set",
                      'inventory'=>(isset($data->inventory)) ? $data->inventory->setMvalue() : "Not Set",
                      ),
                      'attributes'=>array(
                      array('name'=>'account_type', 'label'=>'Account Type'),
                      array('name'=>'currency', 'label'=>'Currency'),
                      array('name'=>'state', 'label'=>'Status'),
                      array('name'=>'has_child', 'label'=>'Has Child'),
                      array('name'=>'cash_bank', 'label'=>'Cash Bank Account'),
                      array('name'=>'hutang', 'label'=>'Payable Account'),
                      array('name'=>'inventory', 'label'=>'Inventory Account'),
                      ),
                      )); ?>
                      </div>

                     */
                    ?>


                </div>
            <?php endforeach; ?>
        </div>

        <?php
        $this->widget('ext.yiinfinite-scroll.YiinfiniteScroller', [
            'contentSelector' => '#posts',
            'itemSelector' => 'div.post',
            'loadingText' => 'Loading...',
            'donetext' => 'This is the end... ',
            'pages' => $pages,
        ]);
        ?>

    </div>
</div>