<?php

/**
 * This is the model class for table "s_notification_group".
 *
 * The followings are the available columns in table 's_notification_group':
 * @property integer $id
 * @property string $group_name
 * @property string $group_description
 * @property integer $status_id
 * @property integer $created_date
 * @property string $created_by
 *
 * The followings are the available model relations:
 * @property SNotificationGroupMember[] $sNotificationGroupMembers
 */
class sNotificationGroup extends BaseModel
{

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return sNotificationGroup the static model class
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
        return 's_notification_group';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['group_name, group_description, status_id', 'required'],
            ['status_id, created_date, updated_date', 'numerical', 'integerOnly' => true],
            ['group_name', 'length', 'max' => 50],
            ['group_description', 'length', 'max' => 500],
            ['created_by, updated_by', 'length', 'max' => 15],
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            ['id, group_name, group_description, status_id, created_date, created_by', 'safe', 'on' => 'search'],
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
            'sNotificationGroupMembers' => [self::HAS_MANY, 'sNotificationGroupMember', 'parent_id'],
            'status' => [self::HAS_ONE, 'sParameter', ['code' => 'status_id'], 'condition' => 'type = "cStatus"'],
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'group_name' => 'Group Name',
            'group_description' => 'Group Description',
            'status_id' => 'Status',
            'created_date' => 'Created Date',
            'created_by' => 'Created By',
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
        $criteria->compare('group_name', $this->group_name, true);
        $criteria->compare('group_description', $this->group_description, true);
        $criteria->compare('status_id', $this->status_id);
        $criteria->compare('created_date', $this->created_date);
        $criteria->compare('created_by', $this->created_by, true);

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
        ]);
    }

    public function getUserList()
    {
        $list = [];
        foreach ($this->sNotificationGroupMembers as $l)
            $list[] = CHtml::link($l->user->username, Yii::app()->createUrl('/sUser/view', ["id" => $l->user->id]));

        $_imList = implode(", ", $list);

        return $_imList;
    }

    public static function getTopCreated()
    {

        $models = self::model()->findAll(['limit' => 10, 'order' => 'created_date DESC']);

        $returnarray = [];

        foreach ($models as $model) {
            $returnarray[] = ['id' => $model->group_name, 'label' => $model->group_name, 'icon' => 'list-alt', 'url' => ['view', 'id' => $model->id]];
        }

        return $returnarray;
    }

    public static function getTopUpdated()
    {

        $models = self::model()->findAll(['limit' => 10, 'order' => 'updated_date DESC']);

        $returnarray = [];

        foreach ($models as $model) {
            $returnarray[] = ['id' => $model->group_name, 'label' => $model->group_name, 'icon' => 'list-alt', 'url' => ['view', 'id' => $model->id]];
        }

        return $returnarray;
    }

}
