<?php

/**
 * This is the model class for table "g_param_payroll".
 *
 * The followings are the available columns in table 'g_param_payroll':
 * @property integer $id
 * @property integer $parent_id
 * @property integer $sort
 * @property string $name
 * @property integer $amount
 * @property integer $created_date
 * @property integer $created_by
 * @property integer $updated_date
 * @property integer $updated_by
 */
class gParamPayroll extends baseModel
{

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return gParamPayroll the static model class
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
        return 'g_param_payroll';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['name,amount', 'required'],
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
            'getparent' => [self::BELONGS_TO, 'gParamPayroll', 'parent_id'],
            'childs' => [self::HAS_MANY, 'gParamPayroll', 'parent_id', 'order' => 'childs.id ASC'],
            'last_amount' => [self::HAS_ONE, 'gParamPayroll', 'parent_id', 'order' => 'yearmonth_start DESC'],
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
            'amount' => 'Amount',
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
                'pageSize' => 50
            ],
        ]);
    }

    public static function payrollDropDown()
    {
        $_items = [];

        $criteria = new CDbCriteria;
        $criteria->order = 'parent_id, sort';
        $criteria->compare('parent_id', 1);
        $models = self::model()->findAll($criteria);
        foreach ($models as $model)
            $_items[$model->id] = $model->name;

        return $_items;
    }

    public static function benefitDropDown()
    {
        $_items = [];

        $criteria = new CDbCriteria;
        $criteria->order = 't.parent_id, t.sort';
        $criteria->with = ['getparent'];
        $criteria->compare('getparent.parent_id', 2);
        $models = self::model()->findAll($criteria);
        foreach ($models as $model)
            $_items[$model->getparent->name][$model->id] = $model->name;

        return $_items;
    }

    public static function deductionDropDown()
    {
        $_items = [];

        $criteria = new CDbCriteria;
        $criteria->order = 't.parent_id, t.sort';
        $criteria->with = ['getparent'];
        $criteria->compare('getparent.parent_id', 3);
        $models = self::model()->findAll($criteria);
        foreach ($models as $model)
            $_items[$model->getparent->name][$model->id] = $model->name;

        return $_items;
    }

}
