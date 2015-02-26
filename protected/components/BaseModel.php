<?php

class BaseModel extends CActiveRecord
{

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return aPorder the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function behaviors()
    {
        return [
            'datetimeI18NBehavior' => [
                'class' => 'DateTimeI18NBehavior'
            ],
            //'defaults'=>array(
            //	'class'=>'ext.decimali18nbehavior.DecimalI18NBehavior',
            //	//'format'=>'db',
            //),
            //'CTimestampBehavior' => array(
            //	'class' => 'zii.behaviors.CTimestampBehavior',
            //	'setUpdateOnCreate'=>true,
            //	'createAttribute' => 'created_date',
            //	'updateAttribute' => 'updated_date',
            //),
        ];
    }

    protected function beforeSave()
    {
        if (parent::beforeSave()) {
            if ($this->isNewRecord) {
                if ($this->hasAttribute('created_date')) {
                    $this->created_date = time();
                    $this->created_by = yii::app()->user->id;
                }
                if ($this->hasAttribute('updated_date')) {
                    $this->updated_date = time();
                    $this->updated_by = yii::app()->user->id;
                }
            } else {
                if ($this->hasAttribute('updated_date')) {
                    $this->updated_date = time();
                    $this->updated_by = yii::app()->user->id;
                }
            }
            return true;
        } else
            return false;
    }

}
