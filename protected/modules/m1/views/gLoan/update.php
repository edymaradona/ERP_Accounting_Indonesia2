<?php
$this->breadcrumbs = [
    'G Cutis' => ['index'],
    $model->id => ['view', 'id' => $model->id],
    'Update',
];

$this->menu4 = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m1/gLoan']],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
];

//$this->menu1=gLoan::getTopUpdated();
//$this->menu2=gLoan::getTopCreated();
$this->menu5 = ['Loan'];

$this->menu9 = ['model' => $model, 'action' => Yii::app()->createUrl('m1/gLoan/list')];

?>

    <div class="page-header">
        <h1>
            <i class="fa fa-money fa-fw"></i>
            Update:
            <?php echo $model->person->employee_name; ?>
        </h1>
    </div>



<?php
echo $this->renderPartial('_formUpdate', ['model' => $model]);
