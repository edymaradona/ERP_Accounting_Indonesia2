<?php

class CheckBox extends CInputWidget
{

    public $label;
    public $type;
    public $field;
    public $model;

    public function run()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('type', $this->type);
        $dataSource = sParameter::model()->findAll($criteria);

        /*echo CHtml::openTag('div',['class'=>'panel panel-default','id'=>'panel1']);
            echo CHtml::openTag('div',['class'=>"panel-heading"]);
                echo CHtml::openTag('span', ['class'=>"panel-title"]);
                echo CHtml::openTag('a',['data-toggle'=>"collapse", 'data-parent'=>"#accordion", 'data-target'=>"#".$this->field,
                   'href'=>'#'.$this->field]);
                    echo $this->label;
                echo CHtml::closeTag('a');

                echo CHtml::closeTag('span');
                echo CHtml::openTag('label', ['class'=>"checkbox", 'style'=>"float:right;"]);
                    echo CHtml::tag('input', ['type'=>"checkbox", 'class'=>$this->field."_checkall"]);
                    echo "Check All";
                echo CHtml::closeTag('label');
            echo CHtml::closeTag('div');
            echo CHtml::openTag('div', ['id'=>$this->field ,'class'=>"panel-collapse collapse in"]);
                echo CHtml::openTag('div', ['class'=>"checkbox", 'style'=>"display:inline"]);
                echo CHtml::openTag('div', ['class'=>"panel-body"]);
        */
        foreach ($dataSource as $data) {
            echo '<label class="checkbox">';
            echo "<input type='checkbox' class='$this->field' name='$this->model[$this->field][]' value='$data[name]' >";
            echo $data['name'];
            echo '</label>';
        }
        /*
                echo CHtml::closeTag('div');
                echo CHtml::closeTag('div');
            echo CHtml::closeTag('div');
        echo CHtml::closeTag('div');
        */

    }

}

?>
