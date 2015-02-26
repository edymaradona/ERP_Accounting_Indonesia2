<?php

/**
 * This is the model class for table "g_param_medical".
 *
 * The followings are the available columns in table 'g_param_medical':
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
class gParamMedical extends BaseModel
{

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return gParamMedical the static model class
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
        return 'g_param_medical';
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
            ['parent_id, status_id, sort, amount, company_id, medical_company_id, level_id, yearmonth_start, created_date, created_by, updated_date, updated_by', 'numerical', 'integerOnly' => true],
            ['name', 'length', 'max' => 100],
            ['formula', 'length', 'max' => 1000],
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
            'getparent' => [self::BELONGS_TO, 'gParamMedical', 'parent_id'],
            'childs' => [self::HAS_MANY, 'gParamMedical', 'parent_id', 'order' => 'childs.id ASC'],
            'status' => [self::BELONGS_TO, 'sParameter', ['status_id' => 'code'], 'condition' => 'type = "cOrganizationStatus"'],
            'level' => [self::BELONGS_TO, 'gParamLevel', 'level_id'],
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
            'level_id' => 'Level',
            'medical_company_id' => 'Medical Company',
            'company_id' => 'Company',
            'yearmonth_start' => 'YearMonth Start',
            'amount' => 'Amount',
            'formula' => 'Formula',
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
        $criteria->compare('company_id', sUser::model()->myGroup);
        $criteria->order = 'sort';

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            'pagination' => [
                'pageSize' => 50
            ],
        ]);
    }

    public static function medicalDropDown()
    {
        $_items = [];

        $criteria = new CDbCriteria;

        $criteria->compare('company_id', sUser::model()->myGroup);
        $criteria->compare('status_id', 1);
        $criteria->compare('parent_id', 0);
        $criteria->order = 'parent_id, sort';
        $models = self::model()->findAll($criteria);

        foreach ($models as $model) {
            $criteria2 = new CDbCriteria;
            $criteria2->compare('parent_id', $model->id);
            $criteria2->compare('level_id', sUser::model()->currentPerson()->mLevelParentId());
            $modelchild = self::model()->findAll($criteria2);
            foreach ($modelchild as $mod)
                $_items[$mod->id] = $mod->name;
        }
        return $_items;
    }

    public static function medicalDropDownAll()
    {
        $_items = [];

        $criteria = new CDbCriteria;

        $criteria->compare('company_id', sUser::model()->myGroup);
        $criteria->compare('status_id', 1);
        $criteria->compare('parent_id', 0);
        $criteria->order = 'parent_id, sort';
        $models = self::model()->findAll($criteria);

        foreach ($models as $model) {
            $criteria2 = new CDbCriteria;
            $criteria2->compare('parent_id', $model->id);
            $modelchild = self::model()->findAll($criteria2);
            foreach ($modelchild as $mod) {
                $desc = ($mod->level_id == 0) ? " (All Level)" : " (" . $mod->level->name;
                $value = ($mod->medical_company_id == 1) ? " =  " . peterFunc::indoFormat($mod->currentAmount) . ")" : ")";
                $_items[$model->name][$mod->id] = $mod->name . $desc . $value;
            }
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

    public static function medicalDropDownParent()
    {
        $_items = [];

        $criteria = new CDbCriteria;
        $criteria->order = 'sort';
        $criteria->compare('parent_id', 0);
        $criteria->compare('company_id', sUser::model()->myGroup);
        $models = self::model()->findAll($criteria);

        $_items['0'] = ".:ROOT:.";
        foreach ($models as $model) {
            $_items[$model->id] = $model->name;

            $criteria1 = new CDbCriteria;
            $criteria1->order = 'sort';
            $criteria1->compare('parent_id', $model->id);
            $mod = self::model()->findAll($criteria1);

            foreach ($mod as $m)
                $_items[$m->id] = "--" . $m->name;

        }

        return $_items;
    }

}
