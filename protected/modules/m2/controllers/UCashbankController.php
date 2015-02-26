<?php

class UCashbankController extends Controller
{

    public $layout = '//layouts/column2';

    public function filters()
    {
        return [
            'rights',
        ];
    }

    public function actionView($id)
    {
        //----- begin new code --------------------
        if (!empty($_GET['asDialog']))
            $this->layout = '//layouts/iframe';
        //----- end new code --------------------
        //This Criteria for Related Journal
        $criteria = new CDbCriteria;
        $criteria1 = new CDbCriteria;
        $_exp = explode(" ", $this->loadModel($id)->remark);

        $criteria->compare('module_id', 2);
        $criteria->compare('id!', $this->loadModel($id)->id);

        if (Yii::app()->user->name != "admin") {
            $criteria->addInCondition('entity_id', sUser::model()->myGroupArray);
        }

        for ($i = 0; $i < sizeof($_exp); ++$i):
            $criteria1->compare('remark', $_exp[$i], true, 'OR');
        endfor;

        $criteria->mergeWith($criteria1);

        $dependency = new CDbCacheDependency('SELECT MAX(id) FROM t_journal');

        $dataProvider = new CActiveDataProvider('tJournal', [
            'criteria' => $criteria,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => 'input_date',
            ]
        ]);
        //End of Related Journal

        $this->render('view', [
            'model' => $this->loadModel($id),
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = new fJournal;
        $modelHeader = tJournal::model()->findByPk((int)$id);

        if ($modelHeader->state_id == 3 or $modelHeader->state_id == 4) {
            Yii::app()->user->setFlash("error", "<strong>Error!</strong> Journal cannot be edited. It has been posted/locked...");
            $this->redirect(['/m2/uCashbank/view', 'id' => $modelHeader->id]);
        }

        //$this->performAjaxValidation($model);

        $_myDebit = 0;
        $_myCredit = 0;

        $model->balance = "NOT OK";

        if (isset($_POST['account_no_id'])) {
            $model->attributes = $_POST['fJournal'];

            $model->input_date = $_POST['fJournal']['input_date'];
            $model->yearmonth_periode = Yii::app()->params["cCurrentPeriod"];
            $model->remark = $_POST['fJournal']['remark'];
            $model->var_account = $_POST['fJournal']['var_account'];
            $model->account_no_id = $_POST['account_no_id'];
            $model->user_remark = $_POST['user_remark'];

            if ($model->journal_type_id == 3) { //CB-expense
                $model->debit = $_POST['debit'];
                $model->credit = [0];

                $_myBalance = 0; //default

                foreach ($model->debit as $_debit)
                    $_myDebit = $_myDebit + $_debit;

                foreach ($model->credit as $_credit)
                    $_myCredit = $_myCredit + $_credit;

                $_myBalance = $_myDebit - $_myCredit;

                $model->balance = "OK";

                if ($model->validate()) {

                    $modelHeader->input_date = $_POST['fJournal']['input_date'];
                    $modelHeader->remark = $_POST['fJournal']['remark'];
                    $modelHeader->cb_custom1 = $_POST['fJournal']['cb_receiver'];

                    $modelHeader->save();

                    tJournalDetail::model()->deleteAll('parent_id = ' . $id); //delete All Journal Detail

                    $_tdebet = 0;
                    $_tcredit = 0;

                    for ($i = 0; $i < sizeof($model->account_no_id); ++$i):
                        $modelDetail = new tJournalDetail;
                        $modelDetail->parent_id = $modelHeader->id;
                        $modelDetail->account_no_id = $model->account_no_id[$i];

                        if ($model->debit[$i] != null) {
                            $modelDetail->debit = $model->debit[$i];
                        } else
                            $modelDetail->debit = 0;

                        if ($modelDetail->credit[$i] != null) {
                            $modelDetail->credit = $model->credit[$i];
                        } else
                            $modelDetail->credit = 0;

                        $modelDetail->user_remark = $model->user_remark[$i];

                        $modelDetail->save();
                    endfor;

                    $modelDetail = new tJournalDetail;
                    $modelDetail->parent_id = $modelHeader->id;
                    $modelDetail->account_no_id = $_POST['fJournal']['var_account'];

                    $modelDetail->debit = 0;
                    $modelDetail->credit = $_myBalance;

                    $modelDetail->system_remark = "Automated by System";
                    $modelDetail->user_remark = $model->user_remark[0];
                    $modelDetail->save();

                    //Create System_ref
                    $_ref = "CB-" . $modelDetail->account->cashbankCode->mvalue . "-" . $modelHeader->yearmonth_periode . "-EXP-" . str_pad($modelHeader->id, 5, "0", STR_PAD_LEFT);
                    $modelHeader->updateByPk((int)$modelHeader->id, ['system_ref' => $_ref]);

                    Yii::app()->user->setFlash("success", "<strong>Great!</strong> Journal updated succesfully...");
                    $this->redirect(['/m2/uCashbank/view', 'id' => $modelHeader->id]);
                    //$this->redirect(array('/m2/uCashbank'));
                }

                $this->render('create', ['model' => $model]);
                Yii::app()->end();
            } else { //CB-Income
                $model->debit = [0];
                $model->credit = $_POST['credit'];

                foreach ($model->debit as $_debit)
                    $_myDebit = $_myDebit + $_debit;

                foreach ($model->credit as $_credit)
                    $_myCredit = $_myCredit + $_credit;

                $_myBalance = $_myCredit - $_myDebit;

                $model->balance = "OK";

                if ($model->validate()) {

                    $modelHeader->input_date = $_POST['fJournal']['input_date'];
                    $modelHeader->remark = $_POST['fJournal']['remark'];
                    $modelHeader->cb_custom1 = $_POST['fJournal']['cb_received_from'];

                    $modelHeader->save();

                    tJournalDetail::model()->deleteAll('parent_id = ' . $id); //delete All Journal

                    $modelDetail = new tJournalDetail;
                    $modelDetail->parent_id = $modelHeader->id;
                    $modelDetail->account_no_id = $_POST['fJournal']['var_account'];

                    $modelDetail->debit = $_myBalance;
                    $modelDetail->credit = 0;

                    $modelDetail->system_remark = "Automated by System";
                    $modelDetail->user_remark = $model->user_remark[0];
                    $modelDetail->save();

                    //Create System_ref
                    $_ref = "CB-" . $modelDetail->account->cashbankCode->mvalue . "-" . $modelHeader->yearmonth_periode . "-INC-" . str_pad($modelHeader->id, 5, "0", STR_PAD_LEFT);
                    $modelHeader->updateByPk((int)$modelHeader->id, ['system_ref' => $_ref]);

                    $_tdebet = 0;
                    $_tcredit = 0;

                    for ($i = 0; $i < sizeof($model->account_no_id); ++$i):
                        $modelDetail = new tJournalDetail;
                        $modelDetail->parent_id = $modelHeader->id;
                        $modelDetail->account_no_id = $model->account_no_id[$i];

                        if ($model->debit[$i] != null) {
                            $modelDetail->debit = $model->debit[$i];
                        } else
                            $modelDetail->debit = 0;

                        if ($model->credit[$i] != null) {
                            $modelDetail->credit = $model->credit[$i];
                        } else
                            $modelDetail->credit = 0;

                        $modelDetail->user_remark = $model->user_remark[$i];

                        $modelDetail->save();
                    endfor;

                    Yii::app()->user->setFlash("success", "<strong>Great!</strong> Journal updated succesfully...");
                    $this->redirect(['/m2/uCashbank/view', 'id' => $modelHeader->id]);
                    //$this->redirect(array('/m2/uCashbank'));
                }

                $this->render('create', ['model' => $model]);
                Yii::app()->end();
            }
        }

        //Fill Current Value
        if (!isset($_POST['account_no_id'])) {
            $model->input_date = $modelHeader->input_date;
            $model->remark = $modelHeader->remark;
            $model->system_ref = $modelHeader->system_ref;
            $model->master_id = $modelHeader->id;
            $model->journal_type_id = $modelHeader->journal_type_id;

            if ($model->journal_type_id == 2) { //CB-income
                $model->cb_received_from = $modelHeader->cb_custom1;
            } else
                $model->cb_receiver = $modelHeader->cb_custom1;

            $modelDetail = tJournalDetail::model()->findAll('parent_id =' . $modelHeader->id);

            $justonce = 0;
            foreach ($modelDetail as $mm) {
                if ($justonce == 0 && in_array($mm->account_no_id, tAccount::cashBankAccountList())) {
                    $model->var_account = $mm->account_no_id;
                    $justonce = 1;
                } else {
                    $model->account_no_id[] = $mm->account_no_id;
                    $model->debit[] = $mm->debit;
                    $model->credit[] = $mm->credit;
                    $model->user_remark[] = $mm->user_remark;
                }
            }
        }

        $this->render('update', ['model' => $model]);
    }

    public function actionDelete($id)
    {
        $model = $this->loadModel($id);

        if ($model->state_id == 3 or $model->state_id == 4) {
            Yii::app()->user->setFlash("error", "<strong>Error!</strong> Journal cannot be deleted. It has been posted/locked...");
            $this->redirect(['/m2/uCashbank/view', 'id' => $model->id]);
        }

        $model->delete();

        Yii::app()->user->setFlash("success", "Journal has been deleted succesfully... ");
        $this->redirect(['/m2/uCashbank']);
    }

    public function actionIndex($pid = 0)
    {
        $model = new tJournal;
        $model->unsetAttributes();

        $criteria = new CDbCriteria;
        $criteria1 = new CDbCriteria;

        $criteria->with = ['journalDetail'];
        $criteria->together = true;
        $criteria->limit = 20;
        $criteria->compare('module_id', 2);
        $criteria->order = 't.yearmonth_periode DESC, journalDetail.updated_date DESC, journalDetail.debit';
        //$criteria->compare('yearmonth_periode',Yii::app()->params["cCurrentPeriod"]);

        if ($pid != 0) {
            $criteria->together = true;
            $criteria->compare('journalDetail.account_no_id', $pid);
        }

        if (isset($_GET['tJournal'])) {
            $model->attributes = $_GET['tJournal'];
            $criteria1->compare('system_ref', $_GET['tJournal']['system_ref'], true, 'OR');
            $criteria1->compare('remark', $_GET['tJournal']['system_ref'], true, 'OR');
        }

        if (Yii::app()->user->name != "admin") {
            $criteria->AddInCondition('entity_id', sUser::model()->myGroupArray);
        }

        $criteria->mergeWith($criteria1);

        $dataProvider = new CActiveDataProvider('tJournal', [
            'criteria' => $criteria
        ]);

        $this->render('index', [
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    public function loadModel($id)
    {
        $criteria = new CDbCriteria;
        $criteria->compare('module_id', 2);
        $criteria->with = ['entity'];

        if (Yii::app()->user->name != "admin") {
            //$criteria->compare('entity_id',sUser::model()->myGroup);
            $criteria->addInCondition('entity_id', sUser::model()->myGroupArray);
        }

        $model = tJournal::model()->findByPk($id, $criteria);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function actionCashbankAutoComplete()
    {
        $res = [];
        if (isset($_GET['term'])) {
            $qtxt = "SELECT system_ref FROM t_journal WHERE module_id = 2 AND system_ref LIKE :name ORDER BY system_ref DESC LIMIT 20";
            $command = Yii::app()->db->createCommand($qtxt);
            $command->bindValue(":name", '%' . $_GET['term'] . '%', PDO::PARAM_STR);
            $res = $command->queryColumn();
        }
        echo CJSON::encode($res);
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'u-journal-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionCreate()
    {
        $model = new fJournal('cashbank');
        $model->setScenario('expense');

        //$this->performAjaxValidation($model);

        $_myDebit = 0;
        $_myCredit = 0;
        $_myBalance = 0;

        $model->balance = "NOT OK";

        if (isset($_POST['account_no_id'])) {
            $model->attributes = $_POST['fJournal'];

            $model->account_no_id = $_POST['account_no_id'];
            $model->debit = $_POST['debit'];
            //$model->credit=$_POST['credit'];
            $model->credit = [0];
            $model->user_remark = $_POST['user_remark'];

            foreach ($model->debit as $_debit)
                $_myDebit = $_myDebit + $_debit;

            foreach ($model->credit as $_credit)
                $_myCredit = $_myCredit + $_credit;

            $_myBalance = $_myDebit - $_myCredit;

            $model->balance = "OK";

            if ($model->validate()) {
                $modelHeader = new tJournal;

                $modelHeader->input_date = $_POST['fJournal']['input_date'];
                $modelHeader->yearmonth_periode = Yii::app()->params["cCurrentPeriod"];
                $modelHeader->cb_custom1 = $_POST['fJournal']['cb_receiver'];
                $modelHeader->remark = $_POST['fJournal']['remark'];

                $modelHeader->entity_id = sUser::model()->myGroup; //default Group
                $modelHeader->module_id = 2; //CB
                $modelHeader->state_id = 1;
                $modelHeader->journal_type_id = 3; //CB-expense

                $modelHeader->save();

                $_tdebet = 0;
                $_tcredit = 0;

                for ($i = 0; $i < sizeof($model->account_no_id); ++$i):
                    $modelDetail = new tJournalDetail;
                    $modelDetail->parent_id = $modelHeader->id;
                    $modelDetail->account_no_id = $model->account_no_id[$i];

                    if ($model->debit[$i] != null) {
                        $modelDetail->debit = $model->debit[$i];
                    } else
                        $modelDetail->debit = 0;

                    if ($model->credit[$i] != null) {
                        $modelDetail->credit = $model->credit[$i];
                    } else
                        $modelDetail->credit = 0;

                    if ($modelDetail->user_remark[$i] != null) {
                        $modelDetail->user_remark = $model->user_remark[$i];
                    } else
                        $modelDetail->user_remark = $modelHeader->cb_custom1 . ". " . $modelHeader->remark;

                    $modelDetail->sub_account_id = 0;

                    $modelDetail->save();
                endfor;

                $modelDetail = new tJournalDetail;
                $modelDetail->parent_id = $modelHeader->id;
                $modelDetail->account_no_id = $_POST['fJournal']['var_account'];

                $modelDetail->debit = 0;
                $modelDetail->credit = $_myBalance;

                $modelDetail->system_remark = "Automated by System";
                $modelDetail->user_remark = $modelHeader->cb_custom1 . ". " . $modelHeader->remark;
                $modelDetail->sub_account_id = 0;
                $modelDetail->save();

                //Create System_ref
                $_ref = "CB-" . $modelDetail->account->cashbankCode->mvalue . "-" . $modelHeader->yearmonth_periode . "-EXP-" . str_pad($modelHeader->id, 5, "0", STR_PAD_LEFT);
                $modelHeader->updateByPk((int)$modelHeader->id, ['system_ref' => $_ref]);

                Yii::app()->user->setFlash("success", "Journal created succesfully...");

                $this->redirect(['/m2/uCashbank']);
            }
        }
        $this->render('create', ['model' => $model]);
    }

    public function actionCreateIncome()
    {
        $model = new fJournal('cashbank');
        $model->setScenario('income');

        //$this->performAjaxValidation($model);

        $_myDebit = 0;
        $_myCredit = 0;
        $_myBalance = 0;

        $model->balance = "NOT OK";

        if (isset($_POST['account_no_id'])) {
            $model->attributes = $_POST['fJournal'];

            $model->account_no_id = $_POST['account_no_id'];
            //$model->debit=$_POST['debit'];
            $model->debit = [0];
            $model->credit = $_POST['credit'];
            $model->user_remark = $_POST['user_remark'];

            foreach ($model->debit as $_debit)
                $_myDebit = $_myDebit + $_debit;

            foreach ($model->credit as $_credit)
                $_myCredit = $_myCredit + $_credit;

            $_myBalance = $_myCredit - $_myDebit;

            $model->balance = "OK";

            if ($model->validate()) {
                $modelHeader = new tJournal;

                $modelHeader->input_date = $_POST['fJournal']['input_date'];
                $modelHeader->yearmonth_periode = Yii::app()->params["cCurrentPeriod"];
                $modelHeader->cb_custom1 = $_POST['fJournal']['cb_received_from'];
                $modelHeader->remark = $_POST['fJournal']['remark'];

                $modelHeader->entity_id = sUser::model()->myGroup; //default Group
                $modelHeader->module_id = 2; //CB
                $modelHeader->state_id = 1;
                $modelHeader->journal_type_id = 2; //CB-Income

                $modelHeader->save();

                $modelDetail = new tJournalDetail;
                $modelDetail->parent_id = $modelHeader->id;
                $modelDetail->account_no_id = $_POST['fJournal']['var_account'];

                $modelDetail->debit = $_myBalance;
                $modelDetail->credit = 0;

                $modelDetail->system_remark = "Automated by System";
                $modelDetail->user_remark = $modelHeader->cb_custom1 . ". " . $modelHeader->remark;
                $modelDetail->sub_account_id = 0;
                $modelDetail->save();

                //Create System_ref
                $_ref = "CB-" . $modelDetail->account->cashbankCode->mvalue . "-" . $modelHeader->yearmonth_periode . "-INC-" . str_pad($modelHeader->id, 5, "0", STR_PAD_LEFT);
                $modelHeader->updateByPk((int)$modelHeader->id, ['system_ref' => $_ref]);

                $_tdebet = 0;
                $_tcredit = 0;

                for ($i = 0; $i < sizeof($model->account_no_id); ++$i):
                    $modelDetail = new tJournalDetail;
                    $modelDetail->parent_id = $modelHeader->id;
                    $modelDetail->account_no_id = $model->account_no_id[$i];

                    if ($model->debit[$i] != null) {
                        $modelDetail->debit = $model->debit[$i];
                    } else
                        $modelDetail->debit = 0;

                    if ($model->credit[$i] != null) {
                        $modelDetail->credit = $model->credit[$i];
                    } else
                        $modelDetail->credit = 0;

                    if ($modelDetail->user_remark[$i] != null) {
                        $modelDetail->user_remark = $model->user_remark[$i];
                    } else
                        $modelDetail->user_remark = $modelHeader->cb_custom1 . ". " . $modelHeader->remark;

                    $modelDetail->sub_account_id = 0;

                    $modelDetail->save();
                endfor;

                Yii::app()->user->setFlash("success", "Journal created succesfully... View Jurnal: " . CHtml::link($modelHeader->system_ref, Yii::app()->createUrl("/m2/uCashbank/view", ["id" => $modelHeader->id])));
                $this->redirect(['/m2/uCashbank']);
            }
        }

        $this->render('createIncome', ['model' => $model]);
    }

    public function actionPrint($id)
    {
        $pdf = new journalVoucher1('P', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 12);

        $pdf->report($id);

        $pdf->Output();
    }

}
