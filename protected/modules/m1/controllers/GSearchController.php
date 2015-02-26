<?php

class GSearchController extends Controller
{

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column1';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return [
            'rights', // perform access control for CRUD operations
            //'accessControl', // perform access control for CRUD operations
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
     * Manages all models.
     */
    public function actionIndex()
    {
        $model = new gBiPerson('getFilter'); //new gBiPerson('getFilter');
        $model->unsetAttributes(); // clear any default values
        if (isset($_REQUEST['gBiPerson'])) {
            $where = 'WHERE TRUE';
            $where .= " AND company_id = " . sUser::model()->myGroup;
            $model->attributes = $_REQUEST['gBiPerson'];
            /*
            $i = 0;
            foreach (Yii::app()->db->schema->getTable('g_bi_person')->columns as $key => $val) {

                if ($i > 0) {
                    if (!empty($_REQUEST['gBiPerson'][$key])) {
                        $model->$key = implode("|", array_filter($_REQUEST['gBiPerson'][$key]));
                    }
                }
                $i++;
            }
             
             * 
             */

        }

        $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionSummary()
    {

        if (isset($_REQUEST['gBiPerson'])) {
            $where = 'WHERE TRUE';
            $where .= " AND company_id = " . sUser::model()->myGroup;

            $i = 0;
            foreach (Yii::app()->db->schema->getTable('g_bi_person')->columns as $key => $val) {

                if ($i > 0) {
                    if (!empty($_REQUEST['gBiPerson'][$key])) {
                        $regex_key[$i] = implode("|", array_filter($_REQUEST['gBiPerson'][$key]));
                        if (!empty($regex_key[$i])) {
                            $where .= " AND $key REGEXP '$regex_key[$i]'";
                        }
                    }
                }
                $i++;
            }

            $i = 0;
            foreach (Yii::app()->db->schema->getTable('g_bi_person')->columns as $key => $val) {

                if ($i > 0) {
                    if (isset($_REQUEST['type']) && !empty($_REQUEST['type'])) {
                        if ($_REQUEST['type'] == $key) {
                            $sql[$i] = "SELECT count($key) as sum, $key FROM (SELECT * FROM g_bi_person $where) as person group by $key";
                            $results[$i] = Yii::app()->db->createCommand($sql[$i])->queryAll();
                            echo "<table class='table table-bordered table-condensed table-striped'>";
                            echo '<tr>';
                            $title_key = strtoupper($key);
                            echo "<td><b>$title_key Filter</b></td><td>Sum</td>";
                            echo '</tr>';
                            foreach ($results[$i] as $data) {
                                echo "<tr>";
                                echo "<td width='80%'>$data[$key]</td><td>$data[sum]</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                        }
                    }
                }
                $i++;
            }
        }
    }

    public function actionExport()
    {
        $this->renderPartial('export');
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model = Person::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'person-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
