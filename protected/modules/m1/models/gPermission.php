<?php

/**
 * This is the model class for table "g_permission".
 *
 * The followings are the available columns in table 'g_permission':
 * @property integer $id
 * @property integer $parent_id
 * @property string $input_date
 * @property string $start_date
 * @property string $end_date
 * @property integer $number_of_day
 * @property integer $permission_type_id
 * @property string $permission_reason
 * @property string $remark
 * @property integer $approved_id
 * @property integer $created_date
 * @property integer $created_by
 * @property integer $updated_date
 * @property integer $updated_by
 */
class gPermission extends BaseModel
{

    public $parent_name;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return gPermission the static model class
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
        return 'g_permission';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['parent_id, input_date, start_date, end_date, permission_type_id, approved_id,permission_reason', 'required'],
            ['parent_id, number_of_day, permission_type_id, approved_id, activation_expire,created_date, created_by, updated_date, updated_by', 'numerical', 'integerOnly' => true],
            ['permission_reason', 'length', 'max' => 300],
            ['start_date, end_date', 'date', 'format' => 'dd-MM-yyyy hh:mm'],
            ['remark', 'length', 'max' => 250],
            ['activation_code', 'length', 'max' => 100],
            ['end_date', 'safe'],
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            ['id, parent_id, input_date, start_date, end_date, number_of_day, permission_type_id, permission_reason, remark, approved_id, created_date, created_by, updated_date, updated_by', 'safe', 'on' => 'search'],
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
            'approved' => [self::BELONGS_TO, 'sParameter', ['approved_id' => 'code'], 'condition' => 'type = \'cLeaveApproved\''],
            'superior_approved' => [self::BELONGS_TO, 'sParameter', ['superior_approved_id' => 'code'], 'condition' => 'type = \'cLeaveApproved\''],
            'permission_type' => [self::BELONGS_TO, 'gParamPermission', 'permission_type_id'],
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
            'start_date' => 'Start Date/Time',
            'end_date' => 'End Date/Time',
            'number_of_day' => 'Number Of Day',
            'permission_type_id' => 'Permission Type',
            'permission_reason' => 'Permission Reason',
            'remark' => 'Remark',
            'approved_id' => 'Approved',
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
        $criteria->order = 't.start_date DESC';

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            'pagination' => [
                'pageSize' => 25,
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
        $criteria->order = 't.start_date DESC, t.id DESC';

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
        $criteria->compare('superior_approved_id', 1);
        $criteria->order = 't.start_date';

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            //'pagination'=>false,
            'pagination' => [
                'pageSize' => 50,
            ]
        ]);
    }

    public function onSuperior()
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
        $criteria->compare('superior_approved_id', 2);
        //$criteria->compare('start_date>', Yii::app()->dateFormatter->format("yyyy-MM-dd", time()));
        $criteria->order = 't.start_date';

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            //'pagination'=>false,
        ]);
    }

    public function onApproved()
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
        $criteria->compare('start_date>', Yii::app()->dateFormatter->format("yyyy-MM-dd", time()));
        $criteria->order = 't.start_date';

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            //'pagination'=>false,
        ]);
    }

    public function onPermission()
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

        $criteria3 = new CDbCriteria;
        $criteria3->condition = 'CURDATE() BETWEEN start_date AND end_date';
        $criteria->mergeWith($criteria3);

        $criteria->order = 't.start_date';

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
        $criteria->compare('approved_id', 2);
        $criteria->compare('YEAR(end_date)', date('Y', time()));
        $criteria->order = 'end_date DESC';

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            //'pagination'=>false,
        ]);
    }

    public function permissionById($id, $month)
    {
        $criteria = new CDbCriteria;
        $criteria->compare('parent_id', $id);
        $criteria->addBetweenCondition('start_date', date("Y-m-d", strtotime(date("Y-m", strtotime($month . " month")) . "-01")), date("Y-m-d", strtotime("-1 day", strtotime(date("Y-m", strtotime($month + 1 . " month")) . "-01"))));
        $criteria->compare('approved_id', 2);
        $criteria->order = 't.start_date';

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
            $model->link = 'm1/gPermission/view/id/' . $this->parent_id;
            $model->content = 'Permission. New Permission created for <read>' . $this->person->employee_name . '</read> on '
                . $this->start_date . ' for: ' . $this->permission_reason . '. Permission type: ' . $this->permission_type->name;
            $model->photo_path = $this->person->photoPath;
            $model->save(false);
        }
        return true;
    }

    public function afterDelete()
    {
        $model = new sNotification;
        $model->group_id = 1;
        $model->link = 'm1/gPermission/view/id/' . $this->parent_id;
        $model->content = 'Permission. Permission deleted for <read>' . $this->person->employee_name . '</read>' . ' that should be on ' . $this->start_date;
        $model->photo_path = $this->person->photoPath;
        $model->save(false);

        return true;
    }

}
