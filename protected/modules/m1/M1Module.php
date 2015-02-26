<?php

class M1Module extends CWebModule
{

    public function init()
    {
        // this method is called when the module is being created
        // you may place code here to customize the module or the application
        // import the module-level models and components
        $this->setImport([
            'm1.models.*',
            'm1.components.*',
            'm1.reports.*',
        ]);
    }

    public $PARAM_JOIN_ARRAY = [1, 2];
    public $PARAM_COMPANY_ARRAY = [1, 2, 3, 4, 5, 6, 15];
    public $PARAM_RESIGN_ARRAY = [8, 9, 10, 13];

    public function filterUserCompany()
    {
        if (Yii::app()->user->name != "admin") {
            $compFilter = "(select b.company_id from g_person_career b where b.parent_id = a.id AND b.status_id IN (" . implode(",", $this->PARAM_COMPANY_ARRAY) . ") order by b.start_date DESC limit 1) IN (" . implode(",", sUser::model()->myGroupArray) . ") AND 
			(select b.status_id from g_person_status b where b.parent_id = a.id order by b.start_date DESC limit 1) NOT IN (" . implode(",", $this->PARAM_RESIGN_ARRAY) . ")";
        } else {
            $compFilter = " (select b.status_id from g_person_status b where b.parent_id = a.id order by b.start_date DESC limit 1) NOT IN (" . implode(",", $this->PARAM_RESIGN_ARRAY) . ")";
        }

        return $compFilter;
    }

    public function beforeControllerAction($controller, $action)
    {
        if (parent::beforeControllerAction($controller, $action)) {
            // this method is called before any module controller action is performed
            // you may place customized code here
            return true;
        } else
            return false;
    }

}
