<?php

/**
 * This is the model class for table "g_person_performance".
 *
 * The followings are the available columns in table 'g_person_performance':
 * @property integer $id
 * @property integer $parent_id
 * @property string $input_date
 * @property integer $year
 * @property string $proficiency_level
 * @property string $remark
 *
 * The followings are the available model relations:
 * @property GPerson $parent
 */
class gTalentPotential extends BaseModel
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
        return 'g_talent_potential';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['parent_id, input_date, year,amount', 'required'],
            ['input_date', 'date', 'format' => 'dd-MM-yyyy'],
            ['parent_id, year', 'numerical', 'integerOnly' => true],
            ['proficiency_level', 'length', 'max' => 10],
            ['remark', 'length', 'max' => 300],
            //['core_description, management_description', 'length', 'max' => 10000],
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            ['id, parent_id, input_date, year, proficiency_level, remark,core_description, management_description', 'safe', 'on' => 'search'],
            ['parent_id', 'UniqueAttributesValidator', 'with' => 'year', 'message' => 'year has been inputted'],
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
            'amount' => 'Competency (%)',
            'proficiency_level' => 'Proficiency Level',
            'core_description' => 'Core Description',
            'management_description' => 'Managerial Description',
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
        ]);
    }

    public function valPotential()
    {
        if ($this->amount <= 49) {
            $_val = "Tidak memenuhi kriteria";
        } elseif ($this->amount >= 50 && $this->amount <= 59) {
            $_val = "Memerlukan pengembangan yang intensif";
        } elseif ($this->amount >= 60 && $this->amount <= 69) {
            $_val = "Memenuhi Kriteria dengan sedikit pengembangan";
        } elseif ($this->amount >= 70 && $this->amount <= 84) {
            $_val = "Memenuhi kriteria";
        } elseif ($this->amount >= 85) {
            $_val = "Diatas kriteria yang ditetapkan";
        } else
            $_val = "ERROR";

        return $_val;
    }

}
