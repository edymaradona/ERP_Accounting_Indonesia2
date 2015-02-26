<?php

/**
 * This is the model class for table "g_person_family".
 *
 * The followings are the available columns in table 'g_person_family':
 * @property integer $id
 * @property integer $parent_id
 * @property string $f_name
 * @property integer $relation_id
 * @property string $birth_place
 * @property string $birth_date
 * @property integer $sex_id
 * @property string $remark
 * @property integer $payroll_cover_id
 *
 * The followings are the available model relations:
 * @property GPerson $parent
 */
class hApplicantFamily extends BaseModel
{

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return gPersonFamily the static model class
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
        return 'h_applicant_family';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['f_name', 'required'],
            ['parent_id, relation_id, sex_id, payroll_cover_id', 'numerical', 'integerOnly' => true],
            ['f_name, birth_place', 'length', 'max' => 50],
            ['remark', 'length', 'max' => 200],
            ['birth_date', 'date', 'format' => 'dd-MM-yyyy'],
            ['birth_date', 'safe'],
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            ['id, parent_id, f_name, relation_id, birth_place, birth_date, sex_id, remark, payroll_cover_id', 'safe', 'on' => 'search'],
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
            'relation' => [self::BELONGS_TO, 'sParameter', ['relation_id' => 'code'], 'condition' => 'type = \'HK\''],
            'sex' => [self::BELONGS_TO, 'sParameter', ['sex_id' => 'code'], 'condition' => 'type = \'cGender\''],
            'cover' => [self::BELONGS_TO, 'sParameter', ['payroll_cover_id' => 'code'], 'condition' => 'type = \'cCover\''],
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
            'f_name' => 'Name',
            'relation_id' => 'Relation',
            'birth_place' => 'Birth Place',
            'birth_date' => 'Birth Date',
            'sex_id' => 'Sex',
            'remark' => 'Remark',
            'payroll_cover_id' => 'Payroll Cover',
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
        $criteria->order = 'relation_id';

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            'pagination' => false,
        ]);
    }

}
