<?php

/**
 * This is the model class for table "s_user_history".
 *
 * The followings are the available columns in table 's_user_history':
 * @property integer $id
 * @property integer $user_id
 * @property integer $log_time
 * @property string $ip_address
 * @property string $browser_name
 * @property integer $request_action_id
 */
class sUserHistory extends BaseModel
{

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 's_user_history';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['user_id, log_time', 'required'],
            ['user_id, log_time, request_action_id', 'numerical', 'integerOnly' => true],
            ['ip_address', 'length', 'max' => 50],
            ['browser_name', 'length', 'max' => 150],
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            ['id, user_id, log_time, ip_address, browser_name, request_action_id', 'safe', 'on' => 'search'],
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
            'user_id' => 'User',
            'log_time' => 'Log Time',
            'ip_address' => 'IP Address',
            'browser_name' => 'Browser Name',
            'request_action_id' => 'Request Action',
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
    public function search($id)
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('user_id', Yii::app()->user->id);

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            'sort' => [
                'defaultOrder' => 'log_time DESC',
            ]
        ]);
    }

    public function searchAll()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            'sort' => [
                'defaultOrder' => 'log_time DESC',
            ]
        ]);
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return sUserHistory the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function getLocation()
    {
        $url = "http://freegeoip.net/json/" . $this->ip_address;
        $geo = json_decode(file_get_contents($url), true);
        return $geo;
    }

}
