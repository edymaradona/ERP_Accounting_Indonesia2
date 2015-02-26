<?php

class textField extends CInputWidget
{

    public $model;
    public $field;

    public function run()
    {

        $placeholder = strtoupper($this->field);
        echo "<input type='text' class='$this->field form-control' name='$this->model[$this->field][]' value='' placeholder='$placeholder'>";

    }

}

?>


