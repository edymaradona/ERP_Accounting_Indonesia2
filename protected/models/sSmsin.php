<?php

/**
 * This is the model class for table "s_smsout".
 *
 * The followings are the available columns in table 's_smsout':
 * @property integer $id
 * @property integer $sender_id
 * @property integer $receivergroup_id
 * @property string $receivergroup_tag
 * @property integer $modem
 * @property string $message
 * @property integer $approved_id
 * @property integer $created_date
 * @property integer $created_by
 * @property integer $updated_date
 * @property integer $updated_by
 */
class sSmsin extends BaseModel
{

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 's_smsin';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['modem, approved_id, created_date, created_by, updated_date, updated_by', 'numerical', 'integerOnly' => true],
            ['sender_number', 'length', 'max' => 100],
            ['message', 'length', 'max' => 767],
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            ['id, sender_number, modem, message,created_date, created_by, updated_date, updated_by', 'safe', 'on' => 'search'],
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
            'sender' => [self::BELONGS_TO, 'sAddressbook', ['sender_number', 'handphone']],
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sender_number' => 'Sender Number',
            'modem' => 'Modem',
            'message' => 'Message',
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
        //$criteria->compare('sender_number', $this->sender_number);
        $criteria->compare('modem', $this->modem);
        $criteria->compare('message', $this->message, true);
        $criteria->compare('created_date', $this->created_date);
        $criteria->compare('created_by', $this->created_by);
        $criteria->compare('updated_date', $this->updated_date);
        $criteria->compare('updated_by', $this->updated_by);

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => 'created_date DESC',
            ]
        ]);
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return sSmsout the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

}
