<?php

/**
 * This is the model class for table "inbox".
 *
 * The followings are the available columns in table 'inbox':
 * @property string $UpdatedInDB
 * @property string $ReceivingDateTime
 * @property string $Text
 * @property string $SenderNumber
 * @property string $Coding
 * @property string $UDH
 * @property string $SMSCNumber
 * @property integer $Class
 * @property string $TextDecoded
 * @property string $ID
 * @property string $RecipientID
 * @property string $Processed
 */
class Inbox extends CActiveRecord
{

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'inbox';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['UpdatedInDB, Text, UDH, TextDecoded, RecipientID', 'required'],
            ['Class', 'numerical', 'integerOnly' => true],
            ['SenderNumber, SMSCNumber', 'length', 'max' => 20],
            ['Coding', 'length', 'max' => 22],
            ['Processed', 'length', 'max' => 5],
            ['ReceivingDateTime', 'safe'],
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            ['UpdatedInDB, ReceivingDateTime, Text, SenderNumber, Coding, UDH, SMSCNumber, Class, TextDecoded, ID, RecipientID, Processed', 'safe', 'on' => 'search'],
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
            'UpdatedInDB' => 'Updated In Db',
            'ReceivingDateTime' => 'Receiving Date Time',
            'Text' => 'Text',
            'SenderNumber' => 'Sender Number',
            'Coding' => 'Coding',
            'UDH' => 'Udh',
            'SMSCNumber' => 'Smscnumber',
            'Class' => 'Class',
            'TextDecoded' => 'Text Decoded',
            'ID' => 'ID',
            'RecipientID' => 'Recipient',
            'Processed' => 'Processed',
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

        $criteria->compare('UpdatedInDB', $this->UpdatedInDB, true);
        $criteria->compare('ReceivingDateTime', $this->ReceivingDateTime, true);
        $criteria->compare('Text', $this->Text, true);
        $criteria->compare('SenderNumber', $this->SenderNumber, true);
        $criteria->compare('Coding', $this->Coding, true);
        $criteria->compare('UDH', $this->UDH, true);
        $criteria->compare('SMSCNumber', $this->SMSCNumber, true);
        $criteria->compare('Class', $this->Class);
        $criteria->compare('TextDecoded', $this->TextDecoded, true);
        $criteria->compare('ID', $this->ID, true);
        $criteria->compare('RecipientID', $this->RecipientID, true);
        $criteria->compare('Processed', $this->Processed, true);

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
        ]);
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Inbox the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

}
