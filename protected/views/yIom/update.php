<?php
/* @var $this SCompanyNewsController */
/* @var $model SCompanyNews */

$this->breadcrumbs = [
    'Inter Office Memo' => ['index'],
    $model->subject => ['view', 'id' => $model->id],
    'Update',
];

$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/yIom']],
    ['label' => 'View', 'icon' => 'edit', 'url' => ['/yIom/view', "id" => $model->id]],
];

$this->menu1 = yIom::getTopUpdated();
$this->menu2 = yIom::getTopCreated();
?>

    <div class="page-header">
        <h1>
            <i class="fa fa-article"></i>
            Update
        </h1>
    </div>

<?php echo $this->renderPartial('_form', ['model' => $model]); ?>