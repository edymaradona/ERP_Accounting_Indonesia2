<?php

/**
 * This is the model class for table "g_absence_timeblock".
 *
 * The followings are the available columns in table 'g_absence_timeblock':
 * @property integer $id
 * @property integer $parent_id
 * @property integer $begin_date
 * @property integer $c1
 * @property integer $c2
 * @property integer $c3
 * @property integer $c4
 * @property integer $c5
 * @property integer $c6
 * @property integer $c7
 * @property integer $c8
 * @property integer $c9
 * @property integer $c10
 * @property integer $c11
 * @property integer $c12
 * @property integer $c13
 * @property integer $c14
 * @property integer $c15
 * @property integer $c16
 * @property integer $c17
 * @property integer $c18
 * @property integer $c19
 * @property integer $c20
 * @property integer $c21
 * @property integer $c22
 * @property integer $c23
 * @property integer $c24
 * @property integer $c25
 * @property integer $c26
 * @property integer $c27
 * @property integer $c28
 * @property integer $c29
 * @property integer $c30
 * @property integer $c31
 */
class gAttendanceTimeblock extends BaseModel
{

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return gAbsenceTimeblock the static model class
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
        return 'g_attendance_timeblock';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['parent_id, begin_date, c1, c2, c3, c4, c5, c6, c7, c8, c9, c10, c11, c12, c13, c14, c15, c16, c17, c18, c19, c20, c21, c22, c23, c24, c25, c26, c27, c28, c29, c30, c31', 'required'],
            ['parent_id, begin_date, c1, c2, c3, c4, c5, c6, c7, c8, c9, c10, c11, c12, c13, c14, c15, c16, c17, c18, c19, c20, c21, c22, c23, c24, c25, c26, c27, c28, c29, c30, c31', 'numerical', 'integerOnly' => true],
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            ['id, parent_id, begin_date, c1, c2, c3, c4, c5, c6, c7, c8, c9, c10, c11, c12, c13, c14, c15, c16, c17, c18, c19, c20, c21, c22, c23, c24, c25, c26, c27, c28, c29, c30, c31', 'safe', 'on' => 'search'],
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
            'parent_id' => 'Parent',
            'begin_date' => 'Begin Date',
            'c1' => 'C1',
            'c2' => 'C2',
            'c3' => 'C3',
            'c4' => 'C4',
            'c5' => 'C5',
            'c6' => 'C6',
            'c7' => 'C7',
            'c8' => 'C8',
            'c9' => 'C9',
            'c10' => 'C10',
            'c11' => 'C11',
            'c12' => 'C12',
            'c13' => 'C13',
            'c14' => 'C14',
            'c15' => 'C15',
            'c16' => 'C16',
            'c17' => 'C17',
            'c18' => 'C18',
            'c19' => 'C19',
            'c20' => 'C20',
            'c21' => 'C21',
            'c22' => 'C22',
            'c23' => 'C23',
            'c24' => 'C24',
            'c25' => 'C25',
            'c26' => 'C26',
            'c27' => 'C27',
            'c28' => 'C28',
            'c29' => 'C29',
            'c30' => 'C30',
            'c31' => 'C31',
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
        $criteria->compare('begin_date', $this->begin_date);
        $criteria->compare('c1', $this->c1);
        $criteria->compare('c2', $this->c2);
        $criteria->compare('c3', $this->c3);
        $criteria->compare('c4', $this->c4);
        $criteria->compare('c5', $this->c5);
        $criteria->compare('c6', $this->c6);
        $criteria->compare('c7', $this->c7);
        $criteria->compare('c8', $this->c8);
        $criteria->compare('c9', $this->c9);
        $criteria->compare('c10', $this->c10);
        $criteria->compare('c11', $this->c11);
        $criteria->compare('c12', $this->c12);
        $criteria->compare('c13', $this->c13);
        $criteria->compare('c14', $this->c14);
        $criteria->compare('c15', $this->c15);
        $criteria->compare('c16', $this->c16);
        $criteria->compare('c17', $this->c17);
        $criteria->compare('c18', $this->c18);
        $criteria->compare('c19', $this->c19);
        $criteria->compare('c20', $this->c20);
        $criteria->compare('c21', $this->c21);
        $criteria->compare('c22', $this->c22);
        $criteria->compare('c23', $this->c23);
        $criteria->compare('c24', $this->c24);
        $criteria->compare('c25', $this->c25);
        $criteria->compare('c26', $this->c26);
        $criteria->compare('c27', $this->c27);
        $criteria->compare('c28', $this->c28);
        $criteria->compare('c29', $this->c29);
        $criteria->compare('c30', $this->c30);
        $criteria->compare('c31', $this->c31);

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
        ]);
    }

}
