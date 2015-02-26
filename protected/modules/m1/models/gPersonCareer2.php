<?php

/**
 * This is the model class for table "g_person_career2".
 *
 * The followings are the available columns in table 'g_person_career2':
 * @property integer $id
 * @property integer $parent_id
 * @property string $start_date
 * @property integer $status_id
 * @property integer $company_id
 * @property integer $department_id
 * @property integer $level_id
 * @property string $job_title
 * @property string $reason
 *
 * The followings are the available model relations:
 * @property GPerson $parent
 */
class gPersonCareer2 extends BaseModel
{

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return gPersonCareer the static model class
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
        return 'g_person_career2';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['start_date, status_id, company_id, department_id, level_id, job_title', 'required'],
            ['start_date, end_date', 'date', 'format' => 'dd-MM-yyyy'],
            ['parent_id, status_id, company_id, department_id, level_id', 'numerical', 'integerOnly' => true],
            ['job_title, reason', 'length', 'max' => 100],
            ['start_date', 'safe'],
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            ['id, parent_id, start_date, status_id, company_id, department_id, level_id, job_title, reason', 'safe', 'on' => 'search'],
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
            'company' => [self::BELONGS_TO, 'aOrganization', 'company_id'],
            'department' => [self::BELONGS_TO, 'aOrganization', 'department_id'],
            'level' => [self::BELONGS_TO, 'gParamLevel', 'level_id'],
            'status' => [self::BELONGS_TO, 'sParameter', ['status_id' => 'code'], 'condition' => 'type = \'cPromotion\''],
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
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'status_id' => 'Status',
            'company_id' => 'Company',
            'department_id' => 'Department',
            'level_id' => 'Level',
            'job_title' => 'Job Title',
            'reason' => 'Reason',
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
        $criteria->order = 'start_date DESC';

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            'pagination' => false,
        ]);
    }

    public function getEmployeeFinanceID()
    {
        $custom1 = peterFunc::issetC($this->company->custom1);
        $custom2 = peterFunc::issetC($this->company->custom2);
        $custom3 = peterFunc::issetC($this->company->custom3);

        $empid = str_pad($custom1, 3, '0', STR_PAD_LEFT) . ' - ' .
            str_pad($custom2, 1, '0', STR_PAD_LEFT) . ' - ' .
            str_pad($custom3, 2, '0', STR_PAD_LEFT) . ' - ' .
            str_pad($custom1, 3, '0', STR_PAD_LEFT);

        return $empid;
    }

}
