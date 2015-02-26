<?php

/**
 * This is the model class for table "g_param_selection".
 *
 * The followings are the available columns in table 'g_param_selection':
 * @property integer $id
 * @property integer $parent_id
 * @property integer $sort
 * @property string $name
 * @property integer $created_date
 * @property integer $created_by
 * @property integer $updated_date
 * @property integer $updated_by
 */
class gParamSelection extends BaseModel
{

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return gParamLevel the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'g_param_selection';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['name', 'required'],
            ['parent_id, sort, created_date, created_by, updated_date, updated_by', 'numerical', 'integerOnly' => true],
            ['name', 'length', 'max' => 100],
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            ['id, parent_id, sort, name, created_date, created_by, updated_date, updated_by', 'safe', 'on' => 'search'],
        ];
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return [
            'getparent' => [self::BELONGS_TO, 'gParamSelection', 'parent_id'],
            'childs' => [self::HAS_MANY, 'gParamSelection', 'parent_id', 'order' => 'id ASC'],
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent',
            'sort' => 'Sort',
            'name' => 'Name',
            'created_date' => 'Created Date',
            'created_by' => 'Created By',
            'updated_date' => 'Updated Date',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('name', $this->name, true);
        $criteria->order = 'sort';

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            'pagination' => [
                'pageSize' => 50,
            ]
        ]);
    }

    public static function levelDropDown()
    {
        $_items = [];

        $criteria = new CDbCriteria;
        $criteria->order = 'sort';
        $criteria->compare('parent_id', 0);

        $models = self::model()->findAll($criteria);
        foreach ($models as $model)
            foreach ($model->childs as $mod)
                if ($mod->id != 22) //ID 22 FOR HOLDING ONLY
                    $_items[$mod->getparent->name][$mod->id] = $mod->name;

        return $_items;
    }

    public static function levelDropDownBss()
    {
        $_items = [];

        $criteria = new CDbCriteria;
        $criteria->order = 'sort';
        $criteria->addInCondition('id', [1, 2]);
        $models = self::model()->findAll($criteria);
        foreach ($models as $model)
            foreach ($model->childs as $mod)
                $_items[$mod->getparent->name][$mod->id] = $mod->name;

        return $_items;
    }

    public static function levelDropDownParent()
    {
        $_items = [];

        $criteria = new CDbCriteria;
        $criteria->order = 'sort';
        $criteria->compare('parent_id', 0);
        $models = self::model()->findAll($criteria);

        $_items['0'] = ".:ROOT:.";
        foreach ($models as $model)
            $_items[$model->id] = $model->name;

        return $_items;
    }

}
