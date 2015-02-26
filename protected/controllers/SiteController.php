<?php

class SiteController extends Controller
{

    public $layout = '//layouts/column1';

    public function init()
    {
        //Yii::app()->language='id';
        //return parent::init();
        //Yii::import('ext.LanguagePicker.ELanguagePicker');
        //ELanguagePicker::setLanguage();
        //return parent::init();
        // register class paths for extension captcha extended
        Yii::$classMap = array_merge(Yii::$classMap, [
            'CaptchaExtendedAction' => Yii::getPathOfAlias('ext.captchaExtended') . DIRECTORY_SEPARATOR . 'CaptchaExtendedAction.php',
            'CaptchaExtendedValidator' => Yii::getPathOfAlias('ext.captchaExtended') . DIRECTORY_SEPARATOR . 'CaptchaExtendedValidator.php'
        ]);
        return parent::init();
    }

    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return [
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => [
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
                //'class'=>'CaptchaExtendedAction',
                //'mode'=>CaptchaExtendedAction::MODE_MATH,
            ],
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'link' => [
                'class' => 'CViewAction',
            ],
            'get_tweets' => [
                'class' => 'ext.new-tweet.TweetFetch'
            ],
        ];
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        $this->layout = '//layouts/column1';
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    public function actionNotSupportedBrowser()
    {
        $b = new EWebBrowser;
        if ($b->browser != 'Internet Explorer')
            $this->redirect(['/menu']);
        $this->layout = '//layouts/baseNotSupport';
        $this->render('notSupportedBrowser');
    }

    public function actionLogin()
    {
        $this->redirect(['/site']);
    }

    /**
     * Displays the login page
     */
    public function actionIndex()
    {
        $b = new EWebBrowser;
        if ($b->browser == 'Internet Explorer')
            $this->redirect(['notSupportedBrowser']);

        $model = new fLogin;
        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        if (isset($_POST['fLogin'])) {
            $model->attributes = $_POST['fLogin'];
            if ($model->validate() && $model->login()) {
                sUser::model()->updateByPk((int)Yii::app()->user->id, ['last_login' => time()]);
                if (Yii::app()->name == "APHRIS")
                    Notification::getUserHistory();

                $this->redirect(Yii::app()->user->returnUrl);
            }
        }

        if (Yii::app()->user->isGuest) {
            $this->render('login', ['model' => $model]);
        } else {

            //Yii::app()->user->setFlash('info', '<strong>Info Penting!</strong>  Update CSS Framework Boostrap Twitter. Jika anda mengalami ada fungsi-fungsi tertentu
            //yang tidak dapat digunakan atau tampilan menjadi berantakan, silahkan mengisi thread baru bugs di forum yang sudah disediakan...');

            if (Yii::app()->user->name == "admin" || sUser::model()->rightCountM > 2 || !Yii::app()->user->checkAccess('HR ESS Staff')) {
                $this->redirect(['/menu']);
            } else
                $this->redirect(['/m1/gEss']);
        }
    }

    public function actionLogin2()
    {
        $model = new fLogin;
        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        if (isset($_POST['fLogin'])) {
            $model->attributes = $_POST['fLogin'];
            if ($model->validate() && $model->login()) {
                sUser::model()->updateByPk((int)Yii::app()->user->id, ['last_login' => time()]);
                $this->redirect(Yii::app()->user->returnUrl);
            }
        }
        if (Yii::app()->user->isGuest) {
            $this->render('login2', ['model' => $model]);
        } else {
            $this->redirect(['/menu']);
        }
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
        //$this->redirect(Yii::app()->homeUrl);
        $this->redirect(['/site/login']);
    }

    public function actionPhoto()
    {
        //$this->layout='//layouts/column1breadcrumb';
        $this->render('/site/photo');
    }

    public function actionPhotoAll()
    {
        //$this->layout='//layouts/column1breadcrumb';
        $this->render('/site/photoAll');
    }

    public function actionPhotoAlbum($id)
    {
        //$this->layout='//layouts/column1breadcrumb';
        $this->render('/site/photoAlbum', [
            "id" => $id,
        ]);
    }

    public function actionLearning()
    {
        //$this->layout='//layouts/column2';
        $this->render('/site/learning');
    }

    public function actionCalendarEvents()
    {
        $criteria = new CDbCriteria;
        $criteria->with = ['getparent'];
        $criteria->compare('year(schedule_date)', date("Y"));
        $criteria->together = true;
        $criteria->AddInCondition('getparent.type_id', [1, 2]);
        $models = iLearningSch::model()->findAll($criteria);
        $items = [];
        $detail = [];
        $input = ["#CC0000", "#0000CC", "#333333", "#663333", "#993333", "#CC3333", "#003366", "#663366", "#993366", "#CC3366", "#6633CC"];
        foreach ($models as $model) {
            $detail['id'] = $model->id;
            $detail['title'] = $model->learning_status;
            $detail['start'] = date('Y') . '-' . date('m', strtotime($model->schedule_date)) . '-' . date('d', strtotime($model->schedule_date));
            //$detail['start']= $model->schedule_date;
            $detail['color'] = $input[rand(0, 10)];
            $detail['allDay'] = true;
            //$detail['url'] = Yii::app()->createUrl('site/viewDetail', array("id" => $model->id));
            $detail['url'] = '#';
            $items[] = $detail;
        }
        echo CJSON::encode($items);
        Yii::app()->end();
    }

    public function actionViewDetail($id)
    {

        if (@$_GET['asModal'] == true) {
            $this->renderPartial('viewDetail', [
                'model' => $this->loadModelSchedule($id),
            ], false, true);
        } else {
            $this->render('viewDetail', [
                'model' => $this->loadModelSchedule($id),
            ]);
        }
    }

    public function loadModelSchedule($id)
    {
        $model = iLearningSch::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 's-user-registration-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionRegister()
    {
        $model = new sUser;
        $model->setScenario('registration');
        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);
        if (isset($_POST['sUser'])) {
            $model->attributes = $_POST['sUser'];
            $criteria = new CDbCriteria;
            $criteria->condition = 'activation_code = :code AND activation_expire >=' . time();
            $criteria->params = [':code' => $_POST['sUser']['activation_code']];
            $cekValidationCode = gPerson::model()->find($criteria);
            if ($cekValidationCode != null)
                $model->default_group = $cekValidationCode->mCompanyId();
            $model->status_id = 1;
            if ($model->validate()) {
                $model->created_date = time();
                $model->created_by = 1;
                $model->full_name = $cekValidationCode->employee_name;
                $_mysalt = sUser::blowfishSalt();
                //$model->password = crypt($model->password, $_mysalt);
                $model->save(false);
                //sUser::model()->updateByPk((int) $model->id, array('password' => $_password, 'salt' => $_mysalt, 'hash_type' => 'crypt'));
                $connection = Yii::app()->db;
                $sql1 = "INSERT INTO `s_authassignment` (`itemname`, `userid`, `bizrule`, `data`) VALUES
				('Authenticated', " . $model->id . ", NULL, 'N;'),
				('HR ESS Staff', " . $model->id . ", NULL, 'N;');";
                $sql2 = "INSERT INTO `s_user_module` (`s_user_id`, `s_module_id`, `favourite_id`) VALUES
				(" . $model->id . ", 194, 1),
				(" . $model->id . ", 248, 1),
				(" . $model->id . ", 23, 1),
				(" . $model->id . ", 24, 1),
				(" . $model->id . ", 25, 1),
				(" . $model->id . ", 26, 1),
				(" . $model->id . ", 67, 1),
                (" . $model->id . ", 263, 1),
				(" . $model->id . ", 259, 1),
                (" . $model->id . ", 268, 1),
				(" . $model->id . ", 208, 1);";
                $command1 = $connection->createCommand($sql1);
                $command1->execute();
                $command2 = $connection->createCommand($sql2);
                $command2->execute();

                $cekValidationCode->userid = $model->id;
                $cekValidationCode->activation_expire = time(); //set now and expire automatically
                $cekValidationCode->updated_by = $model->id;
                $cekValidationCode->updated_date = time();
                $cekValidationCode->save(false);

                $this->newInbox([
                    'recipient' => $cekValidationCode->userid,
                    'subject' => "Welcome To " . Yii::app()->params['title'],
                    'message' => "Dear " . $cekValidationCode->employee_name . ",<br/><br/> 
					Welcome to " . Yii::app()->params['subtitle'] . " or simply we called it: " . Yii::app()->params['title'] . ".  You can use this application to
					maintain your personal profile info and review your education background, work experience, etc. <br/><br/>
					Here, you can also apply your leave, permission and review your attendance information. APHRIS have Training Schedule Information, 
					Talent and Performance Information, Medical, and many features will be added later.<br/><br/> 
					Thank You for joining... <br/><br/>"
                ]);

                $modelS = new sNotification;
                $modelS->group_id = 1;
                $modelS->company_id = $cekValidationCode->mCompanyId();

                $modelS->link = 'sUser/viewAuthenticated/id/' . $model->id;
                $modelS->content = 'Employee Self Service. New ESS created for <read>' . $model->username . '</read>' . ' from ' . $model->organization->name;
                $modelS->save(false);

                Yii::app()->user->setFlash('success', '<strong>Your Registration process is succesfull. Please, login with your given username and password');
                $this->redirect(['site/login2']);
            }
        }
        Yii::app()->user->setFlash('info', '<strong>IMPORTANT INFO!!</strong>
		This Page is dedicated FOR internal Employee !!!... 
		before you activate your username and password, 
			step #1, ask your ACTIVATION CODE to HR Manager at your business unit. Otherwise, you can\'t continue to register.');
        $this->render('register', [
            'model' => $model,
        ]);
    }

    public function actionApprovedByMe($mod = '', $code = 0, $decision = 2)
    {
        if ($mod == 'leave') {
            $criteria = new CDbCriteria;
            $criteria->condition = 'activation_code = :code AND superior_approved_id = 1 AND activation_expire >=' . time();
            $criteria->params = [':code' => $code];
            $cekValidationCode = gLeave::model()->find($criteria);
            if ($cekValidationCode != null) {
                if ($decision == 2) {
                    $cekValidationCode->superior_approved_id = $decision;
                    $decisionD = "Approved";
                } else {
                    $cekValidationCode->superior_approved_id = 3;
                    $cekValidationCode->approved_id = 3;
                    $decisionD = "Rejected";
                }

                $cekValidationCode->updated_date = time();
                $cekValidationCode->save(false);

                $this->newInbox([
                    'recipient' => $cekValidationCode->person->userid,
                    'subject' => "Superior Leave ".$decisionD.". Your Leave has been ".$decisionD." by Your Superior",
                    'message' => "Dear " . $cekValidationCode->person->employee_name . ",<br/> 
					Your leave request on " . $cekValidationCode->start_date . " and will end at " . $cekValidationCode->end_date
                        . " for: \"" . $cekValidationCode->leave_reason . "\" has been ".$decisionD." by your superior via Email. <br/>
					Thank You.. <br/><br/>"
                ]);

                $modelN = new sNotification;
                $modelN->group_id = 1;
                $modelN->company_id = $cekValidationCode->person->mCompanyId();
                $modelN->link = 'm1/gLeave/view/id/' . $cekValidationCode->parent_id;
                $modelN->content = 'Leave '.$decisionD.' by Superior. Leave of <read>' . $cekValidationCode->person->employee_name . '</read> 
                on ' . $cekValidationCode->start_date . ' has been '.$decisionD.' by his/her superior via Email';
                $modelN->save();

                Yii::app()->user->setFlash('success', '
				<strong>Leave process for ' . $cekValidationCode->person->employee_name . ' on ' . $cekValidationCode->start_date . ' for 
				' . $cekValidationCode->leave_reason . ' is success. Thank You');
                $this->render('approved', [
                ]);
                Yii::app()->end();
            }
        } elseif ($mod == 'permission') {
            $criteria = new CDbCriteria;
            $criteria->condition = 'activation_code = :code AND superior_approved_id = 1 AND activation_expire >=' . time();
            $criteria->params = [':code' => $code];
            $cekValidationCode = gPermission::model()->find($criteria);
            if ($cekValidationCode != null) {
                if ($decision == 2) {
                    $cekValidationCode->superior_approved_id = $decision;
                    $decisionD = "Approved";
                } else {
                    $cekValidationCode->superior_approved_id = 3;
                    $cekValidationCode->approved_id = 3;
                    $decisionD = "Rejected";
                }

                $cekValidationCode->updated_date = time();
                $cekValidationCode->save(false);

                $this->newInbox([
                    'recipient' => $cekValidationCode->person->userid,
                    'subject' => "Superior Permission ".$decisionD.". Your Permission has been ".$decisionD." by Your Superior",
                    'message' => "Dear " . $cekValidationCode->person->employee_name . ",<br/> 
                    Your permission request on " . $cekValidationCode->start_date 
                        . " for: \"" . $cekValidationCode->permission_reason . "\" has been ".$decisionD." by your superior via Email. <br/>
                    Thank You.. <br/><br/>"
                ]);

                $modelN = new sNotification;
                $modelN->group_id = 1;
                $modelN->company_id = $cekValidationCode->person->mCompanyId();
                $modelN->link = 'm1/gPermission/view/id/' . $cekValidationCode->parent_id;
                $modelN->content = 'Permission '.$decisionD.' by Superior. Permission of <read>' . $cekValidationCode->person->employee_name . '</read> 
                on ' . $cekValidationCode->start_date . ' has been '.$decisionD.' by his/her superior via Email';
                $modelN->save();

                Yii::app()->user->setFlash('success', '
                <strong>Permission process for ' . $cekValidationCode->person->employee_name . ' on ' . $cekValidationCode->start_date . ' for 
                ' . $cekValidationCode->permission_reason . ' is success. Thank You');
                $this->render('approved', [
                ]);
                Yii::app()->end();
            }

        } elseif ($mod == 'expense') {
            $criteria = new CDbCriteria;
            $criteria->condition = 'activation_code = :code AND superior_approved_id = 1 AND activation_expire >=' . time();
            $criteria->params = [':code' => $code];
            $cekValidationCode = gExpense::model()->find($criteria);
            if ($cekValidationCode != null) {
                if ($decision == 2) {
                    $cekValidationCode->superior_approved_id = $decision;
                    $decisionD = "Approved";
                } else {
                    $cekValidationCode->superior_approved_id = 3;
                    $cekValidationCode->approved_id = 3;
                    $decisionD = "Rejected";
                }

                $cekValidationCode->updated_date = time();
                $cekValidationCode->save(false);

                $type = ($cekValidationCode->expense_type_id == 2) ? "Business Travel" : "Return To Homebase";
                $this->newInbox([
                    'recipient' => $cekValidationCode->person->userid,
                    'subject' => "Superior ".$type." ".$decisionD.". Your ".$type." has been ".$decisionD." by Your Superior",
                    'message' => "Dear " . $cekValidationCode->person->employee_name . ",<br/> 
                    Your ".$type." request on " . $cekValidationCode->start_date 
                        . " destination to: ".$cekValidationCode->destination." for: \"" . $cekValidationCode->purpose . "\" has been ".$decisionD." by your superior via Email. <br/>
                    Thank You.. <br/><br/>"
                ]);

                Yii::app()->user->setFlash('success', '
                <strong>'.$type.' process for ' . $cekValidationCode->person->employee_name . ' on ' . $cekValidationCode->start_date . ' destination to 
                '.$cekValidationCode->destination.' for ' . $cekValidationCode->purpose . ' is success. Thank You');
                $this->render('approved', [
                ]);
                Yii::app()->end();
            }

        //} else {

        }


        Yii::app()->user->setFlash('error', '<strong>Instant Approval Process is failed or might has been processed earlier . Sorry...');
        $this->render('approved', [
        ]);
    }

    // Facebook log in
    /* public function actionFacebooklogin() {
      Yii::import('ext.facebook.*');
      $ui = new FacebookUserIdentity('74026521543', '7f2ffd4bcdfafd919e276006223b4fd4');
      if ($ui->authenticate()) {
      $user=Yii::app()->user;
      $user->login($ui);
      $this->redirect($user->returnUrl);
      } else {
      throw new CHttpException(401, $ui->error);
      }
      } */

    public function actionAddress2AutoComplete()
    {


        $res = [];
        if (isset($_GET['term'])) {
            $qtxt = "SELECT CONCAT(d.nama,', Kec. ',c.nama,', ',b.nama,', ', a.nama) as address2,
            CONCAT(d.nama,', Kec. ',c.nama) as address2a,
            CONCAT(b.nama,', ', a.nama) as address3
            FROM provinsi a
            INNER JOIN kabupaten b ON a.id_prov = b.id_prov
            INNER JOIN kecamatan c ON c.id_kab = b.id_kab
            INNER JOIN kelurahan d ON d.id_kec = c.id_kec
            WHERE CONCAT(d.nama,', Kec. ',c.nama,', ',b.nama,', ', a.nama) LIKE :name 
            ORDER BY a.nama LIMIT 20";

            $command = Yii::app()->db->createCommand($qtxt);
            $command->bindValue(":name", '%' . $_GET['term'] . '%', PDO::PARAM_STR);
            //$res = $command->queryColumn();
            $res =$command->queryAll();
        }
        echo CJSON::encode($res);
    }

    public function actionAddress3AutoComplete()
    {


        $res = [];
        if (isset($_GET['term'])) {
            $qtxt = "SELECT CONCAT(b.nama,', ', a.nama) as address3
            FROM provinsi a
            INNER JOIN kabupaten b ON a.id_prov = b.id_prov
            INNER JOIN kecamatan c ON c.id_kab = b.id_kab
            INNER JOIN kelurahan d ON d.id_kec = c.id_kec
            WHERE CONCAT(b.nama,', ', a.nama) LIKE :name 
            ORDER BY a.nama LIMIT 20";

            $command = Yii::app()->db->createCommand($qtxt);
            $command->bindValue(":name", '%' . $_GET['term'] . '%', PDO::PARAM_STR);
            //$res = $command->queryColumn();
            $res =$command->queryAll();
        }
        echo CJSON::encode($res);
    }

}
