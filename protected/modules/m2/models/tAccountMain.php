<?php

class tAccountMain extends BaseModel
{

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 't_account_main';
    }

    public function rules()
    {
        return [
            ['name, position_id', 'required'],
            ['position_id', 'numerical', 'integerOnly' => true],
            ['name', 'length', 'max' => 128],
            ['id, name, position_id', 'safe', 'on' => 'search'],
        ];
    }

    public function relations()
    {
        return [
            'account_list' => [self::HAS_MANY, 'tAccountProperties', 'mvalue', 'condition' => 'mkey = \'accmain_id\''],
            'account_name' => [self::HAS_ONE, 'tAccount', 'account_list.parent_id', 'through' => 'account_list'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'position_id' => 'Position',
        ];
    }

    public function search()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('position_id', $this->position_id);

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
        ]);
    }

    public static function items()
    {
        $_items = [];
        $models = self::model()->findAll([
        ]);

        if (isset($models)) {
            foreach ($models as $model)
                $_items[$model->id] = $model->name;
        }
        return $_items;
    }

}
