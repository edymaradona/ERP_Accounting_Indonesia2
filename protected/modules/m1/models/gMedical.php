<?php

/**
 * This is the model class for table "g_medical".
 *
 * The followings are the available columns in table 'g_medical':
 * @property integer $id
 * @property integer $parent_id
 * @property string $input_date
 * @property string $process_date
 * @property string $settlement_date
 * @property integer $medical_type_id
 * @property integer $medical_for_id
 * @property string $sympthom
 * @property string $remark
 * @property integer $approved_id
 * @property integer $created_date
 * @property integer $created_by
 * @property integer $updated_date
 * @property integer $updated_by
 */
class gMedical extends BaseModel
{

    public $parent_name;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return gMedical the static model class
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
        return 'g_medical';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['parent_id, input_date, receipt_date, sympthom, original_amount,medical_type_id, medical_for_id', 'required'],
            ['parent_id, medical_type_id, medical_for_id, approved_id, superior_approved_id, created_date, created_by, updated_date, updated_by', 'numerical', 'integerOnly' => true],
            ['original_amount, approved_amount,general_doctor, specialist_doctor,medicine,doctor_medicine, administration,physiotherapy, diagnostics, balance', 'numerical'],
            ['sympthom', 'length', 'max' => 300],
            ['process_date, receipt_date, settlement_date', 'date', 'format' => 'dd-MM-yyyy'],
            ['remark', 'length', 'max' => 250],
            ['settlement_date', 'safe'],
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            ['id, parent_id, input_date, process_date, settlement_date, medical_type_id, medical_for_id, sympthom, remark, approved_id, created_date, created_by, updated_date, updated_by', 'safe', 'on' => 'search'],
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
            'person' => [self::BELONGS_TO, 'gPerson', 'parent_id'],
            'approved' => [self::BELONGS_TO, 'sParameter', ['approved_id' => 'code'], 'condition' => 'type = \'cMedicalApproved\''],
            'superior_approved' => [self::BELONGS_TO, 'sParameter', ['superior_approved_id' => 'code'], 'condition' => 'type = \'cLeaveApproved\''],
            'medical_type' => [self::BELONGS_TO, 'gParamMedical', 'medical_type_id'],
            'medical_for' => [self::BELONGS_TO, 'gPersonFamily', 'medical_for_id'],
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
            'parent_name' => 'Employee Name',
            'input_date' => 'Input Date',
            'receipt_date' => 'Receipt Date',
            'process_date' => 'Process Date',
            'settlement_date' => 'Settlement Date',
            'medical_type_id' => 'Medical Type',
            'medical_for_id' => 'Medical For',
            'sympthom' => 'Sympthom',
            'general_doctor' => 'General Doctor',
            'specialist_doctor' => 'Specialist Doctor',
            'medicine' => 'Medicine',
            'doctor_medicine' => 'Doctor + Medicine',
            'administration' => 'Administration',
            'physiotherapy' => 'Physiotherapy',
            'diagnostics' => 'Diagnostics',
            'original_amount' => 'Original Amount',
            'approved_amount' => 'Approved Amount',
            'remark' => 'Remark',
            'approved_id' => 'Approved',
            'superior_approved_id' => 'Superior Approved',
            'balance' => 'Balance',
            'created_date' => 'Created Date',
            'created_by' => 'Created By',
            'updated_date' => 'Updated Date',
            'updated_by' => 'Updated By',
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
        $criteria->order = 't.input_date DESC, t.id DESC';

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            'pagination' => [
                'pageSize' => 50,
            ]
        ]);
    }

    public static function searchCount($id)
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('parent_id', $id);
        $criteria->compare('superior_approved_id', 1);
        $criteria->order = 't.process_date DESC, t.id DESC';

        return self::model()->count($criteria);
    }

    public function onWaiting()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        //if (Yii::app()->user->name != "admin") {
        $criteria2 = new CDbCriteria;
        $criteria2->condition = '(select c.company_id from g_person_career c WHERE t.parent_id=c.parent_id AND c.status_id IN (' . implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) . ') ORDER BY c.start_date DESC LIMIT 1) IN (' . implode(",", sUser::model()->myGroupArray) . ')';
        $criteria->mergeWith($criteria2);
        //}

        $criteria->with = ['person'];
        $criteria->together = true;
        $criteria->compare('approved_id', 1);
        //$criteria->compare('process_date>',Yii::app()->dateFormatter->format("yyyy-MM-dd",time()));
        $criteria->order = 't.input_date';

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            //'pagination'=>false,
            'pagination' => [
                'pageSize' => 50,
            ]
        ]);
    }

    public function onPending()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        //if (Yii::app()->user->name != "admin") {
        $criteria2 = new CDbCriteria;
        $criteria2->condition = '(select c.company_id from g_person_career c WHERE t.parent_id=c.parent_id AND c.status_id IN (' . implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) . ') ORDER BY c.start_date DESC LIMIT 1) IN (' . implode(",", sUser::model()->myGroupArray) . ')';
        $criteria->mergeWith($criteria2);
        //}

        $criteria->with = ['person'];
        $criteria->together = true;
        $criteria->compare('approved_id', 4);
        $criteria->compare('process_date>', Yii::app()->dateFormatter->format("yyyy-MM-dd", time()));
        $criteria->order = 't.process_date';

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            //'pagination'=>false,
        ]);
    }

    public function onProcess()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        //if (Yii::app()->user->name != "admin") {
        $criteria2 = new CDbCriteria;
        $criteria2->condition = '(select c.company_id from g_person_career c WHERE t.parent_id=c.parent_id AND c.status_id IN (' . implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) . ') ORDER BY c.start_date DESC LIMIT 1) IN (' . implode(",", sUser::model()->myGroupArray) . ')';
        $criteria->mergeWith($criteria2);
        //}

        $criteria->with = ['person'];
        $criteria->together = true;
        $criteria->compare('approved_id', 2);
        //$criteria->compare('process_date>', Yii::app()->dateFormatter->format("yyyy-MM-dd", time()));
        $criteria->order = 't.process_date';

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            //'pagination'=>false,
        ]);
    }

    public function onPaid()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        //if (Yii::app()->user->name != "admin") {
        $criteria2 = new CDbCriteria;
        $criteria2->condition = '(select c.company_id from g_person_career c WHERE t.parent_id=c.parent_id AND c.status_id IN (' . implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) . ') ORDER BY c.start_date DESC LIMIT 1) IN (' . implode(",", sUser::model()->myGroupArray) . ')';
        $criteria->mergeWith($criteria2);
        //}

        $criteria->with = ['person'];
        $criteria->together = true;
        $criteria->compare('approved_id', 3);

        $criteria3 = new CDbCriteria;
        $criteria3->condition = 'CURDATE() BETWEEN process_date AND settlement_date';
        $criteria->mergeWith($criteria3);

        $criteria->order = 't.process_date';

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            //'pagination'=>false,
        ]);
    }

    public function onRecent()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        //if (Yii::app()->user->name != "admin") {
        $criteria2 = new CDbCriteria;
        $criteria2->condition = '(select c.company_id from g_person_career c WHERE t.parent_id=c.parent_id AND c.status_id IN (' . implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) . ') ORDER BY c.start_date DESC LIMIT 1) IN (' . implode(",", sUser::model()->myGroupArray) . ')';
        $criteria->mergeWith($criteria2);
        //}

        $criteria->with = ['person'];
        $criteria->together = true;
        $criteria->compare('approved_id', 3);
        $criteria->compare('YEAR(input_date)', date('Y', time()));
        $criteria->order = 'input_date DESC';

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            'pagination' => [
                'pageSize' => 20,
            ]
        ]);
    }

    public function medicalById($id, $month)
    {
        $criteria = new CDbCriteria;
        $criteria->compare('parent_id', $id);
        $criteria->addBetweenCondition('process_date', date("Y-m-d", strtotime(date("Y-m", strtotime($month . " month")) . "-01")), date("Y-m-d", strtotime("-1 day", strtotime(date("Y-m", strtotime($month + 1 . " month")) . "-01"))));
        $criteria->compare('approved_id', 2);
        $criteria->order = 't.process_date';

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            //'pagination'=>false,
        ]);
    }

    public function afterSave()
    {
        if ($this->isNewRecord) {
            $model = new sNotification;
            $model->group_id = 1;
            $model->link = 'm1/gMedical/view/id/' . $this->parent_id;
            $model->content = 'Medical. New Medical created for <read>' . $this->person->employee_name . '</read> on '
                . $this->process_date . ' for: ' . $this->sympthom;
            $model->photo_path = $this->person->photoPath;
            $model->save(false);
        }
        return true;
    }

    public function afterDelete()
    {
        $model = new sNotification;
        $model->group_id = 1;
        $model->link = 'm1/gMedical/view/id/' . $this->parent_id;
        $model->content = 'Medical. Medical deleted for <read>' . $this->person->employee_name . '</read>' . ' that should be on ' . $this->input_date;
        $model->photo_path = $this->person->photoPath;
        $model->save(false);

        return true;
    }

    public function getMedicalForPlus()
    {
        if ($this->medical_for_id == 0) {
            //return $this->person->employee_name;
            return "Self";
        } else
            return $this->medical_for->f_name;
    }

    public function getMedicalForPlusR()
    {
        if ($this->medical_for_id == 0) {
            return "Diri Sendiri";
        } else
            return $this->medical_for->relation->name;
    }

    public static function lastBalance($id, $type_id)
    {
        $criteria = new CDbCriteria;
        $criteria->compare('medical_type_id', $type_id);
        $criteria->compare('parent_id', $id);
        $criteria->compare('approved_id>', 2);
        $model = gMedical::model()->find($criteria);

        if ($model == null) {
            $criteria1 = new CDbCriteria;
            $criteria1->compare('parent_id', $type_id);
            $criteria1->order = 'yearmonth_start DESC';
            $model1 = gParamMedical::model()->find($criteria1);
            if ($model1 == null) {
                return 0;
            } else
                return $model1->amount;
        } else {

            return $model->balance;
        }
    }

    public function getLastFormula()
    {
        $criteria1 = new CDbCriteria;
        $criteria1->compare('parent_id', $this->medical_type_id);
        $model1 = gParamMedical::model()->find($criteria1);
        if ($model1 == null) {
            return 0;
        } else
            return $model1->formula;
    }

    public static function medicalFamilyDropDown($id)
    {
        $cat_id = $id;
        $_items = [];

        $models = gPersonFamily::model()->findAll(['condition' => 'payroll_cover_id = 1 AND parent_id = ' . $cat_id, 'order' => 'relation_id']);
        $modPerson = gPerson::model()->findByPk((int)$cat_id);

        if ($modPerson != null) {
            $myself = $modPerson->employee_name . " ( self | " . $modPerson->countAgeRoundDown() . " years )";
            echo CHtml::tag('option', ['value' => 0], CHtml::encode($myself), true);
            $_items[0] = CHtml::encode($myself);
        }

        if ($models != null) {

            foreach ($models as $model)
                $_items[$model->id] = $model->f_name . " ( " . $model->relation->name . " | " . $model->countAgeRoundDown() . " years )";

        }

        return $_items;

    }


}
