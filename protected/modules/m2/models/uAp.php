<?php

/**
 * This is the model class for table "u_ap".
 *
 * The followings are the available columns in table 'u_ap':
 * @property integer $id
 * @property integer $entity_id
 * @property integer $periode_date
 * @property integer $ar_type_id
 * @property string $remark
 * @property integer $payment_state_id
 * @property integer $journal_state_id
 * @property integer $total_amount
 * @property integer $created_date
 * @property integer $created_by
 * @property integer $updated_date
 * @property integer $updated_by
 */
class uAp extends BaseModel
{

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'u_ap';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['id, periode_date', 'required'],
            ['id, entity_id, periode_date, ar_type_id, payment_state_id, journal_state_id, total_amount, created_date, created_by, updated_date, updated_by', 'numerical', 'integerOnly' => true],
            ['remark', 'safe'],
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            ['id, entity_id, periode_date, ar_type_id, remark, payment_state_id, journal_state_id, total_amount, created_date, created_by, updated_date, updated_by', 'safe', 'on' => 'search'],
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
            'po' => [self::HAS_ONE, 'uPo', 'id'],
            'entity' => [self::BELONGS_TO, 'aOrganization', 'entity_id'],
            'payment' => [self::HAS_MANY, 'uApPayment', 'parent_id'],
            'paymentSum' => [self::STAT, 'uApPayment', 'parent_id', 'select' => 'sum(amount)'],
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'entity_id' => 'Entity',
            'periode_date' => 'Periode Date',
            'ap_type_id' => 'AP Type',
            'remark' => 'Remark',
            'payment_state_id' => 'Payment State',
            'journal_state_id' => 'Journal State',
            'total_amount' => 'Amount',
            'created_date' => 'Created Date',
            'created_by' => 'Created By',
            'updated_date' => 'Updated Date',
            'updated_by' => 'Updated By',
        ];
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
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('entity_id', $this->entity_id);
        $criteria->compare('periode_date', $this->periode_date);
        $criteria->compare('ar_type_id', $this->ar_type_id);
        $criteria->compare('remark', $this->remark, true);
        $criteria->compare('payment_state_id', $this->payment_state_id);
        $criteria->compare('journal_state_id', $this->journal_state_id);
        $criteria->compare('total_amount', $this->total_amount);
        $criteria->compare('created_date', $this->created_date);
        $criteria->compare('created_by', $this->created_by);
        $criteria->compare('updated_date', $this->updated_date);
        $criteria->compare('updated_by', $this->updated_by);

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
        ]);
    }

    public function onHalfPaid()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;
        $criteria->with = ['po', 'payment'];
        $criteria->together = true;
        $criteria->condition = 't.total_amount > (select sum(p.amount) from u_ap_payment p where t.id = p.parent_id)';

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
        ]);
    }

    public function onPaid()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;
        $criteria->with = ['po', 'payment'];
        $criteria->together = true;
        $criteria->condition = 't.total_amount <= (select sum(p.amount) from u_ap_payment p where t.id = p.parent_id)';

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
        ]);
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return uAp the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

}
