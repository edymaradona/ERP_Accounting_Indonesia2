<?php

/**
 * This is the model class for table "sNotification_reads".
 *
 * The followings are the available columns in table 'sNotification_reads':
 * @property integer $id
 * @property integer $username
 * @property integer $notification_id
 * @property integer $readed
 */
class sNotificationRead extends BaseModel
{

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return NotifyiiReads the static model class
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
        return 's_notification_read';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return [
            ['username', 'required'],
            ['notification_id, readed', 'numerical', 'integerOnly' => true],
            ['id, username, notification_id, readed', 'safe', 'on' => 'search'],
        ];
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return [
            'notification' => [self::BELONGS_TO, 'sNotification', 'notification_id'],
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'User',
            'notification_id' => 'Notification',
            'readed' => 'Readed',
        ];
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('username', $this->username);
        $criteria->compare('notification_id', $this->notification_id);
        $criteria->compare('readed', $this->readed);

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
        ]);
    }

}
