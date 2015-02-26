<?php
$this->renderPartial('_menu');
?>

    <div class="page-header">
        <h1>Create New Contact</h1>
    </div>

<?php $this->renderPartial('_formAddressbook', ['model' => $model]); ?>