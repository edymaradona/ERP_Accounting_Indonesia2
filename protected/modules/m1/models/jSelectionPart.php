<?php

/**
 * This is the model class for table "i_learning_sch_part".
 *
 * The followings are the available columns in table 'i_learning_sch_part':
 * @property integer $id
 * @property integer $parent_id
 * @property integer $employee_id
 * @property integer $flow_id
 * @property integer $created_date
 * @property string $created_by
 */
class jSelectionPart extends BaseModel
{

    public $applicant_name;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return iLearningSchPart the static model class
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
        return 'j_selection_part';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['parent_id, applicant_id, flow_id, company_id, department_id, level_id, for_position', 'required'],
            ['parent_id, applicant_id, flow_id, company_id, department_id, level_id, created_date', 'numerical', 'integerOnly' => true],
            ['created_by', 'length', 'max' => 50],
            ['remark', 'length', 'max' => 500],
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            ['parent_id, applicant_id, flow_id, created_date, created_by', 'safe', 'on' => 'search'],
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
            'getparent' => [self::BELONGS_TO, 'jSelection', 'parent_id'],
            'applicant' => [self::BELONGS_TO, 'hApplicant', 'applicant_id'],
            'employee' => [self::BELONGS_TO, 'gPerson', 'applicant_id'],
            'flow' => [self::BELONGS_TO, 'sParameter', ['flow_id' => 'code'], 'condition' => 'type = \'cTrainingRegister\''],
            'company' => [self::BELONGS_TO, 'aOrganization', 'company_id'],
            'department' => [self::BELONGS_TO, 'aOrganization', 'department_id'],
            'level' => [self::BELONGS_TO, 'gParamLevel', 'level_id'],
            'created' => [self::BELONGS_TO, 'sUser', 'created_by'],
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
            'applicant_id' => 'Applicant Name',
            'employee_name' => 'Applicant Name',
            'company_id' => 'Company',
            'department_id' => 'Department',
            'level_id' => 'Level',
            'for_position' => 'For Position',
            'flow_id' => 'Status',
            'remark' => 'Remark',
            'created_date' => 'Created Date',
            'created_by' => 'Created By',
        ];
    }

    public function search($id)
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('parent_id', $id);
        $criteria->with = ['applicant'];

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            'pagination' => [
                'pageSize' => 50,
            ],
            'sort' => [
                'defaultOrder' => 't.created_date DESC',
            ]
        ]);
    }

    public function searchByEmp($id)
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('applicant_id', $id);
        $criteria->with = ['getparent'];

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            'sort' => [
                'defaultOrder' => 'getparent.schedule_date',
            ]
        ]);
    }

    public function searchByEmployee($id)
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('applicant_id', $id);
        $criteria->with = ['getparent'];
        $criteria->compare('flow_id', 2);

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            'pagination' => [
                'pageSize' => 50,
            ],
            'sort' => [
                'defaultOrder' => 'getparent.schedule_date',
            ]
        ]);
    }

    public function afterSave()
    {
        if ($this->isNewRecord) {
            $model = new sNotification;
            $model->group_id = 4;
            $model->link = 'm1/jSelection/view/id/' . $this->parent_id;
            $model->link2 = 'm1/hApplicant/view/id/' . $this->applicant_id;
            $model->content = '<link2>' . $this->applicant->applicant_name . '</link2> has been added to ' . $this->getparent->category->name .
                ' Selection Schedule on <read>' . $this->getparent->schedule_date . '</read>';
            $model->save(false);
        }
        return true;
    }

}
