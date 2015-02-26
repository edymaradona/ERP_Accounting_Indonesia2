<?php
$this->breadcrumbs = [
    'User' => ['index'],
    $model->id => ['view', 'id' => $model->id],
    'Update',
];


$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/sUser']],
    ['label' => 'View Self', 'icon' => 'edit', 'url' => ['viewSelf', 'id' => $model->id]],
];

//$this->menu2=sUser::getTopCreated();
?>

    <div class="page-header">
        <h1>
            <i class="fa fa-user fa-fw"></i>
            <?php echo $model->username; ?>
        </h1>
    </div>

<?php
$form = $this->beginWidget('TbActiveForm', [
    'id' => 'user-form',
    //'type'=>'horizontal',
    'enableAjaxValidation' => true,
]);
?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldGroup($model, 'full_name', ['class' => 'col-md-4']); ?>

<?php echo $form->textFieldGroup($model, 'username', ['class' => 'col-md-3']); ?>


    <div class="control-group">
        <?php
        $this->widget('booster.widgets.TbButton', [
            'buttonType' => 'submit',
            // 'type' => 'primary',
            'icon' => 'fa fa-check',
            'label' => $model->isNewRecord ? 'Create' : 'Save',
        ]);
        ?>
    </div>

<?php $this->endWidget(); ?>