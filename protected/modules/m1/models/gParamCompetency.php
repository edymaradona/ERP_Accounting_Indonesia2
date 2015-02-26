<?php

/**
 * This is the model class for table "g_param_competency".
 *
 * The followings are the available columns in table 'g_param_competency':
 */
class gParamCompetency extends BaseModel
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
        return 'g_param_competency';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['aspect, description', 'required'],
            ['template_id, aspect, weight, target', 'numerical', 'integerOnly' => true],
            ['aspect', 'length', 'max' => 100],
            ['description', 'length', 'max' => 255],
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
            'template' => [self::BELONGS_TO, 'sParameter', ['template_id' => 'code'], 'condition' => 'type = \'cCompetency\''],
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'template_id' => 'Template',
            'aspect' => 'Aspect',
            'description' => 'Description',
            'weight' => 'Weight',
            'target' => 'Target',
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

    public static function coreDropDown()
    {
        $_items = [];

        $criteria = new CDbCriteria;
        $criteria->compare('template_id', 1);

        $models = self::model()->findAll($criteria);
        foreach ($models as $model)
            $_items[$model->template->name][$model->id] = $model->aspect;

        return $_items;
    }

    public static function leadershipDropDown()
    {
        $_items = [];

        $criteria = new CDbCriteria;
        $criteria->compare('template_id', 2);

        $models = self::model()->findAll($criteria);
        foreach ($models as $model)
            $_items[$model->template->name][$model->id] = $model->aspect;

        return $_items;
    }

    public static function competencyProfileDropDown()
    {
        $_items = [];

        $criteria = new CDbCriteria;
        $criteria->addInCondition('template_id', [1, 2]);

        $models = self::model()->findAll($criteria);
        foreach ($models as $model)
            $_items[$model->template->name][$model->id] = $model->aspect;

        return $_items;
    }

    public static function workResultDropDown($level)
    {
        $_items = [];

        $criteria = new CDbCriteria;
        if ($level >= 10) {
            $criteria->compare('template_id', 3);
        } else
            $criteria->compare('template_id', 4);

        $models = self::model()->findAll($criteria);
        foreach ($models as $model)
            $_items[$model->template->name][$model->id] = $model->aspect;

        return $_items;
    }

}
