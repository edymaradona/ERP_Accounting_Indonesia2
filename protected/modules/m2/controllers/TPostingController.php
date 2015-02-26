<?php

class TPostingController extends Controller
{

    public $layout = '//layouts/column1';

    public function filters()
    {
        return [
            'rights',
        ];
    }

    public function actionUnlock($id)
    {
        tJournal::model()->updateByPk((int)$id, ['state_id' => 2, 'updated_date' => time(), 'updated_by' => Yii::app()->user->id]);
    }

    public function actionRePosting()
    { //backup Posting only
        $criteria = new CDbCriteria;
        $criteria->compare('state_id', 99);
        $criteria->compare('yearmonth_periode', Yii::app()->params["cCurrentPeriod"]);
        $models = tJournal::model()->findAll($criteria);

        foreach ($models as $model) {
            set_time_limit(0); //
            $this->actionPosting($model->id);
        }

        Yii::app()->user->setFlash('success', '<strong>Great!</strong> Reposting finished..');
        $this->redirect(['/m1/default']);
    }

    public function actionPosting($id)
    {
        tJournal::model()->updateByPk((int)$id, ['state_id' => 4, 'posted_date' => time(), 'posted_by' => Yii::app()->user->id]);
        return true;
    }

    public function actionUnposting($id)
    {
        $locked = tJournal::model()->updateByPk((int)$id, ['state_id' => 2, 'updated_date' => time(), 'updated_by' => Yii::app()->user->id]);
        return true;
    }

    public function actionIndex($acc = null)
    {
        $model = new tJournal('search');
        $model->unsetAttributes();

        $criteria = new CDbCriteria;
        $criteria->condition = 'state_id = 1 OR state_id = 2';
        $criteria->order = 't.updated_date DESC';

        if (isset($_GET['tJournal'])) {
            $model->attributes = $_GET['tJournal'];

            $criteria1 = new CDbCriteria;
            $criteria1->compare('system_ref', $_GET['tJournal']['system_ref'], true, 'OR');
            $criteria1->compare('remark', $_GET['tJournal']['system_ref'], true, 'OR');
            $criteria->mergeWith($criteria1);
        }

        if (isset($_GET['acc'])) {
            $criteria->with = ['journalDetail'];
            $criteria->together = true;
            $criteria->compare('journalDetail.account_no_id', $_GET['acc']);
        }

        $criteria->compare('yearmonth_periode', Yii::app()->params["cCurrentPeriod"]);

        $criteria->limit = 20;


        $dataProvider = new CActiveDataProvider('tJournal', [
            'criteria' => $criteria,
            'pagination' => [
                'pageSize' => 20,
            ]
        ]);

        $this->render('index', [
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    public function actionAllJournal($acc = null)
    {
        $model = new tJournal('search');
        $model->unsetAttributes(); // clear any default values

        $criteria = new CDbCriteria;
        //$criteria->condition = 'state_id =4 or state_id = 3';
        $criteria->order = 't.updated_date DESC'; //last updated
        //$criteria->compare('journal_type_id',4);

        if (isset($_GET['tJournal'])) {
            $model->attributes = $_GET['tJournal'];

            $criteria1 = new CDbCriteria;
            $criteria1->compare('system_ref', $_GET['tJournal']['system_ref'], true, 'OR');
            $criteria1->compare('remark', $_GET['tJournal']['system_ref'], true, 'OR');
            $criteria->mergeWith($criteria1);
        }

        if (isset($_GET['acc'])) {
            $criteria->with = ['journalDetail'];
            $criteria->together = true;
            $criteria->compare('journalDetail.account_no_id', $_GET['acc']);
        }

        $criteria->limit = 20;


        $dataProvider = new CActiveDataProvider('tJournal', [
            'criteria' => $criteria,
            'pagination' => [
                'pageSize' => 20,
            ]
        ]);

        $this->render('allJournal', [
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $model = $this->loadModel($id);

        if ($model->state_id == 4) {
            Yii::app()->user->setFlash("error", "<strong>Error!</strong> Journal cannot be deleted. It has been posted...");
        }

        $model->delete();
    }

    public function loadModel($id)
    {
        $model = tJournal::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function actionPostingAutoComplete()
    {
        $res = [];
        if (isset($_GET['term'])) {
            $qtxt = "SELECT system_ref FROM t_journal WHERE system_ref LIKE :name ORDER BY system_ref LIMIT 20";
            $command = Yii::app()->db->createCommand($qtxt);
            $command->bindValue(":name", '%' . $_GET['term'] . '%', PDO::PARAM_STR);
            $res = $command->queryColumn();
        }
        echo CJSON::encode($res);
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 't-account-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
