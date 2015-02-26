<?php

class sHelp extends BaseModel
{

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 's_help';
    }

    public function rules()
    {
        return [
            ['parent_id, sort, title', 'required'],
            ['sort,parent_id', 'numerical', 'integerOnly' => true],
            ['title, name', 'length', 'max' => 50],
            ['description, image', 'length', 'max' => 100],
            ['link', 'length', 'max' => 255],
            ['id, parent_id, title, description, link', 'safe', 'on' => 'search'],
        ];
    }

    public function relations()
    {
        return [
            'getparent' => [self::BELONGS_TO, 'sHelp', 'parent_id'],
            'childs' => [self::HAS_MANY, 'sHelp', 'parent_id', 'order' => 'id ASC'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent ID',
            'sort' => 'Sort',
            'name' => 'Apps Name',
            'title' => 'Title',
            'description' => 'Description',
            'link' => 'Link',
            'image' => 'Icon',
        ];
    }

    public function search()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('parent_id', $this->parent_id, true);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('link', $this->link, true);
        $criteria->order = ('sort');

        return new CActiveDataProvider(get_class($this), [
            'criteria' => $criteria,
            'pagination' => [
                'pageSize' => 100,
            ],
        ]);
    }

    public function getTree()
    {
        $subitems = [];

        if ($this->childs)
            foreach ($this->childs as $child) {
                $subitems[] = $child->getTree();
            }

        if ($this->link != null) {
            $returnarray = ['text' => CHtml::link($this->title, Yii::app()->createUrl('/help/' . $this->name . '/link/view/' . $this->link))];
        } else
            $returnarray = ['text' => CHtml::link($this->title, Yii::app()->createUrl('/help'))];


        if ($subitems != [])
            $returnarray = array_merge($returnarray, ['children' => $subitems]);
        return $returnarray;
    }

    public function searchMenuImage()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('parent_id', 0);
        $criteria->order = ('sort');

        return new CActiveDataProvider(get_class($this), [
            'criteria' => $criteria,
        ]);
    }

    public static function items()
    {
        $_items = [];
        $models = self::model()->findAll([
            'order' => 'sort',
            'condition' => 'parent_id = 0',
        ]);

        $_items[0] = "(ROOT)";

        foreach ($models as $model) {
            //if ($model->childs)
            $_items[$model->id] = $model->sort . ' - ' . $model->title;
        }

        return $_items;
    }

    public static function itemsAll()
    {
        $_items = [];
        $models = self::model()->findAll([
            'order' => 'sort',
        ]);

        $_items[0] = "(ROOT)";

        foreach ($models as $model) {
            $_items[$model->id] = $model->sort . ' - ' . $model->title;
        }

        return $_items;
    }

    public function findSort($id)
    {
        $model = $this->findByPk((int)$id);
        if ($model == null)
            return "All";

        return $model->sort;
    }

    public static function getTopOther()
    {

        $models = self::model()->findAll(['limit' => 10, 'condition' => 'parent_id = 0']);

        $returnarray = [];

        foreach ($models as $model) {
            $returnarray[] = ['id' => $model->id, 'label' => $model->title, 'icon' => 'list-alt', 'url' => ['view', 'id' => $model->id]];
        }

        return $returnarray;
    }

    public function getModuleList()
    {

        $returnarray = [];

        foreach (Yii::app()->modules as $key => $module) {
            $returnarray[$key] = $key;
        }

        return $returnarray;
    }

}
