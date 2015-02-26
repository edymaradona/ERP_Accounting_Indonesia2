<?php
$this->renderPartial('_menu');
?>

    <div class="page-header">
        <h1>Update </h1>
    </div>


<?php $this->renderPartial('_form', ['model' => $model]); ?>