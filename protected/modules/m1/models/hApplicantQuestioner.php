<?php

/**
 * This is the model class for table "h_vacancy_questioner".
 *
 * The followings are the available columns in table 'h_vacancy_questioner':
 * @property integer $id
 * @property integer $parent_id
 * @property string $q01
 * @property string $q02
 * @property string $q03
 * @property string $q04
 * @property string $q05
 * @property string $q06
 * @property string $q07
 * @property string $q08
 * @property string $q09
 * @property string $q10
 * @property string $q11
 * @property string $q12
 * @property string $q13
 * @property string $q14
 * @property string $q15
 */
class hApplicantQuestioner extends BaseModel
{

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return hVacancyQuestioner the static model class
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
        return 'h_applicant_questioner';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['parent_id', 'numerical', 'integerOnly' => true],
            ['q01, q02, q03, q04, q06, q07, q08, q09, q10, q11, q12, q13, q14, q15', 'length', 'max' => 500],
            ['q05', 'length', 'max' => 45],
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            ['id, parent_id, q01, q02, q03, q04, q05, q06, q07, q08, q09, q10, q11, q12, q13, q14, q15', 'safe', 'on' => 'search'],
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
            'id' => 'ID',
            'parent_id' => 'Parent',
            'q01' => 'Q01',
            'q02' => 'Q02',
            'q03' => 'Q03',
            'q04' => 'Q04',
            'q05' => 'Q05',
            'q06' => 'Q06',
            'q07' => 'Q07',
            'q08' => 'Q08',
            'q09' => 'Q09',
            'q10' => 'Q10',
            'q11' => 'Q11',
            'q12' => 'Q12',
            'q13' => 'Q13',
            'q14' => 'Q14',
            'q15' => 'Q15',
            'revisi_id' => 'Revisi',
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

        $criteria->compare('id', $this->id);
        $criteria->compare('parent_id', $this->parent_id);
        $criteria->compare('q01', $this->q01, true);
        $criteria->compare('q02', $this->q02, true);
        $criteria->compare('q03', $this->q03, true);
        $criteria->compare('q04', $this->q04, true);
        $criteria->compare('q05', $this->q05, true);
        $criteria->compare('q06', $this->q06, true);
        $criteria->compare('q07', $this->q07, true);
        $criteria->compare('q08', $this->q08, true);
        $criteria->compare('q09', $this->q09, true);
        $criteria->compare('q10', $this->q10, true);
        $criteria->compare('q11', $this->q11, true);
        $criteria->compare('q12', $this->q12, true);
        $criteria->compare('q13', $this->q13, true);
        $criteria->compare('q14', $this->q14, true);
        $criteria->compare('q15', $this->q15, true);

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
        ]);
    }

}
