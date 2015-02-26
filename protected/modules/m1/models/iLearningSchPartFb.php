<?php

/**
 * This is the model class for table "i_learning_sch_part_fb".
 *
 * The followings are the available columns in table 'i_learning_sch_part_fb':
 * @property integer $id
 * @property integer $parent_id
 * @property integer $A1
 * @property integer $A2
 * @property integer $A3
 * @property integer $A4
 * @property integer $A5
 * @property integer $B1
 * @property integer $B2
 * @property integer $B3
 * @property integer $B4
 * @property integer $C1
 * @property integer $C2
 * @property string $D1
 * @property string $D2
 * @property integer $created_date
 * @property string $created_by
 */
class iLearningSchPartFb extends BaseModel
{

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return iLearningSchPartFb the static model class
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
        return 'i_learning_sch_part_fb';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['parent_id, A1, A2, A3, A4, A5, B1, B2, B3, B4, C1, C2', 'required'],
            ['parent_id, A1, A2, A3, A4, A5, B1, B2, B3, B4, C1, C2, created_date', 'numerical', 'integerOnly' => true],
            ['D1, D2', 'length', 'max' => 500],
            ['created_by', 'length', 'max' => 45],
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            ['id, parent_id, A1, A2, A3, A4, A5, B1, B2, B3, B4, C1, C2, D1, D2, created_date, created_by', 'safe', 'on' => 'search'],
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
            'getparent' => [self::BELONGS_TO, 'iLearningSchPart', 'parent_id'],
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
            'A1' => 'A1',
            'A2' => 'A2',
            'A3' => 'A3',
            'A4' => 'A4',
            'A5' => 'A5',
            'B1' => 'B1',
            'B2' => 'B2',
            'B3' => 'B3',
            'B4' => 'B4',
            'C1' => 'C1',
            'C2' => 'C2',
            'D1' => 'D1',
            'D2' => 'D2',
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
        $criteria->compare('parent_id', $this->parent_id);
        $criteria->compare('A1', $this->A1);
        $criteria->compare('A2', $this->A2);
        $criteria->compare('A3', $this->A3);
        $criteria->compare('A4', $this->A4);
        $criteria->compare('A5', $this->A5);
        $criteria->compare('B1', $this->B1);
        $criteria->compare('B2', $this->B2);
        $criteria->compare('B3', $this->B3);
        $criteria->compare('B4', $this->B4);
        $criteria->compare('C1', $this->C1);
        $criteria->compare('C2', $this->C2);
        $criteria->compare('D1', $this->D1, true);
        $criteria->compare('D2', $this->D2, true);
        $criteria->compare('created_date', $this->created_date);
        $criteria->compare('created_by', $this->created_by, true);

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
        ]);
    }

}
