<?php

class tAccountProperties extends BaseModel
{

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 't_account_properties';
    }

    public function rules()
    {
        return [
            ['parent_id, mkey, mvalue', 'required'],
            ['parent_id', 'numerical', 'integerOnly' => true],
            ['mkey', 'length', 'max' => 15],
            ['mvalue', 'length', 'max' => 50],
            ['parent_id, mkey, mvalue', 'safe', 'on' => 'search'],
        ];
    }

    public function relations()
    {
        return [
            'parentAccount' => [self::BELONGS_TO, 'tAccountMain', 'mvalue'],
            'getparent' => [self::BELONGS_TO, 'tAccount', 'parent_id'],
            'currencyName' => [self::BELONGS_TO, 'sParameter', ['mvalue' => 'code'], 'condition' => 'type=\'cCurrency\''],
            'stateName' => [self::BELONGS_TO, 'sParameter', ['mvalue' => 'code'], 'condition' => 'type=\'cStatusAcc\''],
        ];
    }

    public function attributeLabels()
    {
        return [
            'parent_id' => 'Parent',
            'mkey' => 'Mkey',
            'mvalue' => 'Mvalue',
        ];
    }

    public function search()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('parent_id', $this->parent_id);
        $criteria->compare('mkey', $this->mkey, true);
        $criteria->compare('mvalue', $this->mvalue);

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
        ]);
    }

    public function setMvalue()
    {
        if ($this->mvalue == 0) {
            $_myval = '*Inherited*';
        } elseif ($this->mvalue == 1) {
            $_myval = 'Yes';
        } else
            $_myval = 'Non Active (or Not Set)';

        return $_myval;
    }

}
