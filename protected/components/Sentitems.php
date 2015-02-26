<?php

/**
 * This is the model class for table "sentitems".
 *
 * The followings are the available columns in table 'sentitems':
 * @property string $UpdatedInDB
 * @property string $InsertIntoDB
 * @property string $SendingDateTime
 * @property string $DeliveryDateTime
 * @property string $Text
 * @property string $DestinationNumber
 * @property string $Coding
 * @property string $UDH
 * @property string $SMSCNumber
 * @property integer $Class
 * @property string $TextDecoded
 * @property string $ID
 * @property string $SenderID
 * @property integer $SequencePosition
 * @property string $Status
 * @property integer $StatusError
 * @property integer $TPMR
 * @property integer $RelativeValidity
 * @property string $CreatorID
 */
class Sentitems extends CActiveRecord
{

    public function primaryKey()
    {
        return 'id';
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'sentitems';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['UpdatedInDB, Text, UDH, TextDecoded, SenderID, CreatorID', 'required'],
            ['Class, SequencePosition, StatusError, TPMR, RelativeValidity', 'numerical', 'integerOnly' => true],
            ['DestinationNumber, SMSCNumber', 'length', 'max' => 20],
            ['Coding', 'length', 'max' => 22],
            ['SenderID', 'length', 'max' => 255],
            ['Status', 'length', 'max' => 17],
            ['InsertIntoDB, SendingDateTime, DeliveryDateTime', 'safe'],
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            ['UpdatedInDB, InsertIntoDB, SendingDateTime, DeliveryDateTime, Text, DestinationNumber, Coding, UDH, SMSCNumber, Class, TextDecoded, id, SenderID, SequencePosition, Status, StatusError, TPMR, RelativeValidity, CreatorID', 'safe', 'on' => 'search'],
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
            'InsertIntoDB' => 'Insert Into Db',
            'SendingDateTime' => 'Sending Date Time',
            'DeliveryDateTime' => 'Delivery Date Time',
            'Text' => 'Text',
            'DestinationNumber' => 'Destination Number',
            'Coding' => 'Coding',
            'UDH' => 'Udh',
            'SMSCNumber' => 'Smscnumber',
            'Class' => 'Class',
            'TextDecoded' => 'Text Decoded',
            'id' => 'ID',
            'SenderID' => 'Sender',
            'SequencePosition' => 'Sequence Position',
            'Status' => 'Status',
            'StatusError' => 'Status Error',
            'TPMR' => 'Tpmr',
            'RelativeValidity' => 'Relative Validity',
            'CreatorID' => 'Creator',
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
        $criteria->compare('InsertIntoDB', $this->InsertIntoDB, true);
        $criteria->compare('SendingDateTime', $this->SendingDateTime, true);
        $criteria->compare('DeliveryDateTime', $this->DeliveryDateTime, true);
        $criteria->compare('Text', $this->Text, true);
        $criteria->compare('DestinationNumber', $this->DestinationNumber, true);
        $criteria->compare('Coding', $this->Coding, true);
        $criteria->compare('UDH', $this->UDH, true);
        $criteria->compare('SMSCNumber', $this->SMSCNumber, true);
        $criteria->compare('Class', $this->Class);
        $criteria->compare('TextDecoded', $this->TextDecoded, true);
        $criteria->compare('id', $this->id, true);
        $criteria->compare('SenderID', $this->SenderID, true);
        $criteria->compare('SequencePosition', $this->SequencePosition);
        $criteria->compare('Status', $this->Status, true);
        $criteria->compare('StatusError', $this->StatusError);
        $criteria->compare('TPMR', $this->TPMR);
        $criteria->compare('RelativeValidity', $this->RelativeValidity);
        $criteria->compare('CreatorID', $this->CreatorID, true);

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
        ]);
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Sentitems the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

}
