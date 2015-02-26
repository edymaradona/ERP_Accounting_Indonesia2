<?php

class SSmsController extends Controller
{

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    //public $layout = '//layouts/column2';
    public $layout = '//layouts/column2left';

    //public $defaultAction = 'inbox';
    /**
     * @return array action filters
     */
    public function filters()
    {
        return [
            'rights', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        ];
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view', [
            'model' => $this->loadModel($id),
        ]);
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new sSmsout;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if (isset($_POST['sSmsout'])) {
            $model->attributes = $_POST['sSmsout'];
            $model->sender_id = sUser::model()->myGroup;
            if ($model->save()) {
                $receivers = explode(",", $model->receivergroup_tag);

                //Message Split
                $jmlSMS = ceil(strlen($model->message) / 153);

                // memecah pesan asli
                $pecah = str_split($model->message, 153);

                //if (count($pecah) == 1) {
                $multi = 'false';
                //} else
                //	$multi = 'true';

                foreach ($receivers as $receiver) {
                    $connection = Yii::app()->db;
                    $sql = "SELECT DISTINCT handphone FROM `s_addressbook` 
						WHERE member_of LIKE '%" . $receiver . "%' 
					";

                    $command = $connection->createCommand($sql);
                    $rows = $command->queryAll();

                    foreach ($rows as $row) {
                        $firstnumber = explode(",", $row['handphone']);

                        $connection2 = Yii::app()->db;

                        $newID = $connection2->createCommand('select ID FROM outbox ORDER BY ID DESC LIMIT 1')->queryScalar();
                        ($newID == null) ? $newID = 1 : $newID++;

                        // proses penyimpanan ke tabel mysql untuk setiap pecahan
                        for ($i = 1; $i <= $jmlSMS; $i++) {
                            // membuat UDH untuk setiap pecahan, sesuai urutannya
                            $udh = "050003A7" . sprintf("%02s", $jmlSMS) . sprintf("%02s", $i);

                            // membaca text setiap pecahan
                            $msg = $pecah[$i - 1];

                            if ($i == 1) {
                                // jika merupakan pecahan pertama, maka masukkan ke tabel OUTBOX
                                $sql = "INSERT INTO outbox (DestinationNumber, SenderID, UDH, TextDecoded, ID, MultiPart, CreatorID) 
										VALUES (CONCAT('+62','" . $firstnumber[0] . "'), 'modem1', '" . $udh . "', '" . $msg . "'," . $newID . ", '" . $multi . "', '" . Yii::app()->name . "') 
								";
                            } else {
                                // jika bukan merupakan pecahan pertama, simpan ke tabel OUTBOX_MULTIPART
                                //$sql = "INSERT INTO outbox_multipart(UDH, TextDecoded, ID, SequencePosition)
                                //		VALUES ('".$udh."', '".$msg."',".$newID.",'$i')";

                                $sql = "INSERT INTO outbox (DestinationNumber, SenderID, UDH, TextDecoded, MultiPart, CreatorID) 
										VALUES (CONCAT('+62','" . $firstnumber[0] . "'), 'modem1', '" . $udh . "', '" . $msg . "', '" . $multi . "', '" . Yii::app()->name . "') 
								";
                            }
                            $connection2->createCommand($sql)->execute();
                        }
                    }
                }

                $this->redirect(['view', 'id' => $model->id]);
            }
        }
        $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionCreateSingle()
    {
        $model = new sSmsout;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if (isset($_POST['sSmsout'])) {
            $model->attributes = $_POST['sSmsout'];
            $model->sender_id = sUser::model()->myGroup;
            if ($model->save()) {
                $receivers = explode(",", $model->receivergroup_tag);

                //Message Split
                $jmlSMS = ceil(strlen($model->message) / 153);

                // memecah pesan asli
                $pecah = str_split($model->message, 153);

                //if (count($pecah) == 1) {
                $multi = 'false';
                //} else
                //	$multi = 'true';

                foreach ($receivers as $receiver) {
                    $connection = Yii::app()->db;
                    $sql = "SELECT handphone FROM `s_addressbook` 
						WHERE complete_name = '" . $receiver . "' 
					";

                    $command = $connection->createCommand($sql);
                    $rows = $command->queryAll();

                    foreach ($rows as $row) {
                        $firstnumber = explode(",", $row['handphone']);

                        $connection2 = Yii::app()->db;

                        $newID = $connection2->createCommand('select ID FROM outbox ORDER BY ID DESC LIMIT 1')->queryScalar();
                        ($newID == null) ? $newID = 1 : $newID++;

                        // proses penyimpanan ke tabel mysql untuk setiap pecahan
                        for ($i = 1; $i <= $jmlSMS; $i++) {
                            // membuat UDH untuk setiap pecahan, sesuai urutannya
                            $udh = "050003A7" . sprintf("%02s", $jmlSMS) . sprintf("%02s", $i);

                            // membaca text setiap pecahan
                            $msg = $pecah[$i - 1];

                            if ($i == 1) {
                                // jika merupakan pecahan pertama, maka masukkan ke tabel OUTBOX
                                $sql = "INSERT INTO outbox (DestinationNumber, SenderID, UDH, TextDecoded, ID, MultiPart, CreatorID) 
										VALUES (CONCAT('+62','" . $firstnumber[0] . "'), 'modem1', '" . $udh . "', '" . $msg . "'," . $newID . ", '" . $multi . "', '" . Yii::app()->name . "') 
								";
                            } else {
                                // jika bukan merupakan pecahan pertama, simpan ke tabel OUTBOX_MULTIPART
                                //$sql = "INSERT INTO outbox_multipart(UDH, TextDecoded, ID, SequencePosition)
                                //		VALUES ('".$udh."', '".$msg."',".$newID.",'$i')";

                                $sql = "INSERT INTO outbox (DestinationNumber, SenderID, UDH, TextDecoded, MultiPart, CreatorID) 
										VALUES (CONCAT('+62','" . $firstnumber[0] . "'), 'modem1', '" . $udh . "', '" . $msg . "', '" . $multi . "', '" . Yii::app()->name . "') 
								";
                            }
                            $connection2->createCommand($sql)->execute();
                        }
                    }
                }

                $this->redirect(['view', 'id' => $model->id]);
            }
        }
        $this->render('createSingle', [
            'model' => $model,
        ]);
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if (isset($_POST['sSmsout'])) {
            $model->attributes = $_POST['sSmsout'];
            $model->receivergroup_tag = $_POST['receivergroup_tag'];
            if ($model->save())
                $this->redirect(['view', 'id' => $model->id]);
        }
        $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();
        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : ['admin']);
    }

    public function actionSent()
    {
        $this->render('sent', [
        ]);
    }

    public function actionQueue()
    {
        $rawData = Yii::app()->db->createCommand('SELECT *,ID as id FROM outbox')->queryAll();
        $dataProvider = new CArrayDataProvider($rawData, [
            'id' => 'user',
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);

        $this->render('queue', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndex()
    {
        $this->redirect(['inbox']);
    }

    public function actionInbox()
    {
        $this->render('inbox', [
        ]);
    }

    public function actionAddressbook()
    {
        $model = new sAddressbook('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['sAddressbook']))
            $model->attributes = $_GET['sAddressbook'];
        $this->render('addressbook', [
            'model' => $model,
        ]);
    }

    public function actionAddressbookGroup()
    {
        $model = new sAddressbookGroup('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['sAddressbookGroup']))
            $model->attributes = $_GET['sAddressbookGroup'];
        $this->render('addressbookGroup', [
            'model' => $model,
        ]);
    }

    public function actionViewAddressbook($id)
    {
        $this->render('viewAddressbook', [
            'model' => $this->loadModelAddressbook($id),
        ]);
    }

    public function actionDeleteAddressbook($id)
    {
        $this->loadModelAddressbook($id)->delete();
        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : ['addressbook']);
    }

    public function actionUpdateAddressbook($id)
    {
        $model = $this->loadModelAddressbook($id);
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if (isset($_POST['sAddressbook'])) {
            $model->attributes = $_POST['sAddressbook'];
            if ($model->save())
                $this->redirect(['addressbook']);
        }
        $this->render('updateAddressbook', [
            'model' => $model,
        ]);
    }

    public function loadModelAddressbook($id)
    {
        $model = sAddressbook::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function actionCreateAddressbook()
    {
        $model = new sAddressbook;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if (isset($_POST['sAddressbook'])) {
            $model->attributes = $_POST['sAddressbook'];
            if ($model->save())
                $this->redirect(['addressbook']);
        }
        $this->render('createAddressbook', [
            'model' => $model,
        ]);
    }

    public function actionViewAddressbookGroup($id)
    {
        $newMember = $this->newMember($id);

        $this->render('viewAddressbookGroup', [
            'model' => $this->loadModelAddressbookGroup($id),
            'modelMember' => $newMember,
        ]);
    }

    public function newMember($id)
    {
        $model = new fAddressbook;
        if (isset($_POST['fAddressbook'])) {
            $model->attributes = $_POST['fAddressbook'];
            $modelNew = $this->loadModelAddressbook($model->pid);
            $modelGroup = $this->loadModelAddressbookGroup($id);

            $modelNew->member_of = $modelNew->member_of . "," . $modelGroup->group_name;
            if ($modelNew->save(false))
                $this->refresh();
        }

        return $model;
    }

    public function actionDeleteAddressbookGroup($id)
    {
        $this->loadModelAddressbookGroup($id)->delete();
        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : ['addressbookGroup']);
    }

    public function actionUpdateAddressbookGroup($id)
    {
        $model = $this->loadModelAddressbookGroup($id);
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if (isset($_POST['sAddressbookGroup'])) {
            $model->attributes = $_POST['sAddressbookGroup'];
            if ($model->save())
                $this->redirect(['addressbookGroup']);
        }
        $this->render('updateAddressbookGroup', [
            'model' => $model,
        ]);
    }

    public function loadModelAddressbookGroup($id)
    {
        $model = sAddressbookGroup::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function actionCreateAddressbookGroup()
    {
        $model = new sAddressbookGroup;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if (isset($_POST['sAddressbookGroup'])) {
            $model->attributes = $_POST['sAddressbookGroup'];
            $model->category_name = "sms";
            if ($model->save())
                $this->redirect(['addressbookGroup']);
        }
        $this->render('createAddressbookGroup', [
            'model' => $model,
        ]);
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return sSmsout the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = sSmsout::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param sSmsout $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 's-smsout-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionAddressAutoComplete()
    {


        $res = [];
        if (isset($_GET['term'])) {
            $qtxt = "SELECT a.complete_name as label, a.id FROM s_addressbook a
			WHERE a.complete_name LIKE :name
			ORDER BY a.complete_name LIMIT 20";

            $command = Yii::app()->db->createCommand($qtxt);
            $command->bindValue(":name", '%' . $_GET['term'] . '%', PDO::PARAM_STR);
            $res = $command->queryAll();
        }
        echo CJSON::encode($res);
    }

}
