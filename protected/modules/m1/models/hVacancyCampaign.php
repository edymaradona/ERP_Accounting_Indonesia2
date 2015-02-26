<?php

/**
 * This is the model class for table "h_vacancy_sch".
 *
 * The followings are the available columns in table 'h_vacancy_sch':
 * @property integer $id
 * @property integer $parent_id
 * @property string $campaign_name
 * @property string $start_date
 * @property string $end_date
 * @property string $additional_info
 * @property integer $status_id
 * @property integer $created_date
 * @property string $created_by
 * @property integer $updated_date
 * @property string $updated_by
 */
class hVacancyCampaign extends BaseModel
{

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return hVacancySch the static model class
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
        return 'h_vacancy_campaign';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['parent_id, campaign_name, start_date, end_date', 'required'],
            ['parent_id, status_id, created_date, updated_date', 'numerical', 'integerOnly' => true],
            ['campaign_name', 'length', 'max' => 100],
            ['additional_info', 'length', 'max' => 500],
            ['created_by, updated_by', 'length', 'max' => 50],
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            ['id, parent_id, campaign_name, start_date, end_date, additional_info, status_id, created_date, created_by, updated_date, updated_by', 'safe', 'on' => 'search'],
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
            'campaign_name' => 'Campaign Name',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'additional_info' => 'Additional Info',
            'status_id' => 'Status',
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
            'sort' => [
                'defaultOrder' => 'start_date DESC',
            ],
        ]);
    }

}
