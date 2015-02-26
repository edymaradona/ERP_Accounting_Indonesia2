<?php

/**
 * This is the model class for table "i_learning_sch_part".
 *
 * The followings are the available columns in table 'i_learning_sch_part':
 * @property integer $id
 * @property integer $parent_id
 * @property integer $employee_id
 * @property integer $flow_id
 * @property integer $day1
 * @property integer $day2
 * @property integer $day3
 * @property integer $day4
 * @property integer $created_date
 * @property string $created_by
 */
class iLearningSchPart extends BaseModel
{

    public $employee_name;

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
        return 'i_learning_sch_part';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['parent_id, employee_id, flow_id', 'required'],
            ['parent_id, employee_id, flow_id, day1, day2, day3, day4, created_date', 'numerical', 'integerOnly' => true],
            ['parent_id', 'UniqueAttributesValidator', 'with' => 'employee_id'],
            ['created_by', 'length', 'max' => 50],
            ['certificate_number', 'length', 'max' => 100],
            ['remark', 'length', 'max' => 500],
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            ['parent_id, employee_id, flow_id, day1, day2, day3, day4, created_date, created_by', 'safe', 'on' => 'search'],
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
            'getparent' => [self::BELONGS_TO, 'iLearningSch', 'parent_id'],
            'employee' => [self::BELONGS_TO, 'gPerson', 'employee_id'],
            'flow' => [self::BELONGS_TO, 'sParameter', ['flow_id' => 'code'], 'condition' => 'type = \'cTrainingRegister\''],
            'feedbackCount' => [self::STAT, 'iLearningSchPartFb', 'parent_id', 'select' => 'sum(A1+A2+A3+A4+A5+B1+B2+B3+B4+C1+C2)'],
            'feedbackCountFb' => [self::STAT, 'iLearningSchPartFb', 'parent_id'],
            'feedback' => [self::HAS_ONE, 'iLearningSchPartFb', 'parent_id'],
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
            'employee_id' => 'Employee Name',
            'employee_name' => 'Employee Name',
            'flow_id' => 'Status',
            'day1' => 'Day1',
            'day2' => 'Day2',
            'day3' => 'Day3',
            'day4' => 'Day4',
            'remark' => 'Remark',
            'certificate_number' => 'Certificate Number',
            'created_date' => 'Created Date',
            'created_by' => 'Created By',
        ];
    }

    public function getResultFeedback()
    {
        $result = $this->feedbackCount / 11;
        if ($result == 0) {
            $_return = "::Not Set::";
        } elseif ($result > 0 && $result <= 1.60) {
            $_return = "Very Bad";
        } elseif ($result >= 1.61 && $result <= 2.20) {
            $_return = "Bad";
        } elseif ($result >= 2.21 && $result <= 2.80) {
            $_return = "Good";
        } else
            $_return = "Very Good";

        return $_return;
    }

    public function searchHolding($id)
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('t.parent_id', $id);
        $criteria->with = ['employee'];

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            'pagination' => [
                'pageSize' => 50,
            ],
            //'sort' => [
            //    'defaultOrder' => 'companycurrent.company_id',
            //]
        ]);
    }

    public function search($id)
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('parent_id', $id);
        $criteria->with = ['employee'];

        //if (Yii::app()->user->name != "admin") {
        $criteria2 = new CDbCriteria;
        $criteria2->condition = '(select c.company_id from g_person_career c WHERE t.employee_id=c.parent_id AND c.status_id IN (' . implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) . ') ORDER BY c.start_date DESC LIMIT 1) IN (' . implode(",", sUser::model()->myGroupArray) . ')';
        $criteria->mergeWith($criteria2);
        //}


        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            'pagination' => [
                'pageSize' => 50,
            ],
            'sort' => [
                'defaultOrder' => 'employee.employee_name',
            ]
        ]);
    }

    public function searchByEmployee($id)
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('employee_id', $id);
        $criteria->with = ['getparent'];
        $criteria->compare('flow_id', 2);

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 'getparent.schedule_date DESC',
            )
        ]);
    }

    public function afterSave()
    {
        if ($this->isNewRecord && strtotime($this->getparent->schedule_date) > time()) {
            $model = new sNotification;
            $model->group_id = 3;
            $model->link = 'm1/iLearning/viewDetail/id/' . $this->parent_id;
            $model->link2 = 'm1/iLearning/view/id/' . $this->getparent->parent_id;
            $model->link3 = 'm1/gPerson/view/id/' . $this->employee_id;
            $model->content = '<link3>' . $this->employee->employee_name . '</link3> from ' . $this->employee->mCompany() . ' has been added to <link2>'
                . $this->getparent->getparent->learning_title . '</link2> on <read>'
                . $this->getparent->schedule_date . '</read>';
            $model->photo_path = $this->employee->photoPath;
            $model->save(false);
        }
        return true;
    }

    public static function getLastNumber()
    {
        $lastNumber = 0;

        $criteria = new CDbCriteria;
        $criteria->order = 'certificate_number DESC';
        $model = self::model()->find($criteria);

        if ($model != null) {
            $split = explode("/", $model->certificate_number);

            $lastNumber = (int)$split[0] + 1;
        }

        return $lastNumber;
    }

}
