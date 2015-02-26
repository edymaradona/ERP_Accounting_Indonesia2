<?php

class GPayrollController extends Controller
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
            'postOnly + delete', // we only allow deletion via POST request
        ];
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModelPayroll($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gPayroll'])) {
            $model->attributes = $_POST['gPayroll'];
            if ($model->save())
                //$this->redirect(array('view','id'=>$model->id));
                EQuickDlgs::checkDialogJsScript();
        }

        EQuickDlgs::render('_formPayroll', ['model' => $model]);
    }

    public function actionUpdateBenefit($id)
    {
        $model = $this->loadModelPayrollBenefit($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gPayrollTemplateBenefit'])) {
            $model->attributes = $_POST['gPayrollTemplateBenefit'];
            if ($model->save())
                //$this->redirect(array('view','id'=>$model->id));
                EQuickDlgs::checkDialogJsScript();
        }

        EQuickDlgs::render('_formBenefit', ['model' => $model]);
    }

    public function actionUpdateDeduction($id)
    {
        $model = $this->loadModelPayrollDeduction($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gPayrollTemplateDeduction'])) {
            $model->attributes = $_POST['gPayrollTemplateDeduction'];
            if ($model->save())
                //$this->redirect(array('view','id'=>$model->id));
                EQuickDlgs::checkDialogJsScript();
        }

        EQuickDlgs::render('_formDeduction', ['model' => $model]);
    }

    public function actionConfirm($id)
    {
        $model = $this->loadModelPayroll($id);
        $model->confirm_id = 2; //half confirm
        $model->save(false);

        $yearmonth = peterFunc::cBeginDateAfter(gPayrollTemplate::getLastPeriod());

        $criteria = new CDbCriteria;
        $criteria->compare('parent_id', $model->parent_id);
        $criteria->compare('confirm_id', 1);
        $criteria->compare('yearmonth_start <', $yearmonth);

        gPayrollTemplateBenefit::model()->updateAll(['confirm_id' => 2], $criteria);

        gPayrollTemplateDeduction::model()->updateAll(['confirm_id' => 2], $criteria);

        return true;
    }

    public function actionFullConfirm()
    {

        $model = new gPayroll;
        $model->yearmonth = peterFunc::cBeginDateAfter(gPayrollTemplate::getLastPeriod());
        $model->process_code = 'REG-' . peterFunc::cBeginDateAfter(gPayrollTemplate::getLastPeriod());
        $model->formula = " {Basic Salary} + {Benefit} + {Insentif} - {Deduction} ";
        $model->remark = "Automated Payroll Process";
        $model->save(false);


        $connection = Yii::app()->db;

        $yearmonth = peterFunc::cBeginDateAfter(gPayrollTemplate::getLastPeriod());

        //BASIC SALARY
        $sql1 = '
            INSERT INTO g_payroll_component (parent_id,employee_id,employee_name,detail_code,template_id,component_name,amount,remark, created_date, created_by)

            SELECT ' . $model->id . ',g.id, g.employee_name, "REG-BS", 1, "Basic Salary", 
            (SELECT IF (gg.prorate_salary <> 0 AND gg.yearmonth_start =  ' . $yearmonth . ', gg.prorate_salary, gg.basic_salary) from g_payroll_template gg 
                WHERE gg.yearmonth_start <=  ' . $yearmonth . ' 
                AND gg.parent_id = g.id ORDER BY gg.yearmonth_start DESC LIMIT 1),
            "Automated Process Basic Salary/Prorate Salary", ' . time() . ',' . Yii::app()->user->id . '                    

            FROM g_person g 

            WHERE 
            (select c.company_id from g_person_career c WHERE g.id=c.parent_id AND 
                c.status_id IN (' . implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) . ') 
                ORDER BY c.start_date DESC LIMIT 1) = ' . sUser::model()->myGroup . '

            AND ( 
                (select `s`.`status_id` from `g_person_status` `s` where `s`.`parent_id` = `g`.`id` order by `s`.`start_date` desc limit 1) 
                IN (' . implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) . ') 
                OR
                ( (select `s`.`status_id` from `g_person_status` `s` where `s`.`parent_id` = `g`.`id` order by `s`.`start_date` desc limit 1) 
                    IN (' . implode(',', Yii::app()->getModule("m1")->PARAM_RESIGN_ARRAY) . ') AND 
                    (select date_format(`s`.`start_date`,"%Y%m") from `g_person_status` `s` where `s`.`parent_id` = `g`.`id` order by `s`.`start_date` desc limit 1)
                    = ' . gPayrollTemplate::getLastPeriod() . '
                )
            ) ;

        ';

        Yii::app()->db->createCommand($sql1)->execute();

        //BENEFIT
        $sql2 = '
            INSERT INTO g_payroll_component (parent_id,employee_id,employee_name,detail_code,template_id,component_name,amount,remark, created_date, created_by)

            SELECT ' . $model->id . ', b.parent_id, g.employee_name,"REG-BEN", b.benefit_id, pb.name,
            if (b.type_id = 1, (select gb.amount from g_param_payroll gb 
                WHERE gb.parent_id = b.benefit_id and gb.yearmonth_start <= ' . $yearmonth . ' 
                order by gb.yearmonth_start desc limit 1), IF (b.prorate <> 0 AND b.yearmonth_start = ' . $yearmonth . ', b.prorate, b.amount) ),
            b.remark, ' . time() . ',' . Yii::app()->user->id . '    
            
            FROM g_payroll_template_benefit b
            INNER JOIN g_person g on b.parent_id = g.id
            INNER JOIN g_param_payroll pb on b.benefit_id = pb.id
            WHERE 
            (select c.company_id from g_person_career c WHERE b.parent_id=c.parent_id AND c.status_id 
                IN (' . implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) . ') ORDER BY c.start_date DESC LIMIT 1) = 
                ' . sUser::model()->myGroup . '

            AND b.yearmonth_start <=  ' . $yearmonth . ' 
            AND (b.yearmonth_end >=  ' . $yearmonth . ' OR b.yearmonth_end IS NULL)

            AND (select `s`.`status_id` from `g_person_status` `s` where `s`.`parent_id` = `b`.`parent_id` order by `s`.`start_date` desc limit 1) 
                IN (' . implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) . ')

            AND b.confirm_id = 2;                        
        ';

        Yii::app()->db->createCommand($sql2)->execute();

        //DEDUCTION
        $sql3 = '
            INSERT INTO g_payroll_component (parent_id,employee_id,employee_name,detail_code,template_id,component_name,amount,remark, created_date, created_by)

            SELECT ' . $model->id . ', d.parent_id, g.employee_name,"REG-DED", d.deduction_id, pd.name,
            if (d.type_id = 1, (select gd.amount from g_param_payroll gd 
                WHERE gd.parent_id = d.deduction_id and gd.yearmonth_start <= ' . $yearmonth . ' 
                order by gd.yearmonth_start desc limit 1),IF (d.prorate <> 0 AND d.yearmonth_start = ' . $yearmonth . ', d.prorate, d.amount) ) * -1,
            d.remark, ' . time() . ',' . Yii::app()->user->id . '    
            
            FROM g_payroll_template_deduction d
            INNER JOIN g_person g on d.parent_id = g.id
            INNER JOIN g_param_payroll pd on d.deduction_id = pd.id
            WHERE 
            (select c.company_id from g_person_career c WHERE d.parent_id=c.parent_id AND 
                c.status_id IN (' . implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) . ') ORDER BY c.start_date DESC LIMIT 1) = 
                ' . sUser::model()->myGroup . '

            AND d.yearmonth_start <=  ' . $yearmonth . ' 
            AND (d.yearmonth_end >=  ' . $yearmonth . ' OR d.yearmonth_end IS NULL)

            AND (select `s`.`status_id` from `g_person_status` `s` where `s`.`parent_id` = `d`.`parent_id` order by `s`.`start_date` desc limit 1) 
                IN (' . implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) . ')

            AND d.confirm_id = 2;                        
        ';

        Yii::app()->db->createCommand($sql3)->execute();

        //INSENTIF
        $sql4 = '
            INSERT INTO g_payroll_component (parent_id,employee_id,employee_name,detail_code,template_id,component_name,amount,remark, created_date, created_by)

            SELECT ' . $model->id . ', i.parent_id, g.employee_name,"REG-INS", 1, i.insentif_name,
            i.amount, i.remark, ' . time() . ',' . Yii::app()->user->id . '    
            
            FROM g_payroll_template_insentif i
            INNER JOIN g_person g on i.parent_id = g.id
            WHERE 
            (select c.company_id from g_person_career c WHERE i.parent_id=c.parent_id AND c.status_id 
                IN (' . implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) . ') ORDER BY c.start_date DESC LIMIT 1) = 
                ' . sUser::model()->myGroup . '

            AND i.yearmonth_start =  ' . $yearmonth . ' 

            AND (select `s`.`status_id` from `g_person_status` `s` where `s`.`parent_id` = `i`.`parent_id` order by `s`.`start_date` desc limit 1) 
                IN (' . implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) . ')

            AND i.confirm_id = 2;                        
        ';

        Yii::app()->db->createCommand($sql4)->execute();


        //update confirm to Full Confirm. Basic Salary
        $sql5 = '
            UPDATE g_payroll_template t SET t.confirm_id = 3 
            WHERE 
            (select c.company_id from g_person_career c WHERE t.parent_id = c.parent_id AND 
                c.status_id IN (' . implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) . ') ORDER BY c.start_date DESC LIMIT 1) = 
                ' . sUser::model()->myGroup . ' 
            AND t.confirm_id = 2;
        ';

        Yii::app()->db->createCommand($sql5)->execute();

        //update confirm to Full Confirm. Benefit
        $sql6 = '
            UPDATE g_payroll_template_benefit t SET t.confirm_id = 3 
            WHERE 
            (select c.company_id from g_person_career c WHERE t.parent_id = c.parent_id AND 
                c.status_id IN (' . implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) . ') ORDER BY c.start_date DESC LIMIT 1) = 
                ' . sUser::model()->myGroup . ' 
            AND t.confirm_id = 2;
        ';


        Yii::app()->db->createCommand($sql6)->execute();

        //update confirm to Full Confirm. Benefit
        $sql7 = '
            UPDATE g_payroll_template_deduction t SET t.confirm_id = 3 
            WHERE 
            (select c.company_id from g_person_career c WHERE t.parent_id = c.parent_id AND 
                c.status_id IN (' . implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) . ') ORDER BY c.start_date DESC LIMIT 1) = 
                ' . sUser::model()->myGroup . ' 
            AND t.confirm_id = 2;
        ';


        Yii::app()->db->createCommand($sql7)->execute();

        //update confirm to Full Confirm. Insentif
        $sql8 = '
            UPDATE g_payroll_template_insentif i SET i.confirm_id = 3 
            WHERE 
            (select c.company_id from g_person_career c WHERE i.parent_id = c.parent_id AND 
                c.status_id IN (' . implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) . ') ORDER BY c.start_date DESC LIMIT 1) = 
                ' . sUser::model()->myGroup . ' 
            AND i.confirm_id = 2;
        ';


        Yii::app()->db->createCommand($sql8)->execute();

        Yii::app()->user->setFlash('success', '<strong>Great!</strong> Processing is complete. New Payroll Period has been set...');

        $this->redirect(['/m1/gPayroll']);
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $modelPayroll = $this->newPayroll($id);
        $modelPayrollBenefit = $this->newPayrollBenefit($id);
        $modelPayrollInsentif = $this->newPayrollInsentif($id);
        $modelPayrollDeduction = $this->newPayrollDeduction($id);

        $this->render('view', [
            'model' => $this->loadModel($id),
            'modelPayroll' => $modelPayroll,
            'modelPayrollBenefit' => $modelPayrollBenefit,
            'modelPayrollInsentif' => $modelPayrollInsentif,
            'modelPayrollDeduction' => $modelPayrollDeduction,
        ]);
    }

    public function newPayroll($id)
    {
        $model = new gPayrollTemplate;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gPayrollTemplate'])) {
            $model->attributes = $_POST['gPayrollTemplate'];
            $model->parent_id = (int)$id;
            if ($model->save())
                $this->redirect(['view', 'id' => $id, 'tab' => 'Salary History']);
        }

        return $model;
    }

    public function newPayrollBenefit($id)
    {
        $model = new gPayrollTemplateBenefit;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gPayrollTemplateBenefit'])) {
            $model->attributes = $_POST['gPayrollTemplateBenefit'];
            $model->parent_id = (int)$id;
            if ($model->save())
                $this->redirect(['view', 'id' => $id, 'tab' => 'Benefit']);
        }

        return $model;
    }

    public function newPayrollInsentif($id)
    {
        $model = new gPayrollTemplateInsentif;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gPayrollTemplateInsentif'])) {
            $model->attributes = $_POST['gPayrollTemplateInsentif'];
            $model->parent_id = (int)$id;
            if ($model->save())
                $this->redirect(['view', 'id' => $id, 'tab' => 'Insentif']);
        }

        return $model;
    }

    public function newPayrollDeduction($id)
    {
        $model = new gPayrollTemplateDeduction;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gPayrollTemplateDeduction'])) {
            $model->attributes = $_POST['gPayrollTemplateDeduction'];
            $model->parent_id = (int)$id;
            if ($model->save())
                $this->redirect(['view', 'id' => $id, 'tab' => 'Deduction']);
        }

        return $model;
    }

    public function actionIndex($yearmonth = 0)
    {

        if ($yearmonth == 0)
            $yearmonth = peterFunc::cBeginDateAfter(gPayrollTemplate::getLastPeriod());

        $sql = '
            SELECT g.id, p.id as pid, g.employee_name,
            (select 
                `o`.`name` AS `name` from (`g_person_career` `c`
                left join `a_organization` `o` ON ((`o`.`id` = `c`.`department_id`))) where ((`g`.`id` = `c`.`parent_id`)
                and (`c`.`status_id` in (' . implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) . '))) order by `c`.`start_date` desc limit 1) 
                AS `department`,

            (select `p`.`name` AS `name` from (`g_person_status` `s`
                left join `s_parameter` `p` ON (((`p`.`code` = `s`.`status_id`)
                and (`p`.`type` = "AK")))) where (`s`.`parent_id` = `g`.`id`) order by `s`.`start_date` desc limit 1) 
                AS `employee_status`,
    
            (select `c`.`start_date` AS `start_date` from `g_person_career` `c`
                where ((`g`.`id` = `c`.`parent_id`) and (`c`.`status_id` = 1)) order by `c`.`start_date` desc limit 1) 
                AS `join_date`,

            p.category_id,p.basic_salary,
            IF (p.yearmonth_start = ' . $yearmonth . ',p.prorate_salary, 0) as Prorate_salary, p.remark, 

            p.confirm_id, 

            (SELECT  b.confirm_id
                from g_payroll_template_benefit b 
             WHERE g.id = b.parent_id
             AND b.yearmonth_start = ' . $yearmonth . ' LIMIT 1
            ) as Confirm_benefit_id,

            (SELECT d.confirm_id 
                from g_payroll_template_deduction d WHERE g.id = d.parent_id
             AND d.yearmonth_start = ' . $yearmonth . '  LIMIT 1
            ) as Confirm_deduction_id,

            (SELECT i.confirm_id from g_payroll_template_insentif i WHERE g.id = i.parent_id AND i.yearmonth_start = ' . $yearmonth . ' LIMIT 1
            ) as Confirm_insentif_id,

            
            if (p.yearmonth_start = ' . $yearmonth . ', r.name, if (r.name IS NULL,"","Salary Adjustment")) as Category, 

            p.yearmonth_start as Periode,

            (SELECT  b.yearmonth_start
                from g_payroll_template_benefit b 
             WHERE g.id = b.parent_id
             AND b.yearmonth_start = ' . $yearmonth . '  LIMIT 1
            ) as Periode_benefit,

            (SELECT d.yearmonth_start 
                from g_payroll_template_deduction d WHERE g.id = d.parent_id
             AND d.yearmonth_start = ' . $yearmonth . '  LIMIT 1
            ) as Periode_deduction,

            (SELECT i.yearmonth_start from g_payroll_template_insentif i WHERE g.id = i.parent_id AND i.yearmonth_start = ' . $yearmonth . '
            ) as Periode_insentif,

            (SELECT pp.basic_salary from g_payroll_template pp  
             WHERE g.id = pp.parent_id
             AND pp.yearmonth_start <= ' . gPayrollTemplate::getLastPeriod() . ' ORDER BY pp.yearmonth_start DESC LIMIT 1 
            ) as basic_salary_previous,

            (SELECT sum(if(b.type_id = 1, (select pbb.amount from g_param_payroll pbb WHERE pbb.parent_id = pb.id ORDER BY pbb.yearmonth_start DESC LIMIT 1), b.amount)) 
                from g_payroll_template_benefit b INNER JOIN g_param_payroll pb ON pb.id = b.benefit_id 
             WHERE g.id = b.parent_id
             AND b.yearmonth_start <= ' . $yearmonth . ' AND (b.yearmonth_end IS NULL OR b.yearmonth_end >= ' . $yearmonth . ')
            ) as t_benefit,

            (SELECT sum(prorate) from g_payroll_template_benefit b 
             WHERE g.id = b.parent_id
             AND b.yearmonth_start = ' . $yearmonth . '
            ) as t_benefit_prorate,

            (SELECT sum(if(b.type_id = 1, (select pbb.amount from g_param_payroll pbb WHERE pbb.parent_id = pb.id ORDER BY pbb.yearmonth_start DESC LIMIT 1), b.amount)) 
                from g_payroll_template_benefit b INNER JOIN g_param_payroll pb ON pb.id = b.benefit_id 
             WHERE g.id = b.parent_id
             AND b.yearmonth_start <= ' . gPayrollTemplate::getLastPeriod() . ' AND (b.yearmonth_end IS NULL OR b.yearmonth_end >= ' . gPayrollTemplate::getLastPeriod() . ')
            ) as t_benefit_previous,

            (SELECT sum(if(d.type_id = 1, (select pdd.amount from g_param_payroll pdd WHERE pdd.parent_id = pd.id ORDER BY pdd.yearmonth_start DESC LIMIT 1), d.amount)) 
                from g_payroll_template_deduction d INNER JOIN g_param_payroll pd ON pd.id = d.deduction_id 
             WHERE g.id = d.parent_id
             AND d.yearmonth_start <= ' . $yearmonth . ' AND (d.yearmonth_end IS NULL OR d.yearmonth_end >= ' . $yearmonth . ')
            ) as t_deduction,

            (SELECT sum(prorate) from g_payroll_template_deduction d 
             WHERE g.id = d.parent_id
             AND d.yearmonth_start = ' . $yearmonth . '
            ) as t_deduction_prorate,

            (SELECT sum(if(d.type_id = 1, (select pdd.amount from g_param_payroll pdd WHERE pdd.parent_id = pd.id ORDER BY pdd.yearmonth_start DESC LIMIT 1), d.amount)) 
                from g_payroll_template_deduction d INNER JOIN g_param_payroll pd ON pd.id = d.deduction_id 
             WHERE g.id = d.parent_id
             AND d.yearmonth_start <= ' . gPayrollTemplate::getLastPeriod() . ' AND (d.yearmonth_end IS NULL OR d.yearmonth_end >= ' . gPayrollTemplate::getLastPeriod() . ')
            ) as t_deduction_previous,

            (SELECT sum(i.amount) from g_payroll_template_insentif i WHERE g.id = i.parent_id AND i.yearmonth_start = ' . $yearmonth . '
            ) as t_insentif

            FROM g_person g 
            LEFT JOIN g_payroll_template p ON p.parent_id = g.id
            LEFT JOIN g_param_payroll r ON r.id = p.category_id
            WHERE 
            (select `o`.`id` AS `id` from (`g_person_career` `c` left join `a_organization` `o` ON ((`o`.`id` = `c`.`company_id`)))
            where ((`g`.`id` = `c`.`parent_id`)
                    and (`c`.`status_id` in (' . implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) . ')))
            order by `c`.`start_date` desc limit 1) = ' . sUser::model()->myGroup . '

            AND ( 
                (p.confirm_id <= 2 AND p.yearmonth_start = ' . $yearmonth . ') 
                OR p.yearmonth_start IS NULL
                OR g.id IN (SELECT pb.parent_id FROM g_payroll_template_benefit pb WHERE pb.confirm_id <= 2 AND pb.yearmonth_start = ' . $yearmonth . ')
            )
            ORDER BY r.sort 
                
        ';

        $rawData = Yii::app()->db->createCommand($sql)->queryAll();

        $dataProvider = new CArrayDataProvider($rawData, [
            'pagination' => [
                'pageSize' => 30,
            ],
        ]);

        $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAllEmployee()
    {

        $model = new gPerson('search');

        $criteria = new CDbCriteria;

        $model->unsetAttributes();

        if (isset($_GET['gPerson'])) {
            $model->attributes = $_GET['gPerson'];
            $criteria->compare('employee_name', $model->employee_name);
        }

        $sql = "
            SELECT  
            g.id, g.employee_name, 
            (select `o`.`name` AS `name` from (`g_person_career` `c` left join `a_organization` `o` ON ((`o`.`id` = `c`.`department_id`)))
            where ((`pc`.`employee_id` = `c`.`parent_id`) and (`c`.`status_id` in (1 , 2, 3, 4, 5, 6, 15))) order by `c`.`start_date` desc
            limit 1) AS `department`,

            (select `p`.`name` AS `name` from (`g_person_status` `s` left join `s_parameter` `p` ON (((`p`.`code` = `s`.`status_id`)
            and (`p`.`type` = _latin1'AK')))) where (`s`.`parent_id` = `pc`.`employee_id`) order by `s`.`start_date` desc 
            limit 1) AS `employee_status`,

            IF(pc.template_id = 5, pc.amount, 0) + 
            SUM(IF(ppp.parent_id = 2, pc.amount, 0)) + 
            SUM(IF(ppp.parent_id = 3, pc.amount, 0)) +
            SUM(IF(ppp.parent_id = 4, pc.amount, 0)) as previous_salary,

            (select gt.basic_salary from g_payroll_template gt WHERE gt.parent_id = pc.employee_id AND gt.confirm_id <=2 AND gt.yearmonth_start = 201409)
            as basic_salary,

            (SELECT sum(if(b.type_id = 1, (select pbb.amount from g_param_payroll pbb WHERE pbb.parent_id = pb.id ORDER BY pbb.yearmonth_start DESC LIMIT 1), b.amount)) 
                from g_payroll_template_benefit b INNER JOIN g_param_payroll pb ON pb.id = b.benefit_id 
             WHERE pc.employee_id = b.parent_id
             AND b.yearmonth_start = 201409 AND (b.yearmonth_end IS NULL OR b.yearmonth_end >= 201409)
            ) as t_benefit,

            (SELECT sum(if(d.type_id = 1, (select pdd.amount from g_param_payroll pdd WHERE pdd.parent_id = pd.id ORDER BY pdd.yearmonth_start DESC LIMIT 1), d.amount)) 
                from g_payroll_template_deduction d INNER JOIN g_param_payroll pd ON pd.id = d.deduction_id 
             WHERE pc.employee_id = d.parent_id
             AND d.yearmonth_start = 201409 AND (d.yearmonth_end IS NULL OR d.yearmonth_end >= 201409)
            ) as t_deduction,

            (SELECT sum(i.amount) from g_payroll_template_insentif i WHERE pc.employee_id = i.parent_id AND i.yearmonth_start = 201409
            ) as t_insentif

            FROM g_payroll_component pc 
            INNER JOIN g_payroll p ON p.id = pc.parent_id
            LEFT JOIN g_person g ON g.id = pc.employee_id
            LEFT JOIN g_param_payroll pp ON pp.id = pc.template_id
            INNER JOIN g_param_payroll ppp ON pp.parent_id = ppp.id
            LEFT JOIN g_bi_person_lite b ON b.id = pc.employee_id
            WHERE p.yearmonth = 201408
                AND b.company_id = 1100
            GROUP BY g.id, g.employee_name
            ORDER BY g.employee_name
        ";
        $rawData = Yii::app()->db->createCommand($sql)->queryAll();

        $dataProvider = new CArrayDataProvider($rawData, [
            'pagination' => [
                'pageSize' => 250,
            ],
        ]);

        $this->render('allEmployee', [
            'dataProvider' => $dataProvider,
            'model' => $model,
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

        if (Yii::app()->user->name != "admin") {
            $criteria->condition = '(select c.company_id from g_person_career c WHERE t.id=c.parent_id AND c.status_id IN (' .
                implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) .
                ') ORDER BY c.start_date DESC LIMIT 1) IN (' .
                implode(",", sUser::model()->myGroupArray) . ') OR ' .
                '(select c2.company_id from g_person_career2 c2 WHERE t.id=c2.parent_id AND c2.company_id IN (' .
                sUser::model()->myGroup . ') ORDER BY c2.start_date DESC LIMIT 1) IN (' .
                sUser::model()->myGroup . ')';
        }

        $model = gPerson::model()->findByPk((int)$id, $criteria);
        if ($model === null)
            throw new CHttpException(401, 'You are not authorized to open this page.');
        return $model;
    }

    public function loadModelPayroll($id)
    {

        $model = gPayrollTemplate::model()->findByPk((int)$id);
        if ($model === null)
            throw new CHttpException(401, 'You are not authorized to open this page.');
        return $model;
    }

    public function loadModelPayrollBenefit($id)
    {

        $model = gPayrollTemplateBenefit::model()->findByPk((int)$id);
        if ($model === null)
            throw new CHttpException(401, 'You are not authorized to open this page.');
        return $model;
    }

    public function loadModelPayrollDeduction($id)
    {

        $model = gPayrollTemplateDeduction::model()->findByPk((int)$id);
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

    public function actionPayrollChange($yearmonth = 0)
    {

        if ($yearmonth == 0)
            $yearmonth = peterFunc::cBeginDateAfter(gPayrollTemplate::getLastPeriod());

        $pdf = new payrollChange('L', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 12);

        $connection = Yii::app()->db;

        if ($yearmonth == 0)
            $yearmonth = peterFunc::cBeginDateAfter(gPayrollTemplate::getLastPeriod());

        $sql = '
                SELECT g.id, p.id as pid, g.employee_name, g.account_name, g.account_number, g.bank_name,
                (select 
                        `o`.`name` AS `name`
                    from
                        (`g_person_career` `c`
                        left join `a_organization` `o` ON ((`o`.`id` = `c`.`department_id`)))
                    where
                        ((`g`.`id` = `c`.`parent_id`)
                            and (`c`.`status_id` in (' . implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) . ')))
                    order by `c`.`start_date` desc
                    limit 1) AS `department`,

                (select 
                        `p`.`name` AS `name`
                    from
                        (`g_person_status` `s`
                        left join `s_parameter` `p` ON (((`p`.`code` = `s`.`status_id`)
                            and (`p`.`type` = "AK"))))
                    where
                        (`s`.`parent_id` = `g`.`id`)
                    order by `s`.`start_date` desc
                    limit 1) AS `employee_status`,

                (select 
                    `c`.`start_date` AS `start_date`
                from
                    `g_person_career` `c`
                where
                    ((`g`.`id` = `c`.`parent_id`)
                        and (`c`.`status_id` = 1))
                order by `c`.`start_date` desc
                limit 1) AS `join_date`,



                p.yearmonth_start as Periode, p.category_id,p.basic_salary,p.prorate_salary,p.remark, p.confirm_id,

                (SELECT pp.basic_salary from g_payroll_template pp  
                 WHERE g.id = pp.parent_id
                 AND pp.yearmonth_start <= ' . gPayrollTemplate::getLastPeriod() . ' ORDER BY pp.yearmonth_start DESC LIMIT 1 
                ) as basic_salary_previous,

                (SELECT sum(amount) from g_payroll_template_benefit b 
                 WHERE g.id = b.parent_id
                 AND b.yearmonth_start <= ' . $yearmonth . ' AND (b.yearmonth_end IS NULL OR b.yearmonth_end >= ' . $yearmonth . ')
                ) as t_benefit,

                (SELECT sum(if(b.type_id = 1, (select pbb.amount from g_param_payroll pbb WHERE pbb.parent_id = pb.id ORDER BY pbb.yearmonth_start DESC LIMIT 1), b.amount)) 
                    from g_payroll_template_benefit b INNER JOIN g_param_payroll pb ON pb.id = b.benefit_id 
                 WHERE g.id = b.parent_id
                 AND b.yearmonth_start <= ' . gPayrollTemplate::getLastPeriod() . ' AND (b.yearmonth_end IS NULL OR b.yearmonth_end >= ' . gPayrollTemplate::getLastPeriod() . ')
                ) as t_benefit_previous,

                (SELECT sum(amount) from g_payroll_template_deduction d 
                 WHERE g.id = d.parent_id
                 AND d.yearmonth_start <= ' . $yearmonth . ' AND (d.yearmonth_end IS NULL OR d.yearmonth_end >= ' . $yearmonth . ')
                ) as t_deduction,

                (SELECT sum(if(d.type_id = 1, (select pdd.amount from g_param_payroll pdd WHERE pdd.parent_id = pd.id ORDER BY pdd.yearmonth_start DESC LIMIT 1), d.amount)) 
                    from g_payroll_template_deduction d INNER JOIN g_param_payroll pd ON pd.id = d.deduction_id 
                 WHERE g.id = d.parent_id
                 AND d.yearmonth_start <= ' . gPayrollTemplate::getLastPeriod() . ' AND (d.yearmonth_end IS NULL OR d.yearmonth_end >= ' . gPayrollTemplate::getLastPeriod() . ')
                ) as t_deduction_previous,

                r.name as Category 
                FROM g_person g 
                LEFT JOIN g_payroll_template p ON p.parent_id = g.id
                LEFT JOIN g_param_payroll r ON r.id = p.category_id
                WHERE 
                (select c.company_id from g_person_career c WHERE g.id=c.parent_id AND c.status_id IN (' .
            implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) .
            ') ORDER BY c.start_date DESC LIMIT 1) = ' .
            sUser::model()->myGroup . '
                    AND p.confirm_id = 2 AND p.yearmonth_start = ' . $yearmonth . ' 
                ORDER BY r.sort 
                    
            ';

        $command = $connection->createCommand($sql);
        $rows = $command->queryAll();

        $pdf->report($rows, $yearmonth);

        $pdf->Output();
    }

    public function actionPayrollAllEmployee($yearmonth = 0)
    {

        $pdf = new payrollAllEmployee('L', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 12);

        $connection = Yii::app()->db;

        if ($yearmonth == 0)
            $yearmonth = peterFunc::cBeginDateAfter(gPayrollTemplate::getLastPeriod());

        $sql = '
                    SELECT g.id, p.id as pid,  g.employee_name,
                    (select 
                            `o`.`name` AS `name`
                        from
                            (`g_person_career` `c`
                            left join `a_organization` `o` ON ((`o`.`id` = `c`.`department_id`)))
                        where
                            ((`g`.`id` = `c`.`parent_id`)
                                and (`c`.`status_id` in (' . implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) . ')))
                        order by `c`.`start_date` desc
                        limit 1) AS `department`,

                    (select 
                            `p`.`name` AS `name`
                        from
                            (`g_person_status` `s`
                            left join `s_parameter` `p` ON (((`p`.`code` = `s`.`status_id`)
                                and (`p`.`type` = "AK"))))
                        where
                            (`s`.`parent_id` = `g`.`id`)
                        order by `s`.`start_date` desc
                        limit 1) AS `employee_status`,
                    
                    p.yearmonth_start as Periode, p.category_id,p.basic_salary,p.prorate_salary,p.remark, p.confirm_id,
                    IF (p.confirm_id = 3 , "Existing Employee", r.name )  as category,

                    (SELECT sum(amount) from g_payroll_template_benefit b 
                     WHERE g.id = b.parent_id
                     AND b.yearmonth_start <= ' . $yearmonth . ' AND (b.yearmonth_end IS NULL OR b.yearmonth_end >= ' . $yearmonth . ')
                     AND b.benefit_id = 3
                    ) as t_benefit1,

                    (SELECT sum(amount) from g_payroll_template_benefit b 
                     WHERE g.id = b.parent_id
                     AND b.yearmonth_start <= ' . $yearmonth . ' AND (b.yearmonth_end IS NULL OR b.yearmonth_end >= ' . $yearmonth . ')
                     AND b.benefit_id = 4
                    ) as t_benefit2,

                    (SELECT sum(amount) from g_payroll_template_benefit b 
                     WHERE g.id = b.parent_id
                     AND b.yearmonth_start <= ' . $yearmonth . ' AND (b.yearmonth_end IS NULL OR b.yearmonth_end >= ' . $yearmonth . ')
                     AND b.benefit_id = 5
                    ) as t_benefit3,

                    (SELECT sum(amount) from g_payroll_template_benefit b 
                     WHERE g.id = b.parent_id
                     AND b.yearmonth_start <= ' . $yearmonth . ' AND (b.yearmonth_end IS NULL OR b.yearmonth_end >= ' . $yearmonth . ')
                     AND b.benefit_id = 99
                    ) as t_benefit4,

                    (SELECT sum(amount) from g_payroll_template_benefit b 
                     WHERE g.id = b.parent_id
                     AND b.yearmonth_start <= ' . $yearmonth . ' AND (b.yearmonth_end IS NULL OR b.yearmonth_end >= ' . $yearmonth . ')
                     AND b.benefit_id = 99
                    ) as t_benefit5,

                    (SELECT sum(amount) from g_payroll_template_deduction d 
                     WHERE g.id = d.parent_id
                     AND d.yearmonth_start <= ' . $yearmonth . ' AND (d.yearmonth_end IS NULL OR d.yearmonth_end >= ' . $yearmonth . ')
                     AND d.deduction_id = 3
                    ) as t_deduction1,

                    (SELECT sum(amount) from g_payroll_template_deduction d 
                     WHERE g.id = d.parent_id
                     AND d.yearmonth_start <= ' . $yearmonth . ' AND (d.yearmonth_end IS NULL OR d.yearmonth_end >= ' . $yearmonth . ')
                     AND d.deduction_id = 4
                    ) as t_deduction2,

                    (SELECT sum(amount) from g_payroll_template_deduction d 
                     WHERE g.id = d.parent_id
                     AND d.yearmonth_start <= ' . $yearmonth . ' AND (d.yearmonth_end IS NULL OR d.yearmonth_end >= ' . $yearmonth . ')
                     AND d.deduction_id = 5
                    ) as t_deduction3,

                    (SELECT sum(amount) from g_payroll_template_deduction d 
                     WHERE g.id = d.parent_id
                     AND d.yearmonth_start <= ' . $yearmonth . ' AND (d.yearmonth_end IS NULL OR d.yearmonth_end >= ' . $yearmonth . ')
                     AND d.deduction_id = 99
                    ) as t_deduction4,

                    (SELECT sum(amount) from g_payroll_template_deduction d 
                     WHERE g.id = d.parent_id
                     AND d.yearmonth_start <= ' . $yearmonth . ' AND (d.yearmonth_end IS NULL OR d.yearmonth_end >= ' . $yearmonth . ')
                     AND d.deduction_id = 99
                    ) as t_deduction5,

                    r.name as Category 
                    FROM g_person g 
                    LEFT JOIN g_payroll_template p ON p.parent_id = g.id
                    LEFT JOIN g_param_payroll r ON r.id = p.category_id
                    WHERE 
                        (select c.company_id from g_person_career c WHERE g.id=c.parent_id AND c.status_id IN (' .
            implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) .
            ') ORDER BY c.start_date DESC LIMIT 1) = ' .
            sUser::model()->myGroup . '

                    AND ( (select 
                            `s`.`status_id`
                        from
                            `g_person_status` `s`
                        where
                            `s`.`parent_id` = `g`.`id`
                        order by `s`.`start_date` desc
                        limit 1) IN (' . implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) . ') 
                        OR
                        ( (select 
                            `s`.`status_id`
                        from
                            `g_person_status` `s`
                        where
                            `s`.`parent_id` = `g`.`id`
                        order by `s`.`start_date` desc
                        limit 1) IN (' . implode(',', Yii::app()->getModule("m1")->PARAM_RESIGN_ARRAY) . ') AND p.yearmonth_start = ' . gPayrollTemplate::getLastPeriod() . ' ))  


                        AND p.confirm_id >= 2 AND p.yearmonth_start <= ' . $yearmonth . '

                    ORDER BY p.confirm_id, r.sort, department
                        
                ';

        $command = $connection->createCommand($sql);
        $rows = $command->queryAll();

        $pdf->report($rows, $yearmonth);

        $pdf->Output();
    }

    public function actionPrint($id, $month)
    {

        if ($month > date("m"))
            $this->redirect(['view', 'id' => $id]);

        $pdf = new payrollSlip('P', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 12);

        $criteria = new CDbCriteria;
        $criteria->condition = 'yearmonth_start >= ' . date("Y") . $month . ' AND parent_id = ' . $id;
        $criteria->order = 'yearmonth_start';
        $criteria->with = ['person'];
        $criteria->limit = 1;
        $model = gPayrollTemplate::model()->find($criteria);

        if ($model == null)
            throw new CHttpException(401, 'You are not authorized to open this page.');

        $pdf->report($model, $month);

        $pdf->Output();
    }

}
