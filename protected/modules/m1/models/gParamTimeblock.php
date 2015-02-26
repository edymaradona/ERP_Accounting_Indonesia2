<?php

/**
 * This is the model class for table "c_timeblock".
 *
 * The followings are the available columns in table 'c_timeblock':
 * @property integer $id
 * @property string $code
 * @property string $in
 * @property string $out
 * @property string $rest_in
 * @property string $rest_out
 */
class gParamTimeblock extends BaseModel
{

    /**
     * Returns the static model of the specified AR class.
     * @return CTimeblock the static model class
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
        return 'g_param_timeblock';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['code,in,out', 'required'],
            ['code', 'length', 'max' => 25],
            ['company_id', 'numerical', 'integerOnly' => true],
            ['in, out, rest_in, rest_out', 'safe'],
            ['remark', 'length', 'max' => 300],
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            ['id, code, in, out, rest_in, rest_out', 'safe', 'on' => 'search'],
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
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Code',
            'company_id' => 'Company',
            'code' => 'Name',
            'in' => 'In',
            'out' => 'Out',
            'rest_in' => 'Rest In',
            'rest_out' => 'Rest Out',
            'remark' => 'Remark',
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

        $criteria->compare('code', $this->code, true);
        $criteria->compare('company_id', sUser::model()->myGroup);

        return new CActiveDataProvider(get_class($this), [
            'criteria' => $criteria,
            'pagination' => [
                'pageSize' => 50,
            ]
        ]);
    }


    /**
     * Loads the lookup items for the specified type from the database.
     * @param string the item type
     */
    public static function timeBlockDropDown()
    {
        $_items = [];
        $criteria = new CDbCriteria;
        $criteria->compare('company_id', sUser::model()->myGroup);
        $criteria->order = 'code';

        $criteria1 = new CDbCriteria;
        $criteria1->addInCondition('id', [89, 90]);

        $criteria->mergeWith($criteria1, false);

        $models = self::model()->findAll($criteria);
        foreach ($models as $model)
            $_items[$model->id] = $model->code . " (" . Yii::app()->dateFormatter->format("kk:mm", strtotime($model->in)) . " - " . Yii::app()->dateFormatter->format("kk:mm", strtotime($model->out)) . ")";

        return $_items;
    }

    protected function afterFind()
    {
        $this->in = date("H:i", strtotime($this->in));
        $this->out = date("H:i", strtotime($this->out));

        return true;
    }
}
