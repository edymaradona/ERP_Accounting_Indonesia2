<?php

/**
 * This is the model class for table "g_param_performance".
 *
 * The followings are the available columns in table 'g_param_performance':
 * @property integer $id
 * @property integer $aspect_type_id
 * @property string $aspect_name
 * @property integer $supervisor
 * @property integer $ass_manager
 * @property integer $gen_manager
 */
class gParamPerformance extends BaseModel
{

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'g_param_performance';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['aspect_type_id, aspect_name, supervisor, ass_manager, gen_manager', 'required'],
            ['aspect_type_id, supervisor, ass_manager, gen_manager', 'numerical', 'integerOnly' => true],
            ['aspect_name', 'length', 'max' => 50],
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            ['id, aspect_type_id, aspect_name, supervisor, ass_manager, gen_manager', 'safe', 'on' => 'search'],
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
            'id' => 'ID',
            'aspect_type_id' => 'Aspect Type',
            'aspect_name' => 'Aspect Name',
            'supervisor' => 'Supervisor',
            'ass_manager' => 'Ass Manager',
            'gen_manager' => 'Gen Manager',
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

        $criteria->compare('id', $this->id);
        $criteria->compare('aspect_type_id', $this->aspect_type_id);
        $criteria->compare('aspect_name', $this->aspect_name, true);
        $criteria->compare('supervisor', $this->supervisor);
        $criteria->compare('ass_manager', $this->ass_manager);
        $criteria->compare('gen_manager', $this->gen_manager);

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
        ]);
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return gParamPerformance the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

}
