<?php

/**
 * This is the model class for table "h_applicant".
 *
 * The followings are the available columns in table 'h_applicant':
 * @property integer $id
 * @property string $applicant_name
 * @property string $idcard
 * @property string $birth_place
 * @property string $birth_date
 * @property integer $religion_id
 * @property integer $sex_id
 * @property integer $employee_maritalstat
 * @property integer $employee_nationality
 * @property string $employee_bloodtype
 * @property string $employee_ras
 * @property integer $employee_hometype
 * @property string $employee_address
 * @property string $employee_kec
 * @property string $employee_city
 * @property string $employee_postcode
 * @property integer $employee_country
 * @property string $employee_phone
 * @property string $employee_hp1
 * @property string $employee_hp2
 * @property integer $e_industryid
 * @property integer $e_plevelid
 * @property integer $work_exp_start
 * @property integer $highest_edulevel
 * @property string $mainimagename
 */
class hApplicant extends BaseModel
{

    public $education_level;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return GRecruitment1 the static model class
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
        return 'h_applicant';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['applicant_name, birth_place, birth_date, email', 'required'],
            ['birth_date', 'date', 'format' => 'dd-MM-yyyy'],
            ['company_id, sex_id, religion_id, userid, status_id, created_date, created_by, updated_date, updated_by', 'numerical', 'integerOnly' => true],
            ['applicant_code, address3, identity_address3, blood_id', 'length', 'max' => 10],
            ['applicant_name', 'length', 'max' => 100],
            ['email, email2', 'email'],
            ['email', 'unique', 'className' => 'sUserRegistration', 'on' => 'create'],
            ['email', 'unique', 'on' => 'update'],
            ['birth_place', 'length', 'max' => 20],
            ['address1, identity_address1, c_pathfoto', 'length', 'max' => 255],
            ['c_pathfoto', 'unique'],
            ['address2, identity_address2, home_phone, handphone, handphone2, account_number, account_name, bank_name', 'length', 'max' => 50],
            ['pos_code, identity_pos_code', 'length', 'max' => 5],
            ['identity_number', 'length', 'max' => 25],
            ['birth_date, identity_valid', 'safe'],
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            ['id, applicant_code, applicant_name, birth_place, birth_date, sex_id, religion_id, address1, address2, address3, pos_code, identity_number, identity_valid, identity_address1, identity_address2, identity_address3, identity_pos_code, email, email2, blood_id, home_phone, handphone, handphone2, c_pathfoto, userid, status_id, created_date, created_by, updated_date, updated_by', 'safe', 'on' => 'search'],
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
            'religion' => [self::BELONGS_TO, 'sParameter', ['religion_id' => 'code'], 'condition' => 'type = \'cAgama\''],
            'sex' => [self::BELONGS_TO, 'sParameter', ['sex_id' => 'code'], 'condition' => 'type = \'cGender\''],
            'many_experience' => [self::HAS_MANY, 'hApplicantExperience', 'parent_id', 'order' => 'many_experience.start_date DESC'],
            'many_experienceC' => [self::STAT, 'hApplicantExperience', 'parent_id'],
            'many_education' => [self::HAS_MANY, 'hApplicantEducation', 'parent_id', 'order' => 'many_education.level_id DESC'],
            'many_educationC' => [self::STAT, 'hApplicantEducation', 'parent_id'],
            'many_educationnf' => [self::HAS_MANY, 'hApplicantEducationNf', 'parent_id'],
            'many_family' => [self::HAS_MANY, 'hApplicantFamily', 'parent_id', 'order' => 'many_family.relation_id'],
            'many_familyC' => [self::STAT, 'hApplicantFamily', 'parent_id'],
            'has_couple' => [self::STAT, 'hApplicantFamily', 'parent_id', 'condition' => 'relation_id = 1 OR relation_id = 2'],
            'count_children' => [self::STAT, 'hApplicantFamily', 'parent_id', 'condition' => 'relation_id = 3'],
            'vacancy' => [self::HAS_MANY, 'hVacancyApplicant', 'applicant_id'],
            'vacancyC' => [self::STAT, 'hVacancyApplicant', 'applicant_id'],
            'vacancyLocked' => [self::STAT, 'hVacancyApplicant', 'applicant_id', 'condition' => 'status_id = 4'],
            'vacancyMany' => [self::MANY_MANY, 'hVacancy', 'h_vacancy_applicant(applicant_id,vacancy_id)'],
            'registration' => [self::HAS_ONE, 'sUserRegistration', 'id'],
            'jobalert' => [self::HAS_MANY, 'hApplicantJobalert', 'parent_id', 'condition' => 'jobalert.status_id = 1'],
            'comment' => [self::HAS_MANY, 'hApplicantComment', 'parent_id'],
            'commentC' => [self::STAT, 'hApplicantComment', 'parent_id'],
            'selection' => [self::HAS_ONE, 'hApplicantSelection', 'parent_id', 'order' => 'assessment_date DESC'],
            'selection_many' => [self::HAS_MANY, 'hApplicantSelection', 'parent_id', 'order' => 'assessment_date DESC'],
            'selectionC' => [self::STAT, 'hApplicantSelection', 'parent_id'],
            'schedule' => [self::HAS_ONE, 'jSelectionPart', 'applicant_id', 'order' => 'created_date DESC'],
            'schedule_many' => [self::HAS_MANY, 'jSelectionPart', 'applicant_id', 'order' => 'created_date DESC'],
            'scheduleC' => [self::STAT, 'jSelectionPart', 'parent_id'],
            'company' => [self::BELONGS_TO, 'aOrganization', 'company_id'],
            'systemrating' => [self::HAS_ONE, 'hApplicantRating', 'parent_id', 'condition' => 'user_id = 1'],
            'employee' => [self::HAS_ONE, 'gPerson', ['employee_name' => 'applicant_name'], 'condition' => 'employee.birth_date = employee.birth_date'],
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_id' => 'Company ID',
            'applicant_code' => 'Applicant Code',
            'applicant_name' => 'Applicant Name',
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
            'identity_address1' => 'Address',
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
            'c_pathfoto' => 'C Pathfoto',
            'userid' => 'Userid',
            'freshgrad_id' => 'Fresh Grad',
            'status_id' => 'Status',
            'created_date' => 'Created Date',
            'created_by' => 'Created By',
            'updated_date' => 'Updated Date',
            'updated_by' => 'Updated By',
        ];
    }

    public function getPhotoExist()
    {
        if ($this->c_pathfoto != null) {
            if (is_file(Yii::app()->basePath . "/../shareimages/hr/applicant/" . $this->c_pathfoto))
                return true;
            else
                return false;
        }
        return false;
    }

    public function getPhotoExistThumb()
    {
        if ($this->c_pathfoto != null) {
            if (is_file(Yii::app()->basePath . "/../shareimages/hr/applicant/thumb/" . $this->c_pathfoto))
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
                $path = CHtml::image(Yii::app()->request->baseUrlCdn . "/shareimages/hr/applicant/thumb/" . $this->c_pathfoto, $this->id, ["width" => "100%", 'id' => 'photo']);
            } else
                $path = CHtml::image(Yii::app()->request->baseUrlCdn . "/shareimages/hr/applicant/" . $this->c_pathfoto, $this->id, ["width" => "100%", 'id' => 'photo']);
        } else {
            if ($this->sex_id == 1) {
                $path = CHtml::image(Yii::app()->request->baseUrlCdn . "/shareimages/nophoto.jpg", $this->id, ["width" => "100%", 'id' => 'photo']);
            } else
                $path = CHtml::image(Yii::app()->request->baseUrlCdn . "/shareimages/nophotoW.jpg", $this->id, ["width" => "100%", 'id' => 'photo']);
        }
        return $path;
    }

    public function getPhotoPathReal()
    {
        if ($this->c_pathfoto != null && $this->PhotoExist) {
            if ($this->PhotoExistThumb) {
                $path = Yii::app()->basePath . "/../shareimages/hr/applicant/thumb/" . $this->c_pathfoto;
            } else
                $path = Yii::app()->basePath . "/../shareimages/hr/applicant/" . $this->c_pathfoto;
        } else {
            if ($this->sex_id == 1) {
                $path = Yii::app()->basePath . "/../shareimages/nophoto.jpg";
            } else
                $path = Yii::app()->basePath . "/../shareimages/nophotoW.jpg";
        }
        return $path;
    }

    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('applicant_name', $this->applicant_name, true);

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
        ]);
    }

    public function getHasExperience()
    {

        $model = self::model()->with('many_experience')->count('t.id = ' . Yii::app()->user->id);

        if ($model <= 1) {
            return false;
        } else
            return true;
    }

    public function maritalStatus()
    {
        if ($this->has_couple == 0) {
            $_status = "TK";
        } else
            $_status = "K" . $this->count_children;

        return $_status;
    }

    public static function getTopRecentApplicant()
    {

        $criteria = new CDbCriteria;
        $criteria->limit = 20;
        $criteria->together = true;
        $criteria->order = "vacancy.created_date DESC";
        $criteria->with = ['vacancy'];

        //if (Yii::app()->user->name != "admin") {
        //	$criteria2 = new CDbCriteria;
        //	$criteria2->condition='t.company_id IN ('.implode(",",sUser::model()->myGroupArray).')' ;
        //	$criteria->mergeWith($criteria2);
        //}


        $models = self::model()->with('vacancy')->findAll($criteria);

        $returnarray = [];

        foreach ($models as $model) {
            //$_title= (strlen($model->applicantM->applicant_name) >32) ? substr($model->applicantM->applicant_name,0,32)."..." : $model->applicantM->applicant_name ." ";
            $returnarray[] = ['id' => $model->id, 'label' => $model->applicant_name, 'icon' => 'list-alt', 'url' => ['/m1/hApplicant/view', 'id' => $model->id]];
        }

        return $returnarray;
    }

    public function getFreshgrad()
    {
        if ($this->freshgrad_id == 0) {
            return "No";
        } else
            return "Yes";
    }

    public function employeeTransferRequest()
    {
        $criteria = new CDbCriteria;

        $criteria->with = ['selection'];
        $criteria->condition = 'selection.workflow_id = 54 AND (select max(h.workflow_id) from h_applicant_selection h where t.id = h.parent_id) = 54 ';
        $criteria->order = 'selection.assessment_date DESC';

        if (Yii::app()->user->name != "admin") {
            $criteria1 = new CDbCriteria;
            $criteria1->compare('company_id', sUser::model()->myGroup, false, 'OR');
            $criteria1->compare('company_id', 0, false, 'OR');
            $criteria->mergeWith($criteria1);
        }

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            'pagination' => false,
        ]);
    }

    public static function getLoadModel($id)
    {
        $model = self::model()->findByPk((int)$id);

        if ($model != null) {
            return $model;
        } else
            return false;
    }

}
