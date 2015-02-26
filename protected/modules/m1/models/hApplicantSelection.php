<?php

/**
 * This is the model class for table "h_vacancy_applicant_comment".
 *
 * The followings are the available columns in table 'h_vacancy_applicant_comment':
 * @property integer $id
 * @property integer $parent_id
 * @property integer $user_id
 * @property integer $status_id
 * @property string $comment
 * @property integer $created_date
 * @property integer $created_by
 */
class hApplicantSelection extends BaseModel
{

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return HVacancyApplicantComment the static model class
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
        return 'h_applicant_selection';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['parent_id, assessment_date, assessment_summary, development_area', 'required'],
            ['parent_id, created_date, vacancy_id, workflow_id, workflow_result_id, created_by', 'numerical', 'integerOnly' => true],
            ['workflow_by', 'length', 'max' => 30],
            ['id, parent_id, assessment_summary, assessment_date, development_area, created_date, created_by', 'safe', 'on' => 'search'],
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
            'workflow' => [self::BELONGS_TO, 'gParamSelection', 'workflow_id'],
            'workflow_result3' => [self::BELONGS_TO, 'sParameter', ['workflow_result_id' => 'code'], 'condition' => 'type = \'cSelectionState\''],
            'workflow_result' => [self::BELONGS_TO, 'sParameter', ['workflow_result_id' => 'code'], 'condition' => 'type = \'cSelectionResult\''],
            'applicant' => [self::BELONGS_TO, 'hApplicant', 'parent_id'],
            'vacancy' => [self::BELONGS_TO, 'hVacancy', 'vacancy_id'],
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
            'workflow_id' => 'Work Flow',
            'workflow_by' => 'PIC',
            'workflow_result_id' => 'Work Flow Result',
            'vacancy_id' => 'Vacancy',
            'assessment_date' => 'Date',
            'assessment_summary' => 'Summary',
            'development_area' => 'Development Area',
            'created_date' => 'Created Date',
            'created_by' => 'Created By',
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
        $criteria->order = 'assessment_date DESC';

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
        ]);
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function searchA($id, $act)
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('vacancy_id', $id);
        $criteria->addInCondition('workflow_id', $act);
        $criteria->with = ['applicant'];
        $criteria->order = 't.created_date DESC';


        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            //'pagination'=>array(
            //  'pageSize'=>20,
            //)
        ]);
    }

}
