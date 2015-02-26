<?php

/**
 * This is the model class for table "u_so".
 *
 * The followings are the available columns in table 'u_so':
 * @property integer $id
 * @property integer $entity_id
 * @property integer $customer_id
 * @property string $input_date
 * @property string $system_ref
 * @property integer $periode_date
 * @property integer $so_type_id
 * @property string $remark
 * @property integer $created_date
 * @property integer $created_by
 * @property integer $updated_date
 * @property integer $updated_by
 * @property integer $approved_date
 * @property integer $approved_by
 */
class uSo extends BaseModel
{

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'u_so';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['input_date', 'required'],
            ['state_id, entity_id, customer_id, so_type_id, created_date, created_by, updated_date, updated_by, approved_date, approved_by', 'numerical', 'integerOnly' => true],
            ['system_ref', 'length', 'max' => 100],
            ['remark', 'safe'],
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            ['id, entity_id, customer_id, input_date, system_ref, so_type_id, remark, created_date, created_by, updated_date, updated_by, approved_date, approved_by', 'safe', 'on' => 'search'],
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
            'entity' => [self::BELONGS_TO, 'aOrganization', 'entity_id'],
            'customer' => [self::BELONGS_TO, 'uCustomer', 'customer_id'],
            'ar' => [self::HAS_ONE, 'uAr', 'id'],
            'soDetail' => [self::HAS_MANY, 'uSoDetail', 'parent_id'],
            'soSum' => [self::STAT, 'uSoDetail', 'parent_id', 'select' => 'sum(qty*amount)'],
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
            'customer_id' => 'Customer',
            'input_date' => 'Input Date',
            'system_ref' => 'System Ref',
            'so_type_id' => 'SO Type',
            'state_id' => 'Status',
            'remark' => 'Remark',
            'created_date' => 'Created Date',
            'created_by' => 'Created By',
            'updated_date' => 'Updated Date',
            'updated_by' => 'Updated By',
            'approved_date' => 'Approved Date',
            'approved_by' => 'Approved By',
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
        $criteria->compare('customer_id', $this->customer_id);
        $criteria->compare('input_date', $this->input_date, true);
        $criteria->compare('system_ref', $this->system_ref, true);
        $criteria->compare('so_type_id', $this->so_type_id);
        $criteria->compare('remark', $this->remark, true);
        $criteria->compare('created_date', $this->created_date);
        $criteria->compare('created_by', $this->created_by);
        $criteria->compare('updated_date', $this->updated_date);
        $criteria->compare('updated_by', $this->updated_by);
        $criteria->compare('approved_date', $this->approved_date);
        $criteria->compare('approved_by', $this->approved_by);

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
        ]);
    }

    public function newEntry()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('state_id', 1); //New Entry


        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
        ]);
    }

    public function delivered()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('state_id', 2); //Delivered


        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
        ]);
    }

    public function newSo()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->with = ['ar', 'ar.payment'];
        $criteria->together = true;
        $criteria->condition = 't.state_id = 2  AND (ar.id is null or payment.id is null)';


        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
        ]);
    }

    public function arCustomerView($id)
    {

        $criteria = new CDbCriteria;
        $criteria->compare('customer_id', $id);
        //$criteria->with=array('ar','ar.payment');
        //$criteria->together=true;
        //$criteria->condition='t.state_id = 2  AND (ar.id is null or payment.id is null)';


        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            'pagination' => [
                'pageSize' => 100,
            ]
        ]);
    }

    public static function getTopCreated()
    {

        $models = self::model()->findAll(['limit' => 10, 'order' => 'created_date DESC']);

        $returnarray = [];

        foreach ($models as $model) {
            $returnarray[] = ['id' => $model->system_ref, 'label' => $model->system_ref, 'icon' => 'list-alt', 'url' => ['/m2/uSo/view', 'id' => $model->id]];
        }

        return $returnarray;
    }

    public static function getTopUpdated()
    {

        $models = self::model()->findAll(['limit' => 10, 'order' => 'updated_date DESC']);

        $returnarray = [];

        foreach ($models as $model) {
            $returnarray[] = ['id' => $model->system_ref, 'label' => $model->system_ref, 'icon' => 'list-alt', 'url' => ['/m2/uSo/view', 'id' => $model->id]];
        }

        return $returnarray;
    }

    public static function getTopRelated($name)
    {

        //$_related = self::model()->find((int)$id)->account_name;
        $_exp = explode(" ", $name);


        $criteria = new CDbCriteria;
        //$criteria->compare('account_name',$_related,true,'OR');

        if (isset($_exp[0]))
            $criteria->compare('system_ref', $_exp[0], true, 'OR');

        if (isset($_exp[1]))
            $criteria->compare('system_ref', $_exp[1], true, 'OR');

        $criteria->limit = 10;
        $criteria->order = 'updated_date DESC';

        $models = self::model()->findAll($criteria);

        $returnarray = [];

        foreach ($models as $model) {
            $returnarray[] = ['id' => $model->system_ref, 'label' => $model->system_ref, 'icon' => 'list-alt', 'url' => ['/m2/tAccount/view', 'id' => $model->id]];
        }

        return $returnarray;
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return uSo the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

}
