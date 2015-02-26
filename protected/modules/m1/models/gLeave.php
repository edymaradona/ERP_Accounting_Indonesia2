<?php

/**
 * This is the model class for table "g_leave".
 *
 * The followings are the available columns in table 'g_leave':
 * @property integer $id
 * @property integer $parent_id
 * @property string $input_date
 * @property integer $year_leave
 * @property string $start_date
 * @property string $end_date
 * @property integer $number_of_day
 * @property string $work_date
 * @property string $leave_reason
 * @property integer $balance
 * @property string $replacement
 * @property string $remark
 * @property integer $approved_id
 *
 * The followings are the available model relations:
 * @property GPerson $parent
 */
class gLeave extends BaseModel
{

    public $parent_name;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return gLeave the static model class
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
        return 'g_leave';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['input_date, start_date, end_date, number_of_day,leave_reason', 'required'],
            ['parent_id, parent_name,', 'required', 'on' => 'create'],
            ['work_date', 'required', 'on' => 'createess'],
            ['parent_id, year_leave, number_of_day, balance, approved_id, activation_expire', 'numerical', 'integerOnly' => true],
            ['start_date, end_date, input_date, work_date', 'date', 'format' => 'dd-MM-yyyy'],
            ['leave_reason', 'length', 'max' => 300],
            ['activation_code', 'length', 'max' => 100],
            ['replacement', 'length', 'max' => 50],
            ['remark', 'length', 'max' => 250],
            ['input_date, start_date, end_date, parent_name, work_date', 'safe'],
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            ['id, parent_id, input_date, year_leave, start_date, end_date, number_of_day, work_date, leave_reason, balance, replacement, remark, approved_id', 'safe', 'on' => 'search'],
            ['start_date',
                'ext.date-compare.EDateCompare',
                'compareAttribute' => 'end_date',
                'operator' => '<=',
                'message' => 'Begin date must be before End date.'
            ],
            ['end_date',
                'ext.date-compare.EDateCompare',
                'compareAttribute' => 'start_date',
                'operator' => '>=',
                'message' => 'End date must be after Start date.'
            ],
            ['work_date',
                'ext.date-compare.EDateCompare',
                'compareAttribute' => 'end_date',
                'operator' => '>',
                'message' => 'Work date must be after End date.',
                'on' => 'create',
            ],
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
            'person' => [self::BELONGS_TO, 'gPerson', 'parent_id'],
            'approved' => [self::BELONGS_TO, 'sParameter', ['approved_id' => 'code'], 'condition' => 'type = \'cLeaveApproved\''],
            'superior_approved' => [self::BELONGS_TO, 'sParameter', ['superior_approved_id' => 'code'], 'condition' => 'type = \'cLeaveApproved\''],
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
            'parent_name' => 'Employee Name',
            'input_date' => 'Input Date',
            'year_leave' => 'Year Leave',
            'start_date' => 'Start Date of Leave',
            'end_date' => 'End Date of Leave',
            'number_of_day' => 'Working Days',
            'work_date' => 'Work Date',
            'leave_reason' => 'Reason',
            'balance' => 'Balance',
            'replacement' => 'Substitute',
            'remark' => 'Remark',
            'approved_id' => 'Approved',
            'superior_approved_id' => 'Superior Approved',
            'activation_code' => 'Activation Code',
            'activation_expire' => 'Activation Expire',
            'created_date' => 'Created Date',
            'created_by' => 'Created By',
            'updated_date' => 'Updated Date',
            'updated_by' => 'Updated By',
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
        $criteria->order = 't.start_date DESC, t.id DESC';

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            //'pagination'=>false,
            'pagination' => [
                'pageSize' => 25,
            ]
        ]);
    }

    public static function searchCount($id)
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('parent_id', $id);
        $criteria->compare('superior_approved_id', 1);
        $criteria->order = 't.start_date DESC, t.id DESC';

        return self::model()->count($criteria);
    }

    public function onWaiting()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;


        $criteria->with = ['person'];
        $criteria->together = true;
        $criteria->condition = '(approved_id = 1 AND superior_approved_id = 1) OR (approved_id = 5 AND balance is null) OR (approved_id = 6 AND balance is null)';
        $criteria->group = 'employee_name';
        //$criteria->compare('start_date>',Yii::app()->dateFormatter->format("yyyy-MM-dd",time()));
        $criteria->order = 't.start_date';

        //if (Yii::app()->user->name != "admin") {
        $criteria2 = new CDbCriteria;
        $criteria2->condition = '(select c.company_id from g_person_career c WHERE t.parent_id=c.parent_id AND c.status_id IN (' . implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) . ') ORDER BY c.start_date DESC LIMIT 1) IN (' . implode(",", sUser::model()->myGroupArray) . ')';
        $criteria->mergeWith($criteria2);
        //}

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            'pagination' => [
                'pageSize' => 30,
            ]
        ]);
    }

    public function onSuperior()
    {
        $criteria = new CDbCriteria;


        $criteria->with = ['person'];
        $criteria->together = true;
        $criteria->condition = '(approved_id = 1 AND superior_approved_id = 2) OR (approved_id = 1 AND superior_approved_id = 7 AND balance is null) OR (approved_id = 1 AND superior_approved_id = 8 AND balance is null)';
        $criteria->group = 'employee_name';
        //$criteria->compare('start_date>',Yii::app()->dateFormatter->format("yyyy-MM-dd",time()));
        $criteria->order = 't.start_date';

        //if (Yii::app()->user->name != "admin") {
        $criteria2 = new CDbCriteria;
        $criteria2->condition = '(select c.company_id from g_person_career c WHERE t.parent_id=c.parent_id AND c.status_id IN (' . implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) . ') ORDER BY c.start_date DESC LIMIT 1) IN (' . implode(",", sUser::model()->myGroupArray) . ')';
        $criteria->mergeWith($criteria2);
        //}

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            'pagination' => [
                'pageSize' => 30,
            ]
        ]);
    }

    public function onApproved()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->with = ['person'];
        $criteria->together = true;
        $criteria->compare('approved_id', 2);
        $criteria->compare('start_date>', Yii::app()->dateFormatter->format("yyyy-MM-dd", time()));
        $criteria->group = 'employee_name';
        $criteria->order = 't.start_date';

        //if (Yii::app()->user->name != "admin") {
        $criteria2 = new CDbCriteria;
        $criteria2->condition = '(select c.company_id from g_person_career c WHERE t.parent_id=c.parent_id AND c.status_id IN (' . implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) . ') ORDER BY c.start_date DESC LIMIT 1) IN (' . implode(",", sUser::model()->myGroupArray) . ')';
        $criteria->mergeWith($criteria2);
        //}

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            'pagination' => [
                'pageSize' => 30,
            ]
        ]);
    }

    public function onLeave()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;


        $criteria->with = ['person'];
        $criteria->together = true;
        $criteria->compare('approved_id', 2);
        $criteria->group = 'employee_name';

        $criteria3 = new CDbCriteria;
        $criteria3->condition = 'CURDATE() BETWEEN start_date AND end_date';
        $criteria->mergeWith($criteria3);

        $criteria->order = 't.start_date';

        //if (Yii::app()->user->name != "admin") {
        $criteria2 = new CDbCriteria;
        $criteria2->condition = '(select c.company_id from g_person_career c WHERE t.parent_id=c.parent_id AND c.status_id IN (' . implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) . ') ORDER BY c.start_date DESC LIMIT 1) IN (' . implode(",", sUser::model()->myGroupArray) . ')';
        $criteria->mergeWith($criteria2);
        //}

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            'pagination' => [
                'pageSize' => 30,
            ]
        ]);
    }

    public function onRecent()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->with = ['person'];
        $criteria->together = true;
        $criteria->compare('approved_id', 2);
        $criteria->group = 'employee_name';

        //$criteria->compare('YEAR(end_date)',date('Y',time()));
        $criteria->addBetweenCondition('end_date', Yii::app()->dateFormatter->format("yyyy-MM-dd", time() - (30 * 24 * 60 * 60)), Yii::app()->dateFormatter->format("yyyy-MM-dd", time()));
        $criteria->order = 'end_date DESC';

        //if (Yii::app()->user->name != "admin") {
        $criteria2 = new CDbCriteria;
        $criteria2->condition = '(select c.company_id from g_person_career c WHERE t.parent_id=c.parent_id AND c.status_id IN (' . implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) . ') ORDER BY c.start_date DESC LIMIT 1) IN (' . implode(",", sUser::model()->myGroupArray) . ')';
        $criteria->mergeWith($criteria2);
        //}

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            'pagination' => [
                'pageSize' => 30,
            ]
        ]);
    }

    public function leaveById($id, $month)
    {
        $criteria = new CDbCriteria;
        $criteria->compare('parent_id', $id);
        $criteria->addBetweenCondition('start_date', date("Y-m-d", strtotime(date("Y-m", strtotime($month . " month")) . "-01")), date("Y-m-d", strtotime("-1 day", strtotime(date("Y-m", strtotime($month + 1 . " month")) . "-01"))));
        $criteria->compare('approved_id', 2);
        $criteria->order = 't.start_date';

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            //'pagination'=>false,
        ]);
    }

    public function afterSave()
    {
        if ($this->isNewRecord && strtotime($this->start_date) > time()) {
            $model = new sNotification;
            $model->group_id = 1;
            $model->link = 'm1/gLeave/view/id/' . $this->parent_id;
            $model->content = 'Leave. New Leave created for <read>' . $this->person->employee_name . '</read> on '
                . $this->start_date . ' until ' . $this->end_date . ' for ' . $this->number_of_day . ' working day(s)  with this reason: ' . $this->leave_reason;
            $model->photo_path = $this->person->photoPath;
            $model->save(false);
        }
        return true;
    }

    public function afterDelete()
    {
        $model = new sNotification;
        $model->group_id = 1;
        $model->link = 'm1/gLeave/view/id/' . $this->parent_id;
        $model->content = 'Leave. Leave deleted for <read>' . $this->person->employee_name . '</read>' . ' that should be on ' . $this->start_date;
        $model->photo_path = $this->person->photoPath;
        $model->save(false);

        return true;
    }

}
