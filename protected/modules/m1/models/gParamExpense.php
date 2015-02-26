<?php

/**
 * This is the model class for table "g_param_expense".
 *
 * The followings are the available columns in table 'g_param_expense':
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
class gParamExpense extends baseModel
{

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return gParamExpense the static model class
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
        return 'g_param_expense';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['name, amount', 'required'],
            ['parent_id, status_id, sort, amount, created_date, created_by, updated_date, updated_by', 'numerical', 'integerOnly' => true],
            ['name', 'length', 'max' => 100],
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            ['id, parent_id, sort, name, amount, created_date, created_by, updated_date, updated_by', 'safe', 'on' => 'search'],
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
            'category' => [self::BELONGS_TO, 'sParameter', ['parent_id' => 'code'], 'condition' => 'type = \'cOffWorking\''],
            'getparent' => [self::BELONGS_TO, 'gParamExpense', 'parent_id'],
            'childs' => [self::HAS_MANY, 'gParamExpense', 'parent_id', 'order' => 'childs.id ASC'],
            'status' => [self::BELONGS_TO, 'sParameter', ['status_id' => 'code'], 'condition' => 'type = "cOrganizationStatus"'],
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
            'status_id' => 'Status',
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

    public static function expenseDropDown()
    {
        $_items = [];

        $criteria = new CDbCriteria;

        //$criteria->compare('company_id', sUser::model()->myGroup);
        $criteria->compare('status_id', 1);
        $criteria->compare('parent_id', 0);
        $criteria->order = 'parent_id, sort';
        $models = self::model()->findAll($criteria);

        foreach ($models as $model) {
            $criteria2 = new CDbCriteria;
            $criteria2->compare('parent_id', $model->id);
            //$criteria2->compare('level_id', sUser::model()->currentPerson()->mLevelParentId());
            $modelchild = self::model()->findAll($criteria2);
            foreach ($modelchild as $mod)
                $_items[$mod->id] = $mod->name;
        }
        return $_items;
    }

    public function getCurrentAmount()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('parent_id', $this->id);
        $criteria->order = 'yearmonth_start DESC';
        $model = self::model()->find($criteria);

        if ($model == null) {
            return 0;
        } else
            return $model->amount;
    }

}
