<?php
/* @var $this SCompanyNewsController */
/* @var $model SCompanyNews */

$this->breadcrumbs = [
    'Inter Office Memo' => ['index'],
    $model->subject,
];

$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/yIom']],
    ['label' => 'Update', 'icon' => 'pencil', 'url' => ['/yIom/update', "id" => $model->id]],
    ['label' => 'Print', 'icon' => 'print', 'url' => ['/yIom/print', "id" => $model->id]],
];

$this->menu1 = yIom::getTopUpdated();
$this->menu2 = yIom::getTopCreated();
?>

<div class="page-header">
    <h1>
        <i class="fa fa-article"></i>
        <?php echo $model->subject; ?>
    </h1>
</div>

<div class="row">
    <div class="col-md-12">
        <?php
        $this->widget('TbDetailView', [
            'data' => $model,
            'attributes' => [
                'iom_number',
                'iom_to',
                'iom_cc',
                'iom_from',
                'subject',
                'attachment',
                'iom_date',
                'sender_by',
                'sender_title',
                'approved_by',
                'approved_title',
                //'other_by',
                //'other_title',
            ],
        ]);

        $this->beginWidget('CMarkdown', ['purifyOutput' => true]);
        echo $model->content;
        $this->endWidget();
        ?>
    </div>
</div>
