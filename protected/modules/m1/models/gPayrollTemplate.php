<?php

/**
 * This is the model class for table "g_payroll_template".
 *
 * The followings are the available columns in table 'g_payroll_template':
 * @property integer $id
 * @property integer $basic_salary
 * @property string $remark
 * @property integer $created_date
 * @property integer $created_by
 * @property integer $updated_date
 * @property integer $updated_by
 *
 * The followings are the available model relations:
 * @property GPerson $parent
 * @property GPayrollBenefit[] $gPayrollBenefits
 * @property GPayrollDeduction[] $gPayrollDeductions
 */
class gPayrollTemplate extends BaseModel
{

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return gPayroll the static model class
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
        return 'g_payroll_template';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['basic_salary, yearmonth_start', 'required'],
            ['category_id, created_date, created_by, updated_date, updated_by,confirm_id', 'numerical', 'integerOnly' => true],
            ['basic_salary, prorate_salary', 'numerical'],
            ['remark', 'length', 'max' => 300],
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            ['id, basic_salary, remark, created_date, created_by, updated_date, updated_by', 'safe', 'on' => 'search'],
        ];
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return [
            'person' => [self::BELONGS_TO, 'gPerson', 'parent_id'],
            'category' => [self::BELONGS_TO, 'gParamPayroll', 'category_id'],
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'yearmonth_start' => 'Year Month',
            'category_id' => 'Catagory',
            'basic_salary' => 'Basic Salary',
            'prorate_salary' => 'Prorate Salary',
            'confirm_id' => 'Confirm',
            'remark' => 'Remark',
            'created_date' => 'Created Date',
            'created_by' => 'Created By',
            'updated_date' => 'Updated Date',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search($id)
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('parent_id', $id);
        $criteria->order = 'yearmonth_start DESC';

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
        ]);
    }

    public function getBenefitC()
    {
        $connection = Yii::app()->db;
        $sql = "SELECT sum(amount) FROM `g_payroll_template_benefit` WHERE 
                yearmonth_start <= " . date("Ym") . " AND (yearmonth_end IS NULL OR yearmonth_end >= " . date("Ym") . ") AND 
                parent_id = " . $this->parent_id;

        $command = $connection->createCommand($sql);
        $row = $command->queryScalar();

        if (isset($row)) {
            return $row;
        } else
            return null;
    }

    public function getDeductionC()
    {
        $connection = Yii::app()->db;
        $sql = "SELECT sum(`amount`) FROM `g_payroll_template_deduction` WHERE 
                yearmonth_start <= " . date("Ym") . " AND (yearmonth_end IS NULL OR yearmonth_end >= " . date("Ym") . ") AND 
                `parent_id` = " . $this->parent_id;

        $command = $connection->createCommand($sql);
        $row = $command->queryScalar();

        if (isset($row)) {
            return $row;
        } else
            return null;
    }

    public static function getLastPeriod()
    {
        $connection = Yii::app()->db;
        $sql = "SELECT yearmonth_start FROM `g_payroll_template`
                WHERE  confirm_id = 3 
                ORDER BY yearmonth_start DESC LIMIT 1";

        $command = $connection->createCommand($sql);
        $row = $command->queryScalar();

        if (isset($row)) {
            return $row;
        } else
            return null;
    }

    public static function getYearHistory($id)
    {
        $sql = '
            SELECT p.id, "Basic Salary" as type,
            (SELECT g.basic_salary from g_payroll_template g WHERE g.yearmonth_start <=  ' . date("Y") . '01 AND CURDATE() >= "' . date("Y") . "-01-01" . '" AND g.parent_id = p.id ORDER BY g.yearmonth_start DESC LIMIT 1) as jan,
            (SELECT g.basic_salary from g_payroll_template g WHERE g.yearmonth_start <=  ' . date("Y") . '02 AND CURDATE() >= "' . date("Y") . "-02-01" . '" AND g.parent_id = p.id ORDER BY g.yearmonth_start DESC LIMIT 1) as feb,
            (SELECT g.basic_salary from g_payroll_template g WHERE g.yearmonth_start <=  ' . date("Y") . '03 AND CURDATE() >= "' . date("Y") . "-03-01" . '" AND g.parent_id = p.id ORDER BY g.yearmonth_start DESC LIMIT 1) as mar,
            (SELECT g.basic_salary from g_payroll_template g WHERE g.yearmonth_start <=  ' . date("Y") . '04 AND CURDATE() >= "' . date("Y") . "-04-01" . '" AND g.parent_id = p.id ORDER BY g.yearmonth_start DESC LIMIT 1) as apr,
            (SELECT g.basic_salary from g_payroll_template g WHERE g.yearmonth_start <=  ' . date("Y") . '05 AND CURDATE() >= "' . date("Y") . "-05-01" . '" AND g.parent_id = p.id ORDER BY g.yearmonth_start DESC LIMIT 1) as mei,
            (SELECT g.basic_salary from g_payroll_template g WHERE g.yearmonth_start <=  ' . date("Y") . '06 AND CURDATE() >= "' . date("Y") . "-06-01" . '" AND g.parent_id = p.id ORDER BY g.yearmonth_start DESC LIMIT 1) as jun,
            (SELECT g.basic_salary from g_payroll_template g WHERE g.yearmonth_start <=  ' . date("Y") . '07 AND CURDATE() >= "' . date("Y") . "-07-01" . '" AND g.parent_id = p.id ORDER BY g.yearmonth_start DESC LIMIT 1) as jul,
            (SELECT g.basic_salary from g_payroll_template g WHERE g.yearmonth_start <=  ' . date("Y") . '08 AND CURDATE() >= "' . date("Y") . "-08-01" . '" AND g.parent_id = p.id ORDER BY g.yearmonth_start DESC LIMIT 1) as agt,
            (SELECT g.basic_salary from g_payroll_template g WHERE g.yearmonth_start <=  ' . date("Y") . '09 AND CURDATE() >= "' . date("Y") . "-09-01" . '" AND g.parent_id = p.id ORDER BY g.yearmonth_start DESC LIMIT 1) as sep,
            (SELECT g.basic_salary from g_payroll_template g WHERE g.yearmonth_start <=  ' . date("Y") . '10 AND CURDATE() >= "' . date("Y") . "-10-01" . '" AND g.parent_id = p.id ORDER BY g.yearmonth_start DESC LIMIT 1) as okt,
            (SELECT g.basic_salary from g_payroll_template g WHERE g.yearmonth_start <=  ' . date("Y") . '11 AND CURDATE() >= "' . date("Y") . "-11-01" . '" AND g.parent_id = p.id ORDER BY g.yearmonth_start DESC LIMIT 1) as nov,
            (SELECT g.basic_salary from g_payroll_template g WHERE g.yearmonth_start <=  ' . date("Y") . '12 AND CURDATE() >= "' . date("Y") . "-12-01" . '" AND g.parent_id = p.id ORDER BY g.yearmonth_start DESC LIMIT 1) as des 
            FROM g_person p
            WHERE p.id = ' . $id . ' /*UNION 
            SELECT p.id, "Prorate Salary",
            (SELECT g.prorate_salary from g_payroll_template g WHERE g.yearmonth_start <=  ' . date("Y") . '01 AND CURDATE() >= "' . date("Y") . "-01-01" . '" AND g.parent_id = p.id ORDER BY g.yearmonth_start DESC LIMIT 1) as jan,
            (SELECT g.prorate_salary from g_payroll_template g WHERE g.yearmonth_start <=  ' . date("Y") . '02 AND CURDATE() >= "' . date("Y") . "-02-01" . '" AND g.parent_id = p.id ORDER BY g.yearmonth_start DESC LIMIT 1) as feb,
            (SELECT g.prorate_salary from g_payroll_template g WHERE g.yearmonth_start <=  ' . date("Y") . '03 AND CURDATE() >= "' . date("Y") . "-03-01" . '" AND g.parent_id = p.id ORDER BY g.yearmonth_start DESC LIMIT 1) as mar,
            (SELECT g.prorate_salary from g_payroll_template g WHERE g.yearmonth_start <=  ' . date("Y") . '04 AND CURDATE() >= "' . date("Y") . "-04-01" . '" AND g.parent_id = p.id ORDER BY g.yearmonth_start DESC LIMIT 1) as apr,
            (SELECT g.prorate_salary from g_payroll_template g WHERE g.yearmonth_start <=  ' . date("Y") . '05 AND CURDATE() >= "' . date("Y") . "-05-01" . '" AND g.parent_id = p.id ORDER BY g.yearmonth_start DESC LIMIT 1) as mei,
            (SELECT g.prorate_salary from g_payroll_template g WHERE g.yearmonth_start <=  ' . date("Y") . '06 AND CURDATE() >= "' . date("Y") . "-06-01" . '" AND g.parent_id = p.id ORDER BY g.yearmonth_start DESC LIMIT 1) as jun,
            (SELECT g.prorate_salary from g_payroll_template g WHERE g.yearmonth_start <=  ' . date("Y") . '07 AND CURDATE() >= "' . date("Y") . "-07-01" . '" AND g.parent_id = p.id ORDER BY g.yearmonth_start DESC LIMIT 1) as jul,
            (SELECT g.prorate_salary from g_payroll_template g WHERE g.yearmonth_start <=  ' . date("Y") . '08 AND CURDATE() >= "' . date("Y") . "-08-01" . '" AND g.parent_id = p.id ORDER BY g.yearmonth_start DESC LIMIT 1) as agt,
            (SELECT g.prorate_salary from g_payroll_template g WHERE g.yearmonth_start <=  ' . date("Y") . '09 AND CURDATE() >= "' . date("Y") . "-09-01" . '" AND g.parent_id = p.id ORDER BY g.yearmonth_start DESC LIMIT 1) as sep,
            (SELECT g.prorate_salary from g_payroll_template g WHERE g.yearmonth_start <=  ' . date("Y") . '10 AND CURDATE() >= "' . date("Y") . "-10-01" . '" AND g.parent_id = p.id ORDER BY g.yearmonth_start DESC LIMIT 1) as okt,
            (SELECT g.prorate_salary from g_payroll_template g WHERE g.yearmonth_start <=  ' . date("Y") . '11 AND CURDATE() >= "' . date("Y") . "-11-01" . '" AND g.parent_id = p.id ORDER BY g.yearmonth_start DESC LIMIT 1) as nov,
            (SELECT g.prorate_salary from g_payroll_template g WHERE g.yearmonth_start <=  ' . date("Y") . '12 AND CURDATE() >= "' . date("Y") . "-12-01" . '" AND g.parent_id = p.id ORDER BY g.yearmonth_start DESC LIMIT 1) as des 
            FROM g_person p
            WHERE p.id = ' . $id . ' */ UNION 
            SELECT p.id, "Benefit",
            (SELECT sum( if (b.type_id = 1, (select gb.amount from g_param_payroll gb WHERE gb.parent_id = b.benefit_id and gb.yearmonth_start <= ' . date("Y") . '01 order by gb.yearmonth_start desc limit 1),b.amount) ) 
                from g_payroll_template_benefit b WHERE b.yearmonth_start <=  ' . date("Y") . '01 AND (b.yearmonth_end >=  ' . date("Y") . '01 OR b.yearmonth_end IS NULL) 
                AND CURDATE() >= "' . date("Y") . "-01-01" . '" AND b.parent_id = p.id ORDER BY b.yearmonth_start LIMIT 1),
            (SELECT sum( if (b.type_id = 1, (select gb.amount from g_param_payroll gb WHERE gb.parent_id = b.benefit_id and gb.yearmonth_start <= ' . date("Y") . '02 order by gb.yearmonth_start desc limit 1),b.amount) ) 
                from g_payroll_template_benefit b WHERE b.yearmonth_start <=  ' . date("Y") . '02 AND (b.yearmonth_end >=  ' . date("Y") . '02 OR b.yearmonth_end IS NULL) 
                AND CURDATE() >= "' . date("Y") . "-02-01" . '" AND b.parent_id = p.id ORDER BY b.yearmonth_start LIMIT 1),
            (SELECT sum( if (b.type_id = 1, (select gb.amount from g_param_payroll gb WHERE gb.parent_id = b.benefit_id and gb.yearmonth_start <= ' . date("Y") . '03 order by gb.yearmonth_start desc limit 1),b.amount) ) 
                from g_payroll_template_benefit b WHERE b.yearmonth_start <=  ' . date("Y") . '03 AND (b.yearmonth_end >=  ' . date("Y") . '03 OR b.yearmonth_end IS NULL) 
                AND CURDATE() >= "' . date("Y") . "-03-01" . '" AND b.parent_id = p.id ORDER BY b.yearmonth_start LIMIT 1),
            (SELECT sum( if (b.type_id = 1, (select gb.amount from g_param_payroll gb WHERE gb.parent_id = b.benefit_id and gb.yearmonth_start <= ' . date("Y") . '04 order by gb.yearmonth_start desc limit 1),b.amount) ) 
                from g_payroll_template_benefit b WHERE b.yearmonth_start <=  ' . date("Y") . '04 AND (b.yearmonth_end >=  ' . date("Y") . '04 OR b.yearmonth_end IS NULL) 
                AND CURDATE() >= "' . date("Y") . "-04-01" . '" AND b.parent_id = p.id ORDER BY b.yearmonth_start LIMIT 1),
            (SELECT sum( if (b.type_id = 1, (select gb.amount from g_param_payroll gb WHERE gb.parent_id = b.benefit_id and gb.yearmonth_start <= ' . date("Y") . '05 order by gb.yearmonth_start desc limit 1),b.amount) ) 
                from g_payroll_template_benefit b WHERE b.yearmonth_start <=  ' . date("Y") . '05 AND (b.yearmonth_end >=  ' . date("Y") . '05 OR b.yearmonth_end IS NULL) 
                AND CURDATE() >= "' . date("Y") . "-05-01" . '" AND b.parent_id = p.id ORDER BY b.yearmonth_start LIMIT 1),
            (SELECT sum( if (b.type_id = 1, (select gb.amount from g_param_payroll gb WHERE gb.parent_id = b.benefit_id and gb.yearmonth_start <= ' . date("Y") . '06 order by gb.yearmonth_start desc limit 1),b.amount) ) 
                from g_payroll_template_benefit b WHERE b.yearmonth_start <=  ' . date("Y") . '06 AND (b.yearmonth_end >=  ' . date("Y") . '06 OR b.yearmonth_end IS NULL) 
                AND CURDATE() >= "' . date("Y") . "-06-01" . '" AND b.parent_id = p.id ORDER BY b.yearmonth_start LIMIT 1),
            (SELECT sum( if (b.type_id = 1, (select gb.amount from g_param_payroll gb WHERE gb.parent_id = b.benefit_id and gb.yearmonth_start <= ' . date("Y") . '07 order by gb.yearmonth_start desc limit 1),b.amount) ) 
                from g_payroll_template_benefit b WHERE b.yearmonth_start <=  ' . date("Y") . '07 AND (b.yearmonth_end >=  ' . date("Y") . '07 OR b.yearmonth_end IS NULL) 
                AND CURDATE() >= "' . date("Y") . "-07-01" . '" AND b.parent_id = p.id ORDER BY b.yearmonth_start LIMIT 1),
            (SELECT sum( if (b.type_id = 1, (select gb.amount from g_param_payroll gb WHERE gb.parent_id = b.benefit_id and gb.yearmonth_start <= ' . date("Y") . '08 order by gb.yearmonth_start desc limit 1),b.amount) ) 
                from g_payroll_template_benefit b WHERE b.yearmonth_start <=  ' . date("Y") . '08 AND (b.yearmonth_end >=  ' . date("Y") . '08 OR b.yearmonth_end IS NULL) 
                AND CURDATE() >= "' . date("Y") . "-08-01" . '" AND b.parent_id = p.id ORDER BY b.yearmonth_start LIMIT 1),
            (SELECT sum( if (b.type_id = 1, (select gb.amount from g_param_payroll gb WHERE gb.parent_id = b.benefit_id and gb.yearmonth_start <= ' . date("Y") . '09 order by gb.yearmonth_start desc limit 1),b.amount) ) 
                from g_payroll_template_benefit b WHERE b.yearmonth_start <=  ' . date("Y") . '09 AND (b.yearmonth_end >=  ' . date("Y") . '09 OR b.yearmonth_end IS NULL) 
                AND CURDATE() >= "' . date("Y") . "-09-01" . '" AND b.parent_id = p.id ORDER BY b.yearmonth_start LIMIT 1),
            (SELECT sum( if (b.type_id = 1, (select gb.amount from g_param_payroll gb WHERE gb.parent_id = b.benefit_id and gb.yearmonth_start <= ' . date("Y") . '10 order by gb.yearmonth_start desc limit 1),b.amount) ) 
                from g_payroll_template_benefit b WHERE b.yearmonth_start <=  ' . date("Y") . '10 AND (b.yearmonth_end >=  ' . date("Y") . '10 OR b.yearmonth_end IS NULL) 
                AND CURDATE() >= "' . date("Y") . "-10-01" . '" AND b.parent_id = p.id ORDER BY b.yearmonth_start LIMIT 1),
            (SELECT sum( if (b.type_id = 1, (select gb.amount from g_param_payroll gb WHERE gb.parent_id = b.benefit_id and gb.yearmonth_start <= ' . date("Y") . '11 order by gb.yearmonth_start desc limit 1),b.amount) ) 
                from g_payroll_template_benefit b WHERE b.yearmonth_start <=  ' . date("Y") . '11 AND (b.yearmonth_end >=  ' . date("Y") . '11 OR b.yearmonth_end IS NULL) 
                AND CURDATE() >= "' . date("Y") . "-11-01" . '" AND b.parent_id = p.id ORDER BY b.yearmonth_start LIMIT 1),
            (SELECT sum( if (b.type_id = 1, (select gb.amount from g_param_payroll gb WHERE gb.parent_id = b.benefit_id and gb.yearmonth_start <= ' . date("Y") . '12 order by gb.yearmonth_start desc limit 1),b.amount) ) 
                from g_payroll_template_benefit b WHERE b.yearmonth_start <=  ' . date("Y") . '12 AND (b.yearmonth_end >=  ' . date("Y") . '12 OR b.yearmonth_end IS NULL) 
                AND CURDATE() >= "' . date("Y") . "-12-01" . '" AND b.parent_id = p.id ORDER BY b.yearmonth_start LIMIT 1)
            FROM g_person p
            WHERE p.id = ' . $id . ' UNION
            SELECT p.id, "Deduction",
            (SELECT sum( if (d.type_id = 1, (select gd.amount from g_param_payroll gd WHERE gd.parent_id = d.deduction_id and gd.yearmonth_start <= ' . date("Y") . '01 order by gd.yearmonth_start desc limit 1),d.amount) ) 
                from g_payroll_template_deduction d WHERE d.yearmonth_start <=  ' . date("Y") . '01 AND (d.yearmonth_end >=  ' . date("Y") . '01 OR d.yearmonth_end IS NULL) 
                AND CURDATE() >= "' . date("Y") . "-01-01" . '" AND d.parent_id = p.id ORDER BY d.yearmonth_start LIMIT 1),
            (SELECT sum( if (d.type_id = 1, (select gd.amount from g_param_payroll gd WHERE gd.parent_id = d.deduction_id and gd.yearmonth_start <= ' . date("Y") . '02 order by gd.yearmonth_start desc limit 1),d.amount) ) 
                from g_payroll_template_deduction d WHERE d.yearmonth_start <=  ' . date("Y") . '02 AND (d.yearmonth_end >=  ' . date("Y") . '02 OR d.yearmonth_end IS NULL) 
                AND CURDATE() >= "' . date("Y") . "-02-01" . '" AND d.parent_id = p.id ORDER BY d.yearmonth_start LIMIT 1),
            (SELECT sum( if (d.type_id = 1, (select gd.amount from g_param_payroll gd WHERE gd.parent_id = d.deduction_id and gd.yearmonth_start <= ' . date("Y") . '03 order by gd.yearmonth_start desc limit 1),d.amount) ) 
                from g_payroll_template_deduction d WHERE d.yearmonth_start <=  ' . date("Y") . '03 AND (d.yearmonth_end >=  ' . date("Y") . '03 OR d.yearmonth_end IS NULL) 
                AND CURDATE() >= "' . date("Y") . "-03-01" . '" AND d.parent_id = p.id ORDER BY d.yearmonth_start LIMIT 1),
            (SELECT sum( if (d.type_id = 1, (select gd.amount from g_param_payroll gd WHERE gd.parent_id = d.deduction_id and gd.yearmonth_start <= ' . date("Y") . '04 order by gd.yearmonth_start desc limit 1),d.amount) ) 
                from g_payroll_template_deduction d WHERE d.yearmonth_start <=  ' . date("Y") . '04 AND (d.yearmonth_end >=  ' . date("Y") . '04 OR d.yearmonth_end IS NULL) 
                AND CURDATE() >= "' . date("Y") . "-04-01" . '" AND d.parent_id = p.id ORDER BY d.yearmonth_start LIMIT 1),
            (SELECT sum( if (d.type_id = 1, (select gd.amount from g_param_payroll gd WHERE gd.parent_id = d.deduction_id and gd.yearmonth_start <= ' . date("Y") . '05 order by gd.yearmonth_start desc limit 1),d.amount) ) 
                from g_payroll_template_deduction d WHERE d.yearmonth_start <=  ' . date("Y") . '05 AND (d.yearmonth_end >=  ' . date("Y") . '05 OR d.yearmonth_end IS NULL) 
                AND CURDATE() >= "' . date("Y") . "-05-01" . '" AND d.parent_id = p.id ORDER BY d.yearmonth_start LIMIT 1),
            (SELECT sum( if (d.type_id = 1, (select gd.amount from g_param_payroll gd WHERE gd.parent_id = d.deduction_id and gd.yearmonth_start <= ' . date("Y") . '06 order by gd.yearmonth_start desc limit 1),d.amount) ) 
                from g_payroll_template_deduction d WHERE d.yearmonth_start <=  ' . date("Y") . '06 AND (d.yearmonth_end >=  ' . date("Y") . '06 OR d.yearmonth_end IS NULL) 
                AND CURDATE() >= "' . date("Y") . "-06-01" . '" AND d.parent_id = p.id ORDER BY d.yearmonth_start LIMIT 1),
            (SELECT sum( if (d.type_id = 1, (select gd.amount from g_param_payroll gd WHERE gd.parent_id = d.deduction_id and gd.yearmonth_start <= ' . date("Y") . '07 order by gd.yearmonth_start desc limit 1),d.amount) ) 
                from g_payroll_template_deduction d WHERE d.yearmonth_start <=  ' . date("Y") . '07 AND (d.yearmonth_end >=  ' . date("Y") . '07 OR d.yearmonth_end IS NULL) 
                AND CURDATE() >= "' . date("Y") . "-07-01" . '" AND d.parent_id = p.id ORDER BY d.yearmonth_start LIMIT 1),
            (SELECT sum( if (d.type_id = 1, (select gd.amount from g_param_payroll gd WHERE gd.parent_id = d.deduction_id and gd.yearmonth_start <= ' . date("Y") . '08 order by gd.yearmonth_start desc limit 1),d.amount) ) 
                from g_payroll_template_deduction d WHERE d.yearmonth_start <=  ' . date("Y") . '08 AND (d.yearmonth_end >=  ' . date("Y") . '08 OR d.yearmonth_end IS NULL) 
                AND CURDATE() >= "' . date("Y") . "-08-01" . '" AND d.parent_id = p.id ORDER BY d.yearmonth_start LIMIT 1),
            (SELECT sum( if (d.type_id = 1, (select gd.amount from g_param_payroll gd WHERE gd.parent_id = d.deduction_id and gd.yearmonth_start <= ' . date("Y") . '09 order by gd.yearmonth_start desc limit 1),d.amount) ) 
                from g_payroll_template_deduction d WHERE d.yearmonth_start <=  ' . date("Y") . '09 AND (d.yearmonth_end >=  ' . date("Y") . '09 OR d.yearmonth_end IS NULL) 
                AND CURDATE() >= "' . date("Y") . "-09-01" . '" AND d.parent_id = p.id ORDER BY d.yearmonth_start LIMIT 1),
            (SELECT sum( if (d.type_id = 1, (select gd.amount from g_param_payroll gd WHERE gd.parent_id = d.deduction_id and gd.yearmonth_start <= ' . date("Y") . '10 order by gd.yearmonth_start desc limit 1),d.amount) ) 
                from g_payroll_template_deduction d WHERE d.yearmonth_start <=  ' . date("Y") . '10 AND (d.yearmonth_end >=  ' . date("Y") . '10 OR d.yearmonth_end IS NULL) 
                AND CURDATE() >= "' . date("Y") . "-10-01" . '" AND d.parent_id = p.id ORDER BY d.yearmonth_start LIMIT 1),
            (SELECT sum( if (d.type_id = 1, (select gd.amount from g_param_payroll gd WHERE gd.parent_id = d.deduction_id and gd.yearmonth_start <= ' . date("Y") . '11 order by gd.yearmonth_start desc limit 1),d.amount) ) 
                from g_payroll_template_deduction d WHERE d.yearmonth_start <=  ' . date("Y") . '11 AND (d.yearmonth_end >=  ' . date("Y") . '11 OR d.yearmonth_end IS NULL) 
                AND CURDATE() >= "' . date("Y") . "-11-01" . '" AND d.parent_id = p.id ORDER BY d.yearmonth_start LIMIT 1),
            (SELECT sum( if (d.type_id = 1, (select gd.amount from g_param_payroll gd WHERE gd.parent_id = d.deduction_id and gd.yearmonth_start <= ' . date("Y") . '12 order by gd.yearmonth_start desc limit 1),d.amount) ) 
                from g_payroll_template_deduction d WHERE d.yearmonth_start <=  ' . date("Y") . '12 AND (d.yearmonth_end >=  ' . date("Y") . '12 OR d.yearmonth_end IS NULL) 
                AND CURDATE() >= "' . date("Y") . "-12-01" . '" AND d.parent_id = p.id ORDER BY d.yearmonth_start LIMIT 1)
            FROM g_person p
            WHERE p.id = ' . $id . ' UNION
            SELECT p.id, "Insentif",
            (SELECT sum( i.amount) 
                from g_payroll_template_insentif i WHERE i.yearmonth_start =  ' . date("Y") . '01 AND 
                CURDATE() >= "' . date("Y") . "-01-01" . '" AND i.parent_id = p.id ORDER BY i.yearmonth_start LIMIT 1),
            (SELECT sum( i.amount) 
                from g_payroll_template_insentif i WHERE i.yearmonth_start =  ' . date("Y") . '02 AND 
                CURDATE() >= "' . date("Y") . "-02-01" . '" AND i.parent_id = p.id ORDER BY i.yearmonth_start LIMIT 1),
            (SELECT sum( i.amount) 
                from g_payroll_template_insentif i WHERE i.yearmonth_start =  ' . date("Y") . '03 AND 
                CURDATE() >= "' . date("Y") . "-03-01" . '" AND i.parent_id = p.id ORDER BY i.yearmonth_start LIMIT 1),
            (SELECT sum( i.amount) 
                from g_payroll_template_insentif i WHERE i.yearmonth_start =  ' . date("Y") . '04 AND 
                CURDATE() >= "' . date("Y") . "-04-01" . '" AND i.parent_id = p.id ORDER BY i.yearmonth_start LIMIT 1),
            (SELECT sum( i.amount) 
                from g_payroll_template_insentif i WHERE i.yearmonth_start =  ' . date("Y") . '05 AND 
                CURDATE() >= "' . date("Y") . "-05-01" . '" AND i.parent_id = p.id ORDER BY i.yearmonth_start LIMIT 1),
            (SELECT sum( i.amount) 
                from g_payroll_template_insentif i WHERE i.yearmonth_start =  ' . date("Y") . '06 AND 
                CURDATE() >= "' . date("Y") . "-06-01" . '" AND i.parent_id = p.id ORDER BY i.yearmonth_start LIMIT 1),
            (SELECT sum( i.amount) 
                from g_payroll_template_insentif i WHERE i.yearmonth_start =  ' . date("Y") . '07 AND 
                CURDATE() >= "' . date("Y") . "-07-01" . '" AND i.parent_id = p.id ORDER BY i.yearmonth_start LIMIT 1),
            (SELECT sum( i.amount) 
                from g_payroll_template_insentif i WHERE i.yearmonth_start =  ' . date("Y") . '08 AND 
                CURDATE() >= "' . date("Y") . "-08-01" . '" AND i.parent_id = p.id ORDER BY i.yearmonth_start LIMIT 1),
            (SELECT sum( i.amount) 
                from g_payroll_template_insentif i WHERE i.yearmonth_start =  ' . date("Y") . '09 AND 
                CURDATE() >= "' . date("Y") . "-09-01" . '" AND i.parent_id = p.id ORDER BY i.yearmonth_start LIMIT 1),
            (SELECT sum( i.amount) 
                from g_payroll_template_insentif i WHERE i.yearmonth_start =  ' . date("Y") . '10 AND 
                CURDATE() >= "' . date("Y") . "-10-01" . '" AND i.parent_id = p.id ORDER BY i.yearmonth_start LIMIT 1),
            (SELECT sum( i.amount) 
                from g_payroll_template_insentif i WHERE i.yearmonth_start =  ' . date("Y") . '11 AND 
                CURDATE() >= "' . date("Y") . "-11-01" . '" AND i.parent_id = p.id ORDER BY i.yearmonth_start LIMIT 1),
            (SELECT sum( i.amount) 
                from g_payroll_template_insentif i WHERE i.yearmonth_start =  ' . date("Y") . '12 AND 
                CURDATE() >= "' . date("Y") . "-12-01" . '" AND i.parent_id = p.id ORDER BY i.yearmonth_start LIMIT 1)
            FROM g_person p
            WHERE p.id = ' . $id;

        $rawData = Yii::app()->db->createCommand($sql)->queryAll();
        $dataProvider = new CArrayDataProvider($rawData);

        return $dataProvider;
    }

    public static function benefitList($id, $month)
    {
        $connection = Yii::app()->db;
        $sql = "SELECT `p`.`name` as benefit, 
                if (`b`.`type_id` = 1, (select `gb`.`amount` from `g_param_payroll` `gb` WHERE `gb`.`parent_id` = `b`.`benefit_id` and `gb`.`yearmonth_start` <= " . date("Y") . $month . " order by gb.yearmonth_start desc limit 1),b.amount)
                as amount  FROM `g_payroll_template_benefit` `b`
                INNER JOIN `g_param_payroll` `p` ON `p`.`id` = `b`.`benefit_id`
                WHERE  `b`.`parent_id` = " . $id . " 
                AND  `b`.`yearmonth_start` <= " . date("Y") . $month . " AND (`b`.`yearmonth_end` IS NULL OR `b`.`yearmonth_end` >= " . date("Y") . $month . ")";

        $command = $connection->createCommand($sql);
        $rows = $command->queryAll();

        if (isset($rows)) {
            return $rows;
        } else
            return [];
    }

    public static function insentifList($id, $month)
    {
        $connection = Yii::app()->db;
        $sql = "SELECT `i`.`insentif_name`, `i`.`amount`
                FROM `g_payroll_template_insentif` `i`
                WHERE  `i`.`parent_id` = " . $id . " 
                AND  `i`.`yearmonth_start` = " . date("Y") . $month;

        $command = $connection->createCommand($sql);
        $rows = $command->queryAll();

        if (isset($rows)) {
            return $rows;
        } else
            return [];
    }

    public static function deductionList($id, $month)
    {
        $connection = Yii::app()->db;
        $sql = "SELECT `p`.`name` as deduction, 
                if (`d`.`type_id` = 1, (select `gd`.`amount` from `g_param_payroll` `gd` WHERE `gd`.`parent_id` = `d`.`deduction_id` and `gd`.`yearmonth_start` <= " . date("Y") . $month . " order by `gd`.`yearmonth_start` desc limit 1),`d`.`amount`)
                as amount  FROM `g_payroll_template_deduction` `d`
                INNER JOIN `g_param_payroll` `p` ON `p`.`id` = `d`.`deduction_id`
                WHERE  `d`.`parent_id` = " . $id . " 
                AND  `d`.`yearmonth_start` <= " . date("Y") . $month . " AND (`d`.`yearmonth_end` IS NULL OR `d`.`yearmonth_end` >= " . date("Y") . $month . ")";

        $command = $connection->createCommand($sql);
        $rows = $command->queryAll();

        if (isset($rows)) {
            return $rows;
        } else
            return [];
    }

}
