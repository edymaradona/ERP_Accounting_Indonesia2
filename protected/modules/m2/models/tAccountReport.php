<?php

class tAccountReport extends BaseModel
{

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 't_account_report';
    }

    public function rules()
    {
        return [
            ['parent_id, sort, title, description, link', 'required'],
            ['sort', 'numerical', 'integerOnly' => true],
            ['parent_id', 'length', 'max' => 20],
            ['title', 'length', 'max' => 50],
            ['description', 'length', 'max' => 100],
            ['link', 'length', 'max' => 255],
            ['id, parent_id, sort, title, description, link', 'safe', 'on' => 'search'],
        ];
    }

    public function relations()
    {
        return [
            'getparent' => [self::BELONGS_TO, 'tAccountReport', 'parent_id'],
            'childs' => [self::HAS_MANY, 'tAccountReport', 'parent_id', 'order' => 'id ASC'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent',
            'sort' => 'Sort',
            'title' => 'Title',
            'description' => 'Description',
            'link' => 'Link',
        ];
    }

    public function search()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('parent_id!', 0);

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
        ]);
    }

    public static function accountReportList()
    {
        $_items[] = [];

        $models = self::model()->findAll('parent_id !=0');


        foreach ($models as $model) {
            $_items[$model->getparent->title][$model->id] = $model->title;
        }

        return $_items;
    }

}
