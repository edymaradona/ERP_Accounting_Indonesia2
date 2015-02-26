<?php

/**
 * This is the model class for table "s_notification_group_member".
 *
 * The followings are the available columns in table 's_notification_group_member':
 * @property integer $id
 * @property integer $parent_id
 * @property integer $user_id
 * @property integer $status_id
 *
 * The followings are the available model relations:
 * @property SNotificationGroup $parent
 */
class sNotificationGroupMember extends BaseModel
{

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return sNotificationGroupMember the static model class
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
        return 's_notification_group_member';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['parent_id, user_id', 'required'],
            ['parent_id, created_date, user_id, status_id', 'numerical', 'integerOnly' => true],
            ['created_by', 'length', 'max' => 15],
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            ['id, parent_id, user_id, status_id', 'safe', 'on' => 'search'],
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
            'parent' => [self::BELONGS_TO, 'sNotificationGroup', 'parent_id'],
            'user' => [self::BELONGS_TO, 'sUser', 'user_id'],
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
            'user_id' => 'User',
            'status_id' => 'Status',
            'created_date' => 'Created Date',
            'created_by' => 'Created By',
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

        $criteria->compare('user_id', $id);

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
        ]);
    }

    public function searchParent($id)
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
