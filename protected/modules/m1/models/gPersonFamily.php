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
class gPersonFamily extends BaseModel
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
        return 'g_person_family';
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
            ['insurance_number', 'length', 'max' => 100],
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
            'parent' => [self::BELONGS_TO, 'gPerson', 'parent_id'],
            'relation' => [self::BELONGS_TO, 'sParameter', ['relation_id' => 'code'], 'condition' => 'type = \'HK\''],
            'sex' => [self::BELONGS_TO, 'sParameter', ['sex_id' => 'code'], 'condition' => 'type = \'cGender\''],
            'medical_cover' => [self::BELONGS_TO, 'sParameter', ['payroll_cover_id' => 'code'], 'condition' => 'type = \'cCover\''],
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
            'payroll_cover_id' => 'Medical Cover',
            'insurance_number' => 'Insurance Number',
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

    public function searchCover($id)
    {

        $sql = '
            SELECT  g.id, g.employee_name as f_name, "Diri Sendiri" as relation,g.birth_place, g.birth_date,s2.name as gender, 
            (SELECT document_number o FROM g_person_other o WHERE o.parent_id = g.id AND o.category_name = "ASURANSI" LIMIT 1) AS insurance_number, 1 as sort
            FROM g_person g
            INNER JOIN s_parameter s2 ON s2.code = g.sex_id AND s2.type = "cGender"
            WHERE id = '.$id.' UNION ALL

            SELECT  f.id, f.f_name, s1.name as relation, f.birth_place, f.birth_date, s2.name as gender, f.insurance_number, f.relation_id
            FROM g_person_family f
            INNER JOIN s_parameter s1 ON s1.code = f.relation_id AND s1.type = "HK"
            INNER JOIN s_parameter s2 ON s2.code = f.sex_id AND s2.type = "cGender"
            WHERE payroll_cover_id = 1 AND parent_id = '.$id.' ORDER BY sort
        ';

        $rawData=Yii::app()->db->createCommand($sql)->queryAll();
        return new CArrayDataProvider($rawData, [
            'pagination' => false,
        ]);
    }

    public function countAge()
    { //round up and round down
        $diff = abs(strtotime($this->birth_date) - time());
        $years = round($diff / (365 * 60 * 60 * 24));

        return $years . " years old";
    }

    public function countAgeRoundDown()
    { //round down, exact_age
        $diff = abs(strtotime($this->birth_date) - time());
        $years = floor($diff / (365 * 60 * 60 * 24));

        return $years;
    }

    public static function familyDropDown()
    {
        $_items = [];

        $criteria = new CDbCriteria;
        $criteria->compare('parent_id', sUser::model()->currentPersonId());
        $criteria->compare('payroll_cover_id', 1);
        $criteria->order = 'relation_id';
        $models = self::model()->findAll($criteria);
        $modelself = gPerson::model()->find(['condition' => 'userid = ' . Yii::app()->user->id]);
        $_items[0] = $modelself->employee_name . " ( self | " . $modelself->countAgeRoundDown() . " years )";

        foreach ($models as $model)
            $_items[$model->id] = $model->f_name . " ( " . $model->relation->name . " | " . $model->countAgeRoundDown() . " years )";

        return $_items;
    }

}
