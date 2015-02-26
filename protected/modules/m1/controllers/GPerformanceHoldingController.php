<?php

class GPerformanceHoldingController extends Controller
{

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2left';

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
    public function actionView($id, $year = 0)
    {

        if ($year == 0)
            $year = date('Y');

        $this->render('view', [
            'model' => $this->loadModel($id),
            'year' => $year
        ]);
    }

    public function newPayroll($id)
    {
        $model = new gPayroll;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gPayroll'])) {
            $model->attributes = $_POST['gPayroll'];
            $model->parent_id = (int)$id;
            if ($model->save())
                $this->redirect(['view', 'id' => $id, 'tab' => 'Salary History']);
        }

        return $model;
    }

    public function newPayrollBenefit($id)
    {
        $model = new gPayrollBenefit;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gPayrollBenefit'])) {
            $model->attributes = $_POST['gPayrollBenefit'];
            $model->parent_id = (int)$id;
            if ($model->save())
                $this->redirect(['view', 'id' => $id, 'tab' => 'Benefit']);
        }

        return $model;
    }

    public function newPayrollDeduction($id)
    {
        $model = new gPayrollDeduction;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gPayrollDeduction'])) {
            $model->attributes = $_POST['gPayrollDeduction'];
            $model->parent_id = (int)$id;
            if ($model->save())
                $this->redirect(['view', 'id' => $id, 'tab' => 'Deduction']);
        }

        return $model;
    }

    public function actionIndex($periode = null)
    {
        $model = new gPerson('search');

        if ($periode == null)
            $periode = date("Ym");

        $this->render('index', [
            'periode' => $periode,
            'model' => $model,
        ]);
    }

    public function actionList()
    {
        $model = new gPerson('search');
        $model->unsetAttributes();

        $criteria = new CDbCriteria;
        $criteria1 = new CDbCriteria;

        if (isset($_GET['gPerson'])) {
            $model->attributes = $_GET['gPerson'];

            $criteria1->compare('employee_name', $_GET['gPerson']['employee_name'], true, 'OR');
            //$criteria1->compare('address1',$_GET['gPerson']['address1'],true,'OR');
        }

        $criteria->order = 'updated_date DESC';

        $criteria->mergeWith($criteria1);

        $dataProvider = new CActiveDataProvider('gPerson', [
                'criteria' => $criteria,
            ]
        );

        $this->render('/gPerson/index', [
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    /**
     * Lists all models.
     */
    public function actionCurrentMonth()
    {
        $criteria = new CDbCriteria;

        //if (Yii::app()->user->name != "admin") {
        $criteria2 = new CDbCriteria;
        $criteria2->condition = '(select s.status_id from g_person_status s WHERE t.id=s.parent_id ORDER BY s.start_date DESC LIMIT 1) NOT IN 
			(' . implode(",", Yii::app()->getModule("m1")->PARAM_RESIGN_ARRAY) . ') AND ' .
            '(select c.company_id from g_person_career c WHERE t.id=c.parent_id AND c.status_id IN (' .
            implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) .
            ') ORDER BY c.start_date DESC LIMIT 1) IN (' .
            implode(",", sUser::model()->myGroupArray) . ')';
        $criteria->mergeWith($criteria2);
        //}

        $criteria->order = 'updated_date DESC';

        $dependency = new CDbCacheDependency('SELECT MAX(id) FROM g_person');

        $dataProvider = new CActiveDataProvider(gPerson::model()->cache(3600, $dependency, 2), [
                'criteria' => $criteria,
                'pagination' => false,
            ]
        );

        $this->render('currentMonth', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return gPayroll the loaded model
     * @throws CHttpException
     */

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $criteria = new CDbCriteria;

        $model = gPerson::model()->findByPk((int)$id);
        if ($model === null)
            throw new CHttpException(401, 'You are not authorized to open this page.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param gPayroll $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'g-payroll-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionReport()
    {
        $model = new fBeginEndDate('performance');

        if (isset($_POST['fBeginEndDate'])) {
            $model->attributes = $_POST['fBeginEndDate'];
            if ($model->validate()) {

                spl_autoload_unregister(['YiiBase', 'autoload']);
                Yii::import('ext.phpexcel.Classes.PHPExcel', true);
                spl_autoload_register(['YiiBase', 'autoload']);

                $phpExcel = new PHPExcel();


                if ($model->report_id == 1) {
                    $this->report01($phpExcel, $model);
                } elseif ($model->report_id == 2) {
                    $this->report02($phpExcel, $model);
                }

            }
        }

        $this->render('report', ['model' => $model]);
    }

    private function report01($phpExcel, $model)
    {

        $criteria = new CDbCriteria;
        $criteria->condition = '(select c.company_id from g_person_career c WHERE t.id=c.parent_id AND c.status_id IN (' .
            implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) .
            ') ORDER BY c.start_date DESC LIMIT 1) = ' .
            $model->company_id . '
				AND (select c.level_id from g_person_career c WHERE t.id=c.parent_id AND c.status_id IN (' .
            implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) .
            ') ORDER BY c.start_date DESC LIMIT 1) = ' .
            $model->level_id;
        //$criteria->limit = 15;

        $dataProvider = new CActiveDataProvider('gPerson', [
            'criteria' => $criteria,
            'pagination' => false,
            'sort' => [
                //'defaultOrder'=>'year DESC',
            ]
        ]);

        $title = $dataProvider->getData();


        $styleBold = [
            'font' => [
                'bold' => true,
            ]
        ];

        $styleBackground = [
            'fill' => [
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'startcolor' => [
                    'rgb' => 'D8D8D8',
                ],
            ],
            'font' => [
                'name' => 'Arial',
                'size' => 12,
                'bold' => true,
            ],
        ];

        $foo = $phpExcel->getActiveSheet();

        $foo->setTitle("Performance");

        $foo->setCellValue("A1", "DATA PA KARYAWAN")->getStyle("A1:H1")->applyFromArray($styleBackground);
        $foo->mergeCells("A1:H1");
        $foo->getStyle("A1:H1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $foo->getRowDimension(1)->setRowHeight(22);
        $foo->getRowDimension(2)->setRowHeight(20);
        $foo->getColumnDimension("A")->setWidth(5);
        $foo->getColumnDimension("B")->setWidth(15);
        $foo->getColumnDimension("C")->setWidth(30);
        $foo->getColumnDimension("D")->setWidth(40);
        $foo->getColumnDimension("E")->setWidth(20);
        $foo->getColumnDimension("F")->setWidth(30);
        $foo->getColumnDimension("G")->setWidth(10);
        $foo->getColumnDimension("H")->setWidth(30);

        $foo->setCellValue("A2", "No")
            ->setCellValue("B2", "Photo")
            ->setCellValue("C2", "Basic Profile")
            ->setCellValue("D2", "Education")
            ->setCellValue("E2", "Work Experience")
            ->setCellValue("G2", "Performance Appraisal")
            ->getStyle("A2:H2")->applyFromArray($styleBold);

        $counter = 3;
        $current = 1;

        foreach ($dataProvider->getData() as $data) {
            $n0 = $counter;
            $n1 = $counter + 1;
            $n2 = $counter + 2;
            $n3 = $counter + 3;
            $n4 = $counter + 4;
            $n5 = $counter + 5;
            $n6 = $counter + 6;
            $n7 = $counter + 7;
            $n8 = $counter + 8;
            $n9 = $counter + 9;

            //Basic Profile
            $foo
                ->setCellValue("A$n0", $current)
                ->setCellValue("B$n0", $data->employee_name)
                ->mergeCells("B$n0:C$n0");

            $foo->getRowDimension($n0)->setRowHeight(18);

            $foo
                ->getStyle("A$n0:H$n0")
                ->applyFromArray($styleBackground);

            $foo
                ->setCellValue("B$n1", "PHOTO")
                ->setCellValue("C$n1", "Company: " . $data->mCompany())
                ->setCellValue("C$n2", "Department: " . $data->mDepartment())
                ->setCellValue("C$n3", "Job Title: " . $data->mJobTitle())
                ->setCellValue("C$n4", "Level: " . $data->mLevel())
                ->setCellValue("C$n5", "Status: " . ($data->countContract() != "") ? $data->mStatus() . " " . $data->countContract() : $data->mStatus())
                ->setCellValue("C$n6", "Join Date: " . (isset($data->companyfirst)) ? $data->companyfirst->start_date . " " . $data->countJoinDate() : "")
                ->setCellValue("C$n7", "Superior: " . $data->mSuperior())
                ->setCellValue("C$n8", "Birth Date: " . $data->birth_date)
                ->setCellValue("C$n9", "Length of Services: ");

            $objDrawing = new PHPExcel_Worksheet_Drawing();
            $objDrawing->setName('test_img');
            $objDrawing->setDescription('test_img');
            $objDrawing->setPath($data->photoPathReal);
            $objDrawing->setHeight(130);
            $objDrawing->setCoordinates("B$n1");
            $objDrawing->setWorksheet($foo);

            //Education
            foreach ($data->many_education as $key => $dataEdu) {
                if ($dataEdu->level_id >= 8) {
                    $foo
                        ->setCellValue("D$n1", $dataEdu->edulevel->name . " " . $dataEdu->interest)
                        ->setCellValue("D$n2", $dataEdu->school_name . ", " . $dataEdu->graduate . ". GPA: " . $dataEdu->ipk);
                }
            }

            //Experience
            foreach ($data->many_experience as $key => $dataExp) {
                if ($key <= 5) {
                    $foo
                        ->setCellValue("E$n1", $dataExp->start_date . " to " . $dataExp->end_date)
                        ->setCellValue("F$n1", $dataExp->job_title . " at " . $dataExp->company_name);
                }
            }
            //Performance
            foreach ($data->performance as $key => $perf) {
                $foo
                    ->setCellValue("G$n1", "PA " . $perf->year . ' = ' . $perf->pa_value . ' , ' . $perf->potential);
            }

            $counter = $n9 + 2;
            $current++;
        }

        $phpExcel->setActiveSheetIndex(0);

        //Output the generated excel file so that the user can save or open the file.
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"performance_" . date('Ymd') . ".xls\"");

        header("Cache-Control: max-age=0");

        $objWriter = PHPExcel_IOFactory::createWriter($phpExcel, "Excel5");
        $objWriter->save("php://output");
    }

    private function report02($phpExcel, $model)
    {

        $connection = Yii::app()->db;
        $sql = "
        SELECT a.id, a.employee_name, 
        (select `o`.`name` AS `name` from (`g_person_career` `c` left join `a_organization` `o` ON ((`o`.`id` = `c`.`department_id`)))
            where ((`a`.`id` = `c`.`parent_id`) and (`c`.`status_id` in (1 , 2, 3, 4, 5, 6, 15))) order by `c`.`start_date` desc limit 1) 
            AS `department`,

        (select `o`.`name` AS `name` from (`g_person_career` `s` left join `g_param_level` `o` ON ((`o`.`id` = `s`.`level_id`)))
            where (`s`.`parent_id` = `a`.`id`) order by `s`.`start_date` desc limit 1) 
            AS `level`,

        (select `s`.`level_id` AS `level_id` from `g_person_career` `s`
            where `s`.`parent_id` = `a`.`id` order by `s`.`start_date` desc limit 1) 
            AS `level_id`,

        (select `c`.`start_date` AS `start_date` from `g_person_career` `c` where ((`a`.`id` = `c`.`parent_id`) and (`c`.`status_id` = 1))
            order by `c`.`start_date` desc limit 1) 
            AS `join_date`,

        CONCAT ( TIMESTAMPDIFF(YEAR,(select `c`.`start_date` AS `start_date` from `g_person_career` `c` where ((`a`.`id` = `c`.`parent_id`) and (`c`.`status_id` = 1))
            order by `c`.`start_date` desc limit 1),CURDATE()) , ' Thn ',
            MOD(TIMESTAMPDIFF(MONTH, (select `c`.`start_date` AS `start_date` from `g_person_career` `c` where ((`a`.`id` = `c`.`parent_id`) and (`c`.`status_id` = 1))
            order by `c`.`start_date` desc limit 1),CURDATE()),12) , ' Bln' )
            AS `count_join_date`,


        (SELECT sum(ts.superior_score * ts.weight) as total FROM g_talent_target_setting ts WHERE ts.parent_id = a.id AND ts.year = " . $model->year . ") as kpi1,
        (SELECT sum(ts.superior2_score * ts.weight) as total FROM g_talent_target_setting ts WHERE ts.parent_id = a.id AND ts.year = " . $model->year . ") as kpi2,
        (SELECT sum(cc.superior_score * pp.weight) as total FROM g_talent_work_result cc 
            INNER JOIN g_param_competency pp ON pp.id = cc.talent_template_id WHERE cc.parent_id = a.id AND cc.year = " . $model->year . ") as work_result,


        (SELECT sum(cc.superior_score * pp.weight) as total FROM g_talent_core_competency cc 
            INNER JOIN g_param_competency pp ON pp.id = cc.talent_template_id WHERE cc.parent_id = a.id AND cc.year = " . $model->year . ") as core1,
        (SELECT sum(cc.superior2_score * pp.weight) as total FROM g_talent_core_competency cc 
            INNER JOIN g_param_competency pp ON pp.id = cc.talent_template_id WHERE cc.parent_id = a.id AND cc.year = " . $model->year . ") as core2,

        (SELECT sum(ll.superior_score * pp.weight) as total FROM g_talent_leadership_competency ll
            INNER JOIN g_param_competency pp ON pp.id = ll.talent_template_id WHERE ll.parent_id = a.id AND ll.year = " . $model->year . ") as leadership1,
        (SELECT sum(ll.superior2_score * pp.weight) as total FROM g_talent_leadership_competency ll
            INNER JOIN g_param_competency pp ON pp.id = ll.talent_template_id WHERE ll.parent_id = a.id AND ll.year = " . $model->year . ") as leadership2,

        (SELECT sum(ts.superior2_score * ts.weight) as total FROM g_talent_target_setting ts WHERE ts.parent_id = a.id AND ts.year = " . $model->year . ") +
        (SELECT sum(cc.superior2_score * pp.weight) as total FROM g_talent_core_competency cc 
            INNER JOIN g_param_competency pp ON pp.id = cc.talent_template_id WHERE cc.parent_id = a.id AND cc.year = " . $model->year . ") +
        (SELECT sum(ll.superior2_score * pp.weight) as total FROM g_talent_leadership_competency ll
            INNER JOIN g_param_competency pp ON pp.id = ll.talent_template_id WHERE ll.parent_id = a.id AND ll.year = " . $model->year . ") as t_total

        FROM g_person a 
        WHERE 
        (select `o`.`id` AS `id` from (`g_person_career` `c` left join `a_organization` `o` ON ((`o`.`id` = `c`.`company_id`)))
            where ((`a`.`id` = `c`.`parent_id`) and (`c`.`status_id` in (1 , 2, 3, 4, 5, 6, 15)))
            order by `c`.`start_date` desc limit 1) = " . $model->company_id;

        if ($model->level_id != 0) {
            $sql.= " AND
            (select `s`.`level_id` from `g_person_career` `s` 
                where `s`.`parent_id` = `a`.`id` order by `s`.`start_date` desc limit 1) = " . $model->level_id . "
            ";
        }

        $sql.= " ORDER BY  (select `s`.`level_id` from `g_person_career` `s` 
            where `s`.`parent_id` = `a`.`id` order by `s`.`start_date` desc limit 1)  ";

        $command = $connection->createCommand($sql);
        $rows = $command->queryAll();


        $styleBold = [
            'font' => [
                'bold' => true,
            ]
        ];

        $styleBackground = [
            'fill' => [
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'startcolor' => [
                    'rgb' => 'D8D8D8',
                ],
            ],
            'font' => [
                'name' => 'Arial',
                'size' => 12,
                'bold' => true,
            ],
        ];

        $foo = $phpExcel->getActiveSheet();

        $foo->setTitle("Performance Apraisal");

        $foo->setCellValue("A1", "REKAPITULASI PERFORMANCE APPRAISAL")->getStyle("A1:H1")->applyFromArray($styleBackground);
        $foo->mergeCells("A1:M1");
        $foo->getStyle("A1:M1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $foo->getRowDimension(1)->setRowHeight(22);
        $foo->getRowDimension(2)->setRowHeight(20);
        $foo->getColumnDimension("A")->setWidth(5);
        $foo->getColumnDimension("B")->setWidth(30);
        $foo->getColumnDimension("C")->setWidth(20);
        $foo->getColumnDimension("D")->setWidth(20);
        $foo->getColumnDimension("E")->setWidth(10);
        $foo->getColumnDimension("F")->setWidth(20);
        $foo->getColumnDimension("G")->setWidth(10);
        $foo->getColumnDimension("H")->setWidth(10);
        $foo->getColumnDimension("I")->setWidth(10);
        $foo->getColumnDimension("J")->setWidth(10);
        $foo->getColumnDimension("K")->setWidth(10);
        $foo->getColumnDimension("L")->setWidth(10);
        $foo->getColumnDimension("M")->setWidth(10);

        $foo->setCellValue("A2", "No")
            ->setCellValue("B2", "Nama")
            ->setCellValue("C2", "Direktorat")
            ->setCellValue("D2", "Pangkat")
            ->setCellValue("E2", "Tgl. Mulai Kerja")
            ->setCellValue("F2", "Masa Kerja")
            ->setCellValue("G2", "KPI")
            ->setCellValue("H2", "Kompetensi Diri")
            ->setCellValue("I2", "Kompetensi Kepemimpinan")
            ->setCellValue("J2", "Total Nilai")
            ->setCellValue("K2", "Rating")
            ->setCellValue("L2", "Final Rating")
            ->setCellValue("M2", "Potensial")
            ->getStyle("A2:M2")->applyFromArray($styleBold);

        $n0 = 3;

        foreach ($rows as $row) {

            if ($row['level_id'] >= 10) {
                if ($model->period == 1) {
                    $kpi_workresult = $row['kpi1'];
                    $core = $row['core1'];
                    $leadership = $row['leadership1'];
                    $total = $kpi_workresult + $core + $leadership;
                } else {
                    $kpi_workresult = $row['kpi2'];
                    $core = $row['core2'];
                    $leadership = $row['leadership2'];
                    $total = $kpi_workresult + $core + $leadership;
                }
            } else {
                $kpi_workresult = $row['work_result'];
                $core = $row['core2'];
                if ($row['level_id'] > 6) {
                    $leadership = $row['leadership2'];
                } else
                    $leadership = 0;
                $total = $kpi_workresult + $core + $leadership;
            }

            $foo
                ->setCellValue("A$n0", $n0 - 2)
                ->setCellValue("B$n0", $row['employee_name'])
                ->setCellValue("C$n0", $row['department'])
                ->setCellValue("D$n0", $row['level'])
                ->setCellValue("E$n0", date("d-m-Y", strtotime($row['join_date'])))
                ->setCellValue("F$n0", $row['count_join_date'])
                ->setCellValue("G$n0", $kpi_workresult)
                ->setCellValue("H$n0", $core)
                ->setCellValue("I$n0", $leadership)
                ->setCellValue("J$n0", $total);


            $n0++;
        }

        $phpExcel->setActiveSheetIndex(0);

        //Output the generated excel file so that the user can save or open the file.
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"rekap_pa_" . date('Ymd') . ".xls\"");

        header("Cache-Control: max-age=0");

        $objWriter = PHPExcel_IOFactory::createWriter($phpExcel, "Excel5");
        $objWriter->save("php://output");
    }
}
