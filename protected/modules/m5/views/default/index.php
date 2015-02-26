<?php
$this->breadcrumbs = [
    $this->module->id,
];
?>

<div class="page-header">
    <h3>
        <i class="icon-fa-flag"></i>
        <?php
        echo "DashBoard";
        ?>
    </h3>
</div>


<div class="row">
    <div class="col-md-12">
        <?php
        $this->beginWidget('booster.widgets.TbHeroUnit', [
            //'heading'=>'Welcome!!',
        ]);
        ?>

        <p>Welcome to Process Production Module. This page has been reserved for
            future use. Thank you for using this product</p>

        <p>
            <?php
            $this->widget('booster.widgets.TbButton', [
                'type' => 'primary',
                'size' => 'large',
                'label' => 'Learn more',
                'icon' => 'fa fa-check',
            ]);
            ?>
        </p>

        <?php $this->endWidget(); ?>
    </div>
</div>

