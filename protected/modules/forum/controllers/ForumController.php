<?php

class ForumController extends ForumBaseController
{

    /**
     * @return array action filters
     */
    public function filters()
    {
        return ['accessControl'];
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return [
            // ALL users
            ['allow',
                'actions' => ['index', 'view'],
                'users' => ['*'],
            ],
            /*
              // authenticated users
              array('allow',
              'actions' => [],
              'users' => array('@'),
              ),
             */

            // administrators
            ['allow',
                'actions' => ['create', 'update', 'delete'],
                'users' => ['@'], // Must be authenticated
                'expression' => 'Yii::app()->user->name == "admin"', // And must be admin
            ],
            // deny all users
            ['deny', 'users' => ['*']],
        ];
    }

    /**
     * This is basically the "homepage" for the forums
     * It'll show a list of root categories which forums in each
     */
    public function actionIndex()
    {
        // Dataproviders for forums in each category will be created on the fly
        // This may be a good candidate for eager loading...
        $this->render('index', [
            'categories' => Forum::model()->categories()->findAll(),
        ]);
    }

    /**
     * Shows the content of a forum. First a list of subforums, followed by a
     * list of threads in this forum
     */
    public function actionView($id)
    {
        $forum = Forum::model()->findByPk($id);
        if (null == $forum)
            throw new CHttpException(404, 'The requested page does not exist.');

        $subforumsProvider = new CActiveDataProvider('Forum', [
            'criteria' => [
                'scopes' => ['forums' => [$id]],
            ],
            'pagination' => false,
        ]);

        $threadsProvider = new CActiveDataProvider('Thread', [
            'criteria' => [
                'condition' => 'forum_id=' . $forum->id,
            ],
            'pagination' => [
                'pageSize' => Yii::app()->controller->module->threadsPerPage,
            ],
        ]);

        $this->render('view', [
            'forum' => $forum,
            'subforumsProvider' => $subforumsProvider,
            'threadsProvider' => $threadsProvider,
        ]);
    }

    /**
     * create action
     */
    public function actionCreate($parentid = null)
    {
        $forum = new Forum;
        $forum->parent_id = $parentid; // Set default

        if (isset($_POST['Forum'])) {
            $forum->attributes = $_POST['Forum'];
            if ($forum->validate()) {
                if ((int)$forum->parent_id < 1)
                    $forum->parent_id = null;
                $forum->save();
                $this->redirect($forum->url);
            }
        }
        $this->render('editforum', ['model' => $forum]);
    }

    /**
     * Update action
     * @param type $id Id of forum to edit.
     * @throws CHttpException if forum not found
     */
    public function actionUpdate($id)
    {
        $forum = Forum::model()->findByPk($id);
        if (null == $forum)
            throw new CHttpException(404, 'The requested page does not exist.');

        if (isset($_POST['Forum'])) {
            $forum->attributes = $_POST['Forum'];
            if ($forum->validate()) {
                if ((int)$forum->parent_id < 1)
                    $forum->parent_id = null;
                $forum->save();
                $this->redirect($forum->url);
            }
        }
        $this->render('editforum', ['model' => $forum]);
    }

    /**
     * deleteForum action
     * Deletes both categories or forums.
     * Will take all subforums, threads and posts inside with it!
     */
    public function actionDelete($id)
    {
        if (!Yii::app()->request->isPostRequest || !Yii::app()->request->isAjaxRequest)
            throw new CHttpException(400, 'Invalid request');

        // First, we make sure it even exists
        $forum = Forum::model()->findByPk($id);
        if (null == $forum)
            throw new CHttpException(404, 'The requested page does not exist.');

        $forum->delete();
    }

}
