<?php

/**
 * This is the model class for table "g_person_career".
 *
 * The followings are the available columns in table 'g_person_career':
 * @property integer $id
 * @property integer $parent_id
 * @property string $start_date
 * @property integer $status_id
 * @property integer $company_id
 * @property integer $department_id
 * @property integer $level_id
 * @property string $job_title
 * @property string $reason
 *
 * The followings are the available model relations:
 * @property GPerson $parent
 */
class gPersonCareer extends BaseModel
{

    public $superior_name;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return gPersonCareer the static model class
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
        return 'g_person_career';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['start_date, status_id, company_id, department_id, section_id, level_id, job_title', 'required'],
            ['start_date,custom1_date', 'date', 'format' => 'dd-MM-yyyy'],
            ['superior_id, parent_id, status_id, company_id, department_id, section_id, level_id', 'numerical', 'integerOnly' => true],
            ['job_title, reason', 'length', 'max' => 100],
            ['start_date', 'safe'],
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            ['id, parent_id, start_date, status_id, company_id, department_id, level_id, job_title, reason', 'safe', 'on' => 'search'],
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
            'superior' => [self::BELONGS_TO, 'gPerson', 'superior_id'],
            'parent' => [self::BELONGS_TO, 'gPerson', 'parent_id'],
            'company' => [self::BELONGS_TO, 'aOrganization', 'company_id'],
            'department' => [self::BELONGS_TO, 'aOrganization', 'department_id'],
            'section' => [self::BELONGS_TO, 'aOrganization', 'section_id'],
            'level' => [self::BELONGS_TO, 'gParamLevel', 'level_id'],
            'status' => [self::BELONGS_TO, 'sParameter', ['status_id' => 'code'], 'condition' => 'type = \'cPromotion\''],
            'created' => [self::BELONGS_TO, 'sUser', 'created_by'],
            'updated' => [self::BELONGS_TO, 'sUser', 'updated_by'],
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
            'start_date' => 'Start Date',
            'status_id' => 'Status',
            'company_id' => 'Company',
            'department_id' => 'Department',
            'section_id' => 'Section',
            'level_id' => 'Level',
            'job_title' => 'Job Title',
            'reason' => 'Reason',
            'superior_id' => 'Superior',
            'custom1_date' => 'Site Date',
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
        $criteria->order = 'start_date DESC';

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            'pagination' => false,
        ]);
    }

    public function employeeIn()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        //$criteria->compare('year(start_date)',date('Y'));
        $criteria->compare('start_date >', date("Y-m-d", strtotime("-3 month")));
        $criteria->addInCondition('status_id', Yii::app()->getModule('m1')->PARAM_JOIN_ARRAY);
        $criteria->order = 'start_date DESC';

        //if (Yii::app()->user->name != "admin") {
        $criteria1 = new CDbCriteria;
        $criteria1->condition = 'company_id IN (' . implode(",", sUser::model()->myGroupArray) . ')';
        $criteria->mergeWith($criteria1);
        //}


        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            'pagination' => false,
        ]);
    }

    public function employeeInAll()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('start_date <', date("Y-m-d"));
        $criteria->addInCondition('status_id', Yii::app()->getModule('m1')->PARAM_JOIN_ARRAY);
        $criteria->order = 'start_date DESC';
        $criteria->limit = 5;


        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            'pagination' => false,
        ]);
    }

    public function employeeRecentAll()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        //$criteria->compare('start_date <',date("Y-m-d"));
        $criteria->addInCondition('status_id', Yii::app()->getModule('m1')->PARAM_COMPANY_ARRAY);
        $criteria->order = 'updated_date DESC';
        $criteria->distinct = true;
        $criteria->limit = 5;


        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            'pagination' => false,
        ]);
    }

    public function beforeDelete()
    {
        if ($this->parent->many_careerC == 1) {
            return false;
        } else
            return true;
    }

    public function DeptUpdate()
    {
        $models = aOrganization::model()->findAll(['condition' => 'parent_id = ' . $this->company_id, 'order' => 'id']);

        foreach ($models as $model) {
            foreach ($model->childs as $mod)
                foreach ($mod->childs as $m)
                    //$_items[$m->getparent->getparent->name ." - ". $m->getparent->name][$m->id]=$m->name;
                    $_items[$m->id] = $m->name;
        }

        return $_items;
    }

    public function afterSave()
    {
        if ($this->isNewRecord) {
            $model = new sNotification;
            $model->group_id = 1;
            $model->link = 'm1/gPerson/view/id/' . $this->parent_id;
            $model->content = 'Person Career. New Employee Career: ' . $this->status->name . ' created for <read>' . $this->parent->employee_name . '</read>';
            $model->photo_path = $this->parent->photoPath;
            $model->save(false);
        }
        return true;
    }

}
