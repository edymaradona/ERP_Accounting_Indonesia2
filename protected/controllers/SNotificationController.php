<?php

class SNotificationController extends Controller
{

    public $layout = '//layouts/column1';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return [
            'rights',
            //'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        ];
    }

    public function actionRead($id, $isRead = false)
    {
        $criteria = new CDbCriteria;
        $criteria->compare('id', (int)$id);
        if (!Yii::app()->user->name == "admin") {
            $criteria2 = new CDbCriteria;
            $criteria2->addInCondition('group_id', sUser::model()->myGroupNotificationArray, 'OR');
            $criteria2->compare('company_id', sUser::model()->myGroup, false, 'OR');
            $criteria->mergeWith($criteria2);
            $criteria1 = new CDbCriteria;
            $criteria1->condition = "`t`.`id` NOT IN (
							SELECT `r`.`notification_id` FROM  `s_notification_read` `r` 
							WHERE `r`.`username` = " . Yii::app()->user->id . " AND `r`.`notification_id` = `t`.`id`)";
            $criteria->mergeWith($criteria1);
        }
        $criteria->order = 'expire DESC';
        $model = sNotification::model()->find($criteria);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        if (!$isRead) {
            $reads = new sNotificationRead();
            $reads->username = Yii::app()->user->id;
            $reads->notification_id = $id;
            $reads->readed = true;
            $reads->save(false);
        }
        $this->redirect(Yii::app()->createUrl($model->link));
    }

    public function actionMarkRead()
    {
        $criteria = new CDbCriteria;
        $criteria->addInCondition('group_id', sUser::model()->myGroupNotificationArray, 'OR');
        $criteria->compare('company_id', sUser::model()->myGroup, false, 'OR');
        $criteria1 = new CDbCriteria;
        $criteria1->condition = "`t`.`id` NOT IN (
			SELECT `r`.`notification_id` FROM  `s_notification_read` `r` 
			WHERE `r`.`username` = " . Yii::app()->user->id . " AND `r`.`notification_id` = `t`.`id`)";
        $criteria->mergeWith($criteria1);
        $criteria->order = 'expire DESC';
        $models = sNotification::model()->findAll($criteria);

        if ($models === null)
            throw new CHttpException(404, 'The requested page does not exist.');

        $command = Yii::app()->db->createCommand();
        foreach ($models as $model) {
            $command->insert('s_notification_read',
                [
                    'username' => Yii::app()->user->id,
                    'notification_id' => $model->id,
                    'readed' => true,
                ]);
        }

        $this->redirect(['/sNotification']);
    }

    public function actionIndex()
    {
        $criteria = new CDbCriteria;
        $criteria->addInCondition('group_id', sUser::model()->myGroupNotificationArray, 'OR');
        $criteria->compare('company_id', sUser::model()->myGroup, false, 'OR');
        $criteria->order = 'expire DESC';
        $dataProvider = new CActiveDataProvider('sNotification', [
            'criteria' => $criteria,
            'pagination' => [
                'pageSize' => 50,
            ]
        ]);

        //if (sNotification::getNotifCount() != "")
        //    $this->redirect(['/sNotification/markread']);

        $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $criteria = new CDbCriteria;
        $criteria->compare('id', $id);
        $criteria->addInCondition('group_id', sUser::model()->myGroupNotificationArray);
        $model = sNotification::model()->find($criteria);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function actionUserHistory()
    {
        $this->render('userHistory');
    }

}
