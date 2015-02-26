<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of gBiPerson
 *
 * @author sani
 */
class gBiPerson extends BaseModel
{

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return gPerson the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'g_bi_person';
    }


    public function rules()
    {
        return [
            ['employee_code_global', 'safe'],
            ['employee_code_global', 'getFilter', 'safe']
        ];
    }

    public function getFilter()
    {
        $where = 'WHERE TRUE';
        $where .= " AND company_id = " . sUser::model()->myGroup;

        if (isset($_REQUEST['gBiPerson'])) {
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
        }

        //$sql = "SELECT @rownum:=@rownum+1 'rank', p.employee_status, p.employee_name, p.c_pathfoto, p.company, p.department, p.job_title, p.level, p.email, p.handphone, p.address1, p.age, p.sex, p.religion, p.id FROM g_bi_person p, (SELECT @rownum:=0) r $where";
        $sql = "SELECT @rownum:=@rownum+1 'rank', p.* FROM g_bi_person p, (SELECT @rownum:=0) r $where";
        $count = count(Yii::app()->db->createCommand($sql)->queryAll());
        return new CSqlDataProvider($sql, [
            'keyField' => 'id',
            'totalItemCount' => $count,
            'sort' => ['defaultOrder' => 'id DESC'],
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'employee_name' => 'Employee Name',
            'employee_code_global' => 'Employee ID',
            'birth_place' => 'Birth Place',
            'birth_date' => 'Birth Date',
            'age' => 'Age',
            'sex' => 'Gender',
            'religion' => 'Religion',
            'address1' => 'Address',
            'identity_address1' => 'Identity Address',
            'pos_code' => 'Pos Code',
            'blood_id' => 'Blood',
            'home_phone' => 'Home Phone',
            'company_id' => 'Company ID',
            'company' => 'Company Name',
            'company_type' => 'Company Type',
            'department' => 'Department Name',
            'level' => 'Level',
            'job_title' => 'Job Title',
            'career_status' => 'Career Status',
            'employee_status' => 'Status',
            'employee_status_date' => 'Status Start Date',
            'employee_status_enddate' => 'Status End Date',
            'employee_career_date' => 'Career Start Date',
            'join_date' => 'Join Date',
            'join_year' => 'LoS Year',
            'join_month' => 'LoS Month',
            'email' => 'email',
            'email2' => 'email2',
            'handphone' => 'Hand Phone',
            'handphone2' => 'Hand Phone2',
            'account_number' => 'Account Number',
            'account_name' => 'Account Name',
            'bank_name' => 'Bank Name',
            'last_education' => 'Last Education',
            'education' => 'Education',
            'experience' => 'Experience',
            'family' => 'Family',
            'c_pathfoto' => 'PhotoPath',
            'superior_name' => 'Superior Name',
        ];
    }

    public static function getListField($withnull = null)
    {
        if (isset($withnull))
            $_listField['null'] = null;

        $label = self::model()->attributeLabels();
        foreach (self::model()->tableSchema->columns as $val)
            $_listField[$val->name] = $label[$val->name];

        return $_listField;
    }

}