<?php

/**
 * This is the model class for table "g_person".
 *
 * The followings are the available columns in table 'g_person':
 * @property integer $id
 * @property string $employee_code
 * @property string $employee_name
 * @property string $birth_place
 * @property string $birth_date
 * @property integer $sex_id
 * @property integer $religion_id
 * @property string $address1
 * @property string $address2
 * @property string $address3
 * @property string $pos_code
 * @property string $identity_number
 * @property string $identity_valid
 * @property string $identity_address1
 * @property string $identity_address2
 * @property string $identity_address3
 * @property string $identity_pos_code
 * @property string $email
 * @property string $email2
 * @property string $blood_id
 * @property string $home_phone
 * @property string $handphone
 * @property string $handphone2
 * @property string $c_pathfoto
 * @property integer $userid
 * @property integer $t_status
 * @property integer $created_date
 * @property integer $created_by
 * @property integer $updated_date
 * @property integer $updated_by
 *
 * The followings are the available model relations:
 * @property GLeave[] $gLeaves
 * @property GPersonAbsence[] $gPersonAbsences
 * @property GPersonEducation[] $gPersonEducations
 * @property GPersonFamily[] $gPersonFamilies
 * @property GPersonKarir[] $gPersonKarirs
 */
class gPerson2 extends BaseModel
{

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return gPerson the static model class
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
        return 'g_person';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['employee_name, birth_place, birth_date', 'required'],
            ['birth_date', 'date', 'format' => 'dd-MM-yyyy'],
            ['activation_expire,sex_id, religion_id, userid, created_date, created_by, updated_date, updated_by', 'numerical', 'integerOnly' => true],
            ['address3, identity_address3, blood_id', 'length', 'max' => 50],
            ['employee_code, employee_code_global', 'length', 'max' => 50],
            ['activation_code', 'length', 'max' => 16],
            ['employee_name', 'length', 'max' => 100],
            ['email, email2', 'email'],
            //array('handphone', 'ext.BPhoneNumberValidator'),
            ['birth_place', 'length', 'max' => 20],
            ['address1, identity_address1, c_pathfoto', 'length', 'max' => 255],
            ['c_pathfoto, employee_code_global', 'unique'],
            ['address2, identity_address2, home_phone, handphone, handphone2, account_number, account_name, bank_name', 'length', 'max' => 50],
            ['pos_code, identity_pos_code', 'length', 'max' => 5],
            ['identity_number', 'length', 'max' => 25],
            ['birth_date, identity_valid', 'safe'],
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            ['id, employee_code, employee_name, birth_place, birth_date, sex_id, religion_id, address1, address2, address3, pos_code, identity_number, identity_valid, identity_address1, identity_address2, identity_address3, identity_pos_code, email, email2, blood_id, home_phone, handphone, handphone2, c_pathfoto, userid, created_date, created_by, updated_date, updated_by', 'safe', 'on' => 'search'],
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
            'many_career' => [self::HAS_MANY, 'gPersonCareer', 'parent_id', 'order' => 'many_career.start_date DESC'],
            'many_careerC' => [self::STAT, 'gPersonCareer', 'parent_id'],
            'many_career2' => [self::HAS_MANY, 'gPersonCareer2', 'parent_id', 'order' => 'many_career2.start_date DESC'],
            'many_career2C' => [self::STAT, 'gPersonCareer2', 'parent_id'],
            'many_status' => [self::HAS_MANY, 'gPersonStatus', 'parent_id', 'order' => 'many_status.start_date DESC'],
            'many_statusC' => [self::STAT, 'gPersonStatus', 'parent_id'],
            'many_experience' => [self::HAS_MANY, 'gPersonExperience', 'parent_id', 'order' => 'many_experience.start_date DESC'],
            'many_experienceC' => [self::STAT, 'gPersonExperience', 'parent_id'],
            'many_education' => [self::HAS_MANY, 'gPersonEducation', 'parent_id', 'order' => 'many_education.level_id DESC'],
            'many_educationC' => [self::STAT, 'gPersonEducation', 'parent_id'],
            'many_educationnf' => [self::HAS_MANY, 'gPersonEducationNf', 'parent_id'],
            'many_educationnfC' => [self::STAT, 'gPersonEducationNf', 'parent_id'],
            'many_otherC' => [self::STAT, 'gPersonOther', 'parent_id'],
            'many_training' => [self::HAS_MANY, 'gPersonTraining', 'parent_id', 'order' => 'many_training.start_date'],
            'many_training_holding' => [self::HAS_MANY, 'iLearningSchPart', 'employee_id', 'condition' => 'flow_id = 2'],
            'many_training_holding_empty' => [self::HAS_MANY, 'iLearningSchPart', 'employee_id', 'condition' => 'flow_id is null or flow_id = 2'],
            'many_trainingC' => [self::STAT, 'gPersonTraining', 'parent_id'],
            'many_family' => [self::HAS_MANY, 'gPersonFamily', 'parent_id', 'order' => 'many_family.relation_id'],
            'many_familyC' => [self::STAT, 'gPersonFamily', 'parent_id'],
            'has_couple' => [self::STAT, 'gPersonFamily', 'parent_id', 'condition' => 'relation_id = 1 OR relation_id = 2'],
            'count_children' => [self::STAT, 'gPersonFamily', 'parent_id', 'condition' => 'relation_id = 3'],
            'religion' => [self::BELONGS_TO, 'sParameter', ['religion_id' => 'code'], 'condition' => 'type = \'cAgama\''],
            'sex' => [self::BELONGS_TO, 'sParameter', ['sex_id' => 'code'], 'condition' => 'type = \'cGender\''],
            'company' =>
                [self::HAS_ONE, 'gPersonCareer', 'parent_id',
                    //'order' => 'company.start_date DESC',
                    'condition' => 'company.status_id IN (' . implode(',', Yii::app()->getModule('m1')->PARAM_COMPANY_ARRAY) . ')',
                ],
            'companyfirst' => [self::HAS_ONE, 'gPersonCareer', 'parent_id', 'order' => 'companyfirst.start_date ASC', 'condition' => 'companyfirst.status_id =1'],
            'status' => [self::HAS_ONE, 'gPersonStatus', 'parent_id', 'order' => 'status.start_date DESC'],
            'leave' => [self::HAS_MANY, 'gLeave', 'parent_id', 'order' => 'leave.start_date DESC'],
            'leaveBalance' => [self::HAS_ONE, 'gLeave', 'parent_id', 'order' => 'leaveBalance.end_date DESC', 'condition' => 'leaveBalance.approved_id NOT IN (1,8)'],
            'leaveGenerated' => [self::HAS_ONE, 'gLeave', 'parent_id', 'order' => 'leaveGenerated.end_date DESC', 'condition' => 'leaveGenerated.approved_id = 9 OR leaveGenerated.approved_id = 7'],
            'lastLeave' => [self::HAS_ONE, 'gLeave', 'parent_id', 'order' => 'lastLeave.end_date DESC', 'condition' => 'lastLeave.approved_id = 2'],
            'user' => [self::BELONGS_TO, 'sUser', 'userid'],
            'payroll' => [self::HAS_ONE, 'gPayroll', 'parent_id', 'order' => 'payroll.yearmonth_start DESC'],
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'employee_code' => 'Local ID',
            'employee_code_global' => 'Employee ID',
            'employee_name' => 'Employee Name',
            'birth_place' => 'Birth Place',
            'birth_date' => 'Birth Date',
            'sex_id' => 'Sex',
            'religion_id' => 'Religion',
            'address1' => 'Address',
            'address2' => 'Address2',
            'address3' => 'Address3',
            'pos_code' => 'Pos Code',
            'identity_number' => 'Identity Number',
            'identity_valid' => 'Valid',
            'identity_address1' => 'Identity Address',
            'identity_address2' => 'Identity Address2',
            'identity_address3' => 'Identity Address3',
            'identity_pos_code' => 'Identity Pos Code',
            'email' => 'Email',
            'email2' => 'Email2',
            'blood_id' => 'Blood',
            'home_phone' => 'Home Phone',
            'handphone' => 'Handphone',
            'handphone2' => 'Handphone2',
            'account_number' => 'Account Number',
            'account_name' => 'Account Name',
            'bank_name' => 'Bank Name',
            'c_pathfoto' => 'Photo',
            'userid' => 'User ID',
            'activation_code' => 'Activation Code',
            'activation_expire' => 'Activation Expire',
            'created_date' => 'Created Date',
            'created_by' => 'Created By',
            'updated_date' => 'Updated Date',
            'updated_by' => 'Updated By',
        ];
    }

    public static function employeeOut()
    {

        $dependency = new CDbCacheDependency('SELECT MAX(updated_date) FROM g_person_career');

        if (!Yii::app()->cache->get('employeeout' . Yii::app()->user->id)) {
            $criteria = new CDbCriteria;

            $criteria->with = ['status'];
            $criteria->compare('year(status.start_date)', date('Y'));
            $criteria->compare('status.start_date >', date("Y-m-d", strtotime("-3 month")));
            $criteria->AddInCondition('status.status_id', Yii::app()->getModule('m1')->PARAM_RESIGN_ARRAY);
            $criteria->order = 'status.start_date DESC';


            $criteria1 = new CDbCriteria;
            $criteria1->condition = '(select c.company_id from g_person_career c WHERE t.id=c.parent_id AND c.status_id IN (' . implode(',', Yii::app()->getModule('m1')->PARAM_COMPANY_ARRAY) . ') ORDER BY c.start_date DESC LIMIT 1) IN (' . implode(",", sUser::model()->myGroupArray) . ') AND
					(select c.start_date from g_person_career c WHERE t.id=c.parent_id AND c.status_id IN (' . implode(',', Yii::app()->getModule('m1')->PARAM_COMPANY_ARRAY) . ') ORDER BY c.start_date DESC LIMIT 1) < status.start_date ';
            $criteria->mergeWith($criteria1);

            //$dataProvider = new CActiveDataProvider($this, array(
            $dataProvider = new CActiveDataProvider(gPerson::model()->cache(3600, $dependency, 2), [
                'criteria' => $criteria,
                'pagination' => false,
            ]);

            Yii::app()->cache->set('employeeout' . Yii::app()->user->id, $dataProvider, 3600, $dependency);
        } else
            $dataProvider = Yii::app()->cache->get('employeeout' . Yii::app()->user->id);

        return $dataProvider;
    }

    public static function compDepartment()
    {

        $dependency = new CDbCacheDependency('SELECT MAX(updated_date) FROM g_person_career');

        if (!Yii::app()->cache->get('department' . Yii::app()->user->id)) {
            $default = sUser::model()->myGroup;
            $org = aOrganization::model()->find('parent_id = ' . $default);
            $dept = $org->childs[0]->id;
            $models = aOrganization::model()->findAll(['condition' => 'parent_id =' . $dept, 'order' => 'id']);

            $_items = [];
            foreach ($models as $model) {
                $items[] = "SUM(IF((select b.department_id from g_person_career b where b.parent_id = a.id AND b.status_id IN (" . implode(",", Yii::app()->getModule('m1')->PARAM_COMPANY_ARRAY) . ") order by b.start_date DESC limit 1)= " . $model->id . ",1,0)) as l" . $model->id;
            }

            $extend = implode(",", $items);

            $connection = Yii::app()->db;
            $sql = "SELECT (select x.company_id from g_person_career x where x.parent_id = a.id AND x.status_id IN (" . implode(",", Yii::app()->getModule('m1')->PARAM_COMPANY_ARRAY) . ") order by x.start_date DESC limit 1) as company, " . $extend . "
			from g_person a
			WHERE " . Yii::app()->getModule('m1')->filterUserCompany();

            $command = $connection->cache(3600, $dependency)->createCommand($sql);
            //$command = $connection->createCommand($sql);
            $row = $command->queryAll();

            foreach ($models as $model) {
                $_item[] = (int)$row[0]['l' . $model->id];
            }

            Yii::app()->cache->set('department' . Yii::app()->user->id, $_item, 3600, $dependency);
        } else
            $_item = Yii::app()->cache->get('department' . Yii::app()->user->id);

        return $_item;
    }

    public static function compStatus()
    {

        $_item = [];
        $dependency = new CDbCacheDependency('SELECT MAX(updated_date) FROM g_person_status');

        if (!Yii::app()->cache->get('status' . Yii::app()->user->id)) {
            $connection = Yii::app()->db;
            $sql = "SELECT (select x.company_id from g_person_career x where x.parent_id = a.id AND x.status_id IN (" . implode(",", Yii::app()->getModule('m1')->PARAM_COMPANY_ARRAY) . ") order by x.start_date DESC limit 1) as company,
			SUM(IF((select d.status_id from g_person_status d where d.parent_id = a.id order by d.start_date DESC limit 1) = 1 OR (select d.status_id from g_person_status d where d.parent_id = a.id order by d.start_date DESC limit 1) = 2 OR (select d.status_id from g_person_status d where d.parent_id = a.id order by d.start_date DESC limit 1) = 3,1,0)) as l1,
			SUM(IF((select d.status_id from g_person_status d where d.parent_id = a.id order by d.start_date DESC limit 1) = 4 OR (select d.status_id from g_person_status d where d.parent_id = a.id order by d.start_date DESC limit 1) = 5,1,0)) as l2,
			SUM(IF((select d.status_id from g_person_status d where d.parent_id = a.id order by d.start_date DESC limit 1) = 6,1,0)) as l3,
			SUM(IF((select d.status_id from g_person_status d where d.parent_id = a.id order by d.start_date DESC limit 1) = 7,1,0)) as l4

			from g_person a
			WHERE " . Yii::app()->getModule('m1')->filterUserCompany();

            $dependency = new CDbCacheDependency('SELECT MAX(updated_date) FROM g_person_status');

            $command = $connection->cache(3600, $dependency)->createCommand($sql);
            $row = $command->queryAll();

            $_item[] = (int)$row[0]['l1'];
            $_item[] = (int)$row[0]['l2'];
            $_item[] = (int)$row[0]['l3'];
            $_item[] = (int)$row[0]['l4'];

            Yii::app()->cache->set('status' . Yii::app()->user->id, $_item, 3600, $dependency);
        } else
            $_item = Yii::app()->cache->get('status' . Yii::app()->user->id);

        return $_item;
    }

    public static function compLevel()
    {

        $_item = [];
        $dependency = new CDbCacheDependency('SELECT MAX(updated_date) FROM g_person_career');

        if (!Yii::app()->cache->get('level' . Yii::app()->user->id)) {
            $connection = Yii::app()->db;
            $sql = "SELECT (select x.company_id from g_person_career x where x.parent_id = a.id AND x.status_id IN (" . implode(",", Yii::app()->getModule('m1')->PARAM_COMPANY_ARRAY) . ") order by x.start_date DESC limit 1) as company,
			SUM(IF((select g.parent_id from g_person_career d INNER JOIN g_param_level g ON d.level_id = g.id where d.parent_id = a.id order by d.start_date DESC limit 1)= 21,1,0)) as l1,
			SUM(IF((select g.parent_id from g_person_career d INNER JOIN g_param_level g ON d.level_id = g.id where d.parent_id = a.id order by d.start_date DESC limit 1)= 17,1,0)) as l2,
			SUM(IF((select g.parent_id from g_person_career d INNER JOIN g_param_level g ON d.level_id = g.id where d.parent_id = a.id order by d.start_date DESC limit 1)= 13,1,0)) as l3,
			SUM(IF((select g.parent_id from g_person_career d INNER JOIN g_param_level g ON d.level_id = g.id where d.parent_id = a.id order by d.start_date DESC limit 1)= 9,1,0)) as l4,
			SUM(IF((select g.parent_id from g_person_career d INNER JOIN g_param_level g ON d.level_id = g.id where d.parent_id = a.id order by d.start_date DESC limit 1)= 5,1,0)) as l5,
			SUM(IF((select g.parent_id from g_person_career d INNER JOIN g_param_level g ON d.level_id = g.id where d.parent_id = a.id order by d.start_date DESC limit 1)= 1,1,0)) as l6
			from g_person a
			WHERE " . Yii::app()->getModule('m1')->filterUserCompany();

            $command = $connection->cache(3600, $dependency)->createCommand($sql);
            $row = $command->queryAll();

            $_item[] = (int)$row[0]['l1'];
            $_item[] = (int)$row[0]['l2'];
            $_item[] = (int)$row[0]['l3'];
            $_item[] = (int)$row[0]['l4'];
            $_item[] = (int)$row[0]['l5'];
            $_item[] = (int)$row[0]['l6'];

            Yii::app()->cache->set('level' . Yii::app()->user->id, $_item, 3600, $dependency);
        } else
            $_item = Yii::app()->cache->get('level' . Yii::app()->user->id);

        return $_item;
    }

    public static function compWorking()
    {

        $_item = [];
        $dependency = new CDbCacheDependency('SELECT MAX(updated_date) FROM g_person_career');

        if (!Yii::app()->cache->get('working' . Yii::app()->user->id)) {
            $connection = Yii::app()->db;
            $sql = "SELECT (select x.company_id from g_person_career x where x.parent_id = a.id AND x.status_id IN (" . implode(",", Yii::app()->getModule('m1')->PARAM_COMPANY_ARRAY) . ") order by x.start_date DESC limit 1) as company,
			SUM(IF(YEAR(CURDATE()) - YEAR((SELECT d.start_date FROM g_person_career d WHERE d.parent_id = a.id AND d.status_id = 1 order by d.start_date limit 1)) < 1,1,0)) as l1,
			SUM(IF(YEAR(CURDATE()) - YEAR((SELECT d.start_date FROM g_person_career d WHERE d.parent_id = a.id AND d.status_id = 1 order by d.start_date limit 1)) = 1 OR YEAR(CURDATE()) - YEAR((SELECT d.start_date FROM g_person_career d WHERE d.parent_id = a.id AND d.status_id = 1 order by d.start_date limit 1)) = 2,1,0)) as l2,
			SUM(IF(YEAR(CURDATE()) - YEAR((SELECT d.start_date FROM g_person_career d WHERE d.parent_id = a.id AND d.status_id = 1 order by d.start_date limit 1)) = 3 OR YEAR(CURDATE()) - YEAR((SELECT d.start_date FROM g_person_career d WHERE d.parent_id = a.id AND d.status_id = 1 order by d.start_date limit 1)) = 4,1,0)) as l3,
			SUM(IF(YEAR(CURDATE()) - YEAR((SELECT d.start_date FROM g_person_career d WHERE d.parent_id = a.id AND d.status_id = 1 order by d.start_date limit 1)) = 5 OR YEAR(CURDATE()) - YEAR((SELECT d.start_date FROM g_person_career d WHERE d.parent_id = a.id AND d.status_id = 1 order by d.start_date limit 1)) = 6,1,0)) as l4,
			SUM(IF(YEAR(CURDATE()) - YEAR((SELECT d.start_date FROM g_person_career d WHERE d.parent_id = a.id AND d.status_id = 1 order by d.start_date limit 1)) = 7 OR YEAR(CURDATE()) - YEAR((SELECT d.start_date FROM g_person_career d WHERE d.parent_id = a.id AND d.status_id = 1 order by d.start_date limit 1)) = 8,1,0)) as l5,
			SUM(IF(YEAR(CURDATE()) - YEAR((SELECT d.start_date FROM g_person_career d WHERE d.parent_id = a.id AND d.status_id = 1 order by d.start_date limit 1)) >8,1,0)) as l6
		
			from g_person a
			WHERE " . Yii::app()->getModule('m1')->filterUserCompany();


            $command = $connection->cache(3600, $dependency)->createCommand($sql);
            $row = $command->queryAll();

            $_item[] = (int)$row[0]['l1'];
            $_item[] = (int)$row[0]['l2'];
            $_item[] = (int)$row[0]['l3'];
            $_item[] = (int)$row[0]['l4'];
            $_item[] = (int)$row[0]['l5'];
            $_item[] = (int)$row[0]['l6'];

            Yii::app()->cache->set('working' . Yii::app()->user->id, $_item, 3600, $dependency);
        } else
            $_item = Yii::app()->cache->get('working' . Yii::app()->user->id);

        return $_item;
    }

    public static function compSex()
    {

        $_item = [];
        $dependency = new CDbCacheDependency('SELECT MAX(updated_date) FROM g_person');

        if (!Yii::app()->cache->get('sex' . Yii::app()->user->id)) {
            $connection = Yii::app()->db;
            $sql = "SELECT (select x.company_id from g_person_career x where x.parent_id = a.id AND x.status_id IN (" . implode(",", Yii::app()->getModule('m1')->PARAM_COMPANY_ARRAY) . ") order by x.start_date DESC limit 1) as company,
			SUM(IF((select d.sex_id from g_person d where d.id = a.id)= 1,1,0)) as l1,
			SUM(IF((select d.sex_id from g_person d where d.id = a.id)= 2,1,0)) as l2
		
			from g_person a
			WHERE " . Yii::app()->getModule('m1')->filterUserCompany();


            $command = $connection->cache(3600, $dependency)->createCommand($sql);
            $row = $command->queryAll();

            $_item[] = (int)$row[0]['l1'];
            $_item[] = (int)$row[0]['l2'];

            Yii::app()->cache->set('sex' . Yii::app()->user->id, $_item, 3600, $dependency);
        } else
            $_item = Yii::app()->cache->get('sex' . Yii::app()->user->id);

        return $_item;
    }

    public static function compAge()
    {

        $_item = [];
        $dependency = new CDbCacheDependency('SELECT MAX(updated_date) FROM g_person');

        if (!Yii::app()->cache->get('age' . Yii::app()->user->id)) {
            $_age = "DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT((select d.birth_date from g_person d where d.id = a.id), '%Y') - (DATE_FORMAT(NOW(), '00-%m-%d') < DATE_FORMAT((select d.birth_date from g_person d where d.id = a.id), '00-%m-%d'))";
            $connection = Yii::app()->db;
            $sql = "SELECT (select x.company_id from g_person_career x where x.parent_id = a.id AND x.status_id IN (" . implode(",", Yii::app()->getModule('m1')->PARAM_COMPANY_ARRAY) . ") order by x.start_date DESC limit 1) as company,
			SUM(IF(" . $_age . " <= 25,1,0)) as l1,
			SUM(IF(" . $_age . " > 25 AND " . $_age . " <=30,1,0)) as l2,
			SUM(IF(" . $_age . " > 30 AND " . $_age . " <=35,1,0)) as l3,
			SUM(IF(" . $_age . " > 35 AND " . $_age . " <=40,1,0)) as l4,
			SUM(IF(" . $_age . " > 40 AND " . $_age . " <=45,1,0)) as l5,
			SUM(IF(" . $_age . " > 45 AND " . $_age . " <=50,1,0)) as l6,
			SUM(IF(" . $_age . " > 50 AND " . $_age . " <=55,1,0)) as l7,
			SUM(IF(" . $_age . " > 55,1,0)) as l8
		
			from g_person a
			WHERE " . Yii::app()->getModule('m1')->filterUserCompany();

            $command = $connection->cache(3600, $dependency)->createCommand($sql);
            $row = $command->queryAll();

            $_item[] = (int)$row[0]['l1'];
            $_item[] = (int)$row[0]['l2'];
            $_item[] = (int)$row[0]['l3'];
            $_item[] = (int)$row[0]['l4'];
            $_item[] = (int)$row[0]['l5'];
            $_item[] = (int)$row[0]['l6'];
            $_item[] = (int)$row[0]['l7'];
            $_item[] = (int)$row[0]['l8'];

            Yii::app()->cache->set('age' . Yii::app()->user->id, $_item, 3600, $dependency);
        } else
            $_item = Yii::app()->cache->get('age' . Yii::app()->user->id);

        return $_item;
    }

    public static function compEducation()
    {

        $_item = [];
        $dependency = new CDbCacheDependency('SELECT MAX(id) FROM g_person_education');

        if (!Yii::app()->cache->get('education' . Yii::app()->user->id)) {
            $connection = Yii::app()->db;
            $sql = "SELECT (select x.company_id from g_person_career x where x.parent_id = a.id AND x.status_id IN (" . implode(",", Yii::app()->getModule('m1')->PARAM_COMPANY_ARRAY) . ") order by x.start_date DESC limit 1) as company,
			SUM(IF((select d.level_id from g_person_education d where d.parent_id = a.id order by d.level_id DESC limit 1)= 1,1,0)) as l1,
			SUM(IF((select d.level_id from g_person_education d where d.parent_id = a.id order by d.level_id DESC limit 1)= 2,1,0)) as l2,
			SUM(IF((select d.level_id from g_person_education d where d.parent_id = a.id order by d.level_id DESC limit 1)= 3,1,0)) as l3,
			SUM(IF((select d.level_id from g_person_education d where d.parent_id = a.id order by d.level_id DESC limit 1)= 4 OR (select d.level_id from g_person_education d where d.parent_id = a.id order by d.level_id DESC limit 1) = 5 OR (select d.level_id from g_person_education d where d.parent_id = a.id order by d.level_id DESC limit 1) = 6 OR (select d.level_id from g_person_education d where d.parent_id = a.id order by d.level_id DESC limit 1) = 7,1,0)) as l4,
			SUM(IF((select d.level_id from g_person_education d where d.parent_id = a.id order by d.level_id DESC limit 1)= 8,1,0)) as l5,
			SUM(IF((select d.level_id from g_person_education d where d.parent_id = a.id order by d.level_id DESC limit 1)= 9,1,0)) as l6,
			SUM(IF((select d.level_id from g_person_education d where d.parent_id = a.id order by d.level_id DESC limit 1)= 10,1,0)) as l7
		
			from g_person a
			WHERE " . Yii::app()->getModule('m1')->filterUserCompany();


            $command = $connection->cache(3600, $dependency)->createCommand($sql);
            $row = $command->queryAll();

            $_item[] = (int)$row[0]['l1'];
            $_item[] = (int)$row[0]['l2'];
            $_item[] = (int)$row[0]['l3'];
            $_item[] = (int)$row[0]['l4'];
            $_item[] = (int)$row[0]['l5'];
            $_item[] = (int)$row[0]['l6'];
            $_item[] = (int)$row[0]['l7'];

            Yii::app()->cache->set('education' . Yii::app()->user->id, $_item, 3600, $dependency);
        } else
            $_item = Yii::app()->cache->get('education' . Yii::app()->user->id);

        return $_item;
    }

    public static function compReligion()
    {

        $_item = [];
        $dependency = new CDbCacheDependency('SELECT MAX(updated_date) FROM g_person');

        if (!Yii::app()->cache->get('religion' . Yii::app()->user->id)) {
            $connection = Yii::app()->db;
            $sql = "SELECT (select x.company_id from g_person_career x where x.parent_id = a.id AND x.status_id IN (" . implode(",", Yii::app()->getModule('m1')->PARAM_COMPANY_ARRAY) . ") order by x.start_date DESC limit 1) as company,
			SUM(IF((select d.religion_id from g_person d where d.id = a.id)= 1,1,0)) as l1,
			SUM(IF((select d.religion_id from g_person d where d.id = a.id)= 2,1,0)) as l2,
			SUM(IF((select d.religion_id from g_person d where d.id = a.id)= 3,1,0)) as l3,
			SUM(IF((select d.religion_id from g_person d where d.id = a.id)= 4,1,0)) as l4,
			SUM(IF((select d.religion_id from g_person d where d.id = a.id)= 5,1,0)) as l5,
			SUM(IF((select d.religion_id from g_person d where d.id = a.id)= 6,1,0)) as l6
		
			from g_person a
			WHERE " . Yii::app()->getModule('m1')->filterUserCompany();

            $command = $connection->cache(3600, $dependency)->createCommand($sql);
            $row = $command->queryAll();

            $_item[] = (int)$row[0]['l1'];
            $_item[] = (int)$row[0]['l2'];
            $_item[] = (int)$row[0]['l3'];
            $_item[] = (int)$row[0]['l4'];
            $_item[] = (int)$row[0]['l5'];
            $_item[] = (int)$row[0]['l6'];

            Yii::app()->cache->set('religion' . Yii::app()->user->id, $_item, 3600, $dependency);
        } else
            $_item = Yii::app()->cache->get('religion' . Yii::app()->user->id);

        return $_item;
    }

    public static function compEmployeePerMonth()
    {

        $_data = [];
        $dependency = new CDbCacheDependency('SELECT MAX(updated_date) FROM g_person');

        if (!Yii::app()->cache->get('employeepermonth' . Yii::app()->user->id)) {
            $connection = Yii::app()->db;
            $sql = "
				select `o`.`id`, 'Total' as `state`,
				(select count(`a`.`id`) from `g_person` `a` where 
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` IN (1 , 2)
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-01-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-01-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) AND
					(select `o`.`id` AS `id` from `g_person_career` `c`
							left join `a_organization` `o` ON `o`.`id` = `c`.`company_id`
						where `a`.`id` = `c`.`parent_id` AND `c`.`status_id` in (1 , 2, 3, 4, 5, 6, 15)
							AND `c`.`start_date` <= '" . date("Y") . "-01-31' order by `c`.`start_date` desc limit 1)  = `o`.`id`
				) as `201301`,
				(select count(`a`.`id`) from `g_person` `a` where 
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` IN (1 , 2)
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-02-28' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-02-28' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) AND
					(select `o`.`id` AS `id` from `g_person_career` `c`
							left join `a_organization` `o` ON `o`.`id` = `c`.`company_id`
						where `a`.`id` = `c`.`parent_id` AND `c`.`status_id` in (1 , 2, 3, 4, 5, 6, 15)
							AND `c`.`start_date` <= '" . date("Y") . "-02-28' order by `c`.`start_date` desc limit 1)  = `o`.`id`
				) as `201302`,
				(select count(`a`.`id`) from `g_person` `a` where 
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` IN (1 , 2)
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-03-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-03-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) AND
					(select `o`.`id` AS `id` from `g_person_career` `c`
							left join `a_organization` `o` ON `o`.`id` = `c`.`company_id`
						where `a`.`id` = `c`.`parent_id` AND `c`.`status_id` in (1 , 2, 3, 4, 5, 6, 15)
							AND `c`.`start_date` <= '" . date("Y") . "-03-31' order by `c`.`start_date` desc limit 1)  = `o`.`id`
				) as `201303`,
				(select count(`a`.`id`) from `g_person` `a` where 
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` IN (1 , 2)
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-04-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-04-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) AND
					(select `o`.`id` AS `id` from `g_person_career` `c`
							left join `a_organization` `o` ON `o`.`id` = `c`.`company_id`
						where `a`.`id` = `c`.`parent_id` AND `c`.`status_id` in (1 , 2, 3, 4, 5, 6, 15)
							AND `c`.`start_date` <= '" . date("Y") . "-04-30' order by `c`.`start_date` desc limit 1)  = `o`.`id`
				) as `201304`,
				(select count(`a`.`id`) from `g_person` `a` where 
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` IN (1 , 2)
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-05-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-05-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) AND
					(select `o`.`id` AS `id` from `g_person_career` `c`
							left join `a_organization` `o` ON `o`.`id` = `c`.`company_id`
						where `a`.`id` = `c`.`parent_id` AND `c`.`status_id` in (1 , 2, 3, 4, 5, 6, 15)
							AND `c`.`start_date` <= '" . date("Y") . "-05-31' order by `c`.`start_date` desc limit 1)  = `o`.`id`
				) as `201305`,
				(select count(`a`.`id`) from `g_person` `a` where 
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` IN (1 , 2)
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-06-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-06-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) AND
					(select `o`.`id` AS `id` from `g_person_career` `c`
							left join `a_organization` `o` ON `o`.`id` = `c`.`company_id`
						where `a`.`id` = `c`.`parent_id` AND `c`.`status_id` in (1 , 2, 3, 4, 5, 6, 15)
							AND `c`.`start_date` <= '" . date("Y") . "-06-30' order by `c`.`start_date` desc limit 1)  = `o`.`id`
				) as `201306`,
				(select count(`a`.`id`) from `g_person` `a` where 
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` IN (1 , 2)
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-07-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-07-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) AND
					(select `o`.`id` AS `id` from `g_person_career` `c`
							left join `a_organization` `o` ON `o`.`id` = `c`.`company_id`
						where `a`.`id` = `c`.`parent_id` AND `c`.`status_id` in (1 , 2, 3, 4, 5, 6, 15)
							AND `c`.`start_date` <= '" . date("Y") . "-07-31' order by `c`.`start_date` desc limit 1)  = `o`.`id`
				) as `201307`,
				(select count(`a`.`id`) from `g_person` `a` where 
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` IN (1 , 2)
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-08-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-08-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) AND
					(select `o`.`id` AS `id` from `g_person_career` `c`
							left join `a_organization` `o` ON `o`.`id` = `c`.`company_id`
						where `a`.`id` = `c`.`parent_id` AND `c`.`status_id` in (1 , 2, 3, 4, 5, 6, 15)
							AND `c`.`start_date` <= '" . date("Y") . "-08-31' order by `c`.`start_date` desc limit 1)  = `o`.`id`
				) as `201308`,
				(select count(`a`.`id`) from `g_person` `a` where 
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` IN (1 , 2)
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-09-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-09-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) AND
					(select `o`.`id` AS `id` from `g_person_career` `c`
							left join `a_organization` `o` ON `o`.`id` = `c`.`company_id`
						where `a`.`id` = `c`.`parent_id` AND `c`.`status_id` in (1 , 2, 3, 4, 5, 6, 15)
							AND `c`.`start_date` <= '" . date("Y") . "-09-30' order by `c`.`start_date` desc limit 1)  = `o`.`id`
				) as `201309`,
				(select count(`a`.`id`) from `g_person` `a` where 
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` IN (1 , 2)
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-10-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-10-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) AND
					(select `o`.`id` AS `id` from `g_person_career` `c`
							left join `a_organization` `o` ON `o`.`id` = `c`.`company_id`
						where `a`.`id` = `c`.`parent_id` AND `c`.`status_id` in (1 , 2, 3, 4, 5, 6, 15)
							AND `c`.`start_date` <= '" . date("Y") . "-10-31' order by `c`.`start_date` desc limit 1)  = `o`.`id`
				) as `201310`,
				(select count(`a`.`id`) from `g_person` `a` where 
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` IN (1 , 2)
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-11-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-11-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) AND
					(select `o`.`id` AS `id` from `g_person_career` `c`
							left join `a_organization` `o` ON `o`.`id` = `c`.`company_id`
						where `a`.`id` = `c`.`parent_id` AND `c`.`status_id` in (1 , 2, 3, 4, 5, 6, 15)
							AND `c`.`start_date` <= '" . date("Y") . "-11-30' order by `c`.`start_date` desc limit 1)  = `o`.`id`
				) as `201311`,
				(select count(`a`.`id`) from `g_person` `a` where 
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` IN (1 , 2)
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-12-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-12-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) AND
					(select `o`.`id` AS `id` from `g_person_career` `c`
							left join `a_organization` `o` ON `o`.`id` = `c`.`company_id`
						where `a`.`id` = `c`.`parent_id` AND `c`.`status_id` in (1 , 2, 3, 4, 5, 6, 15)
							AND `c`.`start_date` <= '" . date("Y") . "-12-31' order by `c`.`start_date` desc limit 1)  = `o`.`id`
				) as `201312`



				FROM `a_organization` `o`
				where `id` IN (" . implode(",", sUser::model()->myGroupArray) . ")  


			";

            $command = $connection->cache(3600, $dependency)->createCommand($sql);
            $rows = $command->queryAll();
            foreach ($rows as $row) {
                $_data = [];
                $_second = [];
                $_data[] = (int)$row['201301'];
                $_data[] = (int)$row['201302'];
                $_data[] = (int)$row['201303'];
                $_data[] = (int)$row['201304'];
                $_data[] = (int)$row['201305'];
                $_data[] = (int)$row['201306'];
                $_data[] = (int)$row['201307'];
                $_data[] = (int)$row['201308'];
                $_data[] = (int)$row['201309'];
                $_data[] = (int)$row['201310'];
                $_data[] = (int)$row['201311'];
                $_data[] = (int)$row['201312'];
                $_name['name'] = $row['state'];
                $_second['data'] = $_data;
                $_merge[] = array_merge($_name, $_second);
            }

            Yii::app()->cache->set('employeepermonth' . Yii::app()->user->id, $_merge, 3600, $dependency);
        } else
            $_merge = Yii::app()->cache->get('employeepermonth' . Yii::app()->user->id);

        return $_merge;
    }

    public static function compEmployeeIn()
    {

        $_data = [];
        $dependency = new CDbCacheDependency('SELECT MAX(updated_date) FROM g_person_career');

        if (!Yii::app()->cache->get('employeein' . Yii::app()->user->id)) {
            $connection = Yii::app()->db;
            $sql = "
			SELECT a.parent_id, up.name, 'Employee In' as state,
			Sum(IF(g.start_date BETWEEN '" . date("Y") . "-01-01' AND '" . date("Y") . "-01-31',1,0)) AS l01, 
			Sum(IF(g.start_date BETWEEN '" . date("Y") . "-02-01' AND '" . date("Y") . "-02-28',1,0)) AS l02, 
			Sum(IF(g.start_date BETWEEN '" . date("Y") . "-03-01' AND '" . date("Y") . "-03-31',1,0)) AS l03, 
			Sum(IF(g.start_date BETWEEN '" . date("Y") . "-04-01' AND '" . date("Y") . "-04-30',1,0)) AS l04, 
			Sum(IF(g.start_date BETWEEN '" . date("Y") . "-05-01' AND '" . date("Y") . "-05-31',1,0)) AS l05, 
			Sum(IF(g.start_date BETWEEN '" . date("Y") . "-06-01' AND '" . date("Y") . "-06-30',1,0)) AS l06, 
			Sum(IF(g.start_date BETWEEN '" . date("Y") . "-07-01' AND '" . date("Y") . "-07-31',1,0)) AS l07, 
			Sum(IF(g.start_date BETWEEN '" . date("Y") . "-08-01' AND '" . date("Y") . "-08-31',1,0)) AS l08, 
			Sum(IF(g.start_date BETWEEN '" . date("Y") . "-09-01' AND '" . date("Y") . "-09-30',1,0)) AS l09, 
			Sum(IF(g.start_date BETWEEN '" . date("Y") . "-10-01' AND '" . date("Y") . "-10-31',1,0)) AS l10, 
			Sum(IF(g.start_date BETWEEN '" . date("Y") . "-11-01' AND '" . date("Y") . "-11-30',1,0)) AS l11, 
			Sum(IF(g.start_date BETWEEN '" . date("Y") . "-12-01' AND '" . date("Y") . "-12-31',1,0)) AS l12
			FROM a_organization a INNER JOIN a_organization aa ON a.id = aa.parent_id
			INNER JOIN a_organization up ON a.parent_id = up.id 
			INNER JOIN a_organization aaa ON aa.id = aaa.parent_id 
			LEFT JOIN g_person_career g ON aaa.id = g.department_id
			WHERE g.status_id IN (1,2)
			GROUP BY a.parent_id, up.name
			HAVING a.parent_id= " . sUser::model()->myGroup . " 

			UNION ALL 
		
			SELECT 'id' as id, 'name' as name, 'Employee Out' as state,
			SUM(IF(s.start_date BETWEEN '" . date("Y") . "-01-01' AND '" . date("Y") . "-01-31',1,0)) AS l01, 
			SUM(IF(s.start_date BETWEEN '" . date("Y") . "-02-01' AND '" . date("Y") . "-02-28',1,0)) AS l02, 
			SUM(IF(s.start_date BETWEEN '" . date("Y") . "-03-01' AND '" . date("Y") . "-03-31',1,0)) AS l03, 
			SUM(IF(s.start_date BETWEEN '" . date("Y") . "-04-01' AND '" . date("Y") . "-04-30',1,0)) AS l04, 
			SUM(IF(s.start_date BETWEEN '" . date("Y") . "-05-01' AND '" . date("Y") . "-05-31',1,0)) AS l05, 
			SUM(IF(s.start_date BETWEEN '" . date("Y") . "-06-01' AND '" . date("Y") . "-06-30',1,0)) AS l06, 
			SUM(IF(s.start_date BETWEEN '" . date("Y") . "-07-01' AND '" . date("Y") . "-07-31',1,0)) AS l07, 
			SUM(IF(s.start_date BETWEEN '" . date("Y") . "-08-01' AND '" . date("Y") . "-08-31',1,0)) AS l08, 
			SUM(IF(s.start_date BETWEEN '" . date("Y") . "-09-01' AND '" . date("Y") . "-09-30',1,0)) AS l09, 
			SUM(IF(s.start_date BETWEEN '" . date("Y") . "-10-01' AND '" . date("Y") . "-10-31',1,0)) AS l10, 
			SUM(IF(s.start_date BETWEEN '" . date("Y") . "-11-01' AND '" . date("Y") . "-11-30',1,0)) AS l11, 
			SUM(IF(s.start_date BETWEEN '" . date("Y") . "-12-01' AND '" . date("Y") . "-12-31',1,0)) AS l12

			FROM g_person_status s 
			WHERE s.status_id IN (" . implode(",", Yii::app()->getModule('m1')->PARAM_RESIGN_ARRAY) . ") AND (SELECT p.company_id FROM g_person_career p WHERE p.parent_id = s.parent_id AND p.status_id NOT IN (" . implode(",", Yii::app()->getModule('m1')->PARAM_RESIGN_ARRAY) . ")  ORDER BY p.start_date DESC LIMIT 1) = " . sUser::model()->myGroup . "

			";

            $command = $connection->cache(3600, $dependency)->createCommand($sql);
            $rows = $command->queryAll();
            foreach ($rows as $row) {
                $_data = [];
                $_second = [];
                $_data[] = (int)$row['l01'];
                $_data[] = (int)$row['l02'];
                $_data[] = (int)$row['l03'];
                $_data[] = (int)$row['l04'];
                $_data[] = (int)$row['l05'];
                $_data[] = (int)$row['l06'];
                $_data[] = (int)$row['l07'];
                $_data[] = (int)$row['l08'];
                $_data[] = (int)$row['l09'];
                $_data[] = (int)$row['l10'];
                $_data[] = (int)$row['l11'];
                $_data[] = (int)$row['l12'];
                $_name['name'] = $row['state'];
                $_second['data'] = $_data;
                $_merge[] = array_merge($_name, $_second);
            }

            Yii::app()->cache->set('employeein' . Yii::app()->user->id, $_merge, 3600, $dependency);
        } else
            $_merge = Yii::app()->cache->get('employeein' . Yii::app()->user->id);

        return $_merge;
    }

    public static function compEmployeePmd()
    {

        $_data = [];
        $dependency = new CDbCacheDependency('SELECT MAX(updated_date) FROM g_person_career');

        if (!Yii::app()->cache->get('employeepmd' . Yii::app()->user->id)) {
            $connection = Yii::app()->db;
            $sql = "
            	SELECT 'Promotion' AS 'state',
				(select 
					COUNT((select `c`.`status_id` AS `status_id`
						from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` in (3, 5)
							and `c`.`start_date` BETWEEN '" . date("Y") . "-01-01' AND '" . date("Y") . "-01-31'
						order by `c`.`start_date` desc limit 1)) as 'l01' 
				from `g_person` `a`
				where
					(select `c`.`status_id` AS `status_id`
						from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id`
							and `c`.`status_id` in (3, 5)
							and `c`.`start_date` BETWEEN '" . date("Y") . "-01-01' AND '" . date("Y") . "-01-31'
						order by `c`.`start_date` desc
					limit 1) IN (3,5) AND

					(select 
						`o`.`id` AS `id`
					from
						(`g_person_career` `c`
						left join `a_organization` `o` ON ((`o`.`id` = `c`.`company_id`)))
					where
						((`a`.`id` = `c`.`parent_id`)
							and (`c`.`status_id` in (1 , 2, 3, 4, 5, 6, 15)))
					order by `c`.`start_date` desc
					limit 1) = " . sUser::model()->myGroup . "					
				) as 'l01',

				(select 
					COUNT((select `c`.`status_id` AS `status_id`
						from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` in (3, 5)
							and `c`.`start_date` BETWEEN '" . date("Y") . "-02-01' AND '" . date("Y") . "-02-28'
						order by `c`.`start_date` desc limit 1)) as 'l02' 
				from `g_person` `a`
				where
					(select `c`.`status_id` AS `status_id`
						from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id`
							and `c`.`status_id` in (3, 5)
							and `c`.`start_date` BETWEEN '" . date("Y") . "-02-01' AND '" . date("Y") . "-02-28'
						order by `c`.`start_date` desc
					limit 1) IN (3,5) AND

					(select 
						`o`.`id` AS `id`
					from
						(`g_person_career` `c`
						left join `a_organization` `o` ON ((`o`.`id` = `c`.`company_id`)))
					where
						((`a`.`id` = `c`.`parent_id`)
							and (`c`.`status_id` in (1 , 2, 3, 4, 5, 6, 15)))
					order by `c`.`start_date` desc
					limit 1) = " . sUser::model()->myGroup . "					
				) as 'l02',

				(select 
					COUNT((select `c`.`status_id` AS `status_id`
						from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` in (3, 5)
							and `c`.`start_date` BETWEEN '" . date("Y") . "-03-01' AND '" . date("Y") . "-03-31'
						order by `c`.`start_date` desc limit 1)) as 'l03' 
				from `g_person` `a`
				where
					(select `c`.`status_id` AS `status_id`
						from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id`
							and `c`.`status_id` in (3, 5)
							and `c`.`start_date` BETWEEN '" . date("Y") . "-03-01' AND '" . date("Y") . "-03-31'
						order by `c`.`start_date` desc
					limit 1) IN (3,5) AND

					(select 
						`o`.`id` AS `id`
					from
						(`g_person_career` `c`
						left join `a_organization` `o` ON ((`o`.`id` = `c`.`company_id`)))
					where
						((`a`.`id` = `c`.`parent_id`)
							and (`c`.`status_id` in (1 , 2, 3, 4, 5, 6, 15)))
					order by `c`.`start_date` desc
					limit 1) = " . sUser::model()->myGroup . "					
					) as 'l03',

				(select 
					COUNT((select `c`.`status_id` AS `status_id`
						from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` in (3, 5)
							and `c`.`start_date` BETWEEN '" . date("Y") . "-04-01' AND '" . date("Y") . "-04-30'
						order by `c`.`start_date` desc limit 1)) as 'l04' 
				from `g_person` `a`
				where
					(select `c`.`status_id` AS `status_id`
						from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id`
							and `c`.`status_id` in (3, 5)
							and `c`.`start_date` BETWEEN '" . date("Y") . "-04-01' AND '" . date("Y") . "-04-30'
						order by `c`.`start_date` desc
					limit 1) IN (3,5) AND

					(select 
						`o`.`id` AS `id`
					from
						(`g_person_career` `c`
						left join `a_organization` `o` ON ((`o`.`id` = `c`.`company_id`)))
					where
						((`a`.`id` = `c`.`parent_id`)
							and (`c`.`status_id` in (1 , 2, 3, 4, 5, 6, 15)))
					order by `c`.`start_date` desc
					limit 1) = " . sUser::model()->myGroup . "					
					) as 'l04',

				(select 
					COUNT((select `c`.`status_id` AS `status_id`
						from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` in (3, 5)
							and `c`.`start_date` BETWEEN '" . date("Y") . "-05-01' AND '" . date("Y") . "-05-31'
						order by `c`.`start_date` desc limit 1)) as 'l05' 
				from `g_person` `a`
				where
					(select `c`.`status_id` AS `status_id`
						from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id`
							and `c`.`status_id` in (3, 5)
							and `c`.`start_date` BETWEEN '" . date("Y") . "-05-01' AND '" . date("Y") . "-05-31'
						order by `c`.`start_date` desc
					limit 1) IN (3,5) AND

					(select 
						`o`.`id` AS `id`
					from
						(`g_person_career` `c`
						left join `a_organization` `o` ON ((`o`.`id` = `c`.`company_id`)))
					where
						((`a`.`id` = `c`.`parent_id`)
							and (`c`.`status_id` in (1 , 2, 3, 4, 5, 6, 15)))
					order by `c`.`start_date` desc
					limit 1) = " . sUser::model()->myGroup . "					
					) as 'l05',

				(select 
					COUNT((select `c`.`status_id` AS `status_id`
						from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` in (3, 5)
							and `c`.`start_date` BETWEEN '" . date("Y") . "-06-01' AND '" . date("Y") . "-06-30'
						order by `c`.`start_date` desc limit 1)) as 'l06' 
				from `g_person` `a`
				where
					(select `c`.`status_id` AS `status_id`
						from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id`
							and `c`.`status_id` in (3, 5)
							and `c`.`start_date` BETWEEN '" . date("Y") . "-06-01' AND '" . date("Y") . "-06-30'
						order by `c`.`start_date` desc
					limit 1) IN (3,5) AND

					(select 
						`o`.`id` AS `id`
					from
						(`g_person_career` `c`
						left join `a_organization` `o` ON ((`o`.`id` = `c`.`company_id`)))
					where
						((`a`.`id` = `c`.`parent_id`)
							and (`c`.`status_id` in (1 , 2, 3, 4, 5, 6, 15)))
					order by `c`.`start_date` desc
					limit 1) = " . sUser::model()->myGroup . "					
					) as 'l06',

				(select 
					COUNT((select `c`.`status_id` AS `status_id`
						from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` in (3, 5)
							and `c`.`start_date` BETWEEN '" . date("Y") . "-07-01' AND '" . date("Y") . "-07-31'
						order by `c`.`start_date` desc limit 1)) as 'l07' 
				from `g_person` `a`
				where
					(select `c`.`status_id` AS `status_id`
						from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id`
							and `c`.`status_id` in (3, 5)
							and `c`.`start_date` BETWEEN '" . date("Y") . "-07-01' AND '" . date("Y") . "-07-31'
						order by `c`.`start_date` desc
					limit 1) IN (3,5) AND

					(select 
						`o`.`id` AS `id`
					from
						(`g_person_career` `c`
						left join `a_organization` `o` ON ((`o`.`id` = `c`.`company_id`)))
					where
						((`a`.`id` = `c`.`parent_id`)
							and (`c`.`status_id` in (1 , 2, 3, 4, 5, 6, 15)))
					order by `c`.`start_date` desc
					limit 1) = " . sUser::model()->myGroup . "					
					) as 'l07',

				(select 
					COUNT((select `c`.`status_id` AS `status_id`
						from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` in (3, 5)
							and `c`.`start_date` BETWEEN '" . date("Y") . "-08-01' AND '" . date("Y") . "-08-31'
						order by `c`.`start_date` desc limit 1)) as 'l08' 
				from `g_person` `a`
				where
					(select `c`.`status_id` AS `status_id`
						from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id`
							and `c`.`status_id` in (3, 5)
							and `c`.`start_date` BETWEEN '" . date("Y") . "-08-01' AND '" . date("Y") . "-08-31'
						order by `c`.`start_date` desc
					limit 1) IN (3,5) AND

					(select 
						`o`.`id` AS `id`
					from
						(`g_person_career` `c`
						left join `a_organization` `o` ON ((`o`.`id` = `c`.`company_id`)))
					where
						((`a`.`id` = `c`.`parent_id`)
							and (`c`.`status_id` in (1 , 2, 3, 4, 5, 6, 15)))
					order by `c`.`start_date` desc
					limit 1) = " . sUser::model()->myGroup . "					
					) as 'l08',
					
				(select 
					COUNT((select `c`.`status_id` AS `status_id`
						from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` in (3, 5)
							and `c`.`start_date` BETWEEN '" . date("Y") . "-09-01' AND '" . date("Y") . "-09-30'
						order by `c`.`start_date` desc limit 1)) as 'l09' 
				from `g_person` `a`
				where
					(select `c`.`status_id` AS `status_id`
						from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id`
							and `c`.`status_id` in (3, 5)
							and `c`.`start_date` BETWEEN '" . date("Y") . "-09-01' AND '" . date("Y") . "-09-30'
						order by `c`.`start_date` desc
					limit 1) IN (3,5) AND

					(select 
						`o`.`id` AS `id`
					from
						(`g_person_career` `c`
						left join `a_organization` `o` ON ((`o`.`id` = `c`.`company_id`)))
					where
						((`a`.`id` = `c`.`parent_id`)
							and (`c`.`status_id` in (1 , 2, 3, 4, 5, 6, 15)))
					order by `c`.`start_date` desc
					limit 1) = " . sUser::model()->myGroup . "					
					) as 'l09',
					
				(select 
					COUNT((select `c`.`status_id` AS `status_id`
						from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` in (3, 5)
							and `c`.`start_date` BETWEEN '" . date("Y") . "-10-01' AND '" . date("Y") . "-10-31'
						order by `c`.`start_date` desc limit 1)) as 'l10' 
				from `g_person` `a`
				where
					(select `c`.`status_id` AS `status_id`
						from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id`
							and `c`.`status_id` in (3, 5)
							and `c`.`start_date` BETWEEN '" . date("Y") . "-10-01' AND '" . date("Y") . "-10-31'
						order by `c`.`start_date` desc
					limit 1) IN (3,5) AND

					(select 
						`o`.`id` AS `id`
					from
						(`g_person_career` `c`
						left join `a_organization` `o` ON ((`o`.`id` = `c`.`company_id`)))
					where
						((`a`.`id` = `c`.`parent_id`)
							and (`c`.`status_id` in (1 , 2, 3, 4, 5, 6, 15)))
					order by `c`.`start_date` desc
					limit 1) = " . sUser::model()->myGroup . "					
					) as 'l10',
					
				(select 
					COUNT((select `c`.`status_id` AS `status_id`
						from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` in (3, 5)
							and `c`.`start_date` BETWEEN '" . date("Y") . "-11-01' AND '" . date("Y") . "-11-30'
						order by `c`.`start_date` desc limit 1)) as 'l08' 
				from `g_person` `a`
				where
					(select `c`.`status_id` AS `status_id`
						from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id`
							and `c`.`status_id` in (3, 5)
							and `c`.`start_date` BETWEEN '" . date("Y") . "-11-01' AND '" . date("Y") . "-11-30'
						order by `c`.`start_date` desc
					limit 1) IN (3,5) AND

					(select 
						`o`.`id` AS `id`
					from
						(`g_person_career` `c`
						left join `a_organization` `o` ON ((`o`.`id` = `c`.`company_id`)))
					where
						((`a`.`id` = `c`.`parent_id`)
							and (`c`.`status_id` in (1 , 2, 3, 4, 5, 6, 15)))
					order by `c`.`start_date` desc
					limit 1) = " . sUser::model()->myGroup . "					
					) as 'l11',
					
				(select 
					COUNT((select `c`.`status_id` AS `status_id`
						from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` in (3, 5)
							and `c`.`start_date` BETWEEN '" . date("Y") . "-12-01' AND '" . date("Y") . "-12-31'
						order by `c`.`start_date` desc limit 1)) as 'l12' 
				from `g_person` `a`
				where
					(select `c`.`status_id` AS `status_id`
						from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id`
							and `c`.`status_id` in (3, 5)
							and `c`.`start_date` BETWEEN '" . date("Y") . "-12-01' AND '" . date("Y") . "-12-31'
						order by `c`.`start_date` desc
					limit 1) IN (3,5) AND

					(select 
						`o`.`id` AS `id`
					from
						(`g_person_career` `c`
						left join `a_organization` `o` ON ((`o`.`id` = `c`.`company_id`)))
					where
						((`a`.`id` = `c`.`parent_id`)
							and (`c`.`status_id` in (1 , 2, 3, 4, 5, 6, 15)))
					order by `c`.`start_date` desc
					limit 1) = " . sUser::model()->myGroup . "					
					) as 'l12'
					
				FROM `a_organization` `g` where `g`.`id` = 1
				
				UNION ALL
				
            	SELECT 'Mutation' AS 'state',
				(select 
					COUNT((select `c`.`status_id` AS `status_id`
						from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 2
							and `c`.`start_date` BETWEEN '" . date("Y") . "-01-01' AND '" . date("Y") . "-01-31'
						order by `c`.`start_date` desc limit 1)) as 'l01' 
				from `g_person` `a`
				where
					(select `c`.`status_id` AS `status_id`
						from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id`
							and `c`.`status_id` = 2
							and `c`.`start_date` BETWEEN '" . date("Y") . "-01-01' AND '" . date("Y") . "-01-31'
						order by `c`.`start_date` desc
					limit 1) IN (2) AND

					(select 
						`o`.`id` AS `id`
					from
						(`g_person_career` `c`
						left join `a_organization` `o` ON ((`o`.`id` = `c`.`company_id`)))
					where
						((`a`.`id` = `c`.`parent_id`)
							and (`c`.`status_id` in (1 , 2, 3, 4, 5, 6, 15)))
					order by `c`.`start_date` desc
					limit 1) = " . sUser::model()->myGroup . "					
					) as 'l01',

				(select 
					COUNT((select `c`.`status_id` AS `status_id`
						from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 2
							and `c`.`start_date` BETWEEN '" . date("Y") . "-02-01' AND '" . date("Y") . "-02-28'
						order by `c`.`start_date` desc limit 1)) as 'l02' 
				from `g_person` `a`
				where
					(select `c`.`status_id` AS `status_id`
						from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id`
							and `c`.`status_id` = 2
							and `c`.`start_date` BETWEEN '" . date("Y") . "-02-01' AND '" . date("Y") . "-02-28'
						order by `c`.`start_date` desc
					limit 1) IN (2) AND

					(select 
						`o`.`id` AS `id`
					from
						(`g_person_career` `c`
						left join `a_organization` `o` ON ((`o`.`id` = `c`.`company_id`)))
					where
						((`a`.`id` = `c`.`parent_id`)
							and (`c`.`status_id` in (1 , 2, 3, 4, 5, 6, 15)))
					order by `c`.`start_date` desc
					limit 1) = " . sUser::model()->myGroup . "					
					) as 'l02',

				(select 
					COUNT((select `c`.`status_id` AS `status_id`
						from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 2
							and `c`.`start_date` BETWEEN '" . date("Y") . "-03-01' AND '" . date("Y") . "-03-31'
						order by `c`.`start_date` desc limit 1)) as 'l03' 
				from `g_person` `a`
				where
					(select `c`.`status_id` AS `status_id`
						from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id`
							and `c`.`status_id` = 2
							and `c`.`start_date` BETWEEN '" . date("Y") . "-03-01' AND '" . date("Y") . "-03-31'
						order by `c`.`start_date` desc
					limit 1) IN (2) AND

					(select 
						`o`.`id` AS `id`
					from
						(`g_person_career` `c`
						left join `a_organization` `o` ON ((`o`.`id` = `c`.`company_id`)))
					where
						((`a`.`id` = `c`.`parent_id`)
							and (`c`.`status_id` in (1 , 2, 3, 4, 5, 6, 15)))
					order by `c`.`start_date` desc
					limit 1) = " . sUser::model()->myGroup . "					
					) as 'l03',

				(select 
					COUNT((select `c`.`status_id` AS `status_id`
						from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 2
							and `c`.`start_date` BETWEEN '" . date("Y") . "-04-01' AND '" . date("Y") . "-04-30'
						order by `c`.`start_date` desc limit 1)) as 'l04' 
				from `g_person` `a`
				where
					(select `c`.`status_id` AS `status_id`
						from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id`
							and `c`.`status_id` = 2
							and `c`.`start_date` BETWEEN '" . date("Y") . "-04-01' AND '" . date("Y") . "-04-30'
						order by `c`.`start_date` desc
					limit 1) IN (2) AND

					(select 
						`o`.`id` AS `id`
					from
						(`g_person_career` `c`
						left join `a_organization` `o` ON ((`o`.`id` = `c`.`company_id`)))
					where
						((`a`.`id` = `c`.`parent_id`)
							and (`c`.`status_id` in (1 , 2, 3, 4, 5, 6, 15)))
					order by `c`.`start_date` desc
					limit 1) = " . sUser::model()->myGroup . "					
					) as 'l04',

				(select 
					COUNT((select `c`.`status_id` AS `status_id`
						from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 2
							and `c`.`start_date` BETWEEN '" . date("Y") . "-05-01' AND '" . date("Y") . "-05-31'
						order by `c`.`start_date` desc limit 1)) as 'l05' 
				from `g_person` `a`
				where
					(select `c`.`status_id` AS `status_id`
						from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id`
							and `c`.`status_id` = 2
							and `c`.`start_date` BETWEEN '" . date("Y") . "-05-01' AND '" . date("Y") . "-05-31'
						order by `c`.`start_date` desc
					limit 1) IN (2) AND

					(select 
						`o`.`id` AS `id`
					from
						(`g_person_career` `c`
						left join `a_organization` `o` ON ((`o`.`id` = `c`.`company_id`)))
					where
						((`a`.`id` = `c`.`parent_id`)
							and (`c`.`status_id` in (1 , 2, 3, 4, 5, 6, 15)))
					order by `c`.`start_date` desc
					limit 1) = " . sUser::model()->myGroup . "					
					) as 'l05',

				(select 
					COUNT((select `c`.`status_id` AS `status_id`
						from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 2
							and `c`.`start_date` BETWEEN '" . date("Y") . "-06-01' AND '" . date("Y") . "-06-30'
						order by `c`.`start_date` desc limit 1)) as 'l06' 
				from `g_person` `a`
				where
					(select `c`.`status_id` AS `status_id`
						from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id`
							and `c`.`status_id` = 2
							and `c`.`start_date` BETWEEN '" . date("Y") . "-06-01' AND '" . date("Y") . "-06-30'
						order by `c`.`start_date` desc
					limit 1) IN (2) AND

					(select 
						`o`.`id` AS `id`
					from
						(`g_person_career` `c`
						left join `a_organization` `o` ON ((`o`.`id` = `c`.`company_id`)))
					where
						((`a`.`id` = `c`.`parent_id`)
							and (`c`.`status_id` in (1 , 2, 3, 4, 5, 6, 15)))
					order by `c`.`start_date` desc
					limit 1) = " . sUser::model()->myGroup . "					
					) as 'l06',

				(select 
					COUNT((select `c`.`status_id` AS `status_id`
						from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 2
							and `c`.`start_date` BETWEEN '" . date("Y") . "-07-01' AND '" . date("Y") . "-07-31'
						order by `c`.`start_date` desc limit 1)) as 'l07' 
				from `g_person` `a`
				where
					(select `c`.`status_id` AS `status_id`
						from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id`
							and `c`.`status_id` = 2
							and `c`.`start_date` BETWEEN '" . date("Y") . "-07-01' AND '" . date("Y") . "-07-31'
						order by `c`.`start_date` desc
					limit 1) IN (2) AND

					(select 
						`o`.`id` AS `id`
					from
						(`g_person_career` `c`
						left join `a_organization` `o` ON ((`o`.`id` = `c`.`company_id`)))
					where
						((`a`.`id` = `c`.`parent_id`)
							and (`c`.`status_id` in (1 , 2, 3, 4, 5, 6, 15)))
					order by `c`.`start_date` desc
					limit 1) = " . sUser::model()->myGroup . "					
					) as 'l07',

				(select 
					COUNT((select `c`.`status_id` AS `status_id`
						from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 2
							and `c`.`start_date` BETWEEN '" . date("Y") . "-08-01' AND '" . date("Y") . "-08-31'
						order by `c`.`start_date` desc limit 1)) as 'l08' 
				from `g_person` `a`
				where
					(select `c`.`status_id` AS `status_id`
						from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id`
							and `c`.`status_id` = 2
							and `c`.`start_date` BETWEEN '" . date("Y") . "-08-01' AND '" . date("Y") . "-08-31'
						order by `c`.`start_date` desc
					limit 1) IN (2) AND

					(select 
						`o`.`id` AS `id`
					from
						(`g_person_career` `c`
						left join `a_organization` `o` ON ((`o`.`id` = `c`.`company_id`)))
					where
						((`a`.`id` = `c`.`parent_id`)
							and (`c`.`status_id` in (1 , 2, 3, 4, 5, 6, 15)))
					order by `c`.`start_date` desc
					limit 1) = " . sUser::model()->myGroup . "					
					) as 'l08',
					
				(select 
					COUNT((select `c`.`status_id` AS `status_id`
						from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 2
							and `c`.`start_date` BETWEEN '" . date("Y") . "-09-01' AND '" . date("Y") . "-09-30'
						order by `c`.`start_date` desc limit 1)) as 'l09' 
				from `g_person` `a`
				where
					(select `c`.`status_id` AS `status_id`
						from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id`
							and `c`.`status_id` = 2
							and `c`.`start_date` BETWEEN '" . date("Y") . "-09-01' AND '" . date("Y") . "-09-30'
						order by `c`.`start_date` desc
					limit 1) IN (2) AND

					(select 
						`o`.`id` AS `id`
					from
						(`g_person_career` `c`
						left join `a_organization` `o` ON ((`o`.`id` = `c`.`company_id`)))
					where
						((`a`.`id` = `c`.`parent_id`)
							and (`c`.`status_id` in (1 , 2, 3, 4, 5, 6, 15)))
					order by `c`.`start_date` desc
					limit 1) = " . sUser::model()->myGroup . "					
					) as 'l09',
					
				(select 
					COUNT((select `c`.`status_id` AS `status_id`
						from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 2
							and `c`.`start_date` BETWEEN '" . date("Y") . "-10-01' AND '" . date("Y") . "-10-31'
						order by `c`.`start_date` desc limit 1)) as 'l10' 
				from `g_person` `a`
				where
					(select `c`.`status_id` AS `status_id`
						from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id`
							and `c`.`status_id` = 2
							and `c`.`start_date` BETWEEN '" . date("Y") . "-10-01' AND '" . date("Y") . "-10-31'
						order by `c`.`start_date` desc
					limit 1) IN (2) AND

					(select 
						`o`.`id` AS `id`
					from
						(`g_person_career` `c`
						left join `a_organization` `o` ON ((`o`.`id` = `c`.`company_id`)))
					where
						((`a`.`id` = `c`.`parent_id`)
							and (`c`.`status_id` in (1 , 2, 3, 4, 5, 6, 15)))
					order by `c`.`start_date` desc
					limit 1) = " . sUser::model()->myGroup . "					
					) as 'l10',
					
				(select 
					COUNT((select `c`.`status_id` AS `status_id`
						from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 2
							and `c`.`start_date` BETWEEN '" . date("Y") . "-11-01' AND '" . date("Y") . "-11-30'
						order by `c`.`start_date` desc limit 1)) as 'l11' 
				from `g_person` `a`
				where
					(select `c`.`status_id` AS `status_id`
						from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id`
							and `c`.`status_id` = 2
							and `c`.`start_date` BETWEEN '" . date("Y") . "-11-01' AND '" . date("Y") . "-11-30'
						order by `c`.`start_date` desc
					limit 1) IN (2) AND

					(select 
						`o`.`id` AS `id`
					from
						(`g_person_career` `c`
						left join `a_organization` `o` ON ((`o`.`id` = `c`.`company_id`)))
					where
						((`a`.`id` = `c`.`parent_id`)
							and (`c`.`status_id` in (1 , 2, 3, 4, 5, 6, 15)))
					order by `c`.`start_date` desc
					limit 1) = " . sUser::model()->myGroup . "					
					) as 'l11',
					
				(select 
					COUNT((select `c`.`status_id` AS `status_id`
						from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 2
							and `c`.`start_date` BETWEEN '" . date("Y") . "-12-01' AND '" . date("Y") . "-12-31'
						order by `c`.`start_date` desc limit 1)) as 'l12' 
				from `g_person` `a`
				where
					(select `c`.`status_id` AS `status_id`
						from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id`
							and `c`.`status_id` = 2
							and `c`.`start_date` BETWEEN '" . date("Y") . "-12-01' AND '" . date("Y") . "-12-31'
						order by `c`.`start_date` desc
					limit 1) IN (2) AND

					(select 
						`o`.`id` AS `id`
					from
						(`g_person_career` `c`
						left join `a_organization` `o` ON ((`o`.`id` = `c`.`company_id`)))
					where
						((`a`.`id` = `c`.`parent_id`)
							and (`c`.`status_id` in (1 , 2, 3, 4, 5, 6, 15)))
					order by `c`.`start_date` desc
					limit 1) = " . sUser::model()->myGroup . "					
					) as 'l12'
					
				FROM `a_organization` `g` where `g`.`id` = 1
				
			";

            $command = $connection->cache(3600, $dependency)->createCommand($sql);
            $rows = $command->queryAll();
            foreach ($rows as $row) {
                $_data = [];
                $_second = [];
                $_data[] = (int)$row['l01'];
                $_data[] = (int)$row['l02'];
                $_data[] = (int)$row['l03'];
                $_data[] = (int)$row['l04'];
                $_data[] = (int)$row['l05'];
                $_data[] = (int)$row['l06'];
                $_data[] = (int)$row['l07'];
                $_data[] = (int)$row['l08'];
                $_data[] = (int)$row['l09'];
                $_data[] = (int)$row['l10'];
                $_data[] = (int)$row['l11'];
                $_data[] = (int)$row['l12'];
                $_name['name'] = $row['state'];
                $_second['data'] = $_data;
                $_merge[] = array_merge($_name, $_second);
            }

            Yii::app()->cache->set('employeepmd' . Yii::app()->user->id, $_merge, 3600, $dependency);
        } else
            $_merge = Yii::app()->cache->get('employeepmd' . Yii::app()->user->id);

        return $_merge;
    }

    public static function compEmployeePerMonthAll()
    {

        $_data = [];
        $dependency = new CDbCacheDependency('SELECT MAX(updated_date) FROM g_person');

        if (!Yii::app()->cache->get('employeepermonthall' . Yii::app()->user->id)) {
            $connection = Yii::app()->db;
            $sql = "
				select `o`.`id`, 'Total' as `state`,
				(select count(`a`.`id`) from `g_person` `a` where 
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-01-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-01-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201301`,
				(select count(`a`.`id`) from `g_person` `a` where 
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-02-28' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-02-28' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201302`,
				(select count(`a`.`id`) from `g_person` `a` where 
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-03-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-03-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201303`,
				(select count(`a`.`id`) from `g_person` `a` where 
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-04-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-04-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201304`,
				(select count(`a`.`id`) from `g_person` `a` where 
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-05-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-05-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201305`,
				(select count(`a`.`id`) from `g_person` `a` where 
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-06-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-06-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201306`,
				(select count(`a`.`id`) from `g_person` `a` where 
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-07-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-07-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201307`,
				(select count(`a`.`id`) from `g_person` `a` where 
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-08-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-08-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201308`,
				(select count(`a`.`id`) from `g_person` `a` where 
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-09-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-09-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201309`,
				(select count(`a`.`id`) from `g_person` `a` where 
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-10-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-10-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201310`,
				(select count(`a`.`id`) from `g_person` `a` where 
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-11-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-11-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201311`,
				(select count(`a`.`id`) from `g_person` `a` where 
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-12-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-12-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201312`



				FROM `a_organization` `o`
				where `id` = 1  


			";

            $command = $connection->cache(3600, $dependency)->createCommand($sql);
            $rows = $command->queryAll();
            foreach ($rows as $row) {
                $_data = [];
                $_second = [];
                $_data[] = (int)$row['201301'];
                $_data[] = (int)$row['201302'];
                $_data[] = (int)$row['201303'];
                $_data[] = (int)$row['201304'];
                $_data[] = (int)$row['201305'];
                $_data[] = (int)$row['201306'];
                $_data[] = (int)$row['201307'];
                $_data[] = (int)$row['201308'];
                $_data[] = (int)$row['201309'];
                $_data[] = (int)$row['201310'];
                $_data[] = (int)$row['201311'];
                $_data[] = (int)$row['201312'];
                $_name['name'] = $row['state'];
                $_second['data'] = $_data;
                $_merge[] = array_merge($_name, $_second);
            }

            Yii::app()->cache->set('employeepermonthall' . Yii::app()->user->id, $_merge, 3600, $dependency);
        } else
            $_merge = Yii::app()->cache->get('employeepermonthall' . Yii::app()->user->id);

        return $_merge;
    }

    public static function compEmployeeInAll()
    {

        $_data = [];
        $dependency = new CDbCacheDependency('SELECT MAX(updated_date) FROM g_person_career');

        if (!Yii::app()->cache->get('employeeinall' . Yii::app()->user->id)) {
            $connection = Yii::app()->db;
            $sql = "
			SELECT 'Employee In' as state,
			Sum(IF(g.start_date BETWEEN '" . date("Y") . "-01-01' AND '" . date("Y") . "-01-31',1,0)) AS l01, 
			Sum(IF(g.start_date BETWEEN '" . date("Y") . "-02-01' AND '" . date("Y") . "-02-28',1,0)) AS l02, 
			Sum(IF(g.start_date BETWEEN '" . date("Y") . "-03-01' AND '" . date("Y") . "-03-31',1,0)) AS l03, 
			Sum(IF(g.start_date BETWEEN '" . date("Y") . "-04-01' AND '" . date("Y") . "-04-30',1,0)) AS l04, 
			Sum(IF(g.start_date BETWEEN '" . date("Y") . "-05-01' AND '" . date("Y") . "-05-31',1,0)) AS l05, 
			Sum(IF(g.start_date BETWEEN '" . date("Y") . "-06-01' AND '" . date("Y") . "-06-30',1,0)) AS l06, 
			Sum(IF(g.start_date BETWEEN '" . date("Y") . "-07-01' AND '" . date("Y") . "-07-31',1,0)) AS l07, 
			Sum(IF(g.start_date BETWEEN '" . date("Y") . "-08-01' AND '" . date("Y") . "-08-31',1,0)) AS l08, 
			Sum(IF(g.start_date BETWEEN '" . date("Y") . "-09-01' AND '" . date("Y") . "-09-30',1,0)) AS l09, 
			Sum(IF(g.start_date BETWEEN '" . date("Y") . "-10-01' AND '" . date("Y") . "-10-31',1,0)) AS l10, 
			Sum(IF(g.start_date BETWEEN '" . date("Y") . "-11-01' AND '" . date("Y") . "-11-30',1,0)) AS l11, 
			Sum(IF(g.start_date BETWEEN '" . date("Y") . "-12-01' AND '" . date("Y") . "-12-31',1,0)) AS l12
			FROM a_organization a INNER JOIN a_organization aa ON a.id = aa.parent_id
			INNER JOIN a_organization up ON a.parent_id = up.id 
			INNER JOIN a_organization aaa ON aa.id = aaa.parent_id 
			LEFT JOIN g_person_career g ON aaa.id = g.department_id
			WHERE g.status_id IN (1,2)

			UNION ALL 
		
			SELECT 'Employee Out' as state,
			SUM(IF(s.start_date BETWEEN '" . date("Y") . "-01-01' AND '" . date("Y") . "-01-31',1,0)) AS l01, 
			SUM(IF(s.start_date BETWEEN '" . date("Y") . "-02-01' AND '" . date("Y") . "-02-28',1,0)) AS l02, 
			SUM(IF(s.start_date BETWEEN '" . date("Y") . "-03-01' AND '" . date("Y") . "-03-31',1,0)) AS l03, 
			SUM(IF(s.start_date BETWEEN '" . date("Y") . "-04-01' AND '" . date("Y") . "-04-30',1,0)) AS l04, 
			SUM(IF(s.start_date BETWEEN '" . date("Y") . "-05-01' AND '" . date("Y") . "-05-31',1,0)) AS l05, 
			SUM(IF(s.start_date BETWEEN '" . date("Y") . "-06-01' AND '" . date("Y") . "-06-30',1,0)) AS l06, 
			SUM(IF(s.start_date BETWEEN '" . date("Y") . "-07-01' AND '" . date("Y") . "-07-31',1,0)) AS l07, 
			SUM(IF(s.start_date BETWEEN '" . date("Y") . "-08-01' AND '" . date("Y") . "-08-31',1,0)) AS l08, 
			SUM(IF(s.start_date BETWEEN '" . date("Y") . "-09-01' AND '" . date("Y") . "-09-30',1,0)) AS l09, 
			SUM(IF(s.start_date BETWEEN '" . date("Y") . "-10-01' AND '" . date("Y") . "-10-31',1,0)) AS l10, 
			SUM(IF(s.start_date BETWEEN '" . date("Y") . "-11-01' AND '" . date("Y") . "-11-30',1,0)) AS l11, 
			SUM(IF(s.start_date BETWEEN '" . date("Y") . "-12-01' AND '" . date("Y") . "-12-31',1,0)) AS l12

			FROM g_person_status s 
			WHERE s.status_id IN (" . implode(",", Yii::app()->getModule('m1')->PARAM_RESIGN_ARRAY) . ") 

			";

            $command = $connection->cache(3600, $dependency)->createCommand($sql);
            $rows = $command->queryAll();
            foreach ($rows as $row) {
                $_data = [];
                $_second = [];
                $_data[] = (int)$row['l01'];
                $_data[] = (int)$row['l02'];
                $_data[] = (int)$row['l03'];
                $_data[] = (int)$row['l04'];
                $_data[] = (int)$row['l05'];
                $_data[] = (int)$row['l06'];
                $_data[] = (int)$row['l07'];
                $_data[] = (int)$row['l08'];
                $_data[] = (int)$row['l09'];
                $_data[] = (int)$row['l10'];
                $_data[] = (int)$row['l11'];
                $_data[] = (int)$row['l12'];
                $_name['name'] = $row['state'];
                $_second['data'] = $_data;
                $_merge[] = array_merge($_name, $_second);
            }

            Yii::app()->cache->set('employeeinall' . Yii::app()->user->id, $_merge, 3600, $dependency);
        } else
            $_merge = Yii::app()->cache->get('employeeinall' . Yii::app()->user->id);

        return $_merge;
    }

    public static function compEmployeePmdAll()
    {

        $_data = [];
        $dependency = new CDbCacheDependency('SELECT MAX(updated_date) FROM g_person_career');

        if (!Yii::app()->cache->get('employeepmdall' . Yii::app()->user->id)) {
            $connection = Yii::app()->db;
            $sql = "
            	SELECT 'Promotion' AS 'state',
				(SELECT COUNT(`c`.`status_id`) FROM `g_person_career` `c`
					WHERE `c`.`status_id` in (3, 5)
						AND `c`.`start_date` BETWEEN '" . date("Y") . "-01-01' AND '" . date("Y") . "-01-31') as 'l01', 
				(SELECT COUNT(`c`.`status_id`) FROM `g_person_career` `c`
					WHERE `c`.`status_id` in (3, 5)
						AND `c`.`start_date` BETWEEN '" . date("Y") . "-02-01' AND '" . date("Y") . "-02-28') as 'l02', 
				(SELECT COUNT(`c`.`status_id`) FROM `g_person_career` `c`
					WHERE `c`.`status_id` in (3, 5)
						AND `c`.`start_date` BETWEEN '" . date("Y") . "-03-01' AND '" . date("Y") . "-03-31') as 'l03', 
				(SELECT COUNT(`c`.`status_id`) FROM `g_person_career` `c`
					WHERE `c`.`status_id` in (3, 5)
						AND `c`.`start_date` BETWEEN '" . date("Y") . "-04-01' AND '" . date("Y") . "-04-30') as 'l04', 
				(SELECT COUNT(`c`.`status_id`) FROM `g_person_career` `c`
					WHERE `c`.`status_id` in (3, 5)
						AND `c`.`start_date` BETWEEN '" . date("Y") . "-05-01' AND '" . date("Y") . "-05-31') as 'l05', 
				(SELECT COUNT(`c`.`status_id`) FROM `g_person_career` `c`
					WHERE `c`.`status_id` in (3, 5)
						AND `c`.`start_date` BETWEEN '" . date("Y") . "-06-01' AND '" . date("Y") . "-06-30') as 'l06', 
				(SELECT COUNT(`c`.`status_id`) FROM `g_person_career` `c`
					WHERE `c`.`status_id` in (3, 5)
						AND `c`.`start_date` BETWEEN '" . date("Y") . "-07-01' AND '" . date("Y") . "-07-31') as 'l07', 
				(SELECT COUNT(`c`.`status_id`) FROM `g_person_career` `c`
					WHERE `c`.`status_id` in (3, 5)
						AND `c`.`start_date` BETWEEN '" . date("Y") . "-08-01' AND '" . date("Y") . "-08-31') as 'l08',
				(SELECT COUNT(`c`.`status_id`) FROM `g_person_career` `c`
					WHERE `c`.`status_id` in (3, 5)
						AND `c`.`start_date` BETWEEN '" . date("Y") . "-09-01' AND '" . date("Y") . "-09-30') as 'l09',
				(SELECT COUNT(`c`.`status_id`) FROM `g_person_career` `c`
					WHERE `c`.`status_id` in (3, 5)
						AND `c`.`start_date` BETWEEN '" . date("Y") . "-10-01' AND '" . date("Y") . "-10-31') as 'l10',
				(SELECT COUNT(`c`.`status_id`) FROM `g_person_career` `c`
					WHERE `c`.`status_id` in (3, 5)
						AND `c`.`start_date` BETWEEN '" . date("Y") . "-11-01' AND '" . date("Y") . "-11-30') as 'l11',
				(SELECT COUNT(`c`.`status_id`) FROM `g_person_career` `c`
					WHERE `c`.`status_id` in (3, 5)
						AND `c`.`start_date` BETWEEN '" . date("Y") . "-12-01' AND '" . date("Y") . "-12-31') as 'l12'
					
				FROM `a_organization` `g` where `g`.`id` = 1
				
				UNION ALL
				
            	SELECT 'Mutation' AS 'state',
				(SELECT COUNT(`c`.`status_id`) FROM `g_person_career` `c`
					WHERE `c`.`status_id` in (2)
						AND `c`.`start_date` BETWEEN '" . date("Y") . "-01-01' AND '" . date("Y") . "-01-31') as 'l01', 
				(SELECT COUNT(`c`.`status_id`) FROM `g_person_career` `c`
					WHERE `c`.`status_id` in (2)
						AND `c`.`start_date` BETWEEN '" . date("Y") . "-02-01' AND '" . date("Y") . "-02-28') as 'l02', 
				(SELECT COUNT(`c`.`status_id`) FROM `g_person_career` `c`
					WHERE `c`.`status_id` in (2)
						AND `c`.`start_date` BETWEEN '" . date("Y") . "-03-01' AND '" . date("Y") . "-03-31') as 'l03', 
				(SELECT COUNT(`c`.`status_id`) FROM `g_person_career` `c`
					WHERE `c`.`status_id` in (2)
						AND `c`.`start_date` BETWEEN '" . date("Y") . "-04-01' AND '" . date("Y") . "-04-30') as 'l04', 
				(SELECT COUNT(`c`.`status_id`) FROM `g_person_career` `c`
					WHERE `c`.`status_id` in (2)
						AND `c`.`start_date` BETWEEN '" . date("Y") . "-05-01' AND '" . date("Y") . "-05-31') as 'l05', 
				(SELECT COUNT(`c`.`status_id`) FROM `g_person_career` `c`
					WHERE `c`.`status_id` in (2)
						AND `c`.`start_date` BETWEEN '" . date("Y") . "-06-01' AND '" . date("Y") . "-06-30') as 'l06', 
				(SELECT COUNT(`c`.`status_id`) FROM `g_person_career` `c`
					WHERE `c`.`status_id` in (2)
						AND `c`.`start_date` BETWEEN '" . date("Y") . "-07-01' AND '" . date("Y") . "-07-31') as 'l07', 
				(SELECT COUNT(`c`.`status_id`) FROM `g_person_career` `c`
					WHERE `c`.`status_id` in (2)
						AND `c`.`start_date` BETWEEN '" . date("Y") . "-08-01' AND '" . date("Y") . "-08-31') as 'l08',
				(SELECT COUNT(`c`.`status_id`) FROM `g_person_career` `c`
					WHERE `c`.`status_id` in (2)
						AND `c`.`start_date` BETWEEN '" . date("Y") . "-09-01' AND '" . date("Y") . "-09-30') as 'l09',
				(SELECT COUNT(`c`.`status_id`) FROM `g_person_career` `c`
					WHERE `c`.`status_id` in (2)
						AND `c`.`start_date` BETWEEN '" . date("Y") . "-10-01' AND '" . date("Y") . "-10-31') as 'l10',
				(SELECT COUNT(`c`.`status_id`) FROM `g_person_career` `c`
					WHERE `c`.`status_id` in (2)
						AND `c`.`start_date` BETWEEN '" . date("Y") . "-11-01' AND '" . date("Y") . "-11-30') as 'l11',
				(SELECT COUNT(`c`.`status_id`) FROM `g_person_career` `c`
					WHERE `c`.`status_id` in (2)
						AND `c`.`start_date` BETWEEN '" . date("Y") . "-12-01' AND '" . date("Y") . "-12-31') as 'l12'
					
				FROM `a_organization` `g` where `g`.`id` = 1
				
			";

            $command = $connection->cache(3600, $dependency)->createCommand($sql);
            $rows = $command->queryAll();
            foreach ($rows as $row) {
                $_data = [];
                $_second = [];
                $_data[] = (int)$row['l01'];
                $_data[] = (int)$row['l02'];
                $_data[] = (int)$row['l03'];
                $_data[] = (int)$row['l04'];
                $_data[] = (int)$row['l05'];
                $_data[] = (int)$row['l06'];
                $_data[] = (int)$row['l07'];
                $_data[] = (int)$row['l08'];
                $_data[] = (int)$row['l09'];
                $_data[] = (int)$row['l10'];
                $_data[] = (int)$row['l11'];
                $_data[] = (int)$row['l12'];
                $_name['name'] = $row['state'];
                $_second['data'] = $_data;
                $_merge[] = array_merge($_name, $_second);
            }

            Yii::app()->cache->set('employeepmdall' . Yii::app()->user->id, $_merge, 3600, $dependency);
        } else
            $_merge = Yii::app()->cache->get('employeepmdall' . Yii::app()->user->id);

        return $_merge;
    }

    public static function compApplicantPerMonth()
    {

        $_data = [];
        $dependency = new CDbCacheDependency('SELECT MAX(created_date) FROM h_applicant');

        if (!Yii::app()->cache->get('applicantpermonth' . Yii::app()->user->id)) {
            $connection = Yii::app()->db;
            $sql = "
				select `o`.`id`, 'Total' as `state`,
				(select count(`a`.`id`) from `h_applicant` `a` where FROM_UNIXTIME(created_date) 
					<= '" . date("Y") . "-01-31') as `201301`,
				(select count(`a`.`id`) from `h_applicant` `a` where FROM_UNIXTIME(created_date) 
					<= '" . date("Y") . "-02-28') as `201302`,
				(select count(`a`.`id`) from `h_applicant` `a` where FROM_UNIXTIME(created_date) 
					<= '" . date("Y") . "-03-31') as `201303`,
				(select count(`a`.`id`) from `h_applicant` `a` where FROM_UNIXTIME(created_date) 
					<= '" . date("Y") . "-04-30') as `201304`,
				(select count(`a`.`id`) from `h_applicant` `a` where FROM_UNIXTIME(created_date) 
					<= '" . date("Y") . "-05-31') as `201305`,
				(select count(`a`.`id`) from `h_applicant` `a` where FROM_UNIXTIME(created_date) 
					<= '" . date("Y") . "-06-30') as `201306`,
				(select count(`a`.`id`) from `h_applicant` `a` where FROM_UNIXTIME(created_date) 
					<= '" . date("Y") . "-07-30') as `201307`,
				(select count(`a`.`id`) from `h_applicant` `a` where FROM_UNIXTIME(created_date) 
					<= '" . date("Y") . "-08-31') as `201308`,
				(select count(`a`.`id`) from `h_applicant` `a` where FROM_UNIXTIME(created_date) 
					<= '" . date("Y") . "-09-30') as `201309`,
				(select count(`a`.`id`) from `h_applicant` `a` where FROM_UNIXTIME(created_date) 
					<= '" . date("Y") . "-10-31') as `201310`,
				(select count(`a`.`id`) from `h_applicant` `a` where FROM_UNIXTIME(created_date) 
					<= '" . date("Y") . "-11-30') as `201311`,
				(select count(`a`.`id`) from `h_applicant` `a` where FROM_UNIXTIME(created_date) 
					<= '" . date("Y") . "-12-31') as `201312`



				FROM `a_organization` `o`
				where `id` = 1  


			";

            $command = $connection->cache(3600, $dependency)->createCommand($sql);
            $rows = $command->queryAll();
            foreach ($rows as $row) {
                $_data = [];
                $_second = [];
                $_data[] = (int)$row['201301'];
                $_data[] = (int)$row['201302'];
                $_data[] = (int)$row['201303'];
                $_data[] = (int)$row['201304'];
                $_data[] = (int)$row['201305'];
                $_data[] = (int)$row['201306'];
                $_data[] = (int)$row['201307'];
                $_data[] = (int)$row['201308'];
                $_data[] = (int)$row['201309'];
                $_data[] = (int)$row['201310'];
                $_data[] = (int)$row['201311'];
                $_data[] = (int)$row['201312'];
                $_name['name'] = $row['state'];
                $_second['data'] = $_data;
                $_merge[] = array_merge($_name, $_second);
            }

            Yii::app()->cache->set('applicantpermonth' . Yii::app()->user->id, $_merge, 3600, $dependency);
        } else
            $_merge = Yii::app()->cache->get('applicantpermonth' . Yii::app()->user->id);

        return $_merge;
    }

    public static function compVacancyPerMonth()
    {

        $_data = [];
        $dependency = new CDbCacheDependency('SELECT MAX(updated_date) FROM h_vacancy');

        if (!Yii::app()->cache->get('vacancypermonth' . Yii::app()->user->id)) {
            $connection = Yii::app()->db;
            $sql = "
				select `o`.`id`, 'Opening Jobs' as `state`,
				(select count(`a`.`id`) from `h_vacancy` `a` where date_format(FROM_UNIXTIME(created_date),'%Y%m') 
					= '" . date("Y") . "01') as `201301`,
				(select count(`a`.`id`) from `h_vacancy` `a` where date_format(FROM_UNIXTIME(created_date),'%Y%m') 
					= '" . date("Y") . "02') as `201302`,
				(select count(`a`.`id`) from `h_vacancy` `a` where date_format(FROM_UNIXTIME(created_date),'%Y%m')
					= '" . date("Y") . "03') as `201303`,
				(select count(`a`.`id`) from `h_vacancy` `a` where date_format(FROM_UNIXTIME(created_date),'%Y%m') 
					= '" . date("Y") . "04') as `201304`,
				(select count(`a`.`id`) from `h_vacancy` `a` where date_format(FROM_UNIXTIME(created_date),'%Y%m')
					= '" . date("Y") . "05') as `201305`,
				(select count(`a`.`id`) from `h_vacancy` `a` where date_format(FROM_UNIXTIME(created_date),'%Y%m') 
					= '" . date("Y") . "06') as `201306`,
				(select count(`a`.`id`) from `h_vacancy` `a` where date_format(FROM_UNIXTIME(created_date),'%Y%m') 
					= '" . date("Y") . "07') as `201307`,
				(select count(`a`.`id`) from `h_vacancy` `a` where date_format(FROM_UNIXTIME(created_date),'%Y%m') 
					= '" . date("Y") . "08') as `201308`,
				(select count(`a`.`id`) from `h_vacancy` `a` where date_format(FROM_UNIXTIME(created_date),'%Y%m') 
					= '" . date("Y") . "09') as `201309`,
				(select count(`a`.`id`) from `h_vacancy` `a` where date_format(FROM_UNIXTIME(created_date),'%Y%m') 
					= '" . date("Y") . "10') as `201310`,
				(select count(`a`.`id`) from `h_vacancy` `a` where date_format(FROM_UNIXTIME(created_date),'%Y%m') 
					= '" . date("Y") . "11') as `201311`,
				(select count(`a`.`id`) from `h_vacancy` `a` where date_format(FROM_UNIXTIME(created_date),'%Y%m') 
					= '" . date("Y") . "12') as `201312`

				FROM `a_organization` `o`
				where `id` = 1  

				UNION ALL 
				select `o`.`id`, 'Assessment' as `state`,
				(select count(`a`.`id`) from `j_selection_part` `a` 
				inner join `j_selection` `j` ON `j`.`id` = `a`.`parent_id`
				where date_format(`j`.`schedule_date`,'%Y%m') 
					= '" . date("Y") . "01') as `201301`,
				(select count(`a`.`id`) from `j_selection_part` `a` 
				inner join `j_selection` `j` ON `j`.`id` = `a`.`parent_id`
				where date_format(`j`.`schedule_date`,'%Y%m') 
					= '" . date("Y") . "02') as `201302`,
				(select count(`a`.`id`) from `j_selection_part` `a` 
				inner join `j_selection` `j` ON `j`.`id` = `a`.`parent_id`
				where date_format(`j`.`schedule_date`,'%Y%m') 
					= '" . date("Y") . "03') as `201303`,
				(select count(`a`.`id`) from `j_selection_part` `a` 
				inner join `j_selection` `j` ON `j`.`id` = `a`.`parent_id`
				where date_format(`j`.`schedule_date`,'%Y%m') 
					= '" . date("Y") . "04') as `201304`,
				(select count(`a`.`id`) from `j_selection_part` `a` 
				inner join `j_selection` `j` ON `j`.`id` = `a`.`parent_id`
				where date_format(`j`.`schedule_date`,'%Y%m') 
					= '" . date("Y") . "05') as `201305`,
				(select count(`a`.`id`) from `j_selection_part` `a` 
				inner join `j_selection` `j` ON `j`.`id` = `a`.`parent_id`
				where date_format(`j`.`schedule_date`,'%Y%m') 
					= '" . date("Y") . "06') as `201306`,
				(select count(`a`.`id`) from `j_selection_part` `a` 
				inner join `j_selection` `j` ON `j`.`id` = `a`.`parent_id`
				where date_format(`j`.`schedule_date`,'%Y%m') 
					= '" . date("Y") . "07') as `201307`,
				(select count(`a`.`id`) from `j_selection_part` `a` 
				inner join `j_selection` `j` ON `j`.`id` = `a`.`parent_id`
				where date_format(`j`.`schedule_date`,'%Y%m') 
					= '" . date("Y") . "08') as `201308`,
				(select count(`a`.`id`) from `j_selection_part` `a` 
				inner join `j_selection` `j` ON `j`.`id` = `a`.`parent_id`
				where date_format(`j`.`schedule_date`,'%Y%m') 
					= '" . date("Y") . "09') as `201309`,
				(select count(`a`.`id`) from `j_selection_part` `a` 
				inner join `j_selection` `j` ON `j`.`id` = `a`.`parent_id`
				where date_format(`j`.`schedule_date`,'%Y%m') 
					= '" . date("Y") . "10') as `201310`,
				(select count(`a`.`id`) from `j_selection_part` `a` 
				inner join `j_selection` `j` ON `j`.`id` = `a`.`parent_id`
				where date_format(`j`.`schedule_date`,'%Y%m') 
					= '" . date("Y") . "12') as `201311`,
				(select count(`a`.`id`) from `j_selection_part` `a` 
				inner join `j_selection` `j` ON `j`.`id` = `a`.`parent_id`
				where date_format(`j`.`schedule_date`,'%Y%m') 
					= '" . date("Y") . "12') as `201312`


				FROM `a_organization` `o`
				where `id` = 1  

			";


            $command = $connection->cache(3600, $dependency)->createCommand($sql);
            $rows = $command->queryAll();
            foreach ($rows as $row) {
                $_data = [];
                $_second = [];
                $_data[] = (int)$row['201301'];
                $_data[] = (int)$row['201302'];
                $_data[] = (int)$row['201303'];
                $_data[] = (int)$row['201304'];
                $_data[] = (int)$row['201305'];
                $_data[] = (int)$row['201306'];
                $_data[] = (int)$row['201307'];
                $_data[] = (int)$row['201308'];
                $_data[] = (int)$row['201309'];
                $_data[] = (int)$row['201310'];
                $_data[] = (int)$row['201311'];
                $_data[] = (int)$row['201312'];
                $_name['name'] = $row['state'];
                $_second['data'] = $_data;
                $_merge[] = array_merge($_name, $_second);
            }

            Yii::app()->cache->set('vacancypermonth' . Yii::app()->user->id, $_merge, 3600, $dependency);
        } else
            $_merge = Yii::app()->cache->get('vacancypermonth' . Yii::app()->user->id);

        return $_merge;
    }

    public static function compLearningHoursPerMonth()
    {

        $_data = [];
        $dependency = new CDbCacheDependency('SELECT MAX(created_date) FROM i_learning_sch');

        if (!Yii::app()->cache->get('complearninghourspermonth' . Yii::app()->user->id)) {
            $connection = Yii::app()->db;
            $sql = "
					select `o`.`id`, 'Mandays' as `state`,
					(select sum(`a`.`actual_mandays`) from `i_learning_sch` `a` where date_format(schedule_date,'%Y%m') 
						<= '" . date("Y") . "01' AND date_format(schedule_date,'%Y') = '" . date("Y") . "') as `201301`,
					(select sum(`a`.`actual_mandays`) from `i_learning_sch` `a` where date_format(schedule_date,'%Y%m') 
						<= '" . date("Y") . "02' AND date_format(schedule_date,'%Y') = '" . date("Y") . "') as `201302`,
					(select sum(`a`.`actual_mandays`) from `i_learning_sch` `a` where date_format(schedule_date,'%Y%m') 
						<= '" . date("Y") . "03' AND date_format(schedule_date,'%Y') = '" . date("Y") . "') as `201303`,
					(select sum(`a`.`actual_mandays`) from `i_learning_sch` `a` where date_format(schedule_date,'%Y%m') 
						<= '" . date("Y") . "04' AND date_format(schedule_date,'%Y') = '" . date("Y") . "') as `201304`,
					(select sum(`a`.`actual_mandays`) from `i_learning_sch` `a` where date_format(schedule_date,'%Y%m') 
						<= '" . date("Y") . "05' AND date_format(schedule_date,'%Y') = '" . date("Y") . "') as `201305`,
					(select sum(`a`.`actual_mandays`) from `i_learning_sch` `a` where date_format(schedule_date,'%Y%m') 
						<= '" . date("Y") . "06' AND date_format(schedule_date,'%Y') = '" . date("Y") . "') as `201306`,
					(select sum(`a`.`actual_mandays`) from `i_learning_sch` `a` where date_format(schedule_date,'%Y%m') 
						<= '" . date("Y") . "07' AND date_format(schedule_date,'%Y') = '" . date("Y") . "') as `201307`,
					(select sum(`a`.`actual_mandays`) from `i_learning_sch` `a` where date_format(schedule_date,'%Y%m') 
						<= '" . date("Y") . "08' AND date_format(schedule_date,'%Y') = '" . date("Y") . "') as `201308`,
					(select sum(`a`.`actual_mandays`) from `i_learning_sch` `a` where date_format(schedule_date,'%Y%m') 
						<= '" . date("Y") . "09' AND date_format(schedule_date,'%Y') = '" . date("Y") . "') as `201309`,
					(select sum(`a`.`actual_mandays`) from `i_learning_sch` `a` where date_format(schedule_date,'%Y%m') 
						<= '" . date("Y") . "10' AND date_format(schedule_date,'%Y') = '" . date("Y") . "') as `201310`,
					(select sum(`a`.`actual_mandays`) from `i_learning_sch` `a` where date_format(schedule_date,'%Y%m') 
						<= '" . date("Y") . "11' AND date_format(schedule_date,'%Y') = '" . date("Y") . "') as `201311`,
					(select sum(`a`.`actual_mandays`) from `i_learning_sch` `a` where date_format(schedule_date,'%Y%m') 
						<= '" . date("Y") . "12' AND date_format(schedule_date,'%Y') = '" . date("Y") . "') as `201312`

					FROM `a_organization` `o`
					where `id` = 1  


				";

            $command = $connection->cache(3600, $dependency)->createCommand($sql);
            $rows = $command->queryAll();
            foreach ($rows as $row) {
                $_data = [];
                $_second = [];
                $_data[] = (int)$row['201301'];
                $_data[] = (int)$row['201302'];
                $_data[] = (int)$row['201303'];
                $_data[] = (int)$row['201304'];
                $_data[] = (int)$row['201305'];
                $_data[] = (int)$row['201306'];
                $_data[] = (int)$row['201307'];
                $_data[] = (int)$row['201308'];
                $_data[] = (int)$row['201309'];
                $_data[] = (int)$row['201310'];
                $_data[] = (int)$row['201311'];
                $_data[] = (int)$row['201312'];
                $_name['name'] = $row['state'];
                $_second['data'] = $_data;
                $_merge[] = array_merge($_name, $_second);
            }

            Yii::app()->cache->set('complearninghourspermonth' . Yii::app()->user->id, $_merge, 3600, $dependency);
        } else
            $_merge = Yii::app()->cache->get('complearninghourspermonth' . Yii::app()->user->id);

        return $_merge;
    }

    public static function compLearningClassPerMonth()
    {

        $_data = [];
        $dependency = new CDbCacheDependency('SELECT MAX(created_date) FROM i_learning_sch_part');

        if (!Yii::app()->cache->get('learningclasspermonth' . Yii::app()->user->id)) {
            $connection = Yii::app()->db;
            $sql = "
				select `o`.`id`, 'Class' as `state`,
				(select count(`a`.`id`) from `i_learning_sch` `a` where date_format(schedule_date,'%Y%m') 
					= '" . date("Y") . "01') as `201301`,
				(select count(`a`.`id`) from `i_learning_sch` `a` where date_format(schedule_date,'%Y%m') 
					= '" . date("Y") . "02') as `201302`,
				(select count(`a`.`id`) from `i_learning_sch` `a` where date_format(schedule_date,'%Y%m') 
					= '" . date("Y") . "03') as `201303`,
				(select count(`a`.`id`) from `i_learning_sch` `a` where date_format(schedule_date,'%Y%m') 
					= '" . date("Y") . "04') as `201304`,
				(select count(`a`.`id`) from `i_learning_sch` `a` where date_format(schedule_date,'%Y%m') 
					= '" . date("Y") . "05') as `201305`,
				(select count(`a`.`id`) from `i_learning_sch` `a` where date_format(schedule_date,'%Y%m') 
					= '" . date("Y") . "06') as `201306`,
				(select count(`a`.`id`) from `i_learning_sch` `a` where date_format(schedule_date,'%Y%m') 
					= '" . date("Y") . "07') as `201307`,
				(select count(`a`.`id`) from `i_learning_sch` `a` where date_format(schedule_date,'%Y%m') 
					= '" . date("Y") . "08') as `201308`,
				(select count(`a`.`id`) from `i_learning_sch` `a` where date_format(schedule_date,'%Y%m') 
					= '" . date("Y") . "09') as `201309`,
				(select count(`a`.`id`) from `i_learning_sch` `a` where date_format(schedule_date,'%Y%m') 
					= '" . date("Y") . "10') as `201310`,
				(select count(`a`.`id`) from `i_learning_sch` `a` where date_format(schedule_date,'%Y%m') 
					= '" . date("Y") . "11') as `201311`,
				(select count(`a`.`id`) from `i_learning_sch` `a` where date_format(schedule_date,'%Y%m') 
					= '" . date("Y") . "12') as `201312`

				FROM `a_organization` `o`
				where `id` = 1  
		
				UNION ALL
				
				select `o`.`id`, 'Participant' as `state`,
				(select count(`a`.`id`) + 
				COALESCE((select sum(`s`.`total_participant`) from `i_learning_sch` `s` where date_format(`s`.`schedule_date`,'%Y%m') 
					= '" . date("Y") . "01'),0) from `i_learning_sch_part` `a` 
				inner join `i_learning_sch` `s` ON `s`.`id` = `a`.`parent_id`
				where date_format(`s`.`schedule_date`,'%Y%m') 
					= '" . date("Y") . "01') as `201301`,
				(select count(`a`.`id`)  + 
				COALESCE((select sum(`s`.`total_participant`) from `i_learning_sch` `s` where date_format(`s`.`schedule_date`,'%Y%m') 
					= '" . date("Y") . "02'),0) from `i_learning_sch_part` `a` 
				inner join `i_learning_sch` `s` ON `s`.`id` = `a`.`parent_id`
				where date_format(`s`.`schedule_date`,'%Y%m') 
					= '" . date("Y") . "02') as `201302`,
				(select count(`a`.`id`)  + 
				COALESCE((select sum(`s`.`total_participant`) from `i_learning_sch` `s` where date_format(`s`.`schedule_date`,'%Y%m') 
					= '" . date("Y") . "03'),0) from `i_learning_sch_part` `a` 
				inner join `i_learning_sch` `s` ON `s`.`id` = `a`.`parent_id`
				where date_format(`s`.`schedule_date`,'%Y%m') 
					= '" . date("Y") . "03') as `201303`,
				(select count(`a`.`id`)  + 
				COALESCE((select sum(`s`.`total_participant`) from `i_learning_sch` `s` where date_format(`s`.`schedule_date`,'%Y%m') 
					= '" . date("Y") . "04'),0) from `i_learning_sch_part` `a` 
				inner join `i_learning_sch` `s` ON `s`.`id` = `a`.`parent_id`
				where date_format(`s`.`schedule_date`,'%Y%m') 
					= '" . date("Y") . "04') as `201304`,
				(select count(`a`.`id`)  + 
				COALESCE((select sum(`s`.`total_participant`) from `i_learning_sch` `s` where date_format(`s`.`schedule_date`,'%Y%m') 
					= '" . date("Y") . "05'),0) from `i_learning_sch_part` `a` 
				inner join `i_learning_sch` `s` ON `s`.`id` = `a`.`parent_id`
				where date_format(`s`.`schedule_date`,'%Y%m') 
					= '" . date("Y") . "05') as `201305`,
				(select count(`a`.`id`)  + 
				COALESCE((select sum(`s`.`total_participant`) from `i_learning_sch` `s` where date_format(`s`.`schedule_date`,'%Y%m') 
					= '" . date("Y") . "06'),0) from `i_learning_sch_part` `a` 
				inner join `i_learning_sch` `s` ON `s`.`id` = `a`.`parent_id`
				where date_format(`s`.`schedule_date`,'%Y%m') 
					= '" . date("Y") . "06') as `201306`,
				(select count(`a`.`id`)  + 
				COALESCE((select sum(`s`.`total_participant`) from `i_learning_sch` `s` where date_format(`s`.`schedule_date`,'%Y%m') 
					= '" . date("Y") . "07'),0) from `i_learning_sch_part` `a` 
				inner join `i_learning_sch` `s` ON `s`.`id` = `a`.`parent_id`
				where date_format(`s`.`schedule_date`,'%Y%m') 
					= '" . date("Y") . "07') as `201307`,
				(select count(`a`.`id`)  + 
				COALESCE((select sum(`s`.`total_participant`) from `i_learning_sch` `s` where date_format(`s`.`schedule_date`,'%Y%m') 
					= '" . date("Y") . "08'),0) from `i_learning_sch_part` `a` 
				inner join `i_learning_sch` `s` ON `s`.`id` = `a`.`parent_id`
				where date_format(`s`.`schedule_date`,'%Y%m') 
					= '" . date("Y") . "08') as `201308`,
				(select count(`a`.`id`)  + 
				COALESCE((select sum(`s`.`total_participant`) from `i_learning_sch` `s` where date_format(`s`.`schedule_date`,'%Y%m') 
					= '" . date("Y") . "09'),0) from `i_learning_sch_part` `a` 
				inner join `i_learning_sch` `s` ON `s`.`id` = `a`.`parent_id`
				where date_format(`s`.`schedule_date`,'%Y%m') 
					= '" . date("Y") . "09') as `201309`,
				(select count(`a`.`id`)  + 
				COALESCE((select sum(`s`.`total_participant`) from `i_learning_sch` `s` where date_format(`s`.`schedule_date`,'%Y%m') 
					= '" . date("Y") . "10'),0) from `i_learning_sch_part` `a` 
				inner join `i_learning_sch` `s` ON `s`.`id` = `a`.`parent_id`
				where date_format(`s`.`schedule_date`,'%Y%m') 
					= '" . date("Y") . "10') as `201310`,
				(select count(`a`.`id`)  + 
				COALESCE((select sum(`s`.`total_participant`) from `i_learning_sch` `s` where date_format(`s`.`schedule_date`,'%Y%m') 
					= '" . date("Y") . "11'),0) from `i_learning_sch_part` `a` 
				inner join `i_learning_sch` `s` ON `s`.`id` = `a`.`parent_id`
				where date_format(`s`.`schedule_date`,'%Y%m') 
					= '" . date("Y") . "11') as `201311`,
				(select count(`a`.`id`)  + 
				COALESCE((select sum(`s`.`total_participant`) from `i_learning_sch` `s` where date_format(`s`.`schedule_date`,'%Y%m') 
					= '" . date("Y") . "12'),0) from `i_learning_sch_part` `a` 
				inner join `i_learning_sch` `s` ON `s`.`id` = `a`.`parent_id`
				where date_format(`s`.`schedule_date`,'%Y%m') 
					= '" . date("Y") . "12') as `201312`

				FROM `a_organization` `o`
				where `id` = 1  
				


			";

            $command = $connection->cache(3600, $dependency)->createCommand($sql);
            $rows = $command->queryAll();
            foreach ($rows as $row) {
                $_data = [];
                $_second = [];
                $_data[] = (int)$row['201301'];
                $_data[] = (int)$row['201302'];
                $_data[] = (int)$row['201303'];
                $_data[] = (int)$row['201304'];
                $_data[] = (int)$row['201305'];
                $_data[] = (int)$row['201306'];
                $_data[] = (int)$row['201307'];
                $_data[] = (int)$row['201308'];
                $_data[] = (int)$row['201309'];
                $_data[] = (int)$row['201310'];
                $_data[] = (int)$row['201311'];
                $_data[] = (int)$row['201312'];
                $_name['name'] = $row['state'];
                $_second['data'] = $_data;
                $_merge[] = array_merge($_name, $_second);
            }

            Yii::app()->cache->set('learningclasspermonth' . Yii::app()->user->id, $_merge, 3600, $dependency);
        } else
            $_merge = Yii::app()->cache->get('learningclasspermonth' . Yii::app()->user->id);

        return $_merge;
    }

    public static function compEmployeePerMonthAllAge()
    {

        $_data = [];
        $dependency = new CDbCacheDependency('SELECT MAX(updated_date) FROM g_person');

        if (!Yii::app()->cache->get('employeepermonthallage' . Yii::app()->user->id)) {
            $_age = "DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT((select d.birth_date from g_person d where d.id = a.id), '%Y') - (DATE_FORMAT(NOW(), '00-%m-%d') < DATE_FORMAT((select d.birth_date from g_person d where d.id = a.id), '00-%m-%d'))";
            $connection = Yii::app()->db;
            $sql = "
				select `o`.`id`, '<=25' as `state`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " <=25 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-01-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-01-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201301`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " <=25 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-02-28' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-02-28' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201302`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " <=25 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-03-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-03-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201303`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " <=25 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-04-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-04-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201304`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " <=25 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-05-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-05-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201305`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " <=25 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-06-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-06-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201306`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " <=25 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-07-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-07-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201307`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " <=25 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-08-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-08-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201308`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " <=25 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-09-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-09-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201309`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " <=25 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-10-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-10-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201310`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " <=25 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-11-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-11-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201311`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " <=25 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-12-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-12-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201312`



				FROM `a_organization` `o`
				where `id` = 1  UNION 

				select `o`.`id`, '26 to 30' as `state`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 25 AND " . $_age . " <= 30 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-01-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-01-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201301`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 25 AND " . $_age . " <= 30 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-02-28' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-02-28' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201302`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 25 AND " . $_age . " <= 30 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-03-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-03-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201303`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 25 AND " . $_age . " <= 30 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-04-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-04-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201304`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 25 AND " . $_age . " <= 30 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-05-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-05-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201305`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 25 AND " . $_age . " <= 30 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-06-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-06-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201306`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 25 AND " . $_age . " <= 30 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-07-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-07-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201307`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 25 AND " . $_age . " <= 30 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-08-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-08-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201308`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 25 AND " . $_age . " <= 30 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-09-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-09-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201309`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 25 AND " . $_age . " <= 30 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-10-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-10-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201310`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 25 AND " . $_age . " <= 30 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-11-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-11-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201311`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 25 AND " . $_age . " <= 30 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-12-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-12-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201312`



				FROM `a_organization` `o`
				where `id` = 1  UNION

				select `o`.`id`, '31 to 35' as `state`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 30 AND " . $_age . " <= 35 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-01-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-01-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201301`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 30 AND " . $_age . " <= 35 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-02-28' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-02-28' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201302`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 30 AND " . $_age . " <= 35 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-03-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-03-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201303`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 30 AND " . $_age . " <= 35 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-04-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-04-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201304`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 30 AND " . $_age . " <= 35 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-05-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-05-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201305`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 30 AND " . $_age . " <= 35 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-06-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-06-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201306`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 30 AND " . $_age . " <= 35 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-07-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-07-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201307`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 30 AND " . $_age . " <= 35 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-08-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-08-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201308`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 30 AND " . $_age . " <= 35 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-09-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-09-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201309`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 30 AND " . $_age . " <= 35 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-10-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-10-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201310`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 30 AND " . $_age . " <= 35 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-11-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-11-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201311`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 30 AND " . $_age . " <= 35 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-12-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-12-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201312`



				FROM `a_organization` `o`
				where `id` = 1  UNION
								
				select `o`.`id`, '36 to 40' as `state`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 35 AND " . $_age . " <= 40 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-01-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-01-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201301`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 35 AND " . $_age . " <= 40 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-02-28' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-02-28' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201302`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 35 AND " . $_age . " <= 40 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-03-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-03-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201303`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 35 AND " . $_age . " <= 40 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-04-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-04-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201304`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 35 AND " . $_age . " <= 40 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-05-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-05-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201305`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 35 AND " . $_age . " <= 40 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-06-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-06-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201306`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 35 AND " . $_age . " <= 40 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-07-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-07-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201307`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 35 AND " . $_age . " <= 40 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-08-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-08-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201308`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 35 AND " . $_age . " <= 40 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-09-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-09-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201309`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 35 AND " . $_age . " <= 40 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-10-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-10-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201310`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 35 AND " . $_age . " <= 40 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-11-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-11-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201311`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 35 AND " . $_age . " <= 40 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-12-3' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-12-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201312`



				FROM `a_organization` `o`
				where `id` = 1 UNION
				
				select `o`.`id`, '41 to 45' as `state`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 40 AND " . $_age . " <= 45 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-01-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-01-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201301`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 40 AND " . $_age . " <= 45 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-02-28' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-02-28' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201302`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 40 AND " . $_age . " <= 45 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-03-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-03-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201303`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 40 AND " . $_age . " <= 45 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-04-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-04-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201304`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 40 AND " . $_age . " <= 45 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-05-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-05-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201305`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 40 AND " . $_age . " <= 45 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-06-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-06-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201306`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 40 AND " . $_age . " <= 45 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-07-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-07-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201307`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 40 AND " . $_age . " <= 45 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-08-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-08-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201308`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 40 AND " . $_age . " <= 45 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-09-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-09-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201309`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 40 AND " . $_age . " <= 45 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-10-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-10-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201310`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 40 AND " . $_age . " <= 45 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-11-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-11-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201311`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 40 AND " . $_age . " <= 45 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-12-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-12-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201312`



				FROM `a_organization` `o`
				where `id` = 1 	UNION			 				

				select `o`.`id`, '46 to 50' as `state`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 45 AND " . $_age . " <= 50 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-01-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-01-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201301`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 45 AND " . $_age . " <= 50 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-02-28' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-02-28' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201302`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 45 AND " . $_age . " <= 50 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-03-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-03-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201303`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 45 AND " . $_age . " <= 50 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-04-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-04-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201304`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 45 AND " . $_age . " <= 50 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-05-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-05-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201305`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 45 AND " . $_age . " <= 50 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-06-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-06-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201306`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 45 AND " . $_age . " <= 50 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-07-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-07-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201307`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 45 AND " . $_age . " <= 50 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-08-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-08-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201308`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 45 AND " . $_age . " <= 50 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-09-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-09-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201309`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 45 AND " . $_age . " <= 50 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-10-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-10-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201310`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 45 AND " . $_age . " <= 50 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-11-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-11-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201311`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 45 AND " . $_age . " <= 50 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-12-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-12-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201312`



				FROM `a_organization` `o`
				where `id` = 1 	UNION		

				select `o`.`id`, '51 to 55' as `state`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 50 AND " . $_age . " <= 55 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-01-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-01-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201301`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 50 AND " . $_age . " <= 55 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-02-28' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-02-28' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201302`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 50 AND " . $_age . " <= 55 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-03-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-03-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201303`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 50 AND " . $_age . " <= 55 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-04-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-04-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201304`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 50 AND " . $_age . " <= 55 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-05-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-05-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201305`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 50 AND " . $_age . " <= 55 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-06-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-06-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201306`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 50 AND " . $_age . " <= 55 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-07-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-07-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201307`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 50 AND " . $_age . " <= 55 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-08-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-08-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201308`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 50 AND " . $_age . " <= 55 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-09-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-09-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201309`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 50 AND " . $_age . " <= 55 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-10-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-10-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201310`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 50 AND " . $_age . " <= 55 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-11-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-11-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201311`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 50 AND " . $_age . " <= 55 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-12-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-12-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201312`



				FROM `a_organization` `o`
				where `id` = 1 	UNION		
				
				select `o`.`id`, '>55' as `state`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 55 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-01-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-01-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201301`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 55 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-02-28' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-02-28' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201302`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 55 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-03-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-03-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201303`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 55 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-04-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-04-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201304`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 55 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-05-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-05-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201305`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 55 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-06-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-06-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201306`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 55 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-07-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-07-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201307`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 55 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-08-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-08-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201308`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 55 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-09-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-09-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201309`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 55 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-10-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-10-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201310`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 55 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-11-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-11-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201311`,
				(select count(`a`.`id`) from `g_person` `a` where " . $_age . " > 55 AND
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-12-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-12-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201312`



				FROM `a_organization` `o`
				where `id` = 1 			
				

			";

            $command = $connection->cache(3600, $dependency)->createCommand($sql);
            $rows = $command->queryAll();
            foreach ($rows as $row) {
                $_data = [];
                $_second = [];
                $_data[] = (int)$row['201301'];
                $_data[] = (int)$row['201302'];
                $_data[] = (int)$row['201303'];
                $_data[] = (int)$row['201304'];
                $_data[] = (int)$row['201305'];
                $_data[] = (int)$row['201306'];
                $_data[] = (int)$row['201307'];
                $_data[] = (int)$row['201308'];
                $_data[] = (int)$row['201309'];
                $_data[] = (int)$row['201310'];
                $_data[] = (int)$row['201311'];
                $_data[] = (int)$row['201312'];
                $_name['name'] = $row['state'];
                $_second['data'] = $_data;
                $_merge[] = array_merge($_name, $_second);
            }

            Yii::app()->cache->set('employeepermonthallage' . Yii::app()->user->id, $_merge, 3600, $dependency);
        } else
            $_merge = Yii::app()->cache->get('employeepermonthallage' . Yii::app()->user->id);

        return $_merge;
    }

    public static function compEmployeePerMonthAllGender()
    {

        $_data = [];
        $dependency = new CDbCacheDependency('SELECT MAX(updated_date) FROM g_person');

        if (!Yii::app()->cache->get('employeepermonthallgender' . Yii::app()->user->id)) {
            $connection = Yii::app()->db;
            $sql = "
				select `o`.`id`, 'Male' as `state`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`sex_id` = 1 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-01-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-01-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201301`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`sex_id` = 1 AND 
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-02-28' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-02-28' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201302`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`sex_id` = 1 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-03-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-03-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201303`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`sex_id` = 1 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-04-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-04-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201304`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`sex_id` = 1 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-05-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-05-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201305`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`sex_id` = 1 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-06-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-06-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201306`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`sex_id` = 1 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-07-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-07-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201307`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`sex_id` = 1 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-08-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-08-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201308`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`sex_id` = 1 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-09-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-09-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201309`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`sex_id` = 1 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-10-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-10-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201310`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`sex_id` = 1 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-11-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-11-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201311`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`sex_id` = 1 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-12-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-12-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201312`



				FROM `a_organization` `o`
				where `id` = 1  UNION 

				select `o`.`id`, 'Female' as `state`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`sex_id` = 2 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-01-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-01-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201301`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`sex_id` = 2 AND 
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-02-28' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-02-28' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201302`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`sex_id` = 2 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-03-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-03-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201303`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`sex_id` = 2 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-04-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-04-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201304`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`sex_id` = 2 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-05-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-05-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201305`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`sex_id` = 2 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-06-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-06-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201306`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`sex_id` = 2 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-07-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-07-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201307`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`sex_id` = 2 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-08-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-08-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201308`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`sex_id` = 2 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-09-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-09-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201309`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`sex_id` = 2 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-10-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-10-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201310`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`sex_id` = 2 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-11-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-11-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201311`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`sex_id` = 2 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-12-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-12-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201312`



				FROM `a_organization` `o`
				where `id` = 1  				
				
			";

            $command = $connection->cache(3600, $dependency)->createCommand($sql);
            $rows = $command->queryAll();
            foreach ($rows as $row) {
                $_data = [];
                $_second = [];
                $_data[] = (int)$row['201301'];
                $_data[] = (int)$row['201302'];
                $_data[] = (int)$row['201303'];
                $_data[] = (int)$row['201304'];
                $_data[] = (int)$row['201305'];
                $_data[] = (int)$row['201306'];
                $_data[] = (int)$row['201307'];
                $_data[] = (int)$row['201308'];
                $_data[] = (int)$row['201309'];
                $_data[] = (int)$row['201310'];
                $_data[] = (int)$row['201311'];
                $_data[] = (int)$row['201312'];
                $_name['name'] = $row['state'];
                $_second['data'] = $_data;
                $_merge[] = array_merge($_name, $_second);
            }

            Yii::app()->cache->set('employeepermonthallgender' . Yii::app()->user->id, $_merge, 3600, $dependency);
        } else
            $_merge = Yii::app()->cache->get('employeepermonthallgender' . Yii::app()->user->id);

        return $_merge;
    }

    public static function compEmployeePerMonthAllReligion()
    {

        $_data = [];
        $dependency = new CDbCacheDependency('SELECT MAX(updated_date) FROM g_person');

        if (!Yii::app()->cache->get('employeepermonthallreligion' . Yii::app()->user->id)) {
            $connection = Yii::app()->db;
            $sql = "
				select `o`.`id`, 'Islam' as `state`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 1 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-01-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-01-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201301`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 1 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-02-28' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-02-28' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201302`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 1 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-03-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-03-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201303`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 1 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-04-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-04-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201304`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 1 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-05-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-05-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201305`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 1 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-06-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-06-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201306`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 1 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-07-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-07-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201307`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 1 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-08-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-08-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201308`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 1 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-09-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-09-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201309`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 1 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-10-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-10-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201310`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 1 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-11-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-11-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201311`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 1 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-12-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-12-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201312`



				FROM `a_organization` `o`
				where `id` = 1  UNION

				select `o`.`id`, 'Kr. Protestan' as `state`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 2 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-01-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-01-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201301`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 2 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-02-28' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-02-28' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201302`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 2 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-03-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-03-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201303`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 2 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-04-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-04-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201304`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 2 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-05-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-05-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201305`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 2 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-06-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-06-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201306`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 2 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-07-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-07-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201307`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 2 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-08-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-08-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201308`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 2 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-09-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-09-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201309`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 2 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-10-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-10-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201310`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 2 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-11-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-11-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201311`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 2 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-12-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-12-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201312`



				FROM `a_organization` `o`
				where `id` = 1  UNION
				
				select `o`.`id`, 'Katolik' as `state`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 3 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-01-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-01-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201301`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 3 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-02-28' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-02-28' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201302`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 3 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-03-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-03-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201303`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 3 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-04-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-04-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201304`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 3 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-05-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-05-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201305`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 3 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-06-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-06-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201306`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 3 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-07-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-07-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201307`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 3 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-08-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-08-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201308`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 3 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-09-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-09-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201309`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 3 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-10-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-10-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201310`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 3 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-11-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-11-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201311`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 3 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-12-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-12-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201312`



				FROM `a_organization` `o`
				where `id` = 1  UNION
				
				select `o`.`id`, 'Budha' as `state`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 4 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-01-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-01-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201301`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 4 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-02-28' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-02-28' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201302`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 4 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-03-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-03-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201303`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 4 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-04-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-04-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201304`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 4 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-05-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-05-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201305`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 4 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-06-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-06-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201306`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 4 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-07-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-07-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201307`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 4 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-08-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-08-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201308`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 4 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-09-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-09-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201309`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 4 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-10-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-10-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201310`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 4 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-11-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-11-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201311`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 4 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-12-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-12-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201312`



				FROM `a_organization` `o`
				where `id` = 1  UNION
				
				select `o`.`id`, 'Hindu' as `state`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 5 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-01-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-01-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201301`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 5 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-02-28' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-02-28' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201302`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 5 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-03-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-03-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201303`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 5 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-04-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-04-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201304`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 5 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-05-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-05-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201305`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 5 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-06-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-06-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201306`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 5 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-07-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-07-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201307`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 5 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-08-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-08-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201308`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 5 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-09-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-09-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201309`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 5 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-10-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-10-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201310`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 5 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-11-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-11-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201311`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 5 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-12-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-12-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201312`



				FROM `a_organization` `o`
				where `id` = 1  UNION
				
				select `o`.`id`, 'Kong Hu Cu' as `state`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 6 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-01-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-01-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201301`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 6 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-02-28' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-02-28' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201302`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 6 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-03-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-03-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201303`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 6 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-04-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-04-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201304`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 6 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-05-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-05-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201305`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 6 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-06-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-06-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201306`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 6 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-07-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-07-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201307`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 6 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-08-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-08-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201308`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 6 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-09-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-09-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201309`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 6 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-10-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-10-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201310`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 6 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-11-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-11-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201311`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 6 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-12-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-12-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201312`



				FROM `a_organization` `o`
				where `id` = 1  UNION
				
				select `o`.`id`, 'Total' as `state`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 1 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-01-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-01-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201301`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 1 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-02-28' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-02-28' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201302`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 1 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-03-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-03-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201303`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 1 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-04-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-04-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201304`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 1 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-05-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-05-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201305`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 1 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-06-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-06-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201306`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 1 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-07-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-07-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201307`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 1 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-08-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-08-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201308`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 1 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-09-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-09-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201309`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 1 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-10-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-10-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201310`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 1 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-11-30' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-11-30' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201311`,
				(select count(`a`.`id`) from `g_person` `a` where `a`.`religion_id` = 1 AND  
					(select `c`.`start_date` AS `start_date` from `g_person_career` `c`
						where `a`.`id` = `c`.`parent_id` and `c`.`status_id` = 1
						order by `c`.`start_date` desc limit 1) <= '" . date("Y") . "-12-31' AND
					(select `s`.`status_id` AS `status` from `g_person_status` `s`
						where `s`.`parent_id` = `a`.`id` AND `s`.`start_date` <= '" . date("Y") . "-12-31' 
						order by `s`.`start_date` desc limit 1) IN (1 , 2, 3, 4, 5, 6, 15) 
				) as `201312`



				FROM `a_organization` `o`
				where `id` = 1  																				

			";

            $command = $connection->cache(3600, $dependency)->createCommand($sql);
            $rows = $command->queryAll();
            foreach ($rows as $row) {
                $_data = [];
                $_second = [];
                $_data[] = (int)$row['201301'];
                $_data[] = (int)$row['201302'];
                $_data[] = (int)$row['201303'];
                $_data[] = (int)$row['201304'];
                $_data[] = (int)$row['201305'];
                $_data[] = (int)$row['201306'];
                $_data[] = (int)$row['201307'];
                $_data[] = (int)$row['201308'];
                $_data[] = (int)$row['201309'];
                $_data[] = (int)$row['201310'];
                $_data[] = (int)$row['201311'];
                $_data[] = (int)$row['201312'];
                $_name['name'] = $row['state'];
                $_second['data'] = $_data;
                $_merge[] = array_merge($_name, $_second);
            }

            Yii::app()->cache->set('employeepermonthallreligion' . Yii::app()->user->id, $_merge, 3600, $dependency);
        } else
            $_merge = Yii::app()->cache->get('employeepermonthallreligion' . Yii::app()->user->id);

        return $_merge;
    }

    public static function holdingTotal()
    {


        $dependency = new CDbCacheDependency('SELECT MAX(updated_date) FROM g_person_career');

        if (!Yii::app()->cache->get('holdingtotal' . Yii::app()->user->id)) {

            $models = aOrganization::model()->findAll(['condition' => 'parent_id = 5 AND id <>1690', 'order' => 'id']);

            $connection = Yii::app()->db;

            $_items = [];
            foreach ($models as $model) {
                $sql = "select 
				(select 
					`oo`.`name`
				from
					`g_person_career` `c`
					left join `a_organization` `o` ON `o`.`id` = `c`.`company_id`
					inner join `a_organization` `oo` ON `o`.`parent_id` = `oo`.`id`
				where
					((`a`.`id` = `c`.`parent_id`)
						and (`c`.`status_id` in (1 , 2, 3, 4, 5, 6, 15)))
				order by `c`.`start_date` desc
				limit 1) as `nn`,
			
				count(`a`.`id`) as `total`
		from
			`g_person` `a`
			 where  
		 
			(select 
					`s`.`status_id` AS `status_id`
				from
					`g_person_status` `s`
				where
					(`s`.`parent_id` = `a`.`id`)
				order by `s`.`start_date` desc
				limit 1) NOT IN (" . implode(",", Yii::app()->getModule('m1')->PARAM_RESIGN_ARRAY) . ") AND
			(select 
					`o`.`parent_id` AS `id`
				from
					(`g_person_career` `c`
					left join `a_organization` `o` ON ((`o`.`id` = `c`.`company_id`)))
				where
					((`a`.`id` = `c`.`parent_id`)
						and (`c`.`status_id` in (1 , 2, 3, 4, 5, 6, 15)))
				order by `c`.`start_date` desc
				limit 1) = " . $model->id;

                $command = $connection->createCommand($sql);
                $row = $command->queryAll();
                $_n1['name'] = $row[0]['nn'];
                $_n1['y'] = (int)$row[0]['total'];
                $item[] = $_n1;
            }

            Yii::app()->cache->set('holdingtotal' . Yii::app()->user->id, $item, 3600, $dependency);
        } else
            $item = Yii::app()->cache->get('holdingtotal' . Yii::app()->user->id);

        return $item;
    }

    public static function holdingPerShareTotal()
    {


        $dependency = new CDbCacheDependency('SELECT MAX(updated_date) FROM g_person_career');

        if (!Yii::app()->cache->get('holdingpersharetotal' . Yii::app()->user->id)) {


            $connection = Yii::app()->db;

            $lists = ['1', '2'];

            foreach ($lists as $list) {
                $sql = "select 
				(select 
					`o`.`custom2`
				from
					`g_person_career` `c`
					left join `a_organization` `o` ON `o`.`id` = `c`.`company_id`
				where
					((`a`.`id` = `c`.`parent_id`)
						and (`c`.`status_id` in (1 , 2, 3, 4, 5, 6, 15)))
				order by `c`.`start_date` desc
				limit 1) as `nn`,
			
				count(`a`.`id`) as `total`
			from
			`g_person` `a`
			 where  
		 
			(select 
					`s`.`status_id` AS `status_id`
				from
					`g_person_status` `s`
				where
					(`s`.`parent_id` = `a`.`id`)
				order by `s`.`start_date` desc
				limit 1) NOT IN (" . implode(",", Yii::app()->getModule('m1')->PARAM_RESIGN_ARRAY) . ") AND
			(select 
					`o`.`custom2` AS `id`
				from
					(`g_person_career` `c`
					left join `a_organization` `o` ON ((`o`.`id` = `c`.`company_id`)))
				where
					((`a`.`id` = `c`.`parent_id`)
						and (`c`.`status_id` in (1 , 2, 3, 4, 5, 6, 15)))
				order by `c`.`start_date` desc
				limit 1) = '" . $list . "'";

                $command = $connection->createCommand($sql);
                $row = $command->queryAll();

                ($row[0]['nn'] == 1) ? $_val = "Full Ownership" : $_val = "Partnership";

                $_n1['name'] = $_val;
                $_n1['y'] = (int)$row[0]['total'];
                $item[] = $_n1;
            }

            Yii::app()->cache->set('holdingpersharetotal' . Yii::app()->user->id, $item, 3600, $dependency);
        } else
            $item = Yii::app()->cache->get('holdingpersharetotal' . Yii::app()->user->id);

        return $item;
    }

    public static function holdingPerOwnershipTotal()
    {


        $dependency = new CDbCacheDependency('SELECT MAX(updated_date) FROM g_person_career');

        if (!Yii::app()->cache->get('holdingperownershiptotal' . Yii::app()->user->id)) {


            $connection = Yii::app()->db;

            $lists = ['1', '2'];

            foreach ($lists as $list) {
                $sql = "select 
				(select 
					`o`.`custom4`
				from
					`g_person_career` `c`
					left join `a_organization` `o` ON `o`.`id` = `c`.`company_id`
				where
					((`a`.`id` = `c`.`parent_id`)
						and (`c`.`status_id` in (1 , 2, 3, 4, 5, 6, 15)))
				order by `c`.`start_date` desc
				limit 1) as `nn`,
			
				count(`a`.`id`) as `total`
			from
			`g_person` `a`
			 where  
		 
			(select 
					`s`.`status_id` AS `status_id`
				from
					`g_person_status` `s`
				where
					(`s`.`parent_id` = `a`.`id`)
				order by `s`.`start_date` desc
				limit 1) NOT IN (" . implode(",", Yii::app()->getModule('m1')->PARAM_RESIGN_ARRAY) . ") AND
			(select 
					`o`.`custom2` AS `id`
				from
					(`g_person_career` `c`
					left join `a_organization` `o` ON ((`o`.`id` = `c`.`company_id`)))
				where
					((`a`.`id` = `c`.`parent_id`)
						and (`c`.`status_id` in (1 , 2, 3, 4, 5, 6, 15)))
				order by `c`.`start_date` desc
				limit 1) = '" . $list . "'";

                $command = $connection->createCommand($sql);
                $row = $command->queryAll();

                ($row[0]['nn'] == 1) ? $_val = "APL" : $_val = "APG";

                $_n1['name'] = $_val;
                $_n1['y'] = (int)$row[0]['total'];
                $item[] = $_n1;
            }

            Yii::app()->cache->set('holdingperownershiptotal' . Yii::app()->user->id, $item, 3600, $dependency);
        } else
            $item = Yii::app()->cache->get('holdingperownershiptotal' . Yii::app()->user->id);

        return $item;
    }

    public static function grandTotal()
    {

        $dependency = new CDbCacheDependency('SELECT MAX(updated_date) FROM g_person_career');

        if (!Yii::app()->cache->get('grandtotal' . Yii::app()->user->id)) {

            $connection = Yii::app()->db;
            $_items = [];
            $sql = "select 
				count(`a`.`id`) as `total`
				from `g_person` `a`
				where  
		 
				(select 
					`s`.`status_id` AS `status_id`
				from
					`g_person_status` `s`
				where
					(`s`.`parent_id` = `a`.`id`)
				order by `s`.`start_date` desc
				limit 1) NOT IN (" . implode(",", Yii::app()->getModule('m1')->PARAM_RESIGN_ARRAY) . ")";

            $command = $connection->createCommand($sql);
            $row = $command->queryScalar();
            $item[] = (int)$row;

            Yii::app()->cache->set('grandtotal' . Yii::app()->user->id, $item, 3600, $dependency);
        } else
            $item = Yii::app()->cache->get('grandtotal' . Yii::app()->user->id);

        return $item;
    }

    public static function proEmployee($id)
    {


        $dependency = new CDbCacheDependency('SELECT MAX(updated_date) FROM g_person_career');

        if (!Yii::app()->cache->get('proemployee' . $id . Yii::app()->user->id)) {

            $models = aOrganization::model()->findAll(['condition' => 'parent_id = ' . $id, 'order' => 'id']);

            $connection = Yii::app()->db;

            $_items = [];
            foreach ($models as $model) {
                $sql = "select 
			count(`a`.`id`) 
		from
			`g_person` `a`
			 where  
		 
			(select 
					`s`.`status_id` AS `status_id`
				from
					`g_person_status` `s`
				where
					(`s`.`parent_id` = `a`.`id`)
				order by `s`.`start_date` desc
				limit 1) NOT IN (" . implode(",", Yii::app()->getModule('m1')->PARAM_RESIGN_ARRAY) . ") AND
			(select 
					`o`.`id` AS `id`
				from
					(`g_person_career` `c`
					left join `a_organization` `o` ON ((`o`.`id` = `c`.`company_id`)))
				where
					((`a`.`id` = `c`.`parent_id`)
						and (`c`.`status_id` in (1 , 2, 3, 4, 5, 6, 15)))
				order by `c`.`start_date` desc
				limit 1) = " . $model->id;

                $command = $connection->createCommand($sql);
                $row = $command->queryScalar();
                $item[] = (int)$row;
            }

            Yii::app()->cache->set('proemployee' . $id . Yii::app()->user->id, $item, 3600, $dependency);
        } else
            $item = Yii::app()->cache->get('proemployee' . $id . Yii::app()->user->id);

        return $item;
    }

    public static function compSexAll()
    {

        $_item = [];
        $dependency = new CDbCacheDependency('SELECT MAX(updated_date) FROM g_person');

        if (!Yii::app()->cache->get('sexall' . Yii::app()->user->id)) {
            $connection = Yii::app()->db;
            $sql = "SELECT (select x.company_id from g_person_career x where x.parent_id = a.id AND x.status_id IN (" . implode(",", Yii::app()->getModule('m1')->PARAM_COMPANY_ARRAY) . ") order by x.start_date DESC limit 1) as company,
			SUM(IF((select d.sex_id from g_person d where d.id = a.id)= 1,1,0)) as l1,
			SUM(IF((select d.sex_id from g_person d where d.id = a.id)= 2,1,0)) as l2
		
			from g_person a";


            $command = $connection->cache(3600, $dependency)->createCommand($sql);
            $row = $command->queryAll();

            $_item[] = (int)$row[0]['l1'];
            $_item[] = (int)$row[0]['l2'];

            Yii::app()->cache->set('sexall' . Yii::app()->user->id, $_item, 3600, $dependency);
        } else
            $_item = Yii::app()->cache->get('sexall' . Yii::app()->user->id);

        return $_item;
    }

    public static function compAgeAll()
    {

        $_item = [];
        $dependency = new CDbCacheDependency('SELECT MAX(updated_date) FROM g_person');

        if (!Yii::app()->cache->get('ageall' . Yii::app()->user->id)) {
            $_age = "DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT((select d.birth_date from g_person d where d.id = a.id), '%Y') - (DATE_FORMAT(NOW(), '00-%m-%d') < DATE_FORMAT((select d.birth_date from g_person d where d.id = a.id), '00-%m-%d'))";
            $connection = Yii::app()->db;
            $sql = "SELECT (select x.company_id from g_person_career x where x.parent_id = a.id AND x.status_id IN (" . implode(",", Yii::app()->getModule('m1')->PARAM_COMPANY_ARRAY) . ") order by x.start_date DESC limit 1) as company,
			SUM(IF(" . $_age . " <= 25,1,0)) as l1,
			SUM(IF(" . $_age . " > 25 AND " . $_age . " <=30,1,0)) as l2,
			SUM(IF(" . $_age . " > 30 AND " . $_age . " <=35,1,0)) as l3,
			SUM(IF(" . $_age . " > 35 AND " . $_age . " <=40,1,0)) as l4,
			SUM(IF(" . $_age . " > 40 AND " . $_age . " <=45,1,0)) as l5,
			SUM(IF(" . $_age . " > 45 AND " . $_age . " <=50,1,0)) as l6,
			SUM(IF(" . $_age . " > 50 AND " . $_age . " <=55,1,0)) as l7,
			SUM(IF(" . $_age . " > 55,1,0)) as l8
		
			from g_person a";

            $command = $connection->cache(3600, $dependency)->createCommand($sql);
            $row = $command->queryAll();

            $_item[] = (int)$row[0]['l1'];
            $_item[] = (int)$row[0]['l2'];
            $_item[] = (int)$row[0]['l3'];
            $_item[] = (int)$row[0]['l4'];
            $_item[] = (int)$row[0]['l5'];
            $_item[] = (int)$row[0]['l6'];
            $_item[] = (int)$row[0]['l7'];
            $_item[] = (int)$row[0]['l8'];

            Yii::app()->cache->set('ageall' . Yii::app()->user->id, $_item, 3600, $dependency);
        } else
            $_item = Yii::app()->cache->get('ageall' . Yii::app()->user->id);

        return $_item;
    }

    public static function compEducationAll()
    {

        $_item = [];
        $dependency = new CDbCacheDependency('SELECT MAX(id) FROM g_person_education');

        if (!Yii::app()->cache->get('educationall' . Yii::app()->user->id)) {
            $connection = Yii::app()->db;
            $sql = "SELECT (select x.company_id from g_person_career x where x.parent_id = a.id AND x.status_id IN (" . implode(",", Yii::app()->getModule('m1')->PARAM_COMPANY_ARRAY) . ") order by x.start_date DESC limit 1) as company,
			SUM(IF((select d.level_id from g_person_education d where d.parent_id = a.id order by d.level_id DESC limit 1)= 1,1,0)) as l1,
			SUM(IF((select d.level_id from g_person_education d where d.parent_id = a.id order by d.level_id DESC limit 1)= 2,1,0)) as l2,
			SUM(IF((select d.level_id from g_person_education d where d.parent_id = a.id order by d.level_id DESC limit 1)= 3,1,0)) as l3,
			SUM(IF((select d.level_id from g_person_education d where d.parent_id = a.id order by d.level_id DESC limit 1)= 4 OR (select d.level_id from g_person_education d where d.parent_id = a.id order by d.level_id DESC limit 1) = 5 OR (select d.level_id from g_person_education d where d.parent_id = a.id order by d.level_id DESC limit 1) = 6 OR (select d.level_id from g_person_education d where d.parent_id = a.id order by d.level_id DESC limit 1) = 7,1,0)) as l4,
			SUM(IF((select d.level_id from g_person_education d where d.parent_id = a.id order by d.level_id DESC limit 1)= 8,1,0)) as l5,
			SUM(IF((select d.level_id from g_person_education d where d.parent_id = a.id order by d.level_id DESC limit 1)= 9,1,0)) as l6,
			SUM(IF((select d.level_id from g_person_education d where d.parent_id = a.id order by d.level_id DESC limit 1)= 10,1,0)) as l7
		
			from g_person a";


            $command = $connection->cache(3600, $dependency)->createCommand($sql);
            $row = $command->queryAll();

            $_item[] = (int)$row[0]['l1'];
            $_item[] = (int)$row[0]['l2'];
            $_item[] = (int)$row[0]['l3'];
            $_item[] = (int)$row[0]['l4'];
            $_item[] = (int)$row[0]['l5'];
            $_item[] = (int)$row[0]['l6'];
            $_item[] = (int)$row[0]['l7'];

            Yii::app()->cache->set('educationall' . Yii::app()->user->id, $_item, 3600, $dependency);
        } else
            $_item = Yii::app()->cache->get('educationall' . Yii::app()->user->id);

        return $_item;
    }

    public static function compReligionAll()
    {

        $_item = [];
        $dependency = new CDbCacheDependency('SELECT MAX(updated_date) FROM g_person');

        if (!Yii::app()->cache->get('religionall' . Yii::app()->user->id)) {
            $connection = Yii::app()->db;
            $sql = "SELECT (select x.company_id from g_person_career x where x.parent_id = a.id AND x.status_id IN (" . implode(",", Yii::app()->getModule('m1')->PARAM_COMPANY_ARRAY) . ") order by x.start_date DESC limit 1) as company,
			SUM(IF((select d.religion_id from g_person d where d.id = a.id)= 1,1,0)) as l1,
			SUM(IF((select d.religion_id from g_person d where d.id = a.id)= 2,1,0)) as l2,
			SUM(IF((select d.religion_id from g_person d where d.id = a.id)= 3,1,0)) as l3,
			SUM(IF((select d.religion_id from g_person d where d.id = a.id)= 4,1,0)) as l4,
			SUM(IF((select d.religion_id from g_person d where d.id = a.id)= 5,1,0)) as l5,
			SUM(IF((select d.religion_id from g_person d where d.id = a.id)= 6,1,0)) as l6
		
			from g_person a";

            $command = $connection->cache(3600, $dependency)->createCommand($sql);
            $row = $command->queryAll();

            $_item[] = (int)$row[0]['l1'];
            $_item[] = (int)$row[0]['l2'];
            $_item[] = (int)$row[0]['l3'];
            $_item[] = (int)$row[0]['l4'];
            $_item[] = (int)$row[0]['l5'];
            $_item[] = (int)$row[0]['l6'];

            Yii::app()->cache->set('religionall' . Yii::app()->user->id, $_item, 3600, $dependency);
        } else
            $_item = Yii::app()->cache->get('religionall' . Yii::app()->user->id);

        return $_item;
    }

    public static function compLevelAll()
    {

        $_item = [];
        $dependency = new CDbCacheDependency('SELECT MAX(updated_date) FROM g_person_career');

        if (!Yii::app()->cache->get('levelall' . Yii::app()->user->id)) {
            $connection = Yii::app()->db;
            $sql = "SELECT (select x.company_id from g_person_career x where x.parent_id = a.id AND x.status_id IN (" . implode(",", Yii::app()->getModule('m1')->PARAM_COMPANY_ARRAY) . ") order by x.start_date DESC limit 1) as company,
			SUM(IF((select g.parent_id from g_person_career d INNER JOIN g_param_level g ON d.level_id = g.id where d.parent_id = a.id order by d.start_date DESC limit 1)= 21,1,0)) as l1,
			SUM(IF((select g.parent_id from g_person_career d INNER JOIN g_param_level g ON d.level_id = g.id where d.parent_id = a.id order by d.start_date DESC limit 1)= 17,1,0)) as l2,
			SUM(IF((select g.parent_id from g_person_career d INNER JOIN g_param_level g ON d.level_id = g.id where d.parent_id = a.id order by d.start_date DESC limit 1)= 13,1,0)) as l3,
			SUM(IF((select g.parent_id from g_person_career d INNER JOIN g_param_level g ON d.level_id = g.id where d.parent_id = a.id order by d.start_date DESC limit 1)= 9,1,0)) as l4,
			SUM(IF((select g.parent_id from g_person_career d INNER JOIN g_param_level g ON d.level_id = g.id where d.parent_id = a.id order by d.start_date DESC limit 1)= 5,1,0)) as l5,
			SUM(IF((select g.parent_id from g_person_career d INNER JOIN g_param_level g ON d.level_id = g.id where d.parent_id = a.id order by d.start_date DESC limit 1)= 1,1,0)) as l6
			from g_person a";

            $command = $connection->cache(3600, $dependency)->createCommand($sql);
            $row = $command->queryAll();

            $_item[] = (int)$row[0]['l1'];
            $_item[] = (int)$row[0]['l2'];
            $_item[] = (int)$row[0]['l3'];
            $_item[] = (int)$row[0]['l4'];
            $_item[] = (int)$row[0]['l5'];
            $_item[] = (int)$row[0]['l6'];

            Yii::app()->cache->set('levelall' . Yii::app()->user->id, $_item, 3600, $dependency);
        } else
            $_item = Yii::app()->cache->get('levelall' . Yii::app()->user->id);

        return $_item;
    }

    public static function compWorkingAll()
    {

        $_item = [];
        $dependency = new CDbCacheDependency('SELECT MAX(updated_date) FROM g_person_career');

        if (!Yii::app()->cache->get('workingall' . Yii::app()->user->id)) {
            $connection = Yii::app()->db;
            $sql = "SELECT (select x.company_id from g_person_career x where x.parent_id = a.id AND x.status_id IN (" . implode(",", Yii::app()->getModule('m1')->PARAM_COMPANY_ARRAY) . ") order by x.start_date DESC limit 1) as company,
			SUM(IF(YEAR(CURDATE()) - YEAR((SELECT d.start_date FROM g_person_career d WHERE d.parent_id = a.id AND d.status_id = 1 order by d.start_date limit 1)) < 1,1,0)) as l1,
			SUM(IF(YEAR(CURDATE()) - YEAR((SELECT d.start_date FROM g_person_career d WHERE d.parent_id = a.id AND d.status_id = 1 order by d.start_date limit 1)) = 1 OR YEAR(CURDATE()) - YEAR((SELECT d.start_date FROM g_person_career d WHERE d.parent_id = a.id AND d.status_id = 1 order by d.start_date limit 1)) = 2,1,0)) as l2,
			SUM(IF(YEAR(CURDATE()) - YEAR((SELECT d.start_date FROM g_person_career d WHERE d.parent_id = a.id AND d.status_id = 1 order by d.start_date limit 1)) = 3 OR YEAR(CURDATE()) - YEAR((SELECT d.start_date FROM g_person_career d WHERE d.parent_id = a.id AND d.status_id = 1 order by d.start_date limit 1)) = 4,1,0)) as l3,
			SUM(IF(YEAR(CURDATE()) - YEAR((SELECT d.start_date FROM g_person_career d WHERE d.parent_id = a.id AND d.status_id = 1 order by d.start_date limit 1)) = 5 OR YEAR(CURDATE()) - YEAR((SELECT d.start_date FROM g_person_career d WHERE d.parent_id = a.id AND d.status_id = 1 order by d.start_date limit 1)) = 6,1,0)) as l4,
			SUM(IF(YEAR(CURDATE()) - YEAR((SELECT d.start_date FROM g_person_career d WHERE d.parent_id = a.id AND d.status_id = 1 order by d.start_date limit 1)) = 7 OR YEAR(CURDATE()) - YEAR((SELECT d.start_date FROM g_person_career d WHERE d.parent_id = a.id AND d.status_id = 1 order by d.start_date limit 1)) = 8,1,0)) as l5,
			SUM(IF(YEAR(CURDATE()) - YEAR((SELECT d.start_date FROM g_person_career d WHERE d.parent_id = a.id AND d.status_id = 1 order by d.start_date limit 1)) >8,1,0)) as l6
		
			from g_person a";


            $command = $connection->cache(3600, $dependency)->createCommand($sql);
            $row = $command->queryAll();

            $_item[] = (int)$row[0]['l1'];
            $_item[] = (int)$row[0]['l2'];
            $_item[] = (int)$row[0]['l3'];
            $_item[] = (int)$row[0]['l4'];
            $_item[] = (int)$row[0]['l5'];
            $_item[] = (int)$row[0]['l6'];

            Yii::app()->cache->set('workingall' . Yii::app()->user->id, $_item, 3600, $dependency);
        } else
            $_item = Yii::app()->cache->get('workingall' . Yii::app()->user->id);

        return $_item;
    }

    public static function compStatusAll()
    {

        $_item = [];
        $dependency = new CDbCacheDependency('SELECT MAX(updated_date) FROM g_person_status');

        if (!Yii::app()->cache->get('statusall' . Yii::app()->user->id)) {
            $connection = Yii::app()->db;
            $sql = "SELECT (select x.company_id from g_person_career x where x.parent_id = a.id AND x.status_id IN (" . implode(",", Yii::app()->getModule('m1')->PARAM_COMPANY_ARRAY) . ") order by x.start_date DESC limit 1) as company,
			SUM(IF((select d.status_id from g_person_status d where d.parent_id = a.id order by d.start_date DESC limit 1) = 1 OR (select d.status_id from g_person_status d where d.parent_id = a.id order by d.start_date DESC limit 1) = 2 OR (select d.status_id from g_person_status d where d.parent_id = a.id order by d.start_date DESC limit 1) = 3,1,0)) as l1,
			SUM(IF((select d.status_id from g_person_status d where d.parent_id = a.id order by d.start_date DESC limit 1) = 4 OR (select d.status_id from g_person_status d where d.parent_id = a.id order by d.start_date DESC limit 1) = 5,1,0)) as l2,
			SUM(IF((select d.status_id from g_person_status d where d.parent_id = a.id order by d.start_date DESC limit 1) = 6,1,0)) as l3,
			SUM(IF((select d.status_id from g_person_status d where d.parent_id = a.id order by d.start_date DESC limit 1) = 7,1,0)) as l4

			from g_person a";

            $dependency = new CDbCacheDependency('SELECT MAX(updated_date) FROM g_person_status');

            $command = $connection->cache(3600, $dependency)->createCommand($sql);
            $row = $command->queryAll();

            $_item[] = (int)$row[0]['l1'];
            $_item[] = (int)$row[0]['l2'];
            $_item[] = (int)$row[0]['l3'];
            $_item[] = (int)$row[0]['l4'];

            Yii::app()->cache->set('statusall' . Yii::app()->user->id, $_item, 3600, $dependency);
        } else
            $_item = Yii::app()->cache->get('statusall' . Yii::app()->user->id);

        return $_item;
    }

    public static function compByParent($id)
    {
        $_items = [];
        //$dependency = new CDbCacheDependency('SELECT MAX(updated_date) FROM a_organization');
        // if (!Yii::app()->cache->get('compbyparent' . Yii::app()->user->id)) {

        $criteria = new CDbCriteria;
        $criteria->order = 'id';
        $criteria->compare('parent_id', $id);
        $models = aOrganization::model()->findAll($criteria);
        foreach ($models as $model)
            $_items[] = $model->name;

        //    Yii::app()->cache->set('compbyparent' . Yii::app()->user->id, $_items, 3600, $dependency);
        //}
        //else
        //    $_items = Yii::app()->cache->get('compbyparent' . Yii::app()->user->id);


        return $_items;
    }

    public static function linePermission()
    {

        $_data = [];
        $dependency = new CDbCacheDependency('SELECT MAX(updated_date) FROM g_permission');

        if (!Yii::app()->cache->get('linePermission' . Yii::app()->user->id)) {
            $connection = Yii::app()->db;
            $sql = "
                select count(id) , from_unixtime(created_date,'%d-%m-%Y') as cdate
                from g_permission 
                group by from_unixtime(created_date,'%d-%m-%Y') 
                order by created_date DESC LIMIT 100

                ;
                
            ";

            $command = $connection->cache(3600, $dependency)->createCommand($sql);
            $rows = $command->queryColumn();
            /*foreach ($rows as $row) {
                $_data = [];
                $_second = [];
            */
            $_name['name'] = "Permission";
            $integerIDs = array_map('intval', $rows);
            $_second['data'] = $integerIDs;
            //echo print_r($integerIDs);
            //die;
            $_merge[] = array_merge($_name, $_second);
            //}

            Yii::app()->cache->set('linePermission' . Yii::app()->user->id, $_merge, 3600, $dependency);
        } else
            $_merge = Yii::app()->cache->get('linePermission' . Yii::app()->user->id);

        return $_merge;
    }

    public static function lineLeave()
    {

        $_data = [];
        $dependency = new CDbCacheDependency('SELECT MAX(updated_date) FROM g_leave');

        if (!Yii::app()->cache->get('lineLeave' . Yii::app()->user->id)) {
            $connection = Yii::app()->db;
            $sql = "
                select count(id) , from_unixtime(created_date,'%d-%m-%Y') as cdate
                from g_leave 
                group by from_unixtime(created_date,'%d-%m-%Y') 
                order by created_date DESC LIMIT 100

                ;
                
            ";

            $command = $connection->cache(3600, $dependency)->createCommand($sql);
            $rows = $command->queryColumn();
            /*foreach ($rows as $row) {
                $_data = [];
                $_second = [];
            */
            $_name['name'] = "Leave";
            $integerIDs = array_map('intval', $rows);
            $_second['data'] = $integerIDs;
            //echo print_r($integerIDs);
            //die;
            $_merge[] = array_merge($_name, $_second);
            //}

            Yii::app()->cache->set('lineLeave' . Yii::app()->user->id, $_merge, 3600, $dependency);
        } else
            $_merge = Yii::app()->cache->get('lineLeave' . Yii::app()->user->id);

        return $_merge;
    }

}
