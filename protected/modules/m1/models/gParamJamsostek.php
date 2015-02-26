<?php

/**
 * This is the model class for table "g_param_jamsostek".
 *
 * The followings are the available columns in table 'g_param_jamsostek':
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
class gParamJamsostek extends baseModel
{

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return gParamJamsostek the static model class
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
        return 'g_param_jamsostek';
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
            ['parent_id, sort, created_date, created_by, updated_date, updated_by, status_id,yearmonth_start', 'numerical', 'integerOnly' => true],
            ['value', 'numerical'],
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
            'getparent' => [self::BELONGS_TO, 'gParamJamsostek', 'parent_id'],
            'childs' => [self::HAS_MANY, 'gParamJamsostek', 'parent_id', 'order' => 'childs.id ASC'],
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
            'yearmonth_start' => 'Year Month Start',
            'sort' => 'Sort',
            'name' => 'Name',
            'value' => 'Value',
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

    public static function jamsostekDropDown()
    {
        $_items = [];

        $criteria = new CDbCriteria;
        $criteria->order = 'sort';
        $criteria->compare('parent_id', 0);
        $models = self::model()->findAll($criteria);
        foreach ($models as $model)
            foreach ($model->childs as $mod)
                $_items[$mod->getparent->name][$mod->id] = $mod->name;

        return $_items;
    }

    public static function jkk()
    {
        $value = [];

        $criteria = new CDbCriteria;
        $criteria->order = 'yearmonth_start DESC';
        $criteria->compare('code', 'JKK');
        $model = self::model()->find($criteria);

        if ($model == null) {
            return 0;
        } else
            return $model->value / 100;
    }

    public static function jht()
    {
        $value = [];

        $criteria = new CDbCriteria;
        $criteria->order = 'yearmonth_start DESC';
        $criteria->compare('code', 'JHT');
        $model = self::model()->find($criteria);

        if ($model == null) {
            return 0;
        } else
            return $model->value / 100;
    }

    public static function jkm()
    {
        $value = [];

        $criteria = new CDbCriteria;
        $criteria->order = 'yearmonth_start DESC';
        $criteria->compare('code', 'JKM');
        $model = self::model()->find($criteria);

        if ($model == null) {
            return 0;
        } else
            return $model->value / 100;
    }

    public static function jpk()
    {
        $value = [];

        $criteria = new CDbCriteria;
        $criteria->order = 'yearmonth_start DESC';
        $criteria->compare('code', 'JPK');
        $model = self::model()->find($criteria);

        if ($model == null) {
            return 0;
        } else
            return $model->value / 100;
    }

    public static function ptkpwp()
    {
        $value = [];

        $criteria = new CDbCriteria;
        $criteria->order = 'yearmonth_start DESC';
        $criteria->compare('code', 'PTKPWP');
        $model = self::model()->find($criteria);

        if ($model == null) {
            return 0;
        } else
            return $model->value;
    }

    public static function ptkpk()
    {
        $value = [];

        $criteria = new CDbCriteria;
        $criteria->order = 'yearmonth_start DESC';
        $criteria->compare('code', 'PTKPK');
        $model = self::model()->find($criteria);

        if ($model == null) {
            return 0;
        } else
            return $model->value;
    }

    public static function pph21($value = null)
    {
        $criteria = new CDbCriteria;
        $criteria->order = 'yearmonth_start DESC';
        $criteria->compare('code', 'PPH21' . $value);
        $model = self::model()->find($criteria);

        if ($model == null) {
            return 0;
        } else
            return $model;
    }

}
