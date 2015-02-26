<?php

class aOrganization extends BaseModel
{

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'a_organization';
    }

    public function rules()
    {
        return [
            ['branch_code, structure_id, propinsi_id', 'required'],
            ['kabupaten_id, propinsi_id, created_date, created_id, updated_date, updated_id, parent_id', 'numerical', 'integerOnly' => true],
            ['branch_code, structure_id, name, address, address2, address3, address4, pos_code, phone_code_area, telephone, fax, email, website', 'length', 'max' => 50],
            ['id, branch_code, structure_id, name, address, address2, address3, address4, pos_code, phone_code_area, telephone, fax, email, website, created_date, created_id, updated_date, updated_id', 'safe', 'on' => 'search'],
        ];
    }

    public function relations()
    {
        return [
            'getparent' => [self::BELONGS_TO, 'aOrganization', 'parent_id'],
            'childs' => [self::HAS_MANY, 'aOrganization', 'parent_id', 'order' => 'id ASC'],
            'entityAccount' => [self::HAS_MANY, 'aAccountEntity', 'entity_id', 'order' => 'id ASC'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent ID',
            'branch_code' => 'Branch Code',
            'structure_id' => 'Structure',
            'name' => 'Name',
            'address' => 'address',
            'address2' => 'address2',
            'address3' => 'address3',
            'address4' => 'address4',
            'kabupaten_id' => 'Kab/Kodya',
            'propinsi_id' => 'Propinsi',
            'pos_code' => 'Kode Pos',
            'phone_code_area' => 'Kode Area',
            'telephone' => 'telephone',
            'fax' => 'Fax',
            'email' => 'Email',
            'website' => 'Website',
            'created_date' => 'Created Date',
            'created_id' => 'Created',
            'updated_date' => 'Updated Date',
            'updated_id' => 'Updated',
        ];
    }

    public function search()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('name', $this->name, true);

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
        ]);
    }

    public function getTree()
    {
        $subitems = [];

        if ($this->childs)
            foreach ($this->childs as $child) {
                $subitems[] = $child->getTree();
            }

        $returnarray = [
            'text' => CHtml::link($this->name, Yii::app()->createUrl('/aOrganization/view', ['id' => $this->id]))];

        if ($subitems != [])
            $returnarray = array_merge($returnarray, ['children' => $subitems]);
        return $returnarray;
    }

    public function getTopCreated()
    {

        $models = self::model()->findAll(['limit' => 10, 'order' => 'created_date DESC']);

        $returnarray = [];

        foreach ($models as $model) {
            $returnarray[] = ['id' => $model->name, 'label' => $model->name, 'icon' => 'list-alt', 'url' => ['view', 'id' => $model->id]];
        }

        return $returnarray;
    }

    public function getTopUpdated()
    {

        $models = self::model()->findAll(['limit' => 10, 'order' => 'updated_date DESC']);

        $returnarray = [];

        foreach ($models as $model) {
            $returnarray[] = ['id' => $model->name, 'label' => $model->name, 'icon' => 'list-alt', 'url' => ['view', 'id' => $model->id]];
        }

        return $returnarray;
    }

    public function getTopRelated($id)
    {

        $_related = self::model()->findByPk((int)$id)->name;
        $_exp = explode(" ", $_related);


        $criteria = new CDbCriteria;

        if (isset($_exp[0]))
            $criteria->compare('name', $_exp[0], true, 'OR');

        if (isset($_exp[1]))
            $criteria->compare('name', $_exp[1], true, 'OR');

        $criteria->limit = 10;
        $criteria->order = 'updated_date DESC';

        $models = self::model()->findAll($criteria);

        $returnarray = [];

        foreach ($models as $model) {
            $returnarray[] = ['id' => $model->name, 'label' => $model->name, 'url' => ['view', 'id' => $model->id]];
        }

        return $returnarray;
    }

    public static function items()
    {

        $models = self::model()->findAll();

        foreach ($models as $model) {
            $_items[$model->id] = $model->name;
        }

        return $_items;
    }

    /////////////////////////////////////////////
    public function getRootList()
    {

        $models = self::model()->findAll(['condition' => 'parent_id = 0']);


        $_items = [];

        foreach ($models as $model)
            $_items[$model->id] = $model->name;

        return $_items;
    }

    /////////////////////////////////////////////
    public function getListProject()
    {

        $models = self::model()->findAll('parent_id =' . sUser::model()->myGroupRoot);


        $_items = [];

        $_items[sUser::model()->myGroupRoot] = "(ALL)";

        foreach ($models as $model)
            foreach ($model->childs as $mod)
                $_items[$mod->id] = $mod->name;

        return $_items;
    }

    public function getTopLevel()
    {
        if ($this->parent_id == 0) {
            $_level = $this->name;
        } elseif ($this->getparent->parent_id == 0) {
            $_level = $this->getparent->name;
        } elseif ($this->getparent->getparent->parent_id == 0) {
            $_level = $this->getparent->getparent->name;
        } elseif ($this->getparent->getparent->getparent->parent_id == 0) {
            $_level = $this->getparent->getparent->getparent->name;
        } elseif ($this->getparent->getparent->getparent->getparent->parent_id == 0) {
            $_level = $this->getparent->getparent->getparent->getparent->name;
        } elseif ($this->getparent->getparent->getparent->getparent->getparent->parent_id == 0) {
            $_level = $this->getparent->getparent->getparent->getparent->getparent->name;
        }

        return $_level;
    }

    public function getTopLevelId()
    {
        if ($this->parent_id == 0) {
            $_level = $this->id;
        } elseif ($this->getparent->parent_id == 0) {
            $_level = $this->getparent->id;
        } elseif ($this->getparent->getparent->parent_id == 0) {
            $_level = $this->getparent->getparent->id;
        } elseif ($this->getparent->getparent->getparent->parent_id == 0) {
            $_level = $this->getparent->getparent->getparent->id;
        } elseif ($this->getparent->getparent->getparent->getparent->parent_id == 0) {
            $_level = $this->getparent->getparent->getparent->getparent->id;
        } elseif ($this->getparent->getparent->getparent->getparent->getparent->parent_id == 0) {
            $_level = $this->getparent->getparent->getparent->getparent->getparent->id;
        }

        return $_level;
    }

    /////////////////////////////////////////////
    public function getListed($id)
    {

        $models = self::model()->findAll(['condition' => 'parent_id = 0']);
        $mod = self::model()->findByPk((int)$id);


        $_items = [];
        $_items1 = [];

        foreach ($models as $model)
            $_items[$model->name] = ['label' => $model->name, 'url' => ['index', 'id' => $model->id]];

        $_items1[$model->name] = ['label' => 'Project: ' . $mod->name, 'url' => ['index', 'id' => $model->id], 'items' => $_items];

        return $_items1;
    }

    public function getData($cnd = " = 0")
    {
        $data = [];
        foreach (aOrganization::model()->findAll('parent_id ' . $cnd) as $model) {
            $row['text'] = $model->name;
            $row['id'] = $model->id;
            $row['children'] = aOrganization::model()->getData(' = ' . $model->id);
            $data[] = $row;
        }
        return $data;
    }

    public function getListPersonalia()
    {
        $subitems = [];

        $model = $this->find(['condition' => 'id = ' . $this->id]);
        if ($this->childs)
            foreach ($this->childs as $child)
                $subitems[] = $child->getListPersonalia();

        $returnarray = ['label' => $this->name, 'url' => Yii::app()->createUrl("/m3/cPersonalia/index", ["id" => $this->id])];

        if ($subitems != [])
            $returnarray = array_merge($returnarray, ['items' => $subitems]);

        return $returnarray;
    }

    public function getListAbsence()
    {
        $subitems = [];

        $model = $this->find(['condition' => 'id = ' . $this->id]);
        if ($this->childs)
            foreach ($this->childs as $child)
                $subitems[] = $child->getListAbsence();

        $returnarray = ['label' => $this->name, 'url' => Yii::app()->createUrl("/m3/cAbsence/index", ["id" => $this->id])];

        if ($subitems != [])
            $returnarray = array_merge($returnarray, ['items' => $subitems]);

        return $returnarray;
    }

}
