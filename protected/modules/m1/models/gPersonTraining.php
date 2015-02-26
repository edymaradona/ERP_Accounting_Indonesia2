<?php

/**
 * This is the model class for table "g_person_training".
 *
 * The followings are the available columns in table 'g_person_training':
 * @property integer $id
 * @property integer $parent_id
 * @property string $education_name
 * @property string $category
 * @property string $start
 * @property string $end
 * @property integer $sertificate
 * @property string $country
 */
class gPersonTraining extends BaseModel
{

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return GPersonEducationNf the static model class
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
        return 'g_person_training';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['start_date, type_id, topic, duration, organizer, place', 'required'],
            ['parent_id, type_id, sertificate', 'numerical', 'integerOnly' => true],
            ['topic', 'length', 'max' => 50],
            ['instructor', 'length', 'max' => 75],
            ['organizer, place', 'length', 'max' => 100],
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            ['id, parent_id, type_id, topic, instructor, duration, sertifcate, organizer, place', 'safe', 'on' => 'search'],
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
            'parent' => [self::BELONGS_TO, 'GPerson', 'parent_id'],
            'type' => [self::BELONGS_TO, 'sParameter', ['type_id' => 'code'], 'condition' => 'type = \'cTraining\''],
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'parent_id' => 'Parent',
            'type_id' => 'Type',
            'topic' => 'Topic',
            'instructor' => 'Instructor',
            'duration' => 'Duration',
            'sertificate' => 'Certificate',
            'organizer' => 'Organizer',
            'place' => 'Place',
        ];
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search($id)
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('parent_id', $id);

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            'pagination' => false,
        ]);
    }

}
