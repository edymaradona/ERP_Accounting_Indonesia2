<?php
$this->breadcrumbs = [
    'G people' => ['index'],
    $model->id => ['view', 'id' => $model->id],
    'Update',
];

$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m1/gPerson']],
    ['label' => 'View', 'icon' => 'edit', 'url' => ['view', 'id' => $model->id]],
    ['label' => 'Delete', 'icon' => 'trash-o', 'url' => '#', 'linkOptions' => ['submit' => ['delete', 'id' => $model->id], 'confirm' => 'Are you sure you want to delete this item?'],
        ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
    ],
];

$this->menu1 = gPerson::getTopUpdated();
$this->menu2 = gPerson::getTopCreated();
$this->menu5 = ['Person'];
?>

    <div class="page-header">
        <h1>
            <i class="fa fa-user fa-fw"></i>
            <?php echo $model->employee_name_r; ?>
        </h1>
    </div>

<?php
echo $this->renderPartial('_form', ['model' => $model]);
