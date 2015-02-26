<?php

class TAccountController extends Controller
{

    public $layout = '//layouts/column2breadcrumb';

    public function filters()
    {
        return [
            'rights',
        ];
    }

    public function newEntity($id)
    {
        $model = new tAccountEntity;

        //$this->performAjaxValidation($model);

        if (isset($_POST['tAccountEntity'])) {
            $model->attributes = $_POST['tAccountEntity'];
            $model->parent_id = (int)$id;
            if ($model->save()) {
                $this->redirect(['view', 'id' => $id, '#' => 'yw4_tab_2']);
            } else
                Yii::app()->user->setFlash("error", "<strong>Error!</strong> This Entity already inputed...");
        }

        return $model;
    }

    public function actionViewJournal($id)
    {
        //----- begin new code --------------------
        if (!empty($_GET['asDialog']))
            $this->layout = '//layouts/iframe';
        //----- end new code --------------------

        $model = tJournal::model()->findByPk($id);

        $this->render('/tJournal/view', [
            'model' => $model,
        ]);
    }

    public function actionView($id)
    {
        //$this->layout = '//layouts/column2breadcrumb';

        $account = $this->newAccount($id);
        $entity = $this->newEntity($id);
        /*
          $criteria=new CDbCriteria;

          $criteria->compare('account_no_id',$id);
          $criteria->with=('journal');
          $criteria->compare('yearmonth_periode',Yii::app()->params["cCurrentPeriod"]);

          $total=tJournalDetail::model()->count($criteria);

          $pages = new CPagination($total);
          $pages->pageSize = 20;
          $pages->applyLimit($criteria);
         */

        $this->render('view', [
            'model' => $this->loadModel($id),
            'modelAccount' => $account,
            'modelEntity' => $entity,
            //'pages'=>$pages,
        ]);
    }

    public function newAccount($id)
    {
        $model = new tAccount();

        // $this->performAjaxValidation($model);

        if (isset($_POST['tAccount'])) {
            $model->attributes = $_POST['tAccount'];
            $model->parent_id = (int)$id;

            if ($model->save()) {

                //haschild
                $modelProperties2Add = new tAccountProperties();
                $modelProperties2Add->parent_id = $model->id;
                $modelProperties2Add->mkey = "haschild_id";
                $modelProperties2Add->mvalue = $_POST['tAccount']['haschild_id'];
                $modelProperties2Add->save();

                //currency
                //$modelProperties3Add = new tAccountProperties();
                //$modelProperties3Add->parent_id=$model->id;
                //$modelProperties3Add->mkey="currency_id";
                //$modelProperties3Add->mvalue=$_POST['tAccount']['currency_id'];
                //$modelProperties3Add->save();
                //state
                //$modelProperties4Add = new tAccountProperties();
                //$modelProperties4Add->parent_id=$model->id;
                //$modelProperties4Add->mkey="state_id";
                //$modelProperties4Add->mvalue=$_POST['tAccount']['state_id'];
                //$modelProperties4Add->save();
                //Balance
                //$modelProperties5Add = new tBalanceSheet();
                //$modelProperties5Add->parent_id = $model->id;
                //$modelProperties5Add->yearmonth_periode = Yii::app()->params["cCurrentPeriod"];
                //$modelProperties5Add->type_balance_id = 1;
                //$modelProperties5Add->debit = 0;
                //$modelProperties5Add->credit = 0;
                //$modelProperties5Add->beginning_balance = $_POST['tAccount']['beginning_balance'];
                //$modelProperties5Add->end_balance = $_POST['tAccount']['beginning_balance'];
                //$modelProperties5Add->save();
                //Default Entity
                $modelEntity = new tAccountEntity();
                $modelEntity->parent_id = $model->id;
                $modelEntity->entity_id = sUser::model()->myGroup;
                $modelEntity->state_id = 1; //Active
                $modelEntity->remark = "Default Current Login Entity";
                $modelEntity->save();

                $this->redirect(['view', 'id' => $model->parent_id]);
            }
        }

        return $model;
    }

    public function actionCreate()
    { //create Root
        $model = new tAccount;

        // $this->performAjaxValidation($model);

        if (isset($_POST['tAccount'])) {
            $model->attributes = $_POST['tAccount'];
            $model->parent_id = 0;
            $model->haschild_id = 2; //must have children

            if ($model->save()) {
                //accmain
                $modelProperties0Add = new tAccountProperties();
                $modelProperties0Add->parent_id = $model->id;
                $modelProperties0Add->mkey = "accmain_id";
                $modelProperties0Add->mvalue = $_POST['tAccount']['accmain_id']; //must have children
                $modelProperties0Add->save();

                //haschild
                $modelProperties1Add = new tAccountProperties();
                $modelProperties1Add->parent_id = $model->id;
                $modelProperties1Add->mkey = "haschild_id";
                $modelProperties1Add->mvalue = 2; //must have children
                $modelProperties1Add->save();

                //currency
                $modelProperties2Add = new tAccountProperties();
                $modelProperties2Add->parent_id = $model->id;
                $modelProperties2Add->mkey = "currency_id";
                $modelProperties2Add->mvalue = $_POST['tAccount']['currency_id'];
                $modelProperties2Add->save();

                //state
                $modelProperties3Add = new tAccountProperties();
                $modelProperties3Add->parent_id = $model->id;
                $modelProperties3Add->mkey = "state_id";
                $modelProperties3Add->mvalue = $_POST['tAccount']['state_id'];
                $modelProperties3Add->save();

                //Default Entity
                $modelEntity = new tAccountEntity();
                $modelEntity->parent_id = $model->id;
                $modelEntity->entity_id = sUser::model()->myGroup;
                $modelEntity->save();

                $this->redirect(['view', 'id' => $model->id]);
            }
        }

        $this->render('createroot', [
            'model' => $model,
        ]);
    }

    public function actionUpdateRoot($id)
    {
        $model = $this->loadModelRoot($id);

        // $this->performAjaxValidation($model);

        if (isset($_POST['tAccount'])) {
            $model->attributes = $_POST['tAccount'];
            $model->haschild_id = 2; //to prevent error validation
            if ($model->save()) {
                //accmain_id
                $modelProperties0 = tAccountProperties::model()->find([
                    'condition' => 'mkey = \'accmain_id\' AND parent_id = :id',
                    'params' => [':id' => $id],
                ]);
                $modelProperties0->mvalue = $_POST['tAccount']['accmain_id'];
                $modelProperties0->save();

                //currency_id
                $modelProperties2 = tAccountProperties::model()->find([
                    'condition' => 'mkey = \'currency_id\' AND parent_id = :id',
                    'params' => [':id' => $id],
                ]);
                $modelProperties2->mvalue = $_POST['tAccount']['currency_id'];
                $modelProperties2->save();

                //state_id
                $modelProperties3 = tAccountProperties::model()->find([
                    'condition' => 'mkey = \'state_id\' AND parent_id = :id',
                    'params' => [':id' => $id],
                ]);
                $modelProperties3->mvalue = $_POST['tAccount']['state_id'];
                $modelProperties3->save();

                $this->redirect(['view', 'id' => $model->id]);
            }
        }

        $model->accmain_id = $model->accmain->mvalue;
        $model->currency_id = $model->currency->mvalue;
        $model->state_id = $model->state->mvalue;

        $this->render('updateroot', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        if ($model->parent_id == 0)
            $this->forward('updateRoot');

        // $this->performAjaxValidation($model);

        if (isset($_POST['tAccount'])) {
            $model->attributes = $_POST['tAccount'];
            if ($model->save()) {

                $model->account_properties = $_POST['account_properties'];
                $model->value = $_POST['value'];

                tAccountProperties::model()->deleteAll('parent_id = ' . $id); //delete All Related Properties

                for ($i = 0; $i < sizeof($model->account_properties); ++$i):
                    $modelProp = new tAccountProperties;
                    $modelProp->parent_id = $id;
                    $modelProp->mkey = $model->account_properties[$i];
                    $modelProp->mvalue = $model->value[$i];

                    $modelProp->save();
                endfor;

                $modelProp = new tAccountProperties;
                $modelProp->parent_id = $id;
                $modelProp->mkey = "haschild_id";
                $modelProp->mvalue = $model->haschild_id;

                $modelProp->save();


                $this->redirect(['view', 'id' => $model->id]);
            }
        } else
            $criteria = new CDbCriteria;
        $criteria->addNotInCondition('mkey', ['accmain_id', 'haschild_id']);
        $criteria->compare('parent_id', $model->id);
        $modelDetail = tAccountProperties::model()->findAll($criteria);

        foreach ($modelDetail as $mm) {
            $model->account_properties[] = $mm->mkey;
            $model->value[] = $mm->mvalue;
        }

        if ($model->haschild) {
            $model->haschild_id = "Yes";
        } else
            $model->haschild_id = "No";


        $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $cekJournal = $this->loadModel($id)->hasJournal;
        $cekChild = $this->loadModel($id)->childs; //persistent Child


        if (!empty($cekJournal)) {
            Yii::app()->user->setFlash("error", "<strong>Error!</strong> Account cannot be deleted. It is must empty transaction on current period...");
            $this->redirect(['/m2/tAccount/view', 'id' => $id]);
        } elseif ($cekChild) {
            Yii::app()->user->setFlash("error", "<strong>Error!</strong> Account cannot be deleted. It have child account...");
            $this->redirect(['/m2/tAccount/view', 'id' => $id]);
        } else {
            $this->loadModel($id)->delete();
            $this->redirect(['/m2/tAccount']);
        }
    }

    public function actionDeleteEntity($id)
    {
        $this->loadModelEntity($id)->delete();
    }

    public function actionIndex()
    {
        $model = new tAccount('search');
        $model->unsetAttributes();

        $criteria = new CDbCriteria;

        if (isset($_GET['tAccount'])) {
            $model->attributes = $_GET['tAccount'];

            $criteria->compare('account_name', $_GET['tAccount']['account_name'], true);
        }

        $criteria->order = 'account_no';

        $total = tAccount::model()->count();

        $pages = new CPagination($total);
        $pages->pageSize = 20;
        $pages->applyLimit($criteria);


        $dependency = new CDbCacheDependency('SELECT MAX(id) FROM t_account');

        $dataProvider = tAccount::model()->findAll($criteria);
        //$dataProvider = new CActiveDataProvider(tAccount::model()->cache(3600, $dependency, 2), array(
        //    'criteria' => $criteria,
        //        )
        //);

        $this->render('index', [
            'dataProvider' => $dataProvider,
            'model' => $model,
            'pages' => $pages,
        ]);
    }

    public function actionGenerate($id)
    {
        $_curPeriod = Yii::app()->params["cCurrentPeriod"];

        $modelBalanceCurrent = tBalanceSheet::model()->find([
            'condition' => 'parent_id = :accid AND yearmonth_periode = :period',
            'params' => [':accid' => $id, ':period' => $_curPeriod],
        ]);

        if ($modelBalanceCurrent == null) {
            $modelBalanceCurrent = new tBalanceSheet;
            $modelBalanceCurrent->parent_id = $id;
            $modelBalanceCurrent->yearmonth_periode = $_curPeriod;
            $modelBalanceCurrent->save(false);
        }

        $this->redirect(['/m2/tAccount/view', 'id' => $id]);
    }

    public function actionReload()
    {
        $_curPeriod = Yii::app()->params["cCurrentPeriod"];
        $_lastPeriod = peterFunc::cBeginDateBefore(Yii::app()->params["cCurrentPeriod"]);

        //#1. START DELETE ALL CURRENT PERIOD
        $commandDELETE = Yii::app()->db->createCommand('
				DELETE FROM t_balance_sheet 
				WHERE yearmonth_periode = ' . $_curPeriod . ';');

        $commandDELETE->execute();
        //#1. END DELETE ALL CURRENT PERIOD
        //#2. START TRANFER FROM OLD PERIOD TO NEW PERIOD
        $criteria = new CDbCriteria;
        $criteria->compare('yearmonth_periode', $_lastPeriod);

        $modelBalanceLastTranfer = tBalanceSheet::model()->findAll($criteria);


        if ($modelBalanceLastTranfer != null) { //SUDAH ADA OLD PERIODE
            foreach ($modelBalanceLastTranfer as $mod) {


                if ($mod->account->getTypeValue() == 1) {
                    $modelBalanceCurrentTransfer = tBalanceSheet::model()->find([
                        'condition' => 'parent_id = :accid AND yearmonth_periode = :period',
                        'params' => [':accid' => $mod->parent_id, ':period' => $_curPeriod],
                    ]);

                    if ($modelBalanceCurrentTransfer == null) { //JIKA TIDAK ADA TRANFER DATANYA DAN HANYA ACCOUNT NERACA SAJA
                        $modelBalanceNew = new tBalanceSheet;
                        $modelBalanceNew->parent_id = $mod->parent_id;
                        $modelBalanceNew->yearmonth_periode = $_curPeriod;
                        $modelBalanceNew->beginning_balance = $mod->end_balance;
                        $modelBalanceNew->end_balance = $mod->end_balance;
                        $modelBalanceNew->save(false);
                    }
                }
            }
        }
        //#2. END TRANFER FROM OLD PERIOD TO NEW PERIOD
        //#3. START POSTING VALUE
        $criteria = new CDbCriteria;
        $criteria->with = ['journal'];
        $criteria->compare('journal.state_id', 4);
        $criteria->compare('journal.yearmonth_periode', $_curPeriod);
        $models = tJournalDetail::model()->findAll($criteria);

        foreach ($models as $model) {

            $modelBalanceCurrent = tBalanceSheet::model()->find([
                'condition' => 'parent_id = :accid AND yearmonth_periode = :period',
                'params' => [':accid' => $model->account_no_id, ':period' => $_curPeriod],
            ]);

            if ($modelBalanceCurrent == null) {
                $modelBalanceCurrent = new tBalanceSheet;
                $modelBalanceCurrent->parent_id = $model->account_no_id;
                $modelBalanceCurrent->yearmonth_periode = $_curPeriod;

                $modelBalanceCurrent->save(false);
            }

            $_debit = $model->debit;
            $_credit = $model->credit;
            $_endbalance = 0;

            $_curdebit = $modelBalanceCurrent->debit + $_debit;
            $_curcredit = $modelBalanceCurrent->credit + $_credit;
            $_curbalance = $modelBalanceCurrent->end_balance;

            //if ($model->account->getSideValue() == 1 || isset($model->account->reverse)) { //Asset, Expense
            if ($model->account->getSideValue() == 1) { //Asset, Expense
                $_endbalance = $_curbalance + $_debit - $_credit;
            } else { //Pasiva, Income
                $_endbalance = $_curbalance + $_credit - $_debit;
            }

            $command2 = Yii::app()->db->createCommand('
					UPDATE  t_balance_sheet SET
					debit = ' . $_curdebit . ',
					credit = ' . $_curcredit . ',
					end_balance = ' . $_endbalance . '
					WHERE yearmonth_periode = ' . $_curPeriod . ' AND parent_id = ' . $model->account_no_id . ';');

            $command2->execute();
        }
        //#4. END POSTING VALUE
        //#5. START POSTING LABA DITAHAN
        $_labarugi = tAccount::netprofit($_curPeriod);

        $_lraccount = tAccount::model()->with('accmain')->find('accmain.mvalue=8')->id;

        if ($_lraccount != null) {

            $modelBalanceCurrent = tBalanceSheet::model()->find([
                'condition' => 'parent_id = :account AND yearmonth_periode = :period',
                'params' => [':account' => $_lraccount, ':period' => $_curPeriod],
            ]);

            if ($modelBalanceCurrent == null) {
                $modelBalanceCurrent = new tBalanceSheet;
                $modelBalanceCurrent->parent_id = $_lraccount;
                $modelBalanceCurrent->yearmonth_periode = $_curPeriod;

                //Check Last Balance
                $modelBalanceLast = tBalanceSheet::model()->find([
                    'condition' => 'parent_id = :accid AND yearmonth_periode = :period',
                    'params' => [':accid' => $_lraccount, ':period' => $_lastPeriod],
                ]);
                if ($modelBalanceLast != null) //if null, default 0 by database default
                    $modelBalanceCurrent->beginning_balance = $modelBalanceLast->end_balance;

                $modelBalanceCurrent->save(false);
            }

            $_endbalance = $_labarugi + $modelBalanceCurrent->beginning_balance;

            if ($_labarugi >= 0) {
                $sql = 'UPDATE t_balance_sheet SET
				debit = 0,
				credit = ' . $_labarugi . ',
				end_balance = ' . $_endbalance . '
				WHERE yearmonth_periode = ' . $_curPeriod . ' AND parent_id = ' . $_lraccount;
            } else {
                $sql = 'UPDATE t_balance_sheet SET
				debit = ' . -($_labarugi) . ',
				credit = 0,
				end_balance = ' . $_endbalance . '
				WHERE yearmonth_periode = ' . $_curPeriod . ' AND parent_id = ' . $_lraccount;
            }

            $command = Yii::app()->db->createCommand($sql);

            $command->execute();
        }
        //#5. END POSTING LABA DITAHAN


        Yii::app()->user->setFlash("success", "<strong>Success!</strong> Generating Trial Balance has finished... ");
        $this->redirect(['/m2/tAccount']);
    }

    public function loadModel($id)
    {
        $model = tAccount::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function loadModelRoot($id)
    {
        $model = tAccount::model()->findByPk($id, ['condition' => 'parent_id = 0']);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function loadModelEntity($id)
    {
        $model = tAccountEntity::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 't-account-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionAjaxFillTree()
    {
        if (!Yii::app()->request->isAjaxRequest) {
            exit();
        }
        $parentId = 0;
        if (isset($_GET['root']) && $_GET['root'] !== 'source') {
            $parentId = (int)$_GET['root'];
        }
        //mySQL
        /**/
        $req = Yii::app()->db->createCommand(
            "SELECT m1.id, m1.account_name AS text, m2.id IS NOT NULL AS hasChildren
				FROM t_account AS m1 LEFT JOIN t_account AS m2 ON m1.id=m2.parent_id
				WHERE m1.parent_id = $parentId
				GROUP BY m1.id ORDER BY m1.account_no ASC"
        );
        /**/

        //Postgree
        /* $req = Yii::app()->db->createCommand(
          "SELECT m1.id, m1.account_name AS text, m2.id IS NOT NULL AS hasChildren
          FROM t_account AS m1 LEFT JOIN t_account AS m2 ON m1.id=m2.parent_id
          WHERE m1.parent_id = $parentId"
          );
         */
        $children = $req->queryAll();

        $treedata = [];
        foreach ($children as $child) {
            $options = ['href' => Yii::app()->createUrl('/m2/tAccount/view', ['id' => $child['id']]), 'id' => $child['id'], 'class' => 'treenode'];
            $nodeText = CHtml::openTag('a', $options);
            $nodeText .= $child['text'];
            $nodeText .= CHtml::closeTag('a') . "\n";
            $child['text'] = $nodeText;
            $treedata[] = $child;
        }
        //$children = $this->createLinks($children);

        echo str_replace(
            '"hasChildren":"0"', '"hasChildren":false',
            //CTreeView::saveDataAsJson($children)
            CTreeView::saveDataAsJson($treedata)
        );
        exit();
    }

    public function actionAccountAutoComplete()
    {
        $res = [];
        if (isset($_GET['term'])) {
            $qtxt = "SELECT account_name as name FROM t_account WHERE account_name LIKE :name ORDER BY account_name LIMIT 20";
            //$qtxt ="SELECT account_name as label, id FROM t_account WHERE account_name LIKE :name ORDER BY account_name LIMIT 20";
            $command = Yii::app()->db->createCommand($qtxt);
            $command->bindValue(":name", '%' . $_GET['term'] . '%', PDO::PARAM_STR);
            $res = $command->queryColumn();
            //$res =$command->queryAll();
        }
        echo CJSON::encode($res);
    }

    public function actionPrintList($id = null)
    {
        $model = new fJournalList;

        if (isset($_POST['fJournalList'])) {
            $model->attributes = $_POST['fJournalList'];
            if ($model->validate()) {

                if ($_POST['fJournalList']['type_report_id'] == 1) {
                    $pdf = new journalVoucherList2('P', 'mm', 'A4');
                } else
                    $pdf = new journalVoucherList1('P', 'mm', 'A4');

                $pdf->AliasNbPages();
                $pdf->AddPage();
                $pdf->SetFont('Arial', '', 12);

                $criteria = new CDbCriteria;
                $criteria->with = ['journal'];
                $criteria->compare('account_no_id', $_POST['fJournalList']['account_no_id']);
                $criteria->order = 'journal.input_date';

                //$criteria->compare('DATE_FORMAT(journal.input_date,"%Y%m")', $_POST['fJournalList']['begindate']);
                $criteria->compare('journal.yearmonth_periode', $_POST['fJournalList']['begindate']);

                $models = tJournalDetail::model()->findAll($criteria);

                if ($models != null) {
                    $pdf->report($models, $_POST['fJournalList']['begindate'], $_POST['fJournalList']['account_no_id']);
                    $pdf->Output();
                } else
                    Yii::app()->user->setFlash("error", "<strong>Error!</strong> No Transaction on this account for this period...");
            }
        }

        if (!isset($model->begindate))
            $model->begindate = Yii::app()->params["cCurrentPeriod"];

        if (isset($id))
            $model->account_no_id = $id;

        $this->render('printList', ['model' => $model]);
    }

    public function actionUpdateBalance($id)
    {
        $model = $this->loadModelBalance($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['tBalanceSheet'])) {
            $model->attributes = $_POST['tBalanceSheet'];
            if ($model->save())
                EQuickDlgs::checkDialogJsScript();
        }

        EQuickDlgs::render('_formBalance', ['model' => $model]);
    }

    public function loadModelBalance($id)
    {
        $model = tBalanceSheet::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

}
