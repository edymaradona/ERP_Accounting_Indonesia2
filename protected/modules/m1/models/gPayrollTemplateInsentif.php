<?php

/**
 * This is the model class for table "g_payroll_insentif".
 *
 * The followings are the available columns in table 'g_payroll_insentif':
 * @property integer $id
 * @property integer $parent_id
 * @property integer $yearmonth_start
 * @property integer $yearmonth_end
 * @property integer $insentif_id
 * @property string $remark
 * @property integer $created_date
 * @property integer $created_by
 * @property integer $updated_date
 * @property integer $updated_by
 *
 * The followings are the available model relations:
 * @property GPayroll $parent
 */
class gPayrollTemplateInsentif extends BaseModel
{

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return gPayrollInsentif the static model class
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
        return 'g_payroll_template_insentif';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['insentif_name, yearmonth_start,amount', 'required'],
            ['parent_id, yearmonth_start, created_date,
                confirm_id, created_by, updated_date, updated_by', 'numerical', 'integerOnly' => true],
            ['amount', 'numerical'],
            ['insentif_name', 'length', 'max' => 30],
            ['remark', 'length', 'max' => 300],
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            ['id, parent_id, yearmonth_start, insentif_name, remark, created_date, created_by, updated_date, updated_by', 'safe', 'on' => 'search'],
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
            'insentif_name' => 'Insentif Name',
            'confirm_id' => 'Confirm',
            'amount' => 'Amount',
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

}
