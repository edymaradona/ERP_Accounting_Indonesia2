<?php

/**
 * This is the model class for table "g_performance".
 *
 * The followings are the available columns in table 'g_performance':
 * @property integer $id
 * @property integer $parent_id
 * @property integer $individual_weight
 * @property integer $individual_target
 * @property integer $individual_value
 * @property integer $superior_value
 * @property integer $superior_weight
 * @property integer $remark
 * @property integer $created_date
 * @property integer $created_by
 * @property integer $updated_date
 * @property integer $updated_by
 *
 * The followings are the available model relations:
 * @property GPerson $parent
 */
class fPerformance extends CFormModel
{

    public $aspect_id;
    public $parent_id;
    public $individual_weight;
    public $individual_target;
    public $individual_value;
    public $superior_value;
    public $superior_weight;
    public $remark;

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['aspect_id, parent_id, individual_weight, individual_target, individual_value, superior_value, superior_weight', 'required'],
            ['aspect_id, parent_id, individual_weight, individual_target, individual_value, superior_value, superior_weight, remark, created_date, created_by, updated_date, updated_by', 'numerical', 'integerOnly' => true],
            ['remark', 'length', 'max' => 300],
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            ['parent_id, individual_weight, individual_target, individual_value, superior_value, superior_weight, remark, created_date, created_by, updated_date, updated_by', 'safe', 'on' => 'search'],
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'aspect_id' => 'Aspect',
            'parent_id' => 'Parent',
            'individual_weight' => 'Weight',
            'individual_target' => 'Target',
            'individual_value' => 'Value',
            'superior_value' => 'Superior Value',
            'superior_weight' => 'Superior Weight',
            'remark' => 'Remark',
        ];
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return gPerformance the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

}
