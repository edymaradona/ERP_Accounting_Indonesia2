<?php

class CheckBoxDepartment extends CInputWidget
{

    public $label;
    public $type;
    public $field;
    public $model;

    public function run()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('parent_id', (int)$this->type);
        $dataSource = aOrganization::model()->findAll($criteria);

        foreach ($dataSource as $model) {
            foreach ($model->childs as $mod)
                foreach ($mod->childs as $m) {
                    echo '<label class="checkbox">';
                    echo "<input type='checkbox' class='$this->field' name='$this->model[$this->field][]' value='$m[name]' >";
                    echo $m['name'];
                    echo '</label>';
                }
        }


    }

}

?>
