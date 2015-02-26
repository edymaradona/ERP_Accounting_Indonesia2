<?php

/**
 * This is the model class for table "g_payroll_deduction".
 *
 * The followings are the available columns in table 'g_payroll_deduction':
 * @property integer $id
 * @property integer $parent_id
 * @property integer $yearmonth_start
 * @property integer $yearmonth_end
 * @property integer $deduction_id
 * @property string $remark
 * @property integer $created_date
 * @property integer $created_by
 * @property integer $updated_date
 * @property integer $updated_by
 *
 * The followings are the available model relations:
 * @property GPayroll $parent
 */
class gPayrollTemplateDeduction extends BaseModel
{

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return gPayrollDeduction the static model class
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
        return 'g_payroll_template_deduction';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['deduction_id, yearmonth_start,amount', 'required'],
            ['parent_id, yearmonth_start, yearmonth_end, deduction_id, type_id,
                confirm_id, created_date, created_by, updated_date, updated_by', 'numerical', 'integerOnly' => true],
            ['amount,prorate', 'numerical'],
            ['remark', 'length', 'max' => 300],
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            ['id, parent_id, yearmonth_start, yearmonth_end, deduction_id, remark, created_date, created_by, updated_date, updated_by', 'safe', 'on' => 'search'],
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
            'deduction' => [self::BELONGS_TO, 'gParamPayroll', 'deduction_id'],
            'type' => [self::BELONGS_TO, 'sParameter', ['type_id' => 'code'], 'condition' => 'type = \'cPayrollType\''],
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
            'yearmonth_start' => 'Start',
            'yearmonth_end' => 'End',
            'deduction_id' => 'Deduction',
            'type_id' => 'Type',
            'type.name' => 'Type',
            'confirm_id' => 'Confirm',
            'amount' => 'Amount',
            'prorate' => 'Prorate',
            'remark' => 'Remark',
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

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
        ]);
    }

    public function getcurrentDeduction()
    {
        $criteria = new CDbCriteria;

        $criteria->with = ['parent'];
        $criteria->order = 'parent.employee_name';
        $criteria->condition = '(select s.status_id from g_person_status s WHERE parent.id=s.parent_id ORDER BY s.start_date DESC LIMIT 1) NOT IN 
		(' . implode(",", Yii::app()->getModule("m1")->PARAM_RESIGN_ARRAY) . ') AND ' .
            't.yearmonth_start <= ' . date("Ym") . ' AND t.yearmonth_end >= ' . date("Ym") . ' AND ' .
            ' (select c.company_id from g_person_career c WHERE parent.id=c.parent_id AND c.status_id IN (' .
            implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) .
            ') ORDER BY c.start_date DESC LIMIT 1) IN (' .
            implode(",", sUser::model()->myGroupArray) . ')';


        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
        ]);
    }

    public function amount_inherit()
    {
        if ($this->type_id == 1) {

            if ($this->deduction->last_amount == null) {
                return 0;
            } else
                return $this->deduction->last_amount->amount;
        } else
            return $this->amount;
    }

}
