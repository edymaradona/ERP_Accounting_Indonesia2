<?php

/**
 * This is the model class for table "g_person_performance".
 *
 * The followings are the available columns in table 'g_person_performance':
 * @property integer $id
 * @property integer $parent_id
 * @property string $input_date
 * @property integer $year
 * @property string $pa_value
 * @property string $remark
 *
 * The followings are the available model relations:
 * @property GPerson $parent
 */
class gTalentPerformance extends BaseModel
{

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return gPersonPerformance the static model class
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
        return 'g_talent_performance';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['parent_id, input_date, year, pa_value', 'required'],
            ['input_date', 'date', 'format' => 'dd-MM-yyyy'],
            ['parent_id, year,period_id', 'numerical', 'integerOnly' => true],
            ['pa_value, potential', 'length', 'max' => 5],
            //array('parent_id', 'UniqueAttributesValidator', 'with'=>'year','message'=>'Double Year Input'),
            ['remark, future_dev', 'length', 'max' => 300],
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            ['id, parent_id, input_date, year, pa_value, remark', 'safe', 'on' => 'search'],
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
            'parent' => [self::BELONGS_TO, 'gPerson', 'parent_id'],
            'period' => [self::BELONGS_TO, 'sParameter', ['period_id' => 'code'], 'condition' => 'type = \'cSemester\''],
            'created' => [self::BELONGS_TO, 'sUser', 'created_by'],
            'updated' => [self::BELONGS_TO, 'sUser', 'updated_by'],
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
            'input_date' => 'Input Date',
            'year' => 'Year',
            'period_id' => 'Period',
            'amount' => 'Amount',
            'pa_value' => 'PA Value',
            'potential' => 'HF Identification',
            'future_dev' => 'Future Development',
            'remark' => 'Remark',
        ];
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search($id)
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('parent_id', $id);

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            'pagination' => false,
            'sort' => [
                'defaultOrder' => 'year DESC',
            ]
        ]);
    }

    public function valPerformance()
    {
        if ($this->amount >= 1 && $this->amount <= 2.9) {
            $_val = "Low Performer";
        } elseif ($this->amount >= 3 && $this->amount <= 4.4) {
            $_val = "Mid Performer";
        } elseif ($this->amount >= 4.5 && $this->amount <= 5) {
            $_val = "High Performer";
        } else
            $_val = "ERROR";

        return $_val;
    }

    public static function getTalentPeriod()
    {
        $period['2013'] = "2013";
        $period['2014'] = "2014";

        return $period;
    }

}
