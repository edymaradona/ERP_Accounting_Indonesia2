<?php

/**
 * This is the model class for table "g_loan".
 *
 * The followings are the available columns in table 'g_loan':
 * @property integer $id
 * @property integer $parent_id
 * @property string $input_date
 * @property string $process_date
 * @property string $paid_date
 * @property integer $loan_type_id
 * @property integer $loan_for_id
 * @property string $purpose
 * @property string $remark
 * @property integer $approved_id
 * @property integer $created_date
 * @property integer $created_by
 * @property integer $updated_date
 * @property integer $updated_by
 */
class gLoan extends BaseModel
{

    public $parent_name;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return gLoan the static model class
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
        return 'g_loan';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['parent_id, input_date, purpose, debit, credit', 'required'],
            ['parent_id, loan_type_id, approved_id, superior_approved_id, created_date, created_by, updated_date, updated_by', 'numerical', 'integerOnly' => true],
            ['debit, credit, balance', 'numerical'],
            ['purpose', 'length', 'max' => 300],
            ['process_date', 'date', 'format' => 'dd-MM-yyyy'],
            ['remark', 'length', 'max' => 250],
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            ['id, parent_id, input_date, process_date, loan_type_id, purpose, remark, approved_id, created_date, created_by, updated_date, updated_by', 'safe', 'on' => 'search'],
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
            'loan_type' => [self::BELONGS_TO, 'sParameter', ['loan_type_id' => 'code'], 'condition' => 'type = \'cLoan\''],
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
            'process_date' => 'Process Date',
            'loan_type_id' => 'Loan Type',
            'purpose' => 'Purpose',
            'debit' => 'Debit',
            'credit' => 'Credit',
            'remark' => 'Remark',
            'approved_id' => 'Approved',
            'superior_approved_id' => 'Superior Approved',
            'balance' => 'Balance',
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
        $criteria->order = 't.input_date DESC, t.id DESC';

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            'pagination' => [
                'pageSize' => 50,
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
        $criteria->order = 't.process_date DESC, t.id DESC';

        return self::model()->count($criteria);
    }

    public function onWaiting()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        //if (Yii::app()->user->name != "admin") {
        $criteria2 = new CDbCriteria;
        $criteria2->condition = '(select c.company_id from g_person_career c WHERE t.parent_id=c.parent_id AND c.status_id IN (' . implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) . ') ORDER BY c.start_date DESC LIMIT 1) IN (' . implode(",", sUser::model()->myGroupArray) . ')';
        $criteria->mergeWith($criteria2);
        //}

        $criteria->with = ['person'];
        $criteria->together = true;
        $criteria->compare('approved_id', 1);
        //$criteria->compare('process_date>',Yii::app()->dateFormatter->format("yyyy-MM-dd",time()));
        $criteria->order = 't.input_date';

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            //'pagination'=>false,
            'pagination' => [
                'pageSize' => 50,
            ]
        ]);
    }

    public function onPending()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        //if (Yii::app()->user->name != "admin") {
        $criteria2 = new CDbCriteria;
        $criteria2->condition = '(select c.company_id from g_person_career c WHERE t.parent_id=c.parent_id AND c.status_id IN (' . implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) . ') ORDER BY c.start_date DESC LIMIT 1) IN (' . implode(",", sUser::model()->myGroupArray) . ')';
        $criteria->mergeWith($criteria2);
        //}

        $criteria->with = ['person'];
        $criteria->together = true;
        $criteria->compare('approved_id', 4);
        $criteria->compare('process_date>', Yii::app()->dateFormatter->format("yyyy-MM-dd", time()));
        $criteria->order = 't.process_date';

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            //'pagination'=>false,
        ]);
    }

    public function onOutstanding()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        //if (Yii::app()->user->name != "admin") {
        $criteria2 = new CDbCriteria;
        $criteria2->condition = '(select c.company_id from g_person_career c WHERE t.parent_id=c.parent_id AND c.status_id IN (' . implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) . ') ORDER BY c.start_date DESC LIMIT 1) IN (' . implode(",", sUser::model()->myGroupArray) . ')';
        $criteria->mergeWith($criteria2);
        //}

        $criteria->with = ['person'];
        $criteria->together = true;
        $criteria->compare('approved_id', 2);
        $criteria->compare('credit !', 0);
        //$criteria->compare('process_date>', Yii::app()->dateFormatter->format("yyyy-MM-dd", time()));
        $criteria->order = 't.process_date';

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            //'pagination'=>false,
        ]);
    }

    public function onPaid()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        //if (Yii::app()->user->name != "admin") {
        $criteria2 = new CDbCriteria;
        $criteria2->condition = '(select c.company_id from g_person_career c WHERE t.parent_id=c.parent_id AND c.status_id IN (' . implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) . ') ORDER BY c.start_date DESC LIMIT 1) IN (' . implode(",", sUser::model()->myGroupArray) . ')';
        $criteria->mergeWith($criteria2);
        //}

        $criteria->with = ['person'];
        $criteria->together = true;
        $criteria->compare('approved_id', 3);

        //$criteria3 = new CDbCriteria;
        //$criteria3->condition = 'CURDATE() BETWEEN process_date AND paid_date';
        //$criteria->mergeWith($criteria3);

        $criteria->order = 't.process_date';

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            //'pagination'=>false,
        ]);
    }

    public function loanById($id, $month)
    {
        $criteria = new CDbCriteria;
        $criteria->compare('parent_id', $id);
        $criteria->addBetweenCondition('process_date', date("Y-m-d", strtotime(date("Y-m", strtotime($month . " month")) . "-01")), date("Y-m-d", strtotime("-1 day", strtotime(date("Y-m", strtotime($month + 1 . " month")) . "-01"))));
        $criteria->compare('approved_id', 2);
        $criteria->order = 't.process_date';

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            //'pagination'=>false,
        ]);
    }

    public function afterSave()
    {
        if ($this->isNewRecord) {
            $model = new sNotification;
            $model->group_id = 1;
            $model->link = 'm1/gLoan/view/id/' . $this->parent_id;
            $model->content = 'Loan. New Employee Loan created for <read>' . $this->person->employee_name . '</read> on '
                . $this->process_date . ' for: ' . $this->purpose;
            $model->photo_path = $this->person->photoPath;
            $model->save(false);
        }
        return true;
    }

    public function afterDelete()
    {
        $model = new sNotification;
        $model->group_id = 1;
        $model->link = 'm1/gLoan/view/id/' . $this->parent_id;
        $model->content = 'Loan. Loan deleted for <read>' . $this->person->employee_name . '</read>' . ' that should be on ' . $this->input_date;
        $model->photo_path = $this->person->photoPath;
        $model->save(false);

        return true;
    }

    public static function lastBalance()
    {
        $criteria = new CDbCriteria;
        //$criteria->compare('loan_type_id',$type_id);
        $criteria->compare('parent_id', sUser::model()->currentPersonId());
        $criteria->compare('approved_id>', 1);
        $criteria->order = 'process_date DESC, id DESC';
        $model = gLoan::model()->find($criteria);

        if (!$model == null) {
            return $model->balance;
        } else
            return 0;
    }

}
