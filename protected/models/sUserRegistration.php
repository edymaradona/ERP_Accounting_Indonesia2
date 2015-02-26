<?php

/**
 * This is the model class for table "s_user_registration".
 *
 * The followings are the available columns in table 's_user_registration':
 * @property string $id
 * @property string $module_name
 * @property integer $registration_date
 * @property string $activation_code
 * @property string $email
 * @property string $password
 * @property integer $status_id
 */
class sUserRegistration extends BaseModel
{

    public $password_repeat;
    public $activation_code_repeat;
    public $verifyCode;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return sUserRegistration the static model class
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
        return 's_user_registration';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['email', 'required'],
            ['password_repeat, password', 'required', 'on' => 'registration'],
            ['activation_code_repeat', 'required', 'on' => 'activation'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'on' => 'registration,activation'],
            ['registration_date, status_id', 'numerical', 'integerOnly' => true],
            ['email', 'email'],
            ['email', 'unique', 'on' => 'registration'],
            ['module_name', 'length', 'max' => 15],
            ['activation_code, email, password', 'length', 'max' => 255],
            ['verifyCode', 'captcha', 'allowEmpty' => !CCaptcha::checkRequirements(), 'on' => 'activation,registration'],
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            ['id, module_name, registration_date, activation_code, email, password, status_id', 'safe', 'on' => 'search'],
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
            'status' => [self::HAS_ONE, 'sParameter', ['code' => 'status_id'], 'condition' => 'type = "cStatusP"'],
            'applicant' => [self::HAS_ONE, 'hApplicant', 'id'],
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'module_name' => 'Module Name',
            'registration_date' => 'Registration Date',
            'activation_code' => 'Activation Code',
            'email' => 'Email',
            'password' => 'Password',
            'status_id' => 'Status',
            'verifyCode' => 'Verification Code',
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

        $criteria->compare('id', $this->id, true);
        $criteria->compare('module_name', $this->module_name, true);
        $criteria->compare('registration_date', $this->registration_date);
        $criteria->compare('activation_code', $this->activation_code, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('status_id', $this->status_id);

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => 'registration_date DESC',
            ],
        ]);
    }

    public function validatePassword($password)
    {
        return $this->hashPassword($password, $this->activation_code) === $this->password;
    }

    public function hashPassword($password, $salt)
    {
        return md5($salt . $password);
    }

    public function generateSalt()
    {
        return uniqid('', true);
    }

    protected function beforeSave()
    {
        if ($this->isNewRecord)
            $this->registration_date = time();

        return true;
    }

    /* public function afterSave() {
      if($this->isNewRecord) {
      Notification::create(
      1,
      'sUserRegistration/view/id/'.$this->id,
      'Registrant. New Registrant created: '.$this->email
      );
      }
      return true;
      } */
}
