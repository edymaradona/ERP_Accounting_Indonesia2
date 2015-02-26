<?php
$this->breadcrumbs = [
    'Rights' => Rights::getBaseUrl(),
    Rights::t('core', 'Create :type', [':type' => Rights::getAuthItemTypeName($_GET['type'])]),
];
?>


<div class="page-header">
    <h1>

        <?php
        echo Rights::t('core', 'Create :type', [
            ':type' => Rights::getAuthItemTypeName($_GET['type']),
        ]);
        ?>
    </h1>
</div>

<?php $this->renderPartial('_form', ['model' => $formModel]); ?>
