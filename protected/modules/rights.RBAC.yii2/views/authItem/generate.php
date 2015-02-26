<?php
$this->breadcrumbs = [
    'Rights' => Rights::getBaseUrl(),
    Rights::t('core', 'Generate items'),
];
?>

<div id="generator">

    <div class="page-header">
        <h1>
            <?php echo Rights::t('core', 'Generate items'); ?>
        </h1>
    </div>
    <p>
        <?php echo Rights::t('core', 'Please select which items you wish to generate.'); ?>
    </p>

    <div class="form">

        <?php $form = $this->beginWidget('CActiveForm'); ?>

        <div class="row">

            <table class="items generate-item-table" border="0" cellpadding="0"
                   cellspacing="0">

                <tbody>

                <tr class="application-heading-row">
                    <th colspan="3"><?php echo Rights::t('core', 'Application'); ?></th>
                </tr>

                <?php
                $this->renderPartial('_generateItems', [
                    'model' => $model,
                    'form' => $form,
                    'items' => $items,
                    'existingItems' => $existingItems,
                    'displayModuleHeadingRow' => true,
                    'basePathLength' => strlen(Yii::app()->basePath),
                ]);
                ?>

                </tbody>

            </table>

        </div>

        <div class="row">

            <?php
            echo CHtml::link(Rights::t('core', 'Select all'), '#', [
                'onclick' => "jQuery('.generate-item-table').find(':checkbox').attr('checked', 'checked'); return false;",
                'class' => 'selectAllLink']);
            ?>
            /
            <?php
            echo CHtml::link(Rights::t('core', 'Select none'), '#', [
                'onclick' => "jQuery('.generate-item-table').find(':checkbox').removeAttr('checked'); return false;",
                'class' => 'selectNoneLink']);
            ?>

        </div>

        <div class="row">

            <?php //echo CHtml::submitButton(Rights::t('core', 'Generate'));  ?>
            <?php
            $this->widget('booster.widgets.TbButton', [
                'buttonType' => 'submit',
                //'type' => 'primary',
                'icon' => 'fa fa-check',
                'label' => 'Generate',
            ]);
            ?>


        </div>

        <?php $this->endWidget(); ?>

    </div>

</div>
