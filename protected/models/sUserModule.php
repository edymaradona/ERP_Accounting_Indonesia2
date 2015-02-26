<?php

class sUserModule extends BaseModel
{

    public $s_user_name;

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 's_user_module';
    }

    public function rules()
    {
        return [
            ['s_user_id, s_module_id', 'required'],
            //array('s_user_id, s_module_id', 'unique'),
            ['s_user_id', 'unique', 'criteria' => [
                'condition' => '`s_module_id`=:s_module_id',
                'params' => [
                    ':s_module_id' => $this->s_module_id
                ]
            ]],
            ['s_user_id, s_module_id', 'numerical', 'integerOnly' => true],
            ['s_user_name', 'length', 'max' => 50],
            ['id, s_user_id, s_module_id', 'safe', 'on' => 'search'],
        ];
    }

    public function relations()
    {
        return [
            's_user' => [self::BELONGS_TO, 'sUser', ['s_user_id' => 'id']],
            's_module' => [self::BELONGS_TO, 'sModule', 's_module_id'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            's_user_id' => 'User ID',
            's_user_name' => 'User Name',
            's_module_id' => 'Module',
        ];
    }

    public function search($id)
    {
        $criteria = new CDbCriteria;

        $criteria->compare('s_user_id', $id, true);
        $criteria->compare('s_module_id', $this->s_module_id, true);

        return new CActiveDataProvider(get_class($this), [
            'criteria' => $criteria,
        ]);
    }

    public function searchUser($uid)
    {
        $criteria = new CDbCriteria;
        $criteria->compare('s_user_id', $uid);
        $criteria->with = ['s_module'];
        $criteria->order = 's_module.sort';

        return new CActiveDataProvider(get_class($this), [
            'criteria' => $criteria,
            'pagination' => [
                'pageSize' => 30,
            ],
        ]);
    }

    public function searchModule($id)
    {
        $criteria = new CDbCriteria;
        $criteria->compare('s_module_id', $id);

        return new CActiveDataProvider(get_class($this), [
            'criteria' => $criteria,
            'pagination' => [
                'pageSize' => 50,
            ]
        ]);
    }

}
