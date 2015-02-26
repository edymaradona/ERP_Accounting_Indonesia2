<?php

class sUser extends CActiveRecord
{

    public $default_group_name;
    public $password_repeat;
    public $sso_id;
    public $sso_name;
    public $verifyCode;
    public $activation_code;

    public $old_password;
    public $new_password;
    public $new_password_repeat;

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 's_user';
    }

    public function rules()
    {
        return [
            ['password', 'ext.SPasswordValidator.SPasswordValidator',
                'min' => 4, //def 8
                'low' => 0, //def 2
                'up' => 0, //def 2
                'digit' => 1, //def 2
                'spec' => 0, //def 2
            ],
            ['username, password, status_id', 'required'],
            ['username', 'unique'],
            ['default_group', 'required', 'message' => 'Your Activation Code is wrong or may be expired..'],
            ['default_group_name', 'required', 'on' => 'defaultgroup'],
            ['status_id, default_group, created_date, sso_id', 'numerical', 'integerOnly' => true],
            ['username, created_by,hash_type', 'length', 'max' => 25],
            ['salt, sso_name, photo_path', 'length', 'max' => 100],
            //array('password, password_repeat', 'length', 'min'=>4),
            ['full_name', 'length', 'max' => 50],
            ['last_login,status_id', 'safe'],
            ['username, default_group, status_id,sso_id, photo_path', 'safe', 'on' => 'search'],

            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'on' => 'registration'],
            ['password, password_repeat', 'required', 'on' => 'registration'],

            ['new_password_repeat', 'compare', 'compareAttribute' => 'new_password', 'on' => 'passwordupdate'],
            ['new_password, new_password_repeat,old_password', 'required', 'on' => 'passwordupdate'],
            ['old_password', 'checkOldPassword', 'on' => 'passwordupdate'],

            ['username', 'required', 'on' => 'usernameupdate'],
            ['activation_code', 'required', 'on' => 'registration', 'message' => ''],
            //array('verifyCode', 'captcha', 'allowEmpty' => !CCaptcha::checkRequirements(), 'on' => 'registration'),
        ];
    }

    public function relations()
    {
        return [
            'organization' => [self::BELONGS_TO, 'aOrganization', 'default_group'],
            'status' => [self::HAS_ONE, 'sParameter', ['code' => 'status_id'], 'condition' => 'type = "cStatus"'],
            'module' => [self::HAS_MANY, 'sUserModule', 's_user_id'],
            'group' => [self::HAS_MANY, 'sUserGroup', 'parent_id'],
            'right' => [self::HAS_MANY, 'sAuthassignment', 'userid'],
            'groupCount' => [self::STAT, 'sUserGroup', 'parent_id'],
            'moduleCount' => [self::STAT, 'sUserModule', 's_user_id'],
            'rightCount' => [self::STAT, 'sAuthassignment', 'userid'],
            'moduleList' => [self::MANY_MANY, 'sModule', 's_user_module(s_user_id,s_module_id)', 'order' => 'moduleList.sort'],
            'groupList' => [self::MANY_MANY, 'aOrganization', 's_user_group(parent_id,organization_root_id)'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'salt' => 'Salt',
            'default_group' => 'Default Group',
            'status_id' => 'Status',
            'created_date' => 'Created Date',
            'created_by' => 'Created By',
            'last_login' => 'Last Login',
            'sso_id' => 'SSO ID',
            'photo_path' => 'Photo Path',
        ];
    }

    public function checkOldPassword($attribute, $params)
    {
        if ($this->password != crypt($this->old_password, $this->salt))
            $this->addError($attribute, 'Old password is incorrect.');
    }

    public function search()
    {
        $criteria = new CDbCriteria;
        if (Yii::app()->user->name != "admin")
            $criteria->addNotInCondition('username', ['admin']);

        return new CActiveDataProvider(get_class($this), [
            'criteria' => $criteria,
            'pagination' => [
                'pageSize' => 30,
            ],
            'sort' => [
                'defaultOrder' => 'last_login DESC',
            ],
        ]);
    }

    public function searchEntity($id)
    {
        $criteria = new CDbCriteria;
        $criteria->with = ['group'];

        $criteria1 = new CDbCriteria;
        $criteria->compare('default_group', $id, 'OR');
        $criteria1->compare('organization_root_id', $id, 'OR');

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            'pagination' => [
                'pageSize' => 100,
            ],
        ]);
    }

    protected function beforeValidate()
    {
        $this->username = trim($this->username);
        return true;
    }

    protected function beforeSave()
    {
        if ($this->isNewRecord) {
            //$this->salt=$this->generateSalt();
            //$this->password=md5($this->salt.$this->password);

            $this->salt = self::blowfishSalt();
            $this->password = crypt($this->password, $this->salt);
            $this->hash_type = "crypt";

            $this->created_by = Yii::app()->user->id;
            $this->created_date = time();
        } else {
            $this->created_by = Yii::app()->user->id;
            $this->created_date = time();
        }

        return parent::beforeSave();
    }

    public static function blowfishSalt($cost = 13)
    {
        if (!is_numeric($cost) || $cost < 4 || $cost > 31) {
            throw new Exception("cost parameter must be between 4 and 31");
        }
        $rand = [];
        for ($i = 0; $i < 8; $i += 1) {
            $rand[] = pack('S', mt_rand(0, 0xffff));
        }
        $rand[] = substr(microtime(), 2, 6);
        $rand = sha1(implode('', $rand), true);
        $salt = '$2a$' . sprintf('%02d', $cost) . '$';
        $salt .= strtr(substr(base64_encode($rand), 0, 22), ['+' => '.']);
        return $salt;
    }

    public function generateSalt()
    {
        return uniqid('', true);
    }

    public function validatePassword($password)
    {
        if ($this->hash_type == "md5") {
            $check = $this->hashPassword($password, $this->salt) === $this->password;

            if ($check) {
                $_mysalt = self::blowfishSalt();
                $_password = crypt($password, $_mysalt);
                self::model()->updateByPk($this->id, ['password' => $_password, 'salt' => $_mysalt, 'hash_type' => 'crypt']);
            }
        } else
            $check = $this->password === crypt($password, $this->password);

        return $check;
        //return true;
    }

    public function hashPassword($password, $salt)
    {
        return md5($salt . $password);
    }

    public static function getAllUsers($all = '')
    {
        $_items = [];
        $models = self::model()->findAll(['order' => 'username']);
        if ($all == 'all') {
            $_items[0] = 'All';
        }

        foreach ($models as $model)
            $_items[$model->id] = $model->username;

        return $_items;
    }

    public function findName($id)
    {
        $model = $this->findByPk((int)$id);
        if ($model == null)
            return "All";

        return $model->username;
    }

    private $_items2 = [];
    private $_admin2 = ['admin'];

    public function items2($type)
    {
        if (!isset(self::$_items2[$type]))
            self::loadItems2($type);
        return array_merge(self::$_admin2, self::$_items2[$type]);
    }

    private function loadItems2($type)
    {
        self::$_items2[$type] = [];
        $models2 = self::model()->findAllBySql('SELECT a.id, a.username FROM s_user a
				INNER JOIN s_user_module b ON a.id = b.s_user_id
				WHERE b.s_module_id = "' . $type . '"');
        foreach ($models2 as $model2) {
            self::$_items2[$type][$model2->id] = $model2->username;
        }
    }

    private $_items = [];
    private $_admin = ['admin'];

    public function items($type)
    {
        if (!isset(self::$_items[$type]))
            self::loadItems($type);
        return array_merge(self::$_admin, self::$_items[$type]);
    }

    private function loadItems($type)
    {
        self::$_items[$type] = [];
        $models = self::model()->findAllBySql('SELECT a.id, a.username FROM s_user a
				INNER JOIN s_user_module b ON a.id = b.s_user_id
				WHERE b.s_module_id = "' . $type . '"');
        foreach ($models as $model) {
            self::$_items[$type][$model->id] = $model->username;
        }
    }

    private $_items1 = [];

    public function items1($type)
    {
        if (!isset(self::$_items1[$type]))
            self::loadItems1($type);
        return self::$_items1[$type];
    }

    public static function getMyGroup()
    {
        $model = self::model()->findByPk(Yii::app()->user->id);
        $_group = $model->default_group;
        return (int)$_group;
    }

    public function getRightCountM()
    {
        $model = self::model()->findByPk(Yii::app()->user->id);
        $_count = $model->rightCount;
        return (int)$_count;
    }

    public function getMyGroupParent()
    {
        $model = self::model()->findByPk(Yii::app()->user->id);
        $_group = $model->organization->parent_id;
        return (int)$_group;
    }

    public function getMyGroupMember()
    {
        $_items[] = $this->organization->name;

        foreach ($this->groupList as $model)
            $_items[] = $model->name;

        return $_items;
    }

    public function getModuleMember()
    {
        $_items = [];
        foreach ($this->moduleList as $model)
            $_items[] = $model->title;

        return $_items;
    }

    public function getRightMember()
    {
        $_items = [];
        foreach ($this->right as $model)
            $_items[] = $model->itemname;

        return $_items;
    }

    public static function getMyGroupName()
    {
        $findself = self::model()->findByPk(Yii::app()->user->id);
        $defGroup = $findself->default_group;

        $model = aOrganization::model()->findByPk($defGroup);
        if ($model != null) {
            $grName = $model->name;
        } else
            $grName = "";

        return $grName;
    }

    public function getMyGroupArray()
    {
        $models = sUserGroup::model()->findAll('parent_id = ' . Yii::app()->user->id);

        //Default Group as the first array
        $_items[] = $this->myGroup;

        foreach ($models as $model)
            $_items[] = $model->organization_root_id;

        return $_items;
    }

    public function getMyGroupArrayName()
    {
        $models = sUserGroup::model()->findAll('parent_id = ' . Yii::app()->user->id);

        //Default Group as the first array
        $_items[$this->myGroup] = $this->myGroupName;

        foreach ($models as $model)
            $_items[$model->organization_root_id] = $model->organization_root->name;

        return $_items;
    }

    public function getMyGroupNotificationArray()
    {
        $models = sNotificationGroupMember::model()->findAll('user_id = ' . Yii::app()->user->id);


        foreach ($models as $model)
            $_items[] = $model->parent_id;

        if (isset($_items)) {
            return $_items;
        } else {
            $_items[] = 'NOT AVAILABLE';
            return $_items;
        }
    }

    public function getMyGroupRoot()
    {
        $model = self::findByPk((int)Yii::app()->user->id);

        if ($model->organization->parent_id == 0) { //L1
            $_groupRoot = $model->organization->id;
        } elseif ($model->organization->getparent->parent_id == 0) { //L2
            $_groupRoot = $model->organization->getparent->id;
        } elseif ($model->organization->getparent->getparent->parent_id == 0) { //L3
            $_groupRoot = $model->organization->getparent->getparent->id;
        } else //L4
            $_groupRoot = $model->organization->getparent->getparent->getparent->id;

        return $_groupRoot;
    }

    public function getGroupRootName()
    {
        $model = self::findByPk((int)Yii::app()->user->id);

        if ($model->organization->parent_id == 0) { //L1
            $_groupRoot = $model->organization->name;
        } elseif ($model->organization->getparent->parent_id == 0) { //L2
            $_groupRoot = $model->organization->getparent->name;
        } elseif ($model->organization->getparent->getparent->parent_id == 0) { //L3
            $_groupRoot = $model->organization->getparent->getparent->name;
        } else //L4
            $_groupRoot = $model->organization->getparent->getparent->getparent->name;

        return $_groupRoot;
    }

    public function getAccess($mid)
    {
        $_items = [];
        $models = self::model()->findAllBySql('SELECT a.id, a.username FROM s_user a
			INNER JOIN s_user_module b ON a.id = b.s_user_id
			WHERE b.s_module_id = ' . $mid);
        $_items[] = 'admin';

        if ($models != null) {
            foreach ($models as $model) {
                $_items[$model->id] = $model->username;
            }
        } else
            $_items[] = 'non_registered_user';

        return $_items;
    }

    public static function getTopCreated()
    {

        $models = self::model()->findAll(['limit' => 10, 'order' => 'created_date DESC']);

        $returnarray = [];

        foreach ($models as $model) {
            $returnarray[] = ['id' => $model->username, 'label' => $model->username, 'icon' => 'list-alt', 'url' => ['view', 'id' => $model->id]];
        }

        return $returnarray;
    }

    public function getTopRelated($id)
    {

        $_related = self::model()->findByPk((int)$id)->name;
        $_exp = explode(" ", $_related);


        $criteria = new CDbCriteria;

        if (isset($_exp[0]))
            $criteria->compare('name', $_exp[0], true, 'OR');

        if (isset($_exp[1]))
            $criteria->compare('name', $_exp[1], true, 'OR');

        $criteria->limit = 10;
        $criteria->order = 'updated_date DESC';

        $models = self::model()->findAll($criteria);

        $returnarray = [];

        foreach ($models as $model) {
            $returnarray[] = ['id' => $model->username, 'label' => $model->username, 'icon' => 'list-alt', 'url' => ['view', 'id' => $model->id]];
        }

        return $returnarray;
    }

    public static function getTopLastOneHour()
    {

        $models = self::model()->findAll(['limit' => 10, 'order' => 'last_login DESC', 'condition' => 'last_login > ' . strtotime('-1 hour')]);

        $returnarray = [];

        foreach ($models as $model) {
            $returnarray[] = ['id' => $model->username, 'label' => $model->username, 'icon' => 'list-alt', 'url' => ['view', 'id' => $model->id]];
        }

        return $returnarray;
    }

    public function sso()
    {

        $isExist = is_file(Yii::app()->basePath . "/modules/m1/models/gPerson.php");

        if ($isExist) {
            $model = gPerson::model()->find('userid =' . $this->id);

            if ($model != null)
                return $model->employee_name;
        }
        return "";
    }

    public function ssoId()
    {

        $isExist = is_file(Yii::app()->basePath . "/modules/m1/models/gPerson.php");

        if ($isExist) {
            $model = gPerson::model()->find('userid =' . $this->id);

            if ($model != null)
                return $model->id;
        }
        return "";
    }

    public function getFullName()
    {
        $findself = self::model()->findByPk(Yii::app()->user->id);

        if ($findself->full_name == null) {
            $_name = $findself->username;
        } else
            $_name = $findself->full_name;

        return $_name;
    }

    public function getFullName2()
    {

        if ($this->full_name == null) {
            $_name = $this->username;
        } else
            $_name = $this->full_name;

        return $_name;
    }

    public function currentPersonId()
    {

        $model = gPerson::model()->find('userid =' . Yii::app()->user->id);

        if ($model != null)
            return $model->id;

        return "";
    }

    public function currentPerson()
    {

        $model = gPerson::model()->find('userid =' . Yii::app()->user->id);

        if ($model != null)
            return $model;

        return "";
    }

    public function getPhotoExist()
    {
        if ($this->photo_path != null) {
            if (is_file(Yii::app()->basePath . "/../shareimages/user/" . $this->photo_path))
                return true;
            else
                return false;
        }
        return false;
    }

    public function getPhotoPath()
    {
        if ($this->photo_path != null && $this->PhotoExist) {
            $path = CHtml::image(Yii::app()->request->baseUrlCdn . "/shareimages/user/" . $this->photo_path, $this->id, ["width" => "100%", 'id' => 'photo']);
        } else
            $path = CHtml::image(Yii::app()->request->baseUrlCdn . "/shareimages/nophoto.jpg", $this->id, ["width" => "100%", 'id' => 'photo']);

        return $path;
    }

    public function userRight($id)
    {
        $rawData = Yii::app()->db->createCommand('SELECT * FROM s_authassignment where userid = ' . $id)->queryAll();

        $dataProvider = new CArrayDataProvider($rawData, [
            'keyField' => 'itemname',
            'sort' => [
                'attributes' => [
                    'itemname',
                ],
            ],
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $dataProvider;
    }

    public function afterSave()
    {
        if ($this->isNewRecord) {
            Notification::create(
                5, 'sUser/view/id/' . $this->id, 'User. New User created: <read>' . $this->username . '</read>'
            );
        }
        return true;
    }

}
