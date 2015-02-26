<?php

/**
 * This is the model class for table "g_person_costcenter".
 *
 * The followings are the available columns in table 'g_person_costcenter':
 * @property integer $id
 * @property integer $parent_id
 * @property string $start_date
 * @property integer $costcenter_id
 * @property string $remark
 *
 * The followings are the available model relations:
 * @property GPerson $parent
 */
class gPersonCostcenter extends BaseModel
{

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return gPersoncostcenter the static model class
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
        return 'g_person_costcenter';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['start_date,company_id', 'required'],
            ['start_date, end_date', 'date', 'format' => 'dd-MM-yyyy'],
            ['parent_id, company_id', 'numerical', 'integerOnly' => true],
            ['remark', 'length', 'max' => 150],
            ['start_date, end_date', 'safe'],
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            ['id, parent_id, start_date, end_date, company_id, remark', 'safe', 'on' => 'search'],
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
            'parent' => [self::BELONGS_TO, 'GPerson', 'parent_id'],
            'company' => [self::BELONGS_TO, 'aOrganization', 'company_id'],
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
            'company_id' => 'Company',
            'remark' => 'Remark',
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

}
