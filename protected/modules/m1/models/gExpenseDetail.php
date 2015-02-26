<?php

/**
 * This is the model class for table "g_expense_detail".
 *
 * The followings are the available columns in table 'g_expense_detail':
 * @property integer $id
 * @property integer $parent_id
 * @property integer $expense_id
 * @property string $company_name
 * @property string $amount
 * @property string $remark
 * @property integer $created_date
 * @property string $created_by
 */
class gExpenseDetail extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'g_expense_detail';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('parent_id, expense_id', 'required'),
            array('parent_id, expense_id, payment_source_id, created_date', 'numerical', 'integerOnly' => true),
            array('amount', 'numerical'),
            array('company_name, created_by', 'length', 'max' => 50),
            array('remark', 'length', 'max' => 500),
            array('parent_id', 'UniqueAttributesValidator', 'with'=>'expense_id','message'=>'Expense Item cannot double. Edit existing Item'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, parent_id, expense_id, company_name, amount, remark, created_date, created_by', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'getparent' => [self::BELONGS_TO, 'gParamExpenseDetail', 'parent_id'],
            'expense' => [self::BELONGS_TO, 'gParamExpenseDetail', 'expense_id'],
            'payment_source' => [self::BELONGS_TO, 'sParameter', ['payment_source_id' => 'code'], 'condition' => 'type = \'cExpensePaymentSource\''],
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'parent_id' => 'Parent',
            'expense_id' => 'Expense',
            'company_name' => 'Company Name',
            'amount' => 'Amount',
            'payment_source_id' => 'Payment Source',
            'remark' => 'Remark',
            'created_date' => 'Created Date',
            'created_by' => 'Created By',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search($id)
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('parent_id', $id);
        $criteria->compare('expense_id', $this->expense_id);
        $criteria->compare('company_name', $this->company_name, true);
        $criteria->compare('amount', $this->amount, true);
        $criteria->compare('remark', $this->remark, true);
        $criteria->compare('created_date', $this->created_date);
        $criteria->compare('created_by', $this->created_by, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return GExpenseDetail the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
