<?php
$this->renderPartial('_menu');
?>


    <div class="page-header">
        <h1>Create SMS Group</h1>
    </div>


<?php $this->renderPartial('_formAddressbookGroup', ['model' => $model]); ?>