<?php

/**
 * This is the model class for table "g_vacancy_applicant".
 *
 * The followings are the available columns in table 'g_vacancy_applicant':
 * @property integer $id
 * @property integer $applicant_id
 * @property integer $vacancy_id
 */
class hVacancyApplicant extends BaseModel
{

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return GVacancyApplicant the static model class
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
        return 'h_vacancy_applicant';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['applicant_id, vacancy_id,status_id', 'required'],
            ['applicant_id, vacancy_id, status_id', 'numerical', 'integerOnly' => true],
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            ['id, applicant_id, vacancy_id', 'safe', 'on' => 'search'],
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
            'applicant' => [self::BELONGS_TO, 'hApplicant', 'applicant_id'],
            'vacancy' => [self::BELONGS_TO, 'hVacancy', 'vacancy_id'],
            'comment' => [self::HAS_MANY, 'hVacancyApplicantComment', 'parent_id'],
            'status' => [self::BELONGS_TO, 'sParameter', ['status_id' => 'code'], 'condition' => 'type = \'cApplicantStatus\''],
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'applicant_id' => 'Applicant',
            'vacancy_id' => 'Vacancy',
        ];
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search($id, $act)
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('vacancy_id', $id);
        $criteria->with = ['applicant'];
        $criteria->order = 't.created_date DESC';

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            //'pagination'=>array(
            //	'pageSize'=>20,
            //)
        ]);
    }

    public function searchByApplicant($id)
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('applicant_id', $id);
        $criteria->with = ['applicant'];
        $criteria->order = 't.created_date DESC';

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            //'pagination'=>array(
            //	'pageSize'=>20,
            //)
        ]);
    }

    public static function getTopRecentInterview()
    {

        $criteria = new CDbCriteria;
        $criteria->limit = 10;
        $criteria->together = true;
        $criteria->order = "t.created_date DESC";
        $criteria->with = ['comment'];

        if (Yii::app()->user->name != "admin") {
            $criteria2 = new CDbCriteria;
            $criteria2->with = ['vacancy'];
            $criteria2->condition = 'vacancy.company_id IN (' . implode(",", sUser::model()->myGroupArray) . ')';
            $criteria->mergeWith($criteria2);
        }


        $models = self::model()->findAll($criteria);

        $returnarray = [];

        foreach ($models as $model) {
            $returnarray[] = ['id' => $model->id, 'label' => $model->applicant->applicant_name . " - " . $model->vacancy->vacancy_title, 'icon' => 'list-alt', 'url' => ['/m1/hVacancy/interviewDetail', 'id' => $model->id]];
        }

        return $returnarray;
    }

    public static function listVacancy($id)
    {
        $returnarray = [];
        $criteria = new CDbCriteria;
        $criteria->compare('applicant_id', $id);
        $criteria->limit = 10;
        $models = self::model()->findAll($criteria);

        $returnarray[0] = "Non Applied";
        foreach ($models as $model) {
            $returnarray[$model->vacancy_id] = $model->vacancy->vacancy_title;
        }

        return $returnarray;
    }

}
