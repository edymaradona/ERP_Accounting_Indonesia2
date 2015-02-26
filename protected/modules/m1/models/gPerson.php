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
class gPerson extends BaseModel
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
            ['employee_name, birth_place, birth_date, email, handphone', 'required'],
            ['email, handphone,blood_id,account_number, account_name,bank_name', 'required', 'on' => 'ess'],
            ['email', 'in', 'range'=> require(dirname(__FILE__) . '/../../../config/blacklistEmail.php'),
                'not'=>true, 'on' => 'ess','message'=>'This email registered as a blacklist email. Please change other email or contact admin to remove'],
            ['birth_date', 'date', 'format' => 'dd-MM-yyyy'],
            ['activation_expire,sex_id, religion_id, userid, created_date, created_by, updated_date, updated_by', 'numerical', 'integerOnly' => true],
            ['identity_address3, blood_id', 'length', 'max' => 50],
            ['address3', 'length', 'max' => 150],
            ['employee_code, employee_code_global', 'length', 'max' => 50],
            ['activation_code', 'length', 'max' => 16],
            ['employee_name', 'length', 'max' => 100],
            ['email', 'email'],
            //array('handphone', 'ext.BPhoneNumberValidator'),
            ['birth_place', 'length', 'max' => 20],
            ['address1, identity_address1, c_pathfoto', 'length', 'max' => 255],
            ['c_pathfoto', 'unique', 'on' => 'create'],
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
            'companycurrent' =>
                [self::HAS_ONE, 'gPersonCareer', 'parent_id',
                    'order' => 'companycurrent.start_date DESC',
                ],
            'companyfirst' => [self::HAS_ONE, 'gPersonCareer', 'parent_id', 'order' => 'companyfirst.start_date ASC', 'condition' => 'companyfirst.status_id =1'],
            'companyfirstG' => [self::HAS_ONE, 'gPersonCareer', 'parent_id', 'order' => 'companyfirstG.start_date ASC', 'condition' => 'companyfirstG.status_id =9'],
            'status' => [self::HAS_ONE, 'gPersonStatus', 'parent_id', 'order' => 'status.start_date DESC'],
            'leave' => [self::HAS_MANY, 'gLeave', 'parent_id', 'order' => 'leave.start_date DESC'],
            'leaveBalance' => [self::HAS_ONE, 'gLeave', 'parent_id', 'order' => 'leaveBalance.end_date DESC,leaveBalance.id DESC', 'condition' => 'leaveBalance.approved_id NOT IN (1,5,6)'],
            'leaveGenerated' => [self::HAS_ONE, 'gLeave', 'parent_id', 'order' => 'leaveGenerated.end_date DESC', 'condition' => 'leaveGenerated.approved_id IN (7,9)'],
            'lastLeave' => [self::HAS_ONE, 'gLeave', 'parent_id', 'order' => 'lastLeave.end_date DESC', 'condition' => 'lastLeave.approved_id = 2'],
            'medical' => [self::HAS_MANY, 'gMedical', 'parent_id', 'order' => 'medical.receipt_date DESC'],
            'user' => [self::BELONGS_TO, 'sUser', 'userid'],
            'updated' => [self::BELONGS_TO, 'sUser', 'updated_by'],
            'created' => [self::BELONGS_TO, 'sUser', 'created_by'],
            'targetSetting' => [self::HAS_MANY, 'gTalentTargetSetting', 'parent_id'],
            'coreCompetency' => [self::HAS_MANY, 'gTalentCoreCompetency', 'parent_id'],
            'leadershipCompetency' => [self::HAS_MANY, 'gTalentLeadershipCompetency', 'parent_id'],
            'performance' => [self::HAS_MANY, 'gTalentPerformance', 'parent_id'],
            'many_attendance' => [self::HAS_MANY, 'gAttendance', 'parent_id'],
            'insurance' => [self::HAS_ONE, 'gPersonOther', 'parent_id', 'condition' => 'insurance.category_name ="ASURANSI"'],
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
            'sex_id' => 'Gender',
            'religion_id' => 'Religion',
            'address1' => 'Address',
            'address2' => 'Desa/Kel/Kec',
            'address3' => 'Kodya/Kab/Prov',
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

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function sameDepartment($id)
    {
        //$dependency = new CDbCacheDependency('SELECT MAX(updated_date) FROM g_person_career');
        //if (!Yii::app()->cache->get('samedepartment'.Yii::app()->user->id)) {

        $criteria = new CDbCriteria;


        $criteria->condition = '(select s.status_id from g_person_status s WHERE t.id=s.parent_id ORDER BY s.start_date DESC LIMIT 1) NOT IN 
		(' . implode(",", Yii::app()->getModule("m1")->PARAM_RESIGN_ARRAY) . ') AND ' .
            '(select c.department_id from g_person_career c WHERE t.id=c.parent_id AND c.status_id IN (' .
            implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) .
            ') ORDER BY c.start_date DESC LIMIT 1) =' . $id;

        $criteria->order = '(select s.level_id from g_person_career s WHERE t.id=s.parent_id ORDER BY s.start_date DESC LIMIT 1)';

        $dependency = new CDbCacheDependency('SELECT MAX(updated_date) FROM g_person_career');

        //$dataProvider= new CActiveDataProvider($this, array(
        $dataProvider = new CActiveDataProvider(gPerson::model()->cache(3600, $dependency, 2), [
            'criteria' => $criteria,
            'pagination' => [
                'pageSize' => 90,
            ],
            //'pagination'=>false,
        ]);

        //	Yii::app()->cache->set('samedepartment'.Yii::app()->user->id,$dataProvider,3600,$dependency);
        //} else
        //	$dataProvider=Yii::app()->cache->get('samedepartment'.Yii::app()->user->id);

        return $dataProvider;
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function sameLevel($id)
    {
        $criteria = new CDbCriteria;

        $criteria->with = ['company'];
        $criteria->order = 'company.department_id ';
        $criteria->order = 't.updated_date DESC';

        //if (Yii::app()->user->name != "admin") {
        $criteria->addInCondition('company.company_id', sUser::model()->myGroupArray);
        //} else {
        //	$criteria->addInCondition('company.company_id',array(sUser::model()->myGroup));
        //}

        $criteria1 = new CDbCriteria; //JOIN, JOIN CONTINUED, ROTATION
        $criteria1->condition = '(select status_id from g_person_career s where s.parent_id = t.id AND s.status_id IN (' . implode(',', Yii::app()->getModule('m1')->PARAM_COMPANY_ARRAY) . ') ORDER BY start_date DESC LIMIT 1) IN (' . implode(',', Yii::app()->getModule('m1')->PARAM_COMPANY_ARRAY) . ')';

        $criteria2 = new CDbCriteria;
        $criteria2->condition = '(select level_id from g_person_career s where s.parent_id = t.id AND s.status_id IN (' . implode(',', Yii::app()->getModule('m1')->PARAM_COMPANY_ARRAY) . ') ORDER BY start_date DESC LIMIT 1) =' . $id;

        $criteria3 = new CDbCriteria; //8=RESIGN, 9=TERMINATION, 10=End Of Contract
        $criteria3->condition = '(select status_id from g_person_status s where s.parent_id = t.id ORDER BY start_date DESC LIMIT 1) NOT IN (' . implode(',', Yii::app()->getModule('m1')->PARAM_RESIGN_ARRAY) . ')';

        $criteria->mergeWith($criteria1);
        $criteria->mergeWith($criteria2);
        $criteria->mergeWith($criteria3);

        $dependency = new CDbCacheDependency('SELECT MAX(updated_date) FROM g_person_career');

        return new CActiveDataProvider($this, [
            //return new CActiveDataProvider(gPerson::model()->cache(3600, $dependency, 2), array(
            'criteria' => $criteria,
            'pagination' => [
                'pageSize' => 20,
            ],
            //'pagination'=>false,
        ]);
    }

    public static function subOrdinate()
    {
        $returnarray = [];
        $sql = "
			select 			
				`a`.`id` AS `id`,
				`a`.`employee_name` AS `employee_name`,
				(
				(select count(*) from g_leave l where l.parent_id = a.id AND l.superior_approved_id = 1) +
				(select count(*) from g_permission p where p.parent_id = a.id AND p.superior_approved_id = 1) + 
				(select count(*) from g_attendance t where t.parent_id = a.id AND t.superior_approved_id = 1)
				)
				 as request 
			from
				`g_person` `a` 
			where
				(select 
						`c`.`superior_id` AS `superior_id`
					from
						`g_person_career` `c`
					where
						`a`.`id` = `c`.`parent_id`
							and `c`.`status_id` in (1 , 2, 3, 4, 5, 6, 15)
					order by `c`.`start_date` desc
					limit 1) = " . sUser::model()->currentPersonId() . " 
            and

            (select 
                `s`.`status_id` AS `status`
            from
                `g_person_status` `s`
            where
                `s`.`parent_id` = `a`.`id`
            order by `s`.`start_date` desc
            limit 1) NOT IN (" . implode(',', Yii::app()->getModule('m1')->PARAM_RESIGN_ARRAY) . ")


			UNION ALL
			select 			
				`aa`.`id` AS `id`,
				`aa`.`employee_name` AS `employee_name`, 
				(
				(select count(*) from g_leave l where l.parent_id = aa.id AND l.superior_approved_id = 1) +
				(select count(*) from g_permission p where p.parent_id = aa.id AND p.superior_approved_id = 1) + 
				(select count(*) from g_attendance t where t.parent_id = aa.id AND t.superior_approved_id = 1)
				)
				 as request 
			from
				`g_person` `aa` 
			where
				(select 
						`cc`.`superior_id` AS `superior_id`
					from
						`g_person_career` `cc`
					where
						`aa`.`id` = `cc`.`parent_id`
							and `cc`.`status_id` in (1 , 2, 3, 4, 5, 6, 15)
					order by `cc`.`start_date` desc
					limit 1) IN ( 

            			select 			
            				`a`.`id` AS `id`
            			from
            				`g_person` `a` 
            			where
            				(select 
            						`c`.`superior_id` AS `superior_id`
            					from
            						`g_person_career` `c`
            					where
            						`a`.`id` = `c`.`parent_id`
            							and `c`.`status_id` in (1 , 2, 3, 4, 5, 6, 15)
            					order by `c`.`start_date` desc
            					limit 1) = " . sUser::model()->currentPersonId() . " 
				
			         ) AND 

            (select 
                `ss`.`status_id` AS `status`
            from
                `g_person_status` `ss`
            where
                `ss`.`parent_id` = `aa`.`id`
            order by `ss`.`start_date` desc
            limit 1) NOT IN (" . implode(',', Yii::app()->getModule('m1')->PARAM_RESIGN_ARRAY) . ")


		";

        $rawData = Yii::app()->db->createCommand($sql)->queryAll();
        $dataProvider = new CArrayDataProvider($rawData, [
            'pagination' => false,
        ]);


        foreach ($dataProvider->getData() as $model) {
            $val = $model['request'] != 0 ? CHtml::tag("span", ['class' => 'badge badge-info pull-right'], $model['request']) : "";
            $_nama = (strlen($model['employee_name']) > 28) ? substr($model['employee_name'], 0, 28) . "... "
                . $val :
                $model['employee_name'] . " " . $val;
            $returnarray[] = ['id' => $model['id'], 'label' => $_nama, 'icon' => 'list-alt', 'url' => ['/m1/gEss/subordinate', 'id' => $model['id'],]];
        }

        return $returnarray;
    }

    public static function subOrdinateById($id)
    {
        $returnarray = [];
        $sql = "
			select 			
				`a`.`id` AS `id`,
				`a`.`employee_name` AS `employee_name`,
				(
				(select count(*) from g_leave l where l.parent_id = a.id AND l.superior_approved_id = 1) +
				(select count(*) from g_permission p where p.parent_id = a.id AND p.superior_approved_id = 1) + 
				(select count(*) from g_attendance t where t.parent_id = a.id AND t.superior_approved_id = 1)
				)
				 as request 
			from
				`g_person` `a` 
			where
				(select 
						`c`.`superior_id` AS `superior_id`
					from
						`g_person_career` `c`
					where
						`a`.`id` = `c`.`parent_id`
							and `c`.`status_id` in (1 , 2, 3, 4, 5, 6, 15)
					order by `c`.`start_date` desc
					limit 1) = " . $id . " 
			order by 
				(select 
						`p`.`updated_date` AS `updated_date`
					from
						`g_permission` `p`
					where
						`a`.`id` = `p`.`parent_id`
					order by `p`.`updated_date` desc
					limit 1)					
			LIMIT 100
		";

        $rawData = Yii::app()->db->createCommand($sql)->queryAll();
        $dataProvider = new CArrayDataProvider($rawData, [
            'pagination' => false,
        ]);


        foreach ($dataProvider->getData() as $model) {
            $val = $model['request'] != 0 ? CHtml::tag("span", ['class' => 'badge badge-info'], $model['request']) : "";
            $_nama = (strlen($model['employee_name']) > 28) ? substr($model['employee_name'], 0, 28) . "... "
                . $val :
                $model['employee_name'] . " " . $val;
            $returnarray[] = ['id' => $model['id'], 'label' => $_nama, 'icon' => 'list-alt', 'url' => ['/m1/gEss/subordinate', 'id' => $model['id'],]];
        }

        return $returnarray;
    }

    public static function getTopCreated()
    {

        $criteria = new CDbCriteria;
        $criteria->limit = 10;
        $criteria->order = "created_date DESC";
        if (Yii::app()->user->name != "admin") {
            $criteria1 = new CDbCriteria;
            $criteria1->condition = '(select c.company_id from g_person_career c WHERE t.id=c.parent_id AND c.status_id IN (' . implode(',', Yii::app()->getModule('m1')->PARAM_COMPANY_ARRAY) . ') ORDER BY c.start_date DESC LIMIT 1) IN (' . implode(",", sUser::model()->myGroupArray) . ')';
            $criteria->mergeWith($criteria1);
        }
        $models = self::model()->findAll($criteria);

        $returnarray = [];

        foreach ($models as $model) {
            $_nama = (strlen($model->employee_name) > 28) ? substr($model->employee_name, 0, 28) . "..." : $model->employee_name;
            $returnarray[] = [
                'id' => $model->id,
                'description' => $model->employeeShortId . " | " . $model->mDepartment(),
                'label' => $_nama,
                'photo' => $model->photoPath,
                'url' => ['view', 'id' => $model->id,
                ]];
        }

        return $returnarray;
    }

    public static function getTopUpdated()
    {

        $criteria = new CDbCriteria;
        $criteria->limit = 10;
        $criteria->order = "t.updated_date DESC";
        if (Yii::app()->user->name != "admin") {
            $criteria1 = new CDbCriteria;
            $criteria1->condition = '(select c.company_id from g_person_career c WHERE t.id=c.parent_id AND c.status_id IN (' . implode(',', Yii::app()->getModule('m1')->PARAM_COMPANY_ARRAY) . ') ORDER BY c.start_date DESC LIMIT 1) IN (' . implode(",", sUser::model()->myGroupArray) . ')';
            $criteria->mergeWith($criteria1);
        }
        $models = self::model()->findAll($criteria);

        $returnarray = [];

        foreach ($models as $model) {
            $_nama = (strlen($model->employee_name) > 28) ? substr($model->employee_name, 0, 28) . "..." : $model->employee_name;
            $returnarray[] = [
                'id' => $model->id,
                'description' => $model->employeeShortId . " | " . $model->mDepartment(),
                'label' => $_nama,
                'photo' => $model->photoPath,
                'url' => ['view', 'id' => $model->id,
                ]];
        }

        return $returnarray;
    }

    public static function getTopUpdatedCareer()
    {

        $criteria = new CDbCriteria;
        $criteria->limit = 10;
        $criteria->order = "many_career.updated_date DESC";
        $criteria->together = true;
        $criteria->with = ['many_career'];

        if (Yii::app()->user->name != "admin") {
            $criteria1 = new CDbCriteria;
            $criteria1->condition = '(select c.company_id from g_person_career c WHERE t.id=c.parent_id AND c.status_id IN (' . implode(',', Yii::app()->getModule('m1')->PARAM_COMPANY_ARRAY) . ') ORDER BY c.start_date DESC LIMIT 1) IN (' . implode(",", sUser::model()->myGroupArray) . ')';
            $criteria->mergeWith($criteria1);
        }
        $models = self::model()->findAll($criteria);

        $returnarray = [];

        foreach ($models as $model) {
            $_nama = (strlen($model->employee_name) > 28) ? substr($model->employee_name, 0, 28) . "..." : $model->employee_name;
            $returnarray[] = [
                'id' => $model->id,
                'description' => $model->employeeShortId . " | " . $model->mDepartment(),
                'label' => $_nama,
                'photo' => $model->photoPath,
                'url' => ['view', 'id' => $model->id,
                ]];
        }

        return $returnarray;
    }

    public static function getTopRelated($name)
    {

        $_exp = explode(" ", $name);


        $criteria = new CDbCriteria;
        //$criteria->compare('account_name',$_related,true,'OR');

        if (isset($_exp[0]))
            $criteria->compare('employee_name', $_exp[0], true, 'OR');

        if (isset($_exp[1]))
            $criteria->compare('employee_name', $_exp[1], true, 'OR');

        if (Yii::app()->user->name != "admin") {
            $criteria1 = new CDbCriteria;
            $criteria1->condition = '(select c.company_id from g_person_career c WHERE t.id=c.parent_id AND c.status_id IN (' . implode(',', Yii::app()->getModule('m1')->PARAM_COMPANY_ARRAY) . ') ORDER BY c.start_date DESC LIMIT 1) IN (' . implode(",", sUser::model()->myGroupArray) . ')';
            $criteria->mergeWith($criteria1);
        }

        $criteria->limit = 10;
        $criteria->order = 't.updated_date DESC';

        $models = self::model()->findAll($criteria);

        $returnarray = [];

        foreach ($models as $model) {
            $_nama = (strlen($model->employee_name) > 28) ? substr($model->employee_name, 0, 28) . "..." : $model->employee_name;
            $returnarray[] = ['id' => $model->id, 'label' => $_nama, 'icon' => 'list-alt', 'url' => ['view', 'id' => $model->id,]];
        }

        return $returnarray;
    }

    public static function getTopOther()
    {

        $criteria = new CDbCriteria;
        $criteria->limit = 20;
        $criteria->condition = "birth_date is null"; //uncomplete data
        if (Yii::app()->user->name != "admin") {
            $criteria1 = new CDbCriteria;
            $criteria1->condition = '(select c.company_id from g_person_career c WHERE t.id=c.parent_id AND c.status_id IN (' . implode(',', Yii::app()->getModule('m1')->PARAM_COMPANY_ARRAY) . ') ORDER BY c.start_date DESC LIMIT 1) IN (' . implode(",", sUser::model()->myGroupArray) . ')';
            $criteria->mergeWith($criteria1);
        }
        $models = self::model()->findAll($criteria);

        $returnarray = [];

        foreach ($models as $model) {
            $_nama = (strlen($model->employee_name) > 28) ? substr($model->employee_name, 0, 28) . "..." : $model->employee_name;
            $returnarray[] = ['id' => $model->id, 'label' => $_nama, 'icon' => 'list-alt', 'url' => ['view', 'id' => $model->id,]];
        }

        return $returnarray;
    }

    public function countJoinDate()
    {
        if (isset($this->companyfirst) && !in_array((int)$this->mStatusId(), Yii::app()->getModule('m1')->PARAM_RESIGN_ARRAY)) {
            $diff = abs(strtotime($this->companyfirst->start_date) - time());
            $years = floor($diff / (365 * 60 * 60 * 24));
            $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
            $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));

            if ($years == 0 && $months == 0)
                return $days . " days";
            elseif (!$years != 0)
                return $months . " months, " . $days . " days";
            else
                return $years . " years, " . $months . " months, " . $days . " days";
        } else
            return null;
    }

    public function countJoinDateG()
    {
        if (isset($this->companyfirstG) && !in_array((int)$this->mStatusId(), Yii::app()->getModule('m1')->PARAM_RESIGN_ARRAY)) {
            $diff = abs(strtotime($this->companyfirstG->start_date) - time());
            $years = floor($diff / (365 * 60 * 60 * 24));
            $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
            $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));

            if ($years == 0 && $months == 0)
                return $days . " days";
            elseif (!$years != 0)
                return $months . " months, " . $days . " days";
            else
                return $years . " years, " . $months . " months, " . $days . " days";
        } else
            return null;
    }

    public function countJoinDateB()
    {
        if (isset($this->company) && !in_array((int)$this->mStatusId(), Yii::app()->getModule('m1')->PARAM_RESIGN_ARRAY)) {
            $diff = abs(strtotime($this->companycurrent->start_date) - time());
            $years = floor($diff / (365 * 60 * 60 * 24));
            $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
            $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));

            if ($years == 0 && $months == 0)
                return $days . " days";
            elseif (!$years != 0)
                return $months . " months, " . $days . " days";
            else
                return $years . " years, " . $months . " months, " . $days . " days";
        } else
            return null;
    }

    public function countContract()
    {
        $value = null;
        if (isset($this->companyfirst) && !in_array((int)$this->mStatusId(), Yii::app()->getModule('m1')->PARAM_RESIGN_ARRAY) && $this->mStatusId() != 6) {
            if (isset($this->status->end_date)) {
                $diff = abs(strtotime($this->mStatusEndDate()) - time());
                $years = floor($diff / (365 * 60 * 60 * 24));
                $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));

                if (strtotime($this->mStatusEndDate()) > time()) {
                    if ($years == 0 && $months == 0)
                        $value = $days . " days left";
                    elseif (!$years != 0)
                        $value = $months . " months, " . $days . " days left";
                    else
                        $value = $years . " years, " . $months . " months, " . $days . " days left";
                } else {
                    if ($years == 0 && $months == 0)
                        $value = $days . " days expired";
                    elseif (!$years != 0)
                        $value = $months . " months, " . $days . " days expired";
                    else
                        $value = $years . " years, " . $months . " months, " . $days . " days expired";
                }
            }
        } //else
        //  return null;
        return $value;
    }

    public function countBirthdate()
    {
        $diff = abs(strtotime(date('y') . '-' . date('m', strtotime($this->birth_date)) . '-' . date('d', strtotime($this->birth_date))) - time());
        $years = floor($diff / (365 * 60 * 60 * 24));
        $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
        $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));

        if ($days == 0) {
            $_value = "Today";
        } elseif ($days == 1) {
            $_value = "Tomorrow";
        } else
            $_value = $days . " Days to go";

        return $_value;
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

    public function getPhotoExist()
    {
        if ($this->c_pathfoto != null) {
            if (is_file(Yii::app()->basePath . "/../shareimages/hr/employee/" . $this->c_pathfoto))
                return true;
            else
                return false;
        }
        return false;
    }

    public function getPhotoExistThumb()
    {
        if ($this->c_pathfoto != null) {
            if (is_file(Yii::app()->basePath . "/../shareimages/hr/employee/thumb/" . $this->c_pathfoto))
                return true;
            else
                return false;
        }
        return false;
    }

    public function getPhotoPath()
    {
        if ($this->c_pathfoto != null && $this->PhotoExist) {
            if ($this->PhotoExistThumb) {
                $path = CHtml::image(Yii::app()->request->baseUrlCdn . "/shareimages/hr/employee/thumb/" . $this->c_pathfoto, CHtml::encode($this->employee_name), ["width" => "100%", 'id' => 'photo']);
            } else
                $path = CHtml::image(Yii::app()->request->baseUrlCdn . "/shareimages/hr/employee/" . $this->c_pathfoto, CHtml::encode($this->employee_name), ["width" => "100%", 'id' => 'photo']);
        } else {
            if ($this->sex_id == 1) {
                $path = CHtml::image(Yii::app()->request->baseUrlCdn . "/shareimages/nophoto.jpg", CHtml::encode($this->employee_name), ["width" => "100%", 'id' => 'photo']);
            } else
                $path = CHtml::image(Yii::app()->request->baseUrlCdn . "/shareimages/nophotoW.jpg", CHtml::encode($this->employee_name), ["width" => "100%", 'id' => 'photo']);
        }
        return $path;
    }

    public function getPhotoPathReal()
    {
        if ($this->c_pathfoto != null && $this->PhotoExist) {
            if ($this->PhotoExistThumb) {
                $path = Yii::app()->basePath . "/../shareimages/hr/employee/thumb/" . $this->c_pathfoto;
            } else
                $path = Yii::app()->basePath . "/../shareimages/hr/employee/" . $this->c_pathfoto;
        } else {
            if ($this->sex_id == 1) {
                $path = Yii::app()->basePath . "/../shareimages/nophoto.jpg";
            } else
                $path = Yii::app()->basePath . "/../shareimages/nophotoW.jpg";
        }
        return $path;
    }

    public function getGPersonLink()
    {
        return CHtml::link($this->employee_name, Yii::app()->createUrl('/m1/gPerson/view', [
            'id' => $this->id,
            //'en'=>$this->employee_name,
        ]));
    }

    public function getGPersonPhoto()
    {
        return CHtml::link($this->photoPath, Yii::app()->createUrl('/m1/gPerson/view', [
            'id' => $this->id,
            //'en'=>$this->employee_name,
        ]));
    }

    public function getGAttendanceLink()
    {
        return CHtml::link($this->employee_name, Yii::app()->createUrl('/m1/gAttendance/view', [
            'id' => $this->id,
            //'en'=>$this->employee_name,
        ]));
    }

    public function getGTalentLink()
    {
        return CHtml::link($this->employee_name, Yii::app()->createUrl('/m1/gPerformance/view', [
            'id' => $this->id,
            //'en'=>$this->employee_name,
        ]));
    }

    public function getGTrainingLink()
    {
        return CHtml::link($this->employee_name, Yii::app()->createUrl('/m1/gTraining/view', [
            'id' => $this->id,
            //'en'=>$this->employee_name,
        ]));
    }

    public function companyly($limit = 5)
    {
        $this->getDbCriteria()->mergeWith([
            'limit' => $limit,
        ]);
        return $this;
    }

    public function mCurrentCareerId()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('parent_id', $this->id);
        $criteria->order = 'start_date DESC';
        $criteria->addInCondition("status_id", Yii::app()->getModule('m1')->PARAM_COMPANY_ARRAY);
        $_value = gPersonCareer::model()->find($criteria);
        if ($_value != null) {
            return $_value->id;
        } else
            return null;
    }


    public function mCompanyId()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('parent_id', $this->id);
        $criteria->order = 'start_date DESC';
        $criteria->addInCondition("status_id", Yii::app()->getModule('m1')->PARAM_COMPANY_ARRAY);
        $_value = gPersonCareer::model()->find($criteria);
        if ($_value != null) {
            return $_value->company->id;
        } else
            return '.::INCOMPLETE::.';
    }

    public function mCompany()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('parent_id', $this->id);
        $criteria->order = 'start_date DESC';
        $criteria->addInCondition("status_id", Yii::app()->getModule('m1')->PARAM_COMPANY_ARRAY);
        $_value = gPersonCareer::model()->find($criteria);
        if ($_value != null) {
            return $_value->company->name;
        } else
            return '.::INCOMPLETE::.';
    }

    public function mCompanyLogo()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('parent_id', $this->id);
        $criteria->order = 'start_date DESC';
        $criteria->addInCondition("status_id", Yii::app()->getModule('m1')->PARAM_COMPANY_ARRAY);
        $_value = gPersonCareer::model()->find($criteria);
        if ($_value != null) {
            return $_value->company->photo_path;
        } else
            return '.::INCOMPLETE::.';
    }


    public function mPreviousCompany()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('parent_id', $this->id);
        $criteria->compare('id !', $this->mCurrentCareerId());
        $criteria->order = 'start_date DESC';
        $criteria->addInCondition("status_id", Yii::app()->getModule('m1')->PARAM_COMPANY_ARRAY);
        $_value = gPersonCareer::model()->find($criteria);
        if ($_value != null) {
            return $_value->company->name;
        } else
            return '.::INCOMPLETE::.';
    }

    public function mSuperiorLink()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('parent_id', $this->id);
        $criteria->order = 'start_date DESC';
        $criteria->addInCondition("status_id", Yii::app()->getModule('m1')->PARAM_COMPANY_ARRAY);
        $_value = gPersonCareer::model()->find($criteria);
        if (isset($_value->superior) && $_value->superior_id != null) {
            return CHtml::link($_value->superior->employee_name, Yii::app()->createUrl('m1/gPerson/view', ['id' => $_value->superior_id]));
        } else
            return null;
    }

    public function mSuperior()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('parent_id', $this->id);
        $criteria->order = 'start_date DESC';
        $criteria->addInCondition("status_id", Yii::app()->getModule('m1')->PARAM_COMPANY_ARRAY);
        $_value = gPersonCareer::model()->find($criteria);
        if ($_value->superior_id != null && $_value->superior->employee_name != null) {
            return $_value->superior->employee_name;
        } else
            return null;
    }

    public function mSuperiorJobTitle()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('parent_id', $this->id);
        $criteria->order = 'start_date DESC';
        $criteria->addInCondition("status_id", Yii::app()->getModule('m1')->PARAM_COMPANY_ARRAY);
        $_value = gPersonCareer::model()->find($criteria);
        if ($_value->superior_id != null && $_value->superior->employee_name != null) {
            return $_value->superior->mJobTitle();
        } else
            return null;
    }


    public function mDoubleSuperior()
    {
        $value = null;
        $criteria = new CDbCriteria;
        $criteria->compare('parent_id', $this->id);
        $criteria->order = 'start_date DESC';
        $criteria->addInCondition("status_id", Yii::app()->getModule('m1')->PARAM_COMPANY_ARRAY);
        $_value = gPersonCareer::model()->find($criteria);
        if ($_value->superior_id != null && $_value->superior->employee_name != null) {
            $criteria1 = new CDbCriteria;
            $criteria1->compare('parent_id', $_value->superior_id);
            $criteria1->order = 'start_date DESC';
            $criteria1->addInCondition("status_id", Yii::app()->getModule('m1')->PARAM_COMPANY_ARRAY);
            $_value1 = gPersonCareer::model()->find($criteria1);

            if ($_value1->superior_id != null && $_value1->superior->employee_name != null)
                $value = $_value1->superior->employee_name;
        } //else
        //    return null;
        return $value;
    }

    public function mDoubleSuperiorJobTitle()
    {
        $value = null;
        $criteria = new CDbCriteria;
        $criteria->compare('parent_id', $this->id);
        $criteria->order = 'start_date DESC';
        $criteria->addInCondition("status_id", Yii::app()->getModule('m1')->PARAM_COMPANY_ARRAY);
        $_value = gPersonCareer::model()->find($criteria);
        if ($_value->superior_id != null && $_value->superior->employee_name != null) {
            $criteria1 = new CDbCriteria;
            $criteria1->compare('parent_id', $_value->superior_id);
            $criteria1->order = 'start_date DESC';
            $criteria1->addInCondition("status_id", Yii::app()->getModule('m1')->PARAM_COMPANY_ARRAY);
            $_value1 = gPersonCareer::model()->find($criteria1);

            if ($_value1->superior_id != null && $_value1->superior->employee_name != null)
                $value = $_value1->superior->mJobTitle();
        } //else
        //    return null;
        return $value;
    }

    public function mSuperiorId()
    {
        $value = null;
        $criteria = new CDbCriteria;
        $criteria->compare('parent_id', $this->id);
        $criteria->order = 'start_date DESC';
        $criteria->addInCondition("status_id", Yii::app()->getModule('m1')->PARAM_COMPANY_ARRAY);
        $_value = gPersonCareer::model()->find($criteria);
        if ($_value->superior_id != null && $_value->superior->employee_name != null) {
            $value = $_value->superior_id;
        } //else
        //return null;
        return $value;
    }

    public function mSuperiorUserId()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('parent_id', $this->id);
        $criteria->order = 'start_date DESC';
        $criteria->addInCondition("status_id", Yii::app()->getModule('m1')->PARAM_COMPANY_ARRAY);
        $_value = gPersonCareer::model()->find($criteria);
        if ($_value->superior_id != null && $_value->superior->employee_name != null) {
            return $_value->superior->userid;
        } else
            return null;
    }

    public function mDoubleSuperiorId()
    {
        $value = null;
        $criteria = new CDbCriteria;
        $criteria->compare('parent_id', $this->id);
        $criteria->order = 'start_date DESC';
        $criteria->addInCondition("status_id", Yii::app()->getModule('m1')->PARAM_COMPANY_ARRAY);
        $_value = gPersonCareer::model()->find($criteria);
        if ($_value->superior_id != null && $_value->superior->employee_name != null) {
            $criteria1 = new CDbCriteria;
            $criteria1->compare('parent_id', $_value->superior_id);
            $criteria1->order = 'start_date DESC';
            $criteria1->addInCondition("status_id", Yii::app()->getModule('m1')->PARAM_COMPANY_ARRAY);
            $_value1 = gPersonCareer::model()->find($criteria1);

            if ($_value1->superior_id != null && $_value1->superior->employee_name != null)
                $value = $_value1->superior_id;
        } //else
        //return null;
        return $value;
    }

    public function mDoubleSuperiorUserId()
    {
        $value = null;
        $criteria = new CDbCriteria;
        $criteria->compare('parent_id', $this->id);
        $criteria->order = 'start_date DESC';
        $criteria->addInCondition("status_id", Yii::app()->getModule('m1')->PARAM_COMPANY_ARRAY);
        $_value = gPersonCareer::model()->find($criteria);
        if ($_value->superior_id != null && $_value->superior->employee_name != null) {
            $criteria1 = new CDbCriteria;
            $criteria1->compare('parent_id', $_value->superior_id);
            $criteria1->order = 'start_date DESC';
            $criteria1->addInCondition("status_id", Yii::app()->getModule('m1')->PARAM_COMPANY_ARRAY);
            $_value1 = gPersonCareer::model()->find($criteria1);

            if ($_value1->superior_id != null && $_value1->superior->employee_name != null)
                $value = $_value1->superior->userid;
        } //else
        //          return null;
        return $value;
    }

    public function mJobTitle()
    {
        $value = null;
        $criteria = new CDbCriteria;
        $criteria->compare('parent_id', $this->id);
        $criteria->addInCondition("status_id", Yii::app()->getModule('m1')->PARAM_COMPANY_ARRAY);
        $criteria->order = 'start_date DESC';
        $_value = gPersonCareer::model()->find($criteria);
        if ($_value != null) {
            $value = $_value->job_title;
        };
        return $value;
    }

    public function mPreviousJobTitle()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('parent_id', $this->id);
        $criteria->addInCondition("status_id", Yii::app()->getModule('m1')->PARAM_COMPANY_ARRAY);
        $criteria->compare('id !', $this->mCurrentCareerId());
        $criteria->order = 'start_date DESC';
        $_value = gPersonCareer::model()->find($criteria);
        if ($_value == null) {
            return null;
        } else
            return $_value->job_title;
    }

    public function mLevel()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('parent_id', $this->id);
        $criteria->addInCondition("status_id", Yii::app()->getModule('m1')->PARAM_COMPANY_ARRAY);
        $criteria->order = 'start_date DESC';
        $_value = gPersonCareer::model()->find($criteria);
        if ($_value == null) {
            return null;
        } else
            return $_value->level->name;
    }

    public function mPreviousLevel()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('parent_id', $this->id);
        $criteria->addInCondition("status_id", Yii::app()->getModule('m1')->PARAM_COMPANY_ARRAY);
        $criteria->compare('id !', $this->mCurrentCareerId());
        $criteria->order = 'start_date DESC';
        $_value = gPersonCareer::model()->find($criteria);
        if ($_value == null) {
            return null;
        } else
            return $_value->level->name;
    }


    public function mLevelId()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('parent_id', $this->id);
        $criteria->addInCondition("status_id", Yii::app()->getModule('m1')->PARAM_COMPANY_ARRAY);
        $criteria->order = 'start_date DESC';
        $_value = gPersonCareer::model()->find($criteria);
        if ($_value == null) {
            return null;
        } else
            return $_value->level_id;
    }

    public function mLevelParentId()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('parent_id', $this->id);
        $criteria->addInCondition("status_id", Yii::app()->getModule('m1')->PARAM_COMPANY_ARRAY);
        $criteria->order = 'start_date DESC';
        $_value = gPersonCareer::model()->find($criteria);
        if ($_value == null) {
            return null;
        } else
            return $_value->level->parent_id;
    }

    public function mGolonganId()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('parent_id', $this->id);
        $criteria->addInCondition("status_id", Yii::app()->getModule('m1')->PARAM_COMPANY_ARRAY);
        $criteria->order = 'start_date DESC';
        $_value = gPersonCareer::model()->find($criteria);
        if ($_value == null) {
            return null;
        } else
            return $_value->level->golongan;
    }

    public function mSuperiorGolonganId()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('parent_id', $this->id);
        $criteria->order = 'start_date DESC';
        $criteria->addInCondition("status_id", Yii::app()->getModule('m1')->PARAM_COMPANY_ARRAY);
        $_value = gPersonCareer::model()->find($criteria);
        if ($_value->superior_id != null && $_value->superior->employee_name != null) {
            return $_value->superior->mGolonganId();
        } else
            return null;
    }

    public function mDepartment()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('parent_id', $this->id);
        $criteria->addInCondition('status_id', Yii::app()->getModule('m1')->PARAM_COMPANY_ARRAY);
        $criteria->order = 'start_date DESC';
        $_value = gPersonCareer::model()->find($criteria);
        if ($_value != null) {
            return $_value->department->name;
        } else
            return '.::INCOMPLETE::.';
    }

    public function mPreviousDepartment()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('parent_id', $this->id);
        $criteria->addInCondition('status_id', Yii::app()->getModule('m1')->PARAM_COMPANY_ARRAY);
        $criteria->compare('id !', $this->mCurrentCareerId());
        $criteria->order = 'start_date DESC';
        $_value = gPersonCareer::model()->find($criteria);
        if ($_value != null) {
            return $_value->department->name;
        } else
            return '.::INCOMPLETE::.';
    }

    public function mDepartmentId()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('parent_id', $this->id);
        $criteria->addInCondition('status_id', Yii::app()->getModule('m1')->PARAM_COMPANY_ARRAY);
        $criteria->order = 'start_date DESC';
        $_value = gPersonCareer::model()->find($criteria);
        if ($_value == null) {
            return null;
        } else
            return $_value->department_id;
    }

    public function mCareerDate()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('parent_id', $this->id);
        $criteria->addInCondition('status_id', Yii::app()->getModule('m1')->PARAM_COMPANY_ARRAY);
        $criteria->order = 'start_date DESC';
        $_value = gPersonCareer::model()->find($criteria);
        if ($_value == null) {
            return null;
        } else
            return $_value->start_date;
    }

    public function mJoinTypeId()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('parent_id', $this->id);
        $criteria->addInCondition('status_id', Yii::app()->getModule('m1')->PARAM_COMPANY_ARRAY);
        $criteria->order = 'start_date DESC';
        $_value = gPersonCareer::model()->find($criteria);
        if ($_value == null) {
            return null;
        } else
            return $_value->status_id;
    }

    public function mStatus()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('parent_id', $this->id);
        $criteria->order = 'start_date DESC';
        $_value = gPersonStatus::model()->find($criteria);
        if ($_value == null) {
            return null;
        } else {
            $prog = "";
            if (strtotime($_value->start_date) > time())
                $prog = " (On Progress)";
            return $_value->status->name . $prog;
        }
    }

    public function mStatusId()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('parent_id', $this->id);
        $criteria->order = 'start_date DESC';
        $_value = gPersonStatus::model()->find($criteria);
        if ($_value == null) {
            return null;
        } else
            return $_value->status_id;
    }

    public function mStatusEndDate()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('parent_id', $this->id);
        $criteria->order = 'start_date DESC';
        $_value = gPersonStatus::model()->find($criteria);
        if ($_value == null) {
            return null;
        } else
            return $_value->end_date;
    }

    public function scopes()
    {
        return [
            //'noResign'=>array(
            //    'condition'=>'status=1',
            //),
            //'noResign'=>array(
            //  'with'=>array('status'),
            //'limit'=>5,
            //),
        ];
    }

    public function maritalStatus()
    {
        if ($this->has_couple == 0) {
            $_status = "TK";
        } else
            $_status = "K" . $this->count_children;

        return $_status;
    }

    public function maritalTaxStatus()
    {
        if ($this->has_couple == 0 || ($this->has_couple != 0 && $this->sex_id == 2)) {
            $_status = "TK";
        } else
            $_status = ($this->count_children >= 3) ? "K3" : "K" . $this->count_children;

        return $_status;
    }

    public function maritalTaxValue()
    {
        if ($this->has_couple == 0) {
            $_status = 0;
        } else
            $_status = ($this->count_children >= 3) ? 3 : $this->count_children;

        return $_status;
    }

    public function getEmployee_name_r()
    {
        if (in_array($this->mStatusId(), Yii::app()->getModule('m1')->PARAM_RESIGN_ARRAY)) {
            return $this->employee_name . " " . CHtml::tag("small", [], $this->mStatus());
            //} elseif (!in_array($this->mCompanyId(), sUser::model()->myGroupArray) && $this->many_career2C >= 1) {
            //    return $this->employee_name . " " . CHtml::tag("span", array('style' => 'font-size:inherit', 'class' => 'label label-info'), "Assignment");
        } else
            return $this->employee_name;
    }

    public function getLastID()
    {
        $connection = Yii::app()->db;
        $sqlRaw = "select employee_code_global from g_person ORDER BY employee_code_global DESC limit 1";
        $last = Yii::app()->db->createCommand($sqlRaw)->queryScalar();

        $number = (int)$last + 1;
        $format = str_pad($number, 6, '0', STR_PAD_LEFT);

        return $format;
    }

    public function afterSave()
    {
        if ($this->isNewRecord) {
            $model = new sNotification;
            $model->group_id = 1;
            $model->link = 'm1/gPerson/view/id/' . $this->id;
            $model->content = 'Person. New Employee created for <read>' . $this->employee_name . '</read>';
            $model->save(false);

            self::model()->updateByPk((int)$this->id, ['employee_code_global' => $this->lastID]);
        }
        return true;
    }

    public function afterDelete()
    {
        $model = new sNotification;
        $model->group_id = 1;
        $model->link = 'm1/gPerson/';
        $model->content = 'Person. Employee deleted for ' . $this->employee_name;
        $model->save(false);

        return true;
    }

    public function employeeRandom()
    {
        $criteria = new CDbCriteria;

        $criteria3 = new CDbCriteria; //8=RESIGN, 9=TERMINATION, 10=End Of Contract
        $criteria3->condition = '(select status_id from g_person_status s where s.parent_id = t.id ORDER BY start_date DESC LIMIT 1) NOT IN (' . implode(',', Yii::app()->getModule('m1')->PARAM_RESIGN_ARRAY) . ')';

        $criteria->mergeWith($criteria3);

        $dependency = new CDbCacheDependency('SELECT MAX(updated_date) FROM g_person');

        $models = gPerson::model()->findAll($criteria);

        foreach ($models as $model)
            $list[] = $model->id;

        $_gen = array_rand($list, 5);
        $_rand[] = $list[$_gen[0]];
        $_rand[] = $list[$_gen[1]];
        $_rand[] = $list[$_gen[2]];
        $_rand[] = $list[$_gen[3]];
        $_rand[] = $list[$_gen[4]];

        $criteria->addInCondition('t.id', $_rand);

        $dataProvider2 = new CActiveDataProvider(gPerson::model()->cache(3600, $dependency, 2), [
                //$dataProvider2=new CActiveDataProvider('gPerson', array(
                'criteria' => $criteria,
                'pagination' => [
                    'pageSize' => 5,
                ],
            ]
        );


        return $dataProvider2;
    }

    public function getEmployeeID()
    {
        $companyfirst = isset($this->companyfirst) ? date("Y", strtotime($this->companyfirst->start_date)) : "1900";
        $custom1 = peterFunc::issetC($this->company->company->custom1);
        $custom2 = peterFunc::issetC($this->company->company->custom2);
        $custom3 = peterFunc::issetC($this->company->company->custom3);

        $empid = $companyfirst .
            str_pad($this->employee_code_global, 6, '0', STR_PAD_LEFT) . ' - ' .
            str_pad($custom1, 3, '0', STR_PAD_LEFT) . ' - ' .
            str_pad($custom2, 1, '0', STR_PAD_LEFT) . ' - ' .
            str_pad($custom3, 2, '0', STR_PAD_LEFT) . ' - ' .
            str_pad($custom1, 3, '0', STR_PAD_LEFT);

        return $empid;
    }

    public function getEmployeeShortID()
    {
        $companyfirst = isset($this->companyfirst) ? date("Y", strtotime($this->companyfirst->start_date)) : "1900";

        $empid = $companyfirst . str_pad($this->employee_code_global, 6, '0', STR_PAD_LEFT);

        return $empid;
    }

    public function getEmployeeFinanceID()
    {
        $custom1 = peterFunc::issetC($this->company->company->custom1);
        $custom2 = peterFunc::issetC($this->company->company->custom2);
        $custom3 = peterFunc::issetC($this->company->company->custom3);

        $empid = str_pad($custom1, 3, '0', STR_PAD_LEFT) . ' - ' .
            str_pad($custom2, 1, '0', STR_PAD_LEFT) . ' - ' .
            str_pad($custom3, 2, '0', STR_PAD_LEFT) . ' - ' .
            str_pad($custom1, 3, '0', STR_PAD_LEFT);

        return $empid;
    }

    public function getCompletion()
    {
        $sql = '
			select 
			(if(length(g.birth_place) = 0 or isnull(g.birth_place),0,1) + if(length(g.birth_date) = 0 or isnull(g.birth_date),0,1) + if(length(g.address1) = 0 or isnull(g.address1),0,1) 
			  + if(length(g.identity_number) = 0 or isnull(g.identity_number),0,1) + if(length(g.identity_valid) = 0 or isnull(g.identity_valid),0,1) 
			  + if(length(g.identity_address1) = 0 or isnull(g.identity_address1),0,1) + if(length(g.c_pathfoto) = 0 or isnull(g.c_pathfoto),0,1) + if(length(g.account_number) = 0 or isnull(g.account_number),0,1) 
			  + if(length(g.account_name) = 0 or isnull(g.account_name),0,1) + if(length(g.bank_name) = 0 or isnull(g.bank_name),0,1) + if(length(g.blood_id) = 0 or isnull(g.blood_id),0,1) + if(length(g.email) = 0 or isnull(g.email),0,1) 
			  + if(length(g.handphone) = 0 or isnull(g.handphone),0,1)
			  + if((select count(ed.id) from g_person_education ed where ed.parent_id = g.id) = 0,0,1) 
			  + if((select count(ex.id) from g_person_experience ex where ex.parent_id = g.id) = 0,0,1) 
			  + if((select count(ef.id) from g_person_family ef where ef.parent_id = g.id) = 0,0,1) 
			  + if((select ec.superior_id from g_person_career ec where ec.parent_id = g.id order by ec.start_date DESC LIMIT 1) is Null,0,1) 
			  
			  ) / 17 * 100  as t_total

			from g_person g
                        where g.id =' . $this->id;

        $_percent = Yii::app()->db->createCommand($sql)->queryScalar();

        return $_percent;
    }

    public function getCompletionTalent()
    {
        $sql = '
			select
			(
			  /*  if((select count(cp.id) from g_talent_competency_profile cp where cp.parent_id = g.id) = 0,0,1)
			  + if((select count(cc.id) from g_talent_core_competency cc where cc.parent_id = g.id) = 0,0,1)
			  + if((select count(lc.id) from g_talent_leadership_competency lc where lc.parent_id = g.id) = 0,0,1)
			  + if((select count(tp.id) from g_talent_potential tp where tp.parent_id = g.id) = 0,0,1)
			  + if((select count(ts.id) from g_talent_target_setting ts where ts.parent_id = g.id) = 0,0,1)
			  + if((select count(wr.id) from g_talent_work_result wr where wr.parent_id = g.id) = 0,0,1)
			  + if((select count(pr.id) from g_talent_performance pr where pr.parent_id = g.id) = 0,0,1) */

			  /*  if((select count(pr.id) from g_talent_performance pr where pr.year = 2011 AND pr.parent_id = g.id) = 0,0,1)
			   + if((select count(pr.id) from g_talent_performance pr where pr.year = 2012 AND pr.parent_id = g.id) = 0,0,1)
			  + */ if((select count(pr.id) from g_talent_performance pr where pr.year = 2013 AND pr.parent_id = g.id) = 0,0,1)

			) / 1 * 100  as t_total

			from g_person g
                        where g.id =' . $this->id;

        $_percent = Yii::app()->db->createCommand($sql)->queryScalar();

        return $_percent;
    }


    public static function getUncomplete()
    {
        $sql = '
			select 1 as id, "Birth Place | Birth Date" as  components,
			count(id) as t_count,
			(sum(x_birth_place) + sum(x_birth_date) ) / 2 as t_total
			from g_bi_uncomplete
			where company_id = ' . sUser::model()->myGroup . ' 
			UNION ALL
			select 2, "Address | Identity Number | Identity Valid | Identity Address",
			count(id) as t_count,
			(sum(x_address1) 
			  + sum(x_identity_number) + sum(x_identity_valid) 
			  + sum(x_identity_address1)) / 4 as t_total
			from g_bi_uncomplete
			where company_id = ' . sUser::model()->myGroup . ' 
			UNION ALL
			select 3, "Photo",
			count(id) as t_count,
			sum(x_c_pathfoto) as t_total
			from g_bi_uncomplete
			where company_id = ' . sUser::model()->myGroup . ' 
			UNION ALL
			select 4, "Account Number | Account Name | Bank Name",
			count(id) as t_count,
			(sum(x_account_number) 
			  + sum(x_account_name) + sum(x_bank_name)) / 3 as t_total
			from g_bi_uncomplete
			where company_id = ' . sUser::model()->myGroup . ' 
			UNION ALL
			select 5, "Blood | Email | Handphone",
			count(id) as t_count,
			(sum(x_blood_id) + sum(x_email) 
			  + sum(x_handphone)) / 3 as t_total
			from g_bi_uncomplete
			where company_id = ' . sUser::model()->myGroup . ' 
			UNION ALL
			select 12, "Education",count(id) as Total,sum(x_education)
			from g_bi_uncomplete
			where company_id = ' . sUser::model()->myGroup . '
			UNION ALL
			select 13, "Family",count(id) as Total,sum(x_family)
			from g_bi_uncomplete
			where company_id = ' . sUser::model()->myGroup . '
			UNION ALL
			select 14, "Experience",count(id) as Total,sum(x_experience)
			from g_bi_uncomplete
			where company_id = ' . sUser::model()->myGroup . '
			UNION ALL
			select 15, "Education Non Formal",count(id) as Total,sum(x_education_nf)
			from g_bi_uncomplete
			where company_id = ' . sUser::model()->myGroup . '
			UNION ALL
			select 16, "Other Info",count(id) as Total,sum(x_other)
			from g_bi_uncomplete
			where company_id = ' . sUser::model()->myGroup;

        $dependency = new CDbCacheDependency('SELECT MAX(updated_date) FROM g_person');

        //$rawData = Yii::app()->db->cache(3600, $dependency)->createCommand($sql)->queryAll();
        $rawData = Yii::app()->db->createCommand($sql)->queryAll();
        $dataProvider = new CArrayDataProvider($rawData, [
            'id' => 'uncomplete',
            'sort' => [
                'attributes' => [
                    'components',
                ],
            ],
            'pagination' => false,
        ]);

        return $dataProvider;
    }

    public static function getUncompleteHolding($name)
    {
        if ($name == "basic") {
            $sql = '
				select company_id, company,
				count(id) as t_count,
				(sum(x_birth_place) + sum(x_birth_date) + sum(x_address1) 
				  + sum(x_identity_number) + sum(x_identity_valid) 
				  + sum(x_identity_address1) + sum(x_c_pathfoto) + sum(x_account_number) 
				  + sum(x_account_name) + sum(x_bank_name) + sum(x_blood_id) + sum(x_email) 
				  + sum(x_handphone)) / 13 as t_total
				from g_bi_uncomplete 
							group by company_id ';
        } elseif ($name == "education") {
            $sql = '
				select company_id, company,
				count(id) as t_count,
				sum(x_education) as t_total
				from g_bi_uncomplete 
							group by company_id ';
        } elseif ($name == "family") {
            $sql = '
				select company_id, company,
				count(id) as t_count,
				sum(x_family) as t_total
				from g_bi_uncomplete 
							group by company_id ';
        } elseif ($name == "experience") {
            $sql = '
				select company_id, company,
				count(id) as t_count,
				sum(x_experience) as t_total
				from g_bi_uncomplete 
							group by company_id ';
        } elseif ($name == "educationnf") {
            $sql = '
				select company_id, company,
				count(id) as t_count,
				sum(x_education_nf) as t_total
				from g_bi_uncomplete 
							group by company_id ';
        } elseif ($name == "other") {
            $sql = '
				select company_id, company,
				count(id) as t_count,
				sum(x_other) as t_total
				from g_bi_uncomplete 
							group by company_id ';
        }

        $rawData = Yii::app()->db->createCommand($sql)->queryAll();

        foreach ($rawData as $row) {
            $_item[] = (int)($row['t_total'] / $row['t_count'] * 100);
        }
        return $_item;
    }

    public static function getUncompleteHoldingCompany()
    {
        $sql = '
			select company_id, company_code, company,
			count(id) as t_count,
			(sum(x_birth_place) + sum(x_birth_date) + sum(x_address1) 
			  + sum(x_identity_number) + sum(x_identity_valid) 
			  + sum(x_identity_address1) + sum(x_c_pathfoto) + sum(x_account_number) 
			  + sum(x_account_name) + sum(x_bank_name) + sum(x_blood_id) + sum(x_email) 
			  + sum(x_handphone)) / 13 as t_total

			from g_bi_uncomplete 
                        group by company_id ';

        $rawData = Yii::app()->db->createCommand($sql)->queryAll();

        foreach ($rawData as $row) {
            $_item[] = $row['company_code'];
        }
        return $_item;
    }

    public function uncompleteList()
    {

        $criteria = new CDbCriteria;

        //Tahap 1
        $criteria->condition = 'birth_place is null or birth_date is null or address1 is null
		or identity_number is null or identity_valid is null or identity_address1 is null';

        //Tahap 2
        //$criteria->condition='birth_place is null or birth_date is null or address1 is null
        //or identity_number is null or identity_valid is null or identity_address1 is null or
        //handphone is null or c_pathfoto is null or account_number is null or bank_name is null or
        //account_name is null';
        //if (Yii::app()->user->name != "admin") {
        $criteria1 = new CDbCriteria;
        $criteria1->condition = '(select c.company_id from g_person_career c WHERE t.id=c.parent_id AND c.status_id IN (' . implode(',', Yii::app()->getModule('m1')->PARAM_COMPANY_ARRAY) . ') ORDER BY c.start_date DESC LIMIT 1) IN (' . implode(",", sUser::model()->myGroupArray) . ')';
        $criteria->mergeWith($criteria1);
        //}
        $criteria3 = new CDbCriteria; //8=RESIGN, 9=TERMINATION, 10=End Of Contract
        $criteria3->condition = '(select status_id from g_person_status s where s.parent_id = t.id ORDER BY start_date DESC LIMIT 1) NOT IN (' . implode(',', Yii::app()->getModule('m1')->PARAM_RESIGN_ARRAY) . ')';
        $criteria->mergeWith($criteria3);

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            'pagination' => [
                'pageSize' => 50,
            ],
            'sort' => [
                'defaultOrder' => 'employee_name'
            ]
        ]);
    }

    public function employeeMutationRequest()
    {
        $criteria = new CDbCriteria;

        $criteria2 = new CDbCriteria;
        $criteria2->condition = '
	        (select `s`.`status_id` AS `status_id` from `g_person_status` `s`
            	where `s`.`parent_id` = `t`.`id` order by `s`.`start_date` desc limit 1) = 14
				
				';
        $criteria->mergeWith($criteria2);

        $criteria->order = 'updated_date DESC';

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            'pagination' => false,
        ]);
    }

    public function attendanceStat()
    {

        $sql = "
                    	SELECT a.id, a.employee_name, '" . date('Y') . date('m') . "' as period, 0 as cmonth,
							(select count(id) from g_attendance 
							where parent_id = a.id and CONCAT(year(cdate),lpad(month(cdate),2,'0')) = " . date('Y') . date('m') . ") as xcount, 

							(select date_format(sec_to_time(sum(time_to_sec(TIMEDIFF(subtime(g.`out`,'01:00:00'), g.`in`)))),'%H.%i.%s') from g_attendance g 
								inner join g_param_timeblock t on t.id = g.realpattern_id
								where g.parent_id = a.id and CONCAT(year(g.cdate), lpad(month(g.cdate),2,'0')) = " . date('Y') . date('m') . " and g.cdate <= '" . date('Y-m-d', strtotime('yesterday')) . "' and g.realpattern_id NOT IN (90,89))
								as workhour,

							(select sum(number_of_day) from g_leave where parent_id = a.id and CONCAT(year(start_date),lpad(month(start_date),2,'0')) = " . date('Y') . date('m') . " and start_date <= '" . date('Y-m-d', strtotime('yesterday')) . "' and approved_id = 2) 
							as cuti,

							((select count(id) from g_attendance 
							where parent_id = a.id and CONCAT(year(cdate),lpad(month(cdate),2,'0')) = " . date('Y') . date('m') . " 
								and cdate <= '" . date('Y-m-d', strtotime('yesterday')) . "' 
								and realpattern_id NOT IN (90,89)  and `out` is null and `in` is null) 
								-
							(ifnull((select sum(number_of_day) from g_leave where parent_id = a.id and CONCAT(year(start_date),lpad(month(start_date),2,'0')) = " . date('Y') . date('m') . " and start_date <= '" . date('Y-m-d', strtotime('yesterday')) . "' and approved_id = 2),0)) 
							-
							(ifnull((select sum(datediff(end_date,start_date)+1) from g_permission 
							where parent_id = a.id and permission_type_id = 10 and concat(year(start_date), lpad(month(start_date),2,'0')) = " . date('Y') . date('m') . " 
								and start_date <= '" . date('Y-m-d', strtotime('yesterday')) . "'),0))
								) 
							-
							(ifnull((select sum(datediff(end_date,start_date)+1) from g_permission 
							where parent_id = a.id and permission_type_id IN (1,2,3,4,5,6,7,8,9,15,17,19) and concat(year(start_date), lpad(month(start_date),2,'0')) = " . date('Y') . date('m') . " 
								and start_date <= '" . date('Y-m-d', strtotime('yesterday')) . "'),0)) 

								  as alpha,

							(select count(g.id) from g_attendance g 
								inner join g_param_timeblock t on t.id = g.realpattern_id
								where g.parent_id = a.id and CONCAT(year(g.cdate), lpad(month(g.cdate),2,'0')) = " . date('Y') . date('m') . " and g.cdate <= '" . date('Y-m-d', strtotime('yesterday')) . "' and g.realpattern_id NOT IN (90,89)
								and TIMEDIFF(CONCAT(date_format(g.in,'%Y-%m-%d'),' ', date_format(t.in,'%H:%i:59')),g.`in`) < 0) 
								as lateIn,

							(select date_format(sec_to_time(sum(time_to_sec(TIMEDIFF(g.`in`, CONCAT(date_format(g.in,'%Y-%m-%d'),' ', date_format(t.in,'%H:%i:59')))))),'%H.%i.%s') from g_attendance g 
								inner join g_param_timeblock t on t.id = g.realpattern_id
								where g.parent_id = a.id and CONCAT(year(g.cdate), lpad(month(g.cdate),2,'0')) = " . date('Y') . date('m') . " and g.cdate <= '" . date('Y-m-d', strtotime('yesterday')) . "' and g.realpattern_id NOT IN (90,89)
								and TIMEDIFF(CONCAT(date_format(g.in,'%Y-%m-%d'),' ', date_format(t.in,'%H:%i:59')),g.`in`) < 0) 
								as lateInCount,

							(select count(g.id) from g_attendance g 
								inner join g_param_timeblock t on t.id = g.realpattern_id
								where g.parent_id = a.id and CONCAT(year(g.cdate), lpad(month(g.cdate),2,'0')) = " . date('Y') . date('m') . " and g.cdate <= '" . date('Y-m-d', strtotime('yesterday')) . "' and g.realpattern_id NOT IN (90,89)
								and TIMEDIFF(g.out, CONCAT(date_format(g.in,'%Y-%m-%d'),' ', date_format(t.out,'%H:%i:00'))) < 0) 
								as earlyOut,

							(select date_format(sec_to_time(sum(time_to_sec(TIMEDIFF(CONCAT(date_format(g.in,'%Y-%m-%d'),' ', date_format(t.out,'%H:%i:00')), g.out)))),'%H.%i.%s') from g_attendance g 
								inner join g_param_timeblock t on t.id = g.realpattern_id
								where g.parent_id = a.id and CONCAT(year(g.cdate), lpad(month(g.cdate),2,'0')) = " . date('Y') . date('m') . " and g.cdate <= '" . date('Y-m-d', strtotime('yesterday')) . "' and g.realpattern_id NOT IN (90,89)
								and TIMEDIFF(g.out, CONCAT(date_format(g.in,'%Y-%m-%d'),' ', date_format(t.out,'%H:%i:00'))) < 0) 
								as earlyOutCount,

							(select count(id) from g_attendance where parent_id = a.id and CONCAT(year(cdate),lpad(month(cdate),2,'0')) = " . date('Y') . date('m') . " and cdate <= '" . date('Y-m-d', strtotime('yesterday')) . "' and realpattern_id NOT IN (90,89) and `out` is not null and `in` is null) 
							as tad,
							(select count(id) from g_attendance where parent_id = a.id and CONCAT(year(cdate),lpad(month(cdate),2,'0')) = " . date('Y') . date('m') . " and cdate <= '" . date('Y-m-d', strtotime('yesterday')) . "' and realpattern_id NOT IN (90,89) and `out` is null and `in` is not null) 
							as tap,

							(select sum(datediff(end_date,start_date)+1) from g_permission 
							where parent_id = a.id and permission_type_id = 10 and concat(year(start_date), lpad(month(start_date),2,'0')) = " . date('Y') . date('m') . " 
								and start_date <= '" . date('Y-m-d', strtotime('yesterday')) . "') 
							as sakit,
							
							(select sum(datediff(end_date,start_date)+1) from g_permission 
							where parent_id = a.id and permission_type_id IN (1,2,3,4,5,6,7,8,9,15,19) and concat(year(start_date), lpad(month(start_date),2,'0')) = " . date('Y') . date('m') . " 
								and start_date <= '" . date('Y-m-d', strtotime('yesterday')) . "') 
							as special

						FROM g_person a
						WHERE id = " . $this->id . "
	
						UNION ALL 
						
                    	SELECT a.id, a.employee_name, '" . peterFunc::cBeginDateBefore(date('Y') . date('m')) . "' as period, -1 as cmonth,
							(select count(id) from g_attendance 
							where parent_id = a.id and CONCAT(year(cdate),lpad(month(cdate),2,'0')) = " . peterFunc::cBeginDateBefore(date('Y') . date('m')) . ") as xcount, 

							(select date_format(sec_to_time(sum(time_to_sec(TIMEDIFF(subtime(g.`out`,'01:00:00'), g.`in`)))),'%H.%i.%s') from g_attendance g 
								inner join g_param_timeblock t on t.id = g.realpattern_id
								where g.parent_id = a.id and CONCAT(year(g.cdate), lpad(month(g.cdate),2,'0')) = " . peterFunc::cBeginDateBefore(date('Y') . date('m')) . " and g.cdate <= '" . date('Y-m-d', strtotime('yesterday')) . "' and g.realpattern_id NOT IN (90,89))
								as workhour,

							(select sum(number_of_day) from g_leave where parent_id = a.id and CONCAT(year(start_date),lpad(month(start_date),2,'0')) = " . peterFunc::cBeginDateBefore(date('Y') . date('m')) . " and start_date <= '" . date('Y-m-d', strtotime('yesterday')) . "' and approved_id = 2) 
							as cuti,

							((select count(id) from g_attendance 
							where parent_id = a.id and CONCAT(year(cdate),lpad(month(cdate),2,'0')) = " . peterFunc::cBeginDateBefore(date('Y') . date('m')) . " 
								and cdate <= '" . date('Y-m-d', strtotime('yesterday')) . "' 
								and realpattern_id NOT IN (90,89)  and `out` is null and `in` is null) 
								-
							(ifnull((select sum(number_of_day) from g_leave where parent_id = a.id and CONCAT(year(start_date),lpad(month(start_date),2,'0')) = " . peterFunc::cBeginDateBefore(date('Y') . date('m')) . " and start_date <= '" . date('Y-m-d', strtotime('yesterday')) . "' and approved_id = 2),0)) 
							-
							(ifnull((select sum(datediff(end_date,start_date)+1) from g_permission 
							where parent_id = a.id and permission_type_id = 10 and concat(year(start_date), lpad(month(start_date),2,'0')) = " . peterFunc::cBeginDateBefore(date('Y') . date('m')) . " 
								and start_date <= '" . date('Y-m-d', strtotime('yesterday')) . "'),0))
								) 
							-
							(ifnull((select sum(datediff(end_date,start_date)+1) from g_permission 
							where parent_id = a.id and permission_type_id IN (1,2,3,4,5,6,7,8,9,15,17,19) and concat(year(start_date), lpad(month(start_date),2,'0')) = " . peterFunc::cBeginDateBefore(date('Y') . date('m')) . " 
								and start_date <= '" . date('Y-m-d', strtotime('yesterday')) . "'),0)) 

								  as alpha,

							(select count(g.id) from g_attendance g 
								inner join g_param_timeblock t on t.id = g.realpattern_id
								where g.parent_id = a.id and CONCAT(year(g.cdate), lpad(month(g.cdate),2,'0')) = " . peterFunc::cBeginDateBefore(date('Y') . date('m')) . " and g.cdate <= '" . date('Y-m-d', strtotime('yesterday')) . "' and g.realpattern_id NOT IN (90,89)
								and TIMEDIFF(CONCAT(date_format(g.in,'%Y-%m-%d'),' ', date_format(t.in,'%H:%i:59')),g.`in`) < 0) 
								as lateIn,

							(select date_format(sec_to_time(sum(time_to_sec(TIMEDIFF(g.`in`, CONCAT(date_format(g.in,'%Y-%m-%d'),' ', date_format(t.in,'%H:%i:59')))))),'%H.%i.%s') from g_attendance g 
								inner join g_param_timeblock t on t.id = g.realpattern_id
								where g.parent_id = a.id and CONCAT(year(g.cdate), lpad(month(g.cdate),2,'0')) = " . peterFunc::cBeginDateBefore(date('Y') . date('m')) . " and g.cdate <= '" . date('Y-m-d', strtotime('yesterday')) . "' and g.realpattern_id NOT IN (90,89)
								and TIMEDIFF(CONCAT(date_format(g.in,'%Y-%m-%d'),' ', date_format(t.in,'%H:%i:59')),g.`in`) < 0) 
								as lateInCount,

							(select count(g.id) from g_attendance g 
								inner join g_param_timeblock t on t.id = g.realpattern_id
								where g.parent_id = a.id and CONCAT(year(g.cdate), lpad(month(g.cdate),2,'0')) = " . peterFunc::cBeginDateBefore(date('Y') . date('m')) . " and g.cdate <= '" . date('Y-m-d', strtotime('yesterday')) . "' and g.realpattern_id NOT IN (90,89)
								and TIMEDIFF(g.out, CONCAT(date_format(g.in,'%Y-%m-%d'),' ', date_format(t.out,'%H:%i:00'))) < 0) 
								as earlyOut,

							(select date_format(sec_to_time(sum(time_to_sec(TIMEDIFF(CONCAT(date_format(g.in,'%Y-%m-%d'),' ', date_format(t.out,'%H:%i:00')), g.out)))),'%H.%i.%s') from g_attendance g 
								inner join g_param_timeblock t on t.id = g.realpattern_id
								where g.parent_id = a.id and CONCAT(year(g.cdate), lpad(month(g.cdate),2,'0')) = " . peterFunc::cBeginDateBefore(date('Y') . date('m')) . " and g.cdate <= '" . date('Y-m-d', strtotime('yesterday')) . "' and g.realpattern_id NOT IN (90,89)
								and TIMEDIFF(g.out, CONCAT(date_format(g.in,'%Y-%m-%d'),' ', date_format(t.out,'%H:%i:00'))) < 0) 
								as earlyOutCount,

							(select count(id) from g_attendance where parent_id = a.id and CONCAT(year(cdate),lpad(month(cdate),2,'0')) = " . peterFunc::cBeginDateBefore(date('Y') . date('m')) . " and cdate <= '" . date('Y-m-d', strtotime('yesterday')) . "' and realpattern_id NOT IN (90,89) and `out` is not null and `in` is null) 
							as tad,
							(select count(id) from g_attendance where parent_id = a.id and CONCAT(year(cdate),lpad(month(cdate),2,'0')) = " . peterFunc::cBeginDateBefore(date('Y') . date('m')) . " and cdate <= '" . date('Y-m-d', strtotime('yesterday')) . "' and realpattern_id NOT IN (90,89) and `out` is null and `in` is not null) 
							as tap,

							(select sum(datediff(end_date,start_date)+1) from g_permission 
							where parent_id = a.id and permission_type_id = 10 and concat(year(start_date), lpad(month(start_date),2,'0')) = " . peterFunc::cBeginDateBefore(date('Y') . date('m')) . " 
								and start_date <= '" . date('Y-m-d', strtotime('yesterday')) . "') 
							as sakit,
							
							(select sum(datediff(end_date,start_date)+1) from g_permission 
							where parent_id = a.id and permission_type_id IN (1,2,3,4,5,6,7,8,9,15,19) and concat(year(start_date), lpad(month(start_date),2,'0')) = " . peterFunc::cBeginDateBefore(date('Y') . date('m')) . " 
								and start_date <= '" . date('Y-m-d', strtotime('yesterday')) . "') 
							as special

						FROM g_person a
						WHERE id = " . $this->id . "

						UNION ALL 
						
                    	SELECT a.id, a.employee_name, '" . peterFunc::cBeginDateBefore(peterFunc::cBeginDateBefore(date('Y') . date('m'))) . "' as period, -2 as cmonth,
							(select count(id) from g_attendance 
							where parent_id = a.id and CONCAT(year(cdate),lpad(month(cdate),2,'0')) = " . peterFunc::cBeginDateBefore(peterFunc::cBeginDateBefore(date('Y') . date('m'))) . ") as xcount, 

							(select date_format(sec_to_time(sum(time_to_sec(TIMEDIFF(subtime(g.`out`,'01:00:00'), g.`in`)))),'%H.%i.%s') from g_attendance g 
								inner join g_param_timeblock t on t.id = g.realpattern_id
								where g.parent_id = a.id and CONCAT(year(g.cdate), lpad(month(g.cdate),2,'0')) = " . peterFunc::cBeginDateBefore(peterFunc::cBeginDateBefore(date('Y') . date('m'))) . " and g.cdate <= '" . date('Y-m-d', strtotime('yesterday')) . "' and g.realpattern_id NOT IN (90,89))
								as workhour,

							(select sum(number_of_day) from g_leave where parent_id = a.id and CONCAT(year(start_date),lpad(month(start_date),2,'0')) = " . peterFunc::cBeginDateBefore(peterFunc::cBeginDateBefore(date('Y') . date('m'))) . " and start_date <= '" . date('Y-m-d', strtotime('yesterday')) . "' and approved_id = 2) 
							as cuti,

							((select count(id) from g_attendance 
							where parent_id = a.id and CONCAT(year(cdate),lpad(month(cdate),2,'0')) = " . peterFunc::cBeginDateBefore(peterFunc::cBeginDateBefore(date('Y') . date('m'))) . " 
								and cdate <= '" . date('Y-m-d', strtotime('yesterday')) . "' 
								and realpattern_id NOT IN (90,89)  and `out` is null and `in` is null) 
								-
							(ifnull((select sum(number_of_day) from g_leave where parent_id = a.id and CONCAT(year(start_date),lpad(month(start_date),2,'0')) = " . peterFunc::cBeginDateBefore(peterFunc::cBeginDateBefore(date('Y') . date('m'))) . " and start_date <= '" . date('Y-m-d', strtotime('yesterday')) . "' and approved_id = 2),0)) 
							-
							(ifnull((select sum(datediff(end_date,start_date)+1) from g_permission 
							where parent_id = a.id and permission_type_id = 10 and concat(year(start_date), lpad(month(start_date),2,'0')) = " . peterFunc::cBeginDateBefore(peterFunc::cBeginDateBefore(date('Y') . date('m'))) . " 
								and start_date <= '" . date('Y-m-d', strtotime('yesterday')) . "'),0))
								) 
							-
							(ifnull((select sum(datediff(end_date,start_date)+1) from g_permission 
							where parent_id = a.id and permission_type_id IN (1,2,3,4,5,6,7,8,9,15,17,19) and concat(year(start_date), lpad(month(start_date),2,'0')) = " . peterFunc::cBeginDateBefore(peterFunc::cBeginDateBefore(date('Y') . date('m'))) . " 
								and start_date <= '" . date('Y-m-d', strtotime('yesterday')) . "'),0)) 

								  as alpha,

							(select count(g.id) from g_attendance g 
								inner join g_param_timeblock t on t.id = g.realpattern_id
								where g.parent_id = a.id and CONCAT(year(g.cdate), lpad(month(g.cdate),2,'0')) = " . peterFunc::cBeginDateBefore(peterFunc::cBeginDateBefore(date('Y') . date('m'))) . " and g.cdate <= '" . date('Y-m-d', strtotime('yesterday')) . "' and g.realpattern_id NOT IN (90,89)
								and TIMEDIFF(CONCAT(date_format(g.in,'%Y-%m-%d'),' ', date_format(t.in,'%H:%i:59')),g.`in`) < 0) 
								as lateIn,

							(select date_format(sec_to_time(sum(time_to_sec(TIMEDIFF(g.`in`, CONCAT(date_format(g.in,'%Y-%m-%d'),' ', date_format(t.in,'%H:%i:59')))))),'%H.%i.%s') from g_attendance g 
								inner join g_param_timeblock t on t.id = g.realpattern_id
								where g.parent_id = a.id and CONCAT(year(g.cdate), lpad(month(g.cdate),2,'0')) = " . peterFunc::cBeginDateBefore(peterFunc::cBeginDateBefore(date('Y') . date('m'))) . " and g.cdate <= '" . date('Y-m-d', strtotime('yesterday')) . "' and g.realpattern_id NOT IN (90,89)
								and TIMEDIFF(CONCAT(date_format(g.in,'%Y-%m-%d'),' ', date_format(t.in,'%H:%i:59')),g.`in`) < 0) 
								as lateInCount,

							(select count(g.id) from g_attendance g 
								inner join g_param_timeblock t on t.id = g.realpattern_id
								where g.parent_id = a.id and CONCAT(year(g.cdate), lpad(month(g.cdate),2,'0')) = " . peterFunc::cBeginDateBefore(peterFunc::cBeginDateBefore(date('Y') . date('m'))) . " and g.cdate <= '" . date('Y-m-d', strtotime('yesterday')) . "' and g.realpattern_id NOT IN (90,89)
								and TIMEDIFF(g.out, CONCAT(date_format(g.in,'%Y-%m-%d'),' ', date_format(t.out,'%H:%i:00'))) < 0) 
								as earlyOut,

							(select date_format(sec_to_time(sum(time_to_sec(TIMEDIFF(CONCAT(date_format(g.in,'%Y-%m-%d'),' ', date_format(t.out,'%H:%i:00')), g.out)))),'%H.%i.%s') from g_attendance g 
								inner join g_param_timeblock t on t.id = g.realpattern_id
								where g.parent_id = a.id and CONCAT(year(g.cdate), lpad(month(g.cdate),2,'0')) = " . peterFunc::cBeginDateBefore(peterFunc::cBeginDateBefore(date('Y') . date('m'))) . " and g.cdate <= '" . date('Y-m-d', strtotime('yesterday')) . "' and g.realpattern_id NOT IN (90,89)
								and TIMEDIFF(g.out, CONCAT(date_format(g.in,'%Y-%m-%d'),' ', date_format(t.out,'%H:%i:00'))) < 0) 
								as earlyOutCount,

							(select count(id) from g_attendance where parent_id = a.id and CONCAT(year(cdate),lpad(month(cdate),2,'0')) = " . peterFunc::cBeginDateBefore(peterFunc::cBeginDateBefore(date('Y') . date('m'))) . " and cdate <= '" . date('Y-m-d', strtotime('yesterday')) . "' and realpattern_id NOT IN (90,89) and `out` is not null and `in` is null) 
							as tad,
							(select count(id) from g_attendance where parent_id = a.id and CONCAT(year(cdate),lpad(month(cdate),2,'0')) = " . peterFunc::cBeginDateBefore(peterFunc::cBeginDateBefore(date('Y') . date('m'))) . " and cdate <= '" . date('Y-m-d', strtotime('yesterday')) . "' and realpattern_id NOT IN (90,89) and `out` is null and `in` is not null) 
							as tap,

							(select sum(datediff(end_date,start_date)+1) from g_permission 
							where parent_id = a.id and permission_type_id = 10 and concat(year(start_date), lpad(month(start_date),2,'0')) = " . peterFunc::cBeginDateBefore(peterFunc::cBeginDateBefore(date('Y') . date('m'))) . " 
								and start_date <= '" . date('Y-m-d', strtotime('yesterday')) . "') 
							as sakit,
							
							(select sum(datediff(end_date,start_date)+1) from g_permission 
							where parent_id = a.id and permission_type_id IN (1,2,3,4,5,6,7,8,9,15,19) and concat(year(start_date), lpad(month(start_date),2,'0')) = " . peterFunc::cBeginDateBefore(peterFunc::cBeginDateBefore(date('Y') . date('m'))) . " 
								and start_date <= '" . date('Y-m-d', strtotime('yesterday')) . "') 
							as special

						FROM g_person a
						WHERE id = " . $this->id;

        $rawData = Yii::app()->db->createCommand($sql)->queryAll();
        $dataProvider = new CArrayDataProvider($rawData, [
            'id' => 'stat',
            'pagination' => false,
        ]);

        return $dataProvider;
    }

    public function getCountAttendance($period)
    {
        $criteria = new CDbCriteria;
        $criteria->with = ['many_attendance'];
        $criteria->condition = "CONCAT(year(cdate),lpad(month(cdate),2,'0')) = " . peterFunc::cBeginDateBefore(date('Y') . date('m')) . " and parent_id = " . $this->id;

        $count = self::model()->count($criteria);

        return $count;
    }

    public function getReminder()
    {
        $message = CHtml::link($this->employee_name, Yii::app()->createUrl('m1/gPerson/view', ['id' => $this->id]))
            . "<br/>" . $this->mStatus() . ". " . $this->mStatus() . " status is " . $this->countContract();
        return $message;
    }

    public function getReminder2()
    {
        $message = "Newly Employee. " . CHtml::link(strtoupper($this->employee_name), Yii::app()->createUrl('m1/gPerson/view', ['id' => $this->id])) . " " . $this->mStatus() . " status is " . $this->countJoinDate();
        return $message;
    }

    public function getIsValidEmail()
    {
        $value = "";
        if (in_array($this->email, require(dirname(__FILE__) . '/../../../config/blacklistEmail.php')))
            $value = CHtml::tag("span", ['class' => 'badge badge-error'], "Invalid / Inactive / Bouncing Email");
        return $value;
    }

    public function getCloakEmail()
    {
        $at = str_replace('@', ' at ', $this->email);
        //$dot = str_replace('.',' dot ',$at);

        return $at;
    }

    public function getIsValidProfile()
    {
        $value = "";
        if (in_array($this->email, require(dirname(__FILE__) . '/../../../config/blacklistEmail.php')))
            $value = CHtml::tag("span", ['class' => 'badge badge-error'], "1 Error");
        return $value;
    }

    public function getNewMutation()
    {
        $criteria = new CDbCriteria;

        //$criteria1=new CDbCriteria;

        $criteria->condition = '((select s.status_id from g_person_status s WHERE t.id=s.parent_id ORDER BY s.start_date DESC LIMIT 1) NOT IN 
        (' . implode(",", Yii::app()->getModule("m1")->PARAM_RESIGN_ARRAY) . ') AND ' .
            '(select c.company_id from g_person_career c WHERE t.id=c.parent_id AND c.status_id IN (' .
            implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) .
            ') ORDER BY c.start_date DESC LIMIT 1) IN (' .
            implode(",", sUser::model()->myGroupArray) . ')) AND ' .
            '(select concat(left(a.start_date,4),mid(a.start_date,6,2)) from g_person_career a
        WHERE t.id=a.parent_id AND status_id IN (3,4) ORDER BY a.start_date DESC LIMIT 1) = ' . date("Ym");


        //$criteria->mergeWith($criteria1);

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
        ]);
    }

    public function getNewPromotion()
    {
        $criteria = new CDbCriteria;

        //$criteria1=new CDbCriteria;

        $criteria->condition = '((select s.status_id from g_person_status s WHERE t.id=s.parent_id ORDER BY s.start_date DESC LIMIT 1) NOT IN 
        (' . implode(",", Yii::app()->getModule("m1")->PARAM_RESIGN_ARRAY) . ') AND ' .
            '(select c.company_id from g_person_career c WHERE t.id=c.parent_id AND c.status_id IN (' .
            implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) .
            ') ORDER BY c.start_date DESC LIMIT 1) IN (' .
            implode(",", sUser::model()->myGroupArray) . ')) AND ' .
            '(select concat(left(a.start_date,4),mid(a.start_date,6,2)) from g_person_career a
        WHERE t.id=a.parent_id AND status_id IN (5) ORDER BY a.start_date DESC LIMIT 1) = ' . date("Ym");


        //$criteria->mergeWith($criteria1);

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
        ]);
    }

    public function getNewResign()
    {
        $criteria = new CDbCriteria;

        $criteria->condition = '(select s.status_id from g_person_status s WHERE t.id=s.parent_id ORDER BY s.start_date DESC LIMIT 1) IN 
        (' . implode(",", Yii::app()->getModule("m1")->PARAM_RESIGN_ARRAY) . ') AND ' .
            '(select concat(left(a.start_date,4),mid(a.start_date,6,2)) from g_person_status a
        WHERE t.id=a.parent_id AND status_id IN (' . implode(",", Yii::app()->getModule("m1")->PARAM_RESIGN_ARRAY) . ')
             ORDER BY a.start_date DESC LIMIT 1) = ' . date("Ym") . ' AND ' .
            ' (select c.company_id from g_person_career c WHERE t.id=c.parent_id AND c.status_id IN (' .
            implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) .
            ') ORDER BY c.start_date DESC LIMIT 1) IN (' .
            implode(",", sUser::model()->myGroupArray) . ')';

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
        ]);
    }

    //Used for PRODESI Module
    public function getNewMutationAll($periode)
    {
        if ($periode == null)
            $periode = date("Ym");
        $criteria = new CDbCriteria;
        $criteria->condition = '(select s.status_id from g_person_status s WHERE t.id=s.parent_id ORDER BY s.start_date DESC LIMIT 1) NOT IN 
        (' . implode(",", Yii::app()->getModule("m1")->PARAM_RESIGN_ARRAY) . ') AND ' .
            '(select concat(left(a.start_date,4),mid(a.start_date,6,2)) from g_person_career a
        WHERE t.id=a.parent_id AND status_id IN (3,4) ORDER BY a.start_date DESC LIMIT 1) = ' . $periode;

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
        ]);
    }

    //Used for PRODESI Module
    public function getNewPromotionAll($periode)
    {
        if ($periode == null)
            $periode = date("Ym");

        $criteria = new CDbCriteria;

        //$criteria1=new CDbCriteria;

        $criteria->condition = '(select s.status_id from g_person_status s WHERE t.id=s.parent_id ORDER BY s.start_date DESC LIMIT 1) NOT IN 
        (' . implode(",", Yii::app()->getModule("m1")->PARAM_RESIGN_ARRAY) . ') AND ' .
            '(select concat(left(a.start_date,4),mid(a.start_date,6,2)) from g_person_career a
        WHERE t.id=a.parent_id AND status_id IN (5) ORDER BY a.start_date DESC LIMIT 1) = ' . $periode;


        //$criteria->mergeWith($criteria1);

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            'pagination' => false
        ]);
    }

    //add by Sani Iman Pribadi
    public function getFilter()
    {
        $where = 'WHERE TRUE';
        $where .= " AND company_id = " . sUser::model()->myGroup;

        if (isset($_REQUEST['gPerson'])) {
            $i = 0;
            foreach (Yii::app()->db->schema->getTable('g_bi_person')->columns as $key => $val) {

                if ($i > 0) {
                    //if (!empty($_REQUEST['gPerson'][$key])) {
                    if (count($_REQUEST['gPerson'][$key]) > 1) {
                        $regex_key[$i] = implode("|", array_filter($_REQUEST['gPerson'][$key]));
                        $where .= " AND $key REGEXP '$regex_key[$i]'";
                    }
                }
                $i++;
            }
        }

        $sql = "SELECT @rownum:=@rownum+1 'rank', p.* FROM g_bi_person p, (SELECT @rownum:=0) r $where";
        $count = count(Yii::app()->db->createCommand($sql)->queryAll());
        return new CSqlDataProvider($sql, [
            'keyField' => 'id',
            'totalItemCount' => $count,
            'sort' => ['defaultOrder' => 'id DESC'],
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
    }

    public static function getPersonList()
    {
        $connection = Yii::app()->db;

        $sql = 'SELECT t.employee_name from g_person t WHERE 
        (select c.company_id from g_person_career c WHERE t.id=c.parent_id AND c.status_id IN (' .
            implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) .
            ') ORDER BY c.start_date DESC LIMIT 1) IN (' .
            implode(",", sUser::model()->myGroupArray) . ') OR ' .
            '(select c2.company_id from g_person_career2 c2 WHERE t.id=c2.parent_id AND c2.company_id IN (' .
            implode(",", sUser::model()->myGroupArray) . ') ORDER BY c2.start_date DESC LIMIT 1) IN (' .
            implode(",", sUser::model()->myGroupArray) . ')';

        $command = $connection->createCommand($sql);
        $rows = $command->queryColumn();

        return $rows;
    }

    public function getInsuranceNumber () {
        if (isset($this->insurance)) {
            return $this->insurance->document_number;
        } else
            return null;
    }
}
