<?php

/**
 * This is the model class for table "c_personalia_absence".
 *
 * The followings are the available columns in table 'c_personalia_absence':
 * @property string $id
 * @property string $parent_id
 * @property string $cdate
 * @property integer $realpattern_id
 * @property string $in
 * @property string $out
 */
class gAttendance extends BaseModel
{

    /**
     * Returns the static model of the specified AR class.
     * @return cPersonaliaAbsence the static model class
     */
    public $lateIn;
    public $earlyOut;

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'g_attendance';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['cdate', 'required'],
            ['remark', 'required', 'on' => 'changeshift', 'message' => 'Remark cannot be blank. You must explain the reason why you change your schedule...'],
            ['cdate', 'date', 'format' => 'dd-MM-yyyy'],
            //array('cdate, parent_id', 'ext.EUniqueIndexValidator'),
            ['realpattern_id, changepattern_id, overtime_in, overtime_out', 'numerical', 'integerOnly' => true],
            ['parent_id', 'length', 'max' => 11],
            ['remark, notes', 'length', 'max' => 150],
            ['cdate, in, out', 'safe'],
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            ['id, parent_id, cdate, realpattern_id, in, out', 'safe', 'on' => 'search'],
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
            'realpattern' => [self::BELONGS_TO, 'gParamTimeblock', 'realpattern_id'],
            'changepattern' => [self::BELONGS_TO, 'gParamTimeblock', 'changepattern_id'],
            'person' => [self::BELONGS_TO, 'gPerson', 'parent_id'],
            'approved' => [self::BELONGS_TO, 'sParameter', ['approved_id' => 'code'], 'condition' => 'type = \'cLeaveApproved\''],
            'superior_approved' => [self::BELONGS_TO, 'sParameter', ['superior_approved_id' => 'code'], 'condition' => 'type = \'cLeaveApproved\''],
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent',
            'cdate' => 'Date',
            'realpattern_id' => 'Real Pattern',
            'changepattern_id' => 'Change Pattern To',
            'in' => 'In',
            'out' => 'Out',
            'remark' => 'Remark',
            'notes' => 'Notes to HR',
            'overtime_in' => 'Overtime In',
            'overtime_out' => 'Overtime Out',
        ];
    }

    public function search($id, $month)
    {
        $criteria = new CDbCriteria;

        $criteria->compare('parent_id', $id);
        $criteria->addBetweenCondition('cdate', date("Y-m-d", strtotime(date("Y-m", strtotime($month . " month")) . "-01")), date("Y-m-d", strtotime("-1 day", strtotime(date("Y-m", strtotime($month + 1 . " month")) . "-01"))));
        $criteria->order = 'cdate';
        $criteria->with = 'realpattern';

        return new CActiveDataProvider(get_class($this), [
            'criteria' => $criteria,
            //'pagination'=>array(
            //		'pageSize'=>31,
            //),
            'pagination' => false,
        ]);
    }

    public function searchByDate($day,$department_id = 0)
    {
        $criteria = new CDbCriteria;

        $criteria->condition = '(select c.company_id from g_person_career c WHERE t.parent_id=c.parent_id AND c.status_id IN (' .
            implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) .
            ') ORDER BY c.start_date DESC LIMIT 1) = ' .sUser::model()->myGroup ;

        if (isset($_GET['dropDownStatus'])) {
            $criteria1 = new CDbCriteria;
            $criteria1->condition = '(select c.department_id from g_person_career c WHERE t.parent_id=c.parent_id 
                ORDER BY c.start_date DESC LIMIT 1) = ' .$_GET['dropDownStatus'] ;
            $criteria->mergeWith($criteria1);
        } 

        $criteria->addBetweenCondition('cdate', date("Y-m-d", strtotime($day ." day")), date("Y-m-d", strtotime($day ." day")));
        $criteria->order = 'person.employee_name';
        $criteria->with = array('realpattern','person');

        return new CActiveDataProvider(get_class($this), [
            'criteria' => $criteria,
            'pagination'=>array(
                  'pageSize'=>50,
            ),
            //'pagination' => false,
        ]);
    }

    public function searchOvertime($id, $month)
    {

        $criteria = new CDbCriteria;

        $criteria->compare('parent_id', $id);
        $criteria->addBetweenCondition('cdate', date("Y-m-d", strtotime(date("Y-m", strtotime($month . " month")) . "-01")), date("Y-m-d", strtotime("-1 day", strtotime(date("Y-m", strtotime($month + 1 . " month")) . "-01"))));
        //$criteria->compare('realpattern_id',$this->realpattern_id);
        $criteria->order = 'cdate';
        $criteria->with = 'realpattern';

        $criteria1 = new CDbCriteria;
        $criteria1->condition = 'ADDTIME(DATE_FORMAT(CONCAT(DATE(`t`.`out`)," ",TIME(`t`.`out`)),"%Y-%m-%d %H:%i:%s"),"02:00:00") > `t`.`out`';
        $criteria->mergeWith($criteria1);

        return new CActiveDataProvider(get_class($this), [
            'criteria' => $criteria,
            'pagination' => [
                'pageSize' => 31,
            ],
        ]);
    }

    public function onWaiting()
    {

        $criteria = new CDbCriteria;

        //if (Yii::app()->user->name != "admin") {
        $criteria2 = new CDbCriteria;
        $criteria2->condition = '(select c.company_id from g_person_career c WHERE t.parent_id=c.parent_id AND c.status_id IN (' . implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) . ') ORDER BY c.start_date DESC LIMIT 1) IN (' . implode(",", sUser::model()->myGroupArray) . ')';
        $criteria->mergeWith($criteria2);
        //}

        $criteria->with = ['person'];
        $criteria->together = true;
        $criteria->compare('approved_id', 1);
        //$criteria->compare('start_date>',Yii::app()->dateFormatter->format("yyyy-MM-dd",time()));
        $criteria->order = 't.cdate';

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            //'pagination'=>false,
            'pagination' => [
                'pageSize' => 50,
            ]
        ]);
    }

    public function getLateInStatus()
    {
        if (isset($this->in) && peterFunc::isTimeMore($this->in, $this->realpattern->in)) {
            $_val = "Late In";
        } else
            $_val = "";

        return $_val;
    }

    public function getEarlyOutStatus()
    {
        if (isset($this->out) && peterFunc::isTimeMore2($this->realpattern->out, $this->out, $this->in)) {
            $_val = "Early Out";
        } else
            $_val = "";

        return $_val;
    }

    public function getActualIn()
    {
        if (isset($this->in)) {
            $_val = peterFunc::toTime($this->in);
        } elseif ($this->realpattern_id != 90 && $this->realpattern_id != 89 && !isset($this->syncLeave) && time() > strtotime($this->cdate . " " . $this->in)) {
            $_val = "??:??";
        } else
            $_val = "";

        return $_val;
    }

    public function getActualOut()
    {
        if (isset($this->out)) {
            $_val = peterFunc::toTime($this->out);
        } elseif ($this->realpattern_id != 90 && $this->realpattern_id != 89 && !isset($this->syncLeave) && time() > strtotime($this->cdate . " " . $this->out)) {
            $_val = "??:??";
        } else
            $_val = "";

        return $_val;
    }

    public function getDiffIn()
    {
        if (peterFunc::isTimeMore($this->in, $this->realpattern->in)) {
            $_val = peterFunc::countTimeDiff($this->in, $this->realpattern->in);
        } else
            $_val = "";

        return $_val;
    }

    public function getDiffOut()
    {
        if (peterFunc::isTimeMore2($this->realpattern->out, $this->out, $this->in)) {
            $_val = peterFunc::countTimeDiff($this->realpattern->out, $this->out);
        } else
            $_val = "";

        return $_val;
    }

    public function getOvertimeIn()
    {
        if (peterFunc::isTimeMore($this->in, $this->realpattern->in)) {
            $_val = "";
        } else
            $_val = peterFunc::countTimeDiff($this->realpattern->in, $this->in);

        return $_val;
    }

    public function getOvertimeOut()
    {
        if (peterFunc::isTimeMore2($this->realpattern->out, $this->out, $this->in)) {
            $_val = "";
        } else
            $_val = peterFunc::countTimeDiff($this->out, $this->realpattern->out);

        return $_val;
    }

    public function getSyncPermission()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('parent_id', $this->parent_id);

        $criteria1 = new CDbCriteria;
        //$criteria1->compare('DATE_FORMAT(start_date,"%Y-%m-%d")', date("Y-m-d", strtotime($this->cdate)), false, 'OR');
        //$criteria1->compare('DATE_FORMAT(end_date,"%Y-%m-%d")', date("Y-m-d", strtotime($this->cdate)), false, 'OR');
        $criteria1->condition = 'DATE_FORMAT(start_date,"%Y-%m-%d") <= "' . date("Y-m-d", strtotime($this->cdate)) . '" AND 
        					 DATE_FORMAT(end_date,"%Y-%m-%d") >= "' . date("Y-m-d", strtotime($this->cdate)) . '"';

        $criteria->mergeWith($criteria1);

        $model = gPermission::model()->find($criteria);

        if (isset($model) && $this->realpattern_id <> 90 && $this->realpattern_id <> 89) {
            return $model;
        } else
            return null;
    }

    public function getSyncLeave()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('parent_id', $this->parent_id);
        $criteria->addInCondition('approved_id', [1, 2]);

        $criteria1 = new CDbCriteria;
        $criteria1->condition = 'DATE_FORMAT(start_date,"%Y-%m-%d") <= "' . date("Y-m-d", strtotime($this->cdate)) . '" AND 
        					 DATE_FORMAT(end_date,"%Y-%m-%d") >= "' . date("Y-m-d", strtotime($this->cdate)) . '"';

        $criteria->mergeWith($criteria1);

        $model = gLeave::model()->find($criteria);

        if (isset($model) && $this->realpattern_id <> 90 && $this->realpattern_id <> 89) {
            return $model;
        } else
            return null;
    }

    public function getSyncLearning()
    {
        $criteria = new CDbCriteria;
        $criteria->with=['getparent'];
        $criteria->together=true;
        $criteria->compare('employee_id', $this->parent_id);
        $criteria->compare('getparent.schedule_date', date("Y-m-d", strtotime($this->cdate)));
        $criteria->addInCondition('flow_id', [1, 2]);


        $model = iLearningSchPart::model()->find($criteria);

        if (isset($model) && $this->realpattern_id <> 90 && $this->realpattern_id <> 89) {
            return $model;
        } else
            return null;
    }


    public static function searchCount($id)
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('parent_id', $id);
        $criteria->compare('superior_approved_id', 1);
        $criteria->order = 't.start_date DESC, t.id DESC';

        return self::model()->count($criteria);
    }

    public static function searchCountMonth($id, $month = 0)
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;
        $criteria->addBetweenCondition('cdate', date("Y-m-d", strtotime(date("Y-m", strtotime($month . " month")) . "-01")), date("Y-m-d", strtotime("-1 day", strtotime(date("Y-m", strtotime($month + 1 . " month")) . "-01"))));

        $criteria->compare('parent_id', $id);
        $criteria->compare('superior_approved_id', 1);

        return self::model()->count($criteria);
    }

    /* public function afterSave() {
      if($this->isNewRecord) {
      Notification::create(
      1,
      'm1/gAttendance/view/id/'.$this->parent_id,
      'Attendance. New Attendance created: '.$this->person->employee_name
      );
      }
      return true;
      } */

    public static function getTopCreated()
    {

        $criteria = new CDbCriteria;
        $criteria->limit = 10;
        $criteria->with = ['person'];
        $criteria->group = 'employee_name';
        $criteria->order = "t.created_date DESC";
        if (Yii::app()->user->name != "admin") {
            $criteria1 = new CDbCriteria;
            $criteria1->condition = '(select c.company_id from g_person_career c WHERE t.parent_id=c.parent_id AND c.status_id IN (' . implode(',', Yii::app()->getModule('m1')->PARAM_COMPANY_ARRAY) . ') ORDER BY c.start_date DESC LIMIT 1) IN (' . implode(",", sUser::model()->myGroupArray) . ')';
            $criteria->mergeWith($criteria1);
        }
        $models = self::model()->findAll($criteria);

        $returnarray = [];

        foreach ($models as $model) {
            $_nama = (strlen($model->person->employee_name) > 28) ? substr($model->person->employee_name, 0, 28) . "..." : $model->person->employee_name;
            $returnarray[] = [
                'id' => $model->person->id,
                'description' => $model->person->employeeShortId . " | " . $model->person->mDepartment(),
                'label' => $_nama,
                'photo' => $model->person->photoPath,
                'url' => ['view', 'id' => $model->person->id,
                ]];
        }

        return $returnarray;
    }

    public static function getTopUpdated()
    {

        $criteria = new CDbCriteria;
        $criteria->limit = 10;
        $criteria->with = ['person'];
        $criteria->group = 'employee_name';
        $criteria->order = "t.updated_date DESC";
        if (Yii::app()->user->name != "admin") {
            $criteria1 = new CDbCriteria;
            $criteria1->condition = '(select c.company_id from g_person_career c WHERE t.parent_id=c.parent_id AND c.status_id IN (' . implode(',', Yii::app()->getModule('m1')->PARAM_COMPANY_ARRAY) . ') ORDER BY c.start_date DESC LIMIT 1) IN (' . implode(",", sUser::model()->myGroupArray) . ')';
            $criteria->mergeWith($criteria1);
        }
        $models = self::model()->findAll($criteria);

        $returnarray = [];

        foreach ($models as $model) {
            $_nama = (strlen($model->person->employee_name) > 28) ? substr($model->person->employee_name, 0, 28) . "..." : $model->person->employee_name;
            $returnarray[] = [
                'id' => $model->person->id,
                'description' => $model->person->employeeShortId . " | " . $model->person->mDepartment(),
                'label' => $_nama,
                'photo' => $model->person->photoPath,
                'url' => ['view', 'id' => $model->person->id,
                ]];
        }

        return $returnarray;
    }

    public function lateList()
    {

        $dependency = new CDbCacheDependency('SELECT MAX(id) FROM g_attendance');

        if (!Yii::app()->cache->get('latelist' . Yii::app()->user->id)) {

            $sql = "
            SELECT a.id, a.employee_name, '" . date('Y') . date('m') . "' as period, 0 as cmonth,
                (select count(id) from g_attendance 
                where parent_id = a.id and CONCAT(year(cdate),lpad(month(cdate),2,'0')) = " . date('Y') . date('m') . ") as xcount, 

                (select date_format(sec_to_time(sum(time_to_sec(TIMEDIFF(subtime(g.`out`,'01:00:00'), g.`in`)))),'%H.%i.%s') from g_attendance g 
                    inner join g_param_timeblock t on t.id = g.realpattern_id
                    where g.parent_id = a.id and CONCAT(year(g.cdate), lpad(month(g.cdate),2,'0')) = " . date('Y') . date('m') . " and g.cdate <= '" . date('Y-m-d', strtotime('yesterday')) . "' and g.realpattern_id NOT IN (90,89))
                    as workhour,

                (select sum(number_of_day) from g_leave where parent_id = a.id and CONCAT(year(start_date),lpad(month(start_date),2,'0')) = " . date('Y') . date('m') . " and start_date <= '" . date('Y-m-d', strtotime('yesterday')) . "' and approved_id = 2) 
                as cuti,

                ((select count(id) from g_attendance 
                where parent_id = a.id and CONCAT(year(cdate),lpad(month(cdate),2,'0')) = " . date('Y') . date('m') . " 
                    and cdate <= '" . date('Y-m-d', strtotime('yesterday')) . "' 
                    and realpattern_id NOT IN (90,89)  and `out` is null and `in` is null) 
                    -
                (ifnull((select sum(number_of_day) from g_leave where parent_id = a.id and CONCAT(year(start_date),lpad(month(start_date),2,'0')) = " . date('Y') . date('m') . " and start_date <= '" . date('Y-m-d', strtotime('yesterday')) . "' and approved_id = 2),0)) 
                -
                (ifnull((select sum(datediff(end_date,start_date)+1) from g_permission 
                where parent_id = a.id and permission_type_id = 10 and concat(year(start_date), lpad(month(start_date),2,'0')) = " . date('Y') . date('m') . " 
                    and start_date <= '" . date('Y-m-d', strtotime('yesterday')) . "'),0))
                    ) 
                -
                (ifnull((select sum(datediff(end_date,start_date)+1) from g_permission 
                where parent_id = a.id and permission_type_id IN (1,2,3,4,5,6,7,8,9,15,19) and concat(year(start_date), lpad(month(start_date),2,'0')) = " . date('Y') . date('m') . " 
                    and start_date <= '" . date('Y-m-d', strtotime('yesterday')) . "'),0)) 

                      as alpha,

                (select count(g.id) from g_attendance g 
                    inner join g_param_timeblock t on t.id = g.realpattern_id
                    where g.parent_id = a.id and CONCAT(year(g.cdate), lpad(month(g.cdate),2,'0')) = " . date('Y') . date('m') . " and g.cdate <= '" . date('Y-m-d', strtotime('yesterday')) . "' and g.realpattern_id NOT IN (90,89)
                    and TIMEDIFF(CONCAT(date_format(g.in,'%Y-%m-%d'),' ', date_format(t.in,'%H:%i:59')),g.`in`) < 0) 
                    as lateIn,

                (select date_format(sec_to_time(sum(time_to_sec(TIMEDIFF(g.`in`, CONCAT(date_format(g.in,'%Y-%m-%d'),' ', date_format(t.in,'%H:%i:59')))))),'%H.%i.%s') from g_attendance g 
                    inner join g_param_timeblock t on t.id = g.realpattern_id
                    where g.parent_id = a.id and CONCAT(year(g.cdate), lpad(month(g.cdate),2,'0')) = " . date('Y') . date('m') . " and g.cdate <= '" . date('Y-m-d', strtotime('yesterday')) . "' and g.realpattern_id NOT IN (90,89)
                    and TIMEDIFF(CONCAT(date_format(g.in,'%Y-%m-%d'),' ', date_format(t.in,'%H:%i:59')),g.`in`) < 0) 
                    as lateInCount,

                (select count(g.id) from g_attendance g 
                    inner join g_param_timeblock t on t.id = g.realpattern_id
                    where g.parent_id = a.id and CONCAT(year(g.cdate), lpad(month(g.cdate),2,'0')) = " . date('Y') . date('m') . " and g.cdate <= '" . date('Y-m-d', strtotime('yesterday')) . "' and g.realpattern_id NOT IN (90,89)
                    and TIMEDIFF(g.out, CONCAT(date_format(g.in,'%Y-%m-%d'),' ', date_format(t.out,'%H:%i:00'))) < 0) 
                    as earlyOut,

                (select date_format(sec_to_time(sum(time_to_sec(TIMEDIFF(CONCAT(date_format(g.in,'%Y-%m-%d'),' ', date_format(t.out,'%H:%i:00')), g.out)))),'%H.%i.%s') from g_attendance g 
                    inner join g_param_timeblock t on t.id = g.realpattern_id
                    where g.parent_id = a.id and CONCAT(year(g.cdate), lpad(month(g.cdate),2,'0')) = " . date('Y') . date('m') . " and g.cdate <= '" . date('Y-m-d', strtotime('yesterday')) . "' and g.realpattern_id NOT IN (90,89)
                    and TIMEDIFF(g.out, CONCAT(date_format(g.in,'%Y-%m-%d'),' ', date_format(t.out,'%H:%i:00'))) < 0) 
                    as earlyOutCount,

                (select count(id) from g_attendance where parent_id = a.id and CONCAT(year(cdate),lpad(month(cdate),2,'0')) = " . date('Y') . date('m') . " and cdate <= '" . date('Y-m-d', strtotime('yesterday')) . "' and realpattern_id NOT IN (90,89) and `out` is not null and `in` is null) 
                as tad,
                (select count(id) from g_attendance where parent_id = a.id and CONCAT(year(cdate),lpad(month(cdate),2,'0')) = " . date('Y') . date('m') . " and cdate <= '" . date('Y-m-d', strtotime('yesterday')) . "' and realpattern_id NOT IN (90,89) and `out` is null and `in` is not null) 
                as tap,

                (select sum(datediff(end_date,start_date)+1) from g_permission 
                where parent_id = a.id and permission_type_id = 10 and concat(year(start_date), lpad(month(start_date),2,'0')) = " . date('Y') . date('m') . " 
                    and start_date <= '" . date('Y-m-d', strtotime('yesterday')) . "') 
                as sakit,
                
                (select sum(datediff(end_date,start_date)+1) from g_permission 
                where parent_id = a.id and permission_type_id IN (1,2,3,4,5,6,7,8,9,15,19) and concat(year(start_date), lpad(month(start_date),2,'0')) = " . date('Y') . date('m') . " 
                    and start_date <= '" . date('Y-m-d', strtotime('yesterday')) . "') 
                as special

            FROM g_person a
            WHERE (select 
                    `o`.`id` AS `id`
                from
                    (`g_person_career` `c`
                    left join `a_organization` `o` ON ((`o`.`id` = `c`.`company_id`)))
                where
                    ((`a`.`id` = `c`.`parent_id`)
                        and (`c`.`status_id` in (1 , 2, 3, 4, 5, 6, 15)))
                order by `c`.`start_date` desc
                limit 1) = " . sUser::model()->myGroup . "
            ORDER BY 
                (select count(g.id) from g_attendance g 
                    inner join g_param_timeblock t on t.id = g.realpattern_id
                    where g.parent_id = a.id and CONCAT(year(g.cdate), lpad(month(g.cdate),2,'0')) = " . date('Y') . date('m') . " and g.cdate <= '" . date('Y-m-d', strtotime('yesterday')) . "' and g.realpattern_id NOT IN (90,89)
                    and TIMEDIFF(CONCAT(date_format(g.in,'%Y-%m-%d'),' ', date_format(t.in,'%H:%i:59')),g.`in`) < 0) DESC
            LIMIT 10";

            $rawData = Yii::app()->db->createCommand($sql)->queryAll();
            $dataProvider = new CArrayDataProvider($rawData, [
                'id' => 'stat',
                'pagination' => false,
            ]);

            Yii::app()->cache->set('latelist' . Yii::app()->user->id, $dataProvider, 3600, $dependency);
        } else
            $dataProvider = Yii::app()->cache->get('latelist' . Yii::app()->user->id);

        return $dataProvider;
    }

    public function absenceList()
    {

        $dependency = new CDbCacheDependency('SELECT MAX(id) FROM g_attendance');

        if (!Yii::app()->cache->get('absencelist' . Yii::app()->user->id)) {

            $sql = "
            SELECT a.id, a.employee_name, '" . date('Y') . date('m') . "' as period, 0 as cmonth,
                (select count(id) from g_attendance 
                where parent_id = a.id and CONCAT(year(cdate),lpad(month(cdate),2,'0')) = " . date('Y') . date('m') . ") as xcount, 

                (select date_format(sec_to_time(sum(time_to_sec(TIMEDIFF(subtime(g.`out`,'01:00:00'), g.`in`)))),'%H.%i.%s') from g_attendance g 
                    inner join g_param_timeblock t on t.id = g.realpattern_id
                    where g.parent_id = a.id and CONCAT(year(g.cdate), lpad(month(g.cdate),2,'0')) = " . date('Y') . date('m') . " and g.cdate <= '" . date('Y-m-d', strtotime('yesterday')) . "' and g.realpattern_id NOT IN (90,89))
                    as workhour,

                (select sum(number_of_day) from g_leave where parent_id = a.id and CONCAT(year(start_date),lpad(month(start_date),2,'0')) = " . date('Y') . date('m') . " and start_date <= '" . date('Y-m-d', strtotime('yesterday')) . "' and approved_id = 2) 
                as cuti,

                ((select count(id) from g_attendance 
                where parent_id = a.id and CONCAT(year(cdate),lpad(month(cdate),2,'0')) = " . date('Y') . date('m') . " 
                    and cdate <= '" . date('Y-m-d', strtotime('yesterday')) . "' 
                    and realpattern_id NOT IN (90,89)  and `out` is null and `in` is null) 
                    -
                (ifnull((select sum(number_of_day) from g_leave where parent_id = a.id and CONCAT(year(start_date),lpad(month(start_date),2,'0')) = " . date('Y') . date('m') . " and start_date <= '" . date('Y-m-d', strtotime('yesterday')) . "' and approved_id = 2),0)) 
                -
                (ifnull((select sum(datediff(end_date,start_date)+1) from g_permission 
                where parent_id = a.id and permission_type_id = 10 and concat(year(start_date), lpad(month(start_date),2,'0')) = " . date('Y') . date('m') . " 
                    and start_date <= '" . date('Y-m-d', strtotime('yesterday')) . "'),0))
                    ) 
                -
                (ifnull((select sum(datediff(end_date,start_date)+1) from g_permission 
                where parent_id = a.id and permission_type_id IN (1,2,3,4,5,6,7,8,9,15,19) and concat(year(start_date), lpad(month(start_date),2,'0')) = " . date('Y') . date('m') . " 
                    and start_date <= '" . date('Y-m-d', strtotime('yesterday')) . "'),0)) 

                      as alpha,

                (select count(g.id) from g_attendance g 
                    inner join g_param_timeblock t on t.id = g.realpattern_id
                    where g.parent_id = a.id and CONCAT(year(g.cdate), lpad(month(g.cdate),2,'0')) = " . date('Y') . date('m') . " and g.cdate <= '" . date('Y-m-d', strtotime('yesterday')) . "' and g.realpattern_id NOT IN (90,89)
                    and TIMEDIFF(CONCAT(date_format(g.in,'%Y-%m-%d'),' ', date_format(t.in,'%H:%i:59')),g.`in`) < 0) 
                    as lateIn,

                (select date_format(sec_to_time(sum(time_to_sec(TIMEDIFF(g.`in`, CONCAT(date_format(g.in,'%Y-%m-%d'),' ', date_format(t.in,'%H:%i:59')))))),'%H.%i.%s') from g_attendance g 
                    inner join g_param_timeblock t on t.id = g.realpattern_id
                    where g.parent_id = a.id and CONCAT(year(g.cdate), lpad(month(g.cdate),2,'0')) = " . date('Y') . date('m') . " and g.cdate <= '" . date('Y-m-d', strtotime('yesterday')) . "' and g.realpattern_id NOT IN (90,89)
                    and TIMEDIFF(CONCAT(date_format(g.in,'%Y-%m-%d'),' ', date_format(t.in,'%H:%i:59')),g.`in`) < 0) 
                    as lateInCount,

                (select count(g.id) from g_attendance g 
                    inner join g_param_timeblock t on t.id = g.realpattern_id
                    where g.parent_id = a.id and CONCAT(year(g.cdate), lpad(month(g.cdate),2,'0')) = " . date('Y') . date('m') . " and g.cdate <= '" . date('Y-m-d', strtotime('yesterday')) . "' and g.realpattern_id NOT IN (90,89)
                    and TIMEDIFF(g.out, CONCAT(date_format(g.in,'%Y-%m-%d'),' ', date_format(t.out,'%H:%i:00'))) < 0) 
                    as earlyOut,

                (select date_format(sec_to_time(sum(time_to_sec(TIMEDIFF(CONCAT(date_format(g.in,'%Y-%m-%d'),' ', date_format(t.out,'%H:%i:00')), g.out)))),'%H.%i.%s') from g_attendance g 
                    inner join g_param_timeblock t on t.id = g.realpattern_id
                    where g.parent_id = a.id and CONCAT(year(g.cdate), lpad(month(g.cdate),2,'0')) = " . date('Y') . date('m') . " and g.cdate <= '" . date('Y-m-d', strtotime('yesterday')) . "' and g.realpattern_id NOT IN (90,89)
                    and TIMEDIFF(g.out, CONCAT(date_format(g.in,'%Y-%m-%d'),' ', date_format(t.out,'%H:%i:00'))) < 0) 
                    as earlyOutCount,

                (select count(id) from g_attendance where parent_id = a.id and CONCAT(year(cdate),lpad(month(cdate),2,'0')) = " . date('Y') . date('m') . " and cdate <= '" . date('Y-m-d', strtotime('yesterday')) . "' and realpattern_id NOT IN (90,89) and `out` is not null and `in` is null) 
                as tad,
                (select count(id) from g_attendance where parent_id = a.id and CONCAT(year(cdate),lpad(month(cdate),2,'0')) = " . date('Y') . date('m') . " and cdate <= '" . date('Y-m-d', strtotime('yesterday')) . "' and realpattern_id NOT IN (90,89) and `out` is null and `in` is not null) 
                as tap,

                (select sum(datediff(end_date,start_date)+1) from g_permission 
                where parent_id = a.id and permission_type_id = 10 and concat(year(start_date), lpad(month(start_date),2,'0')) = " . date('Y') . date('m') . " 
                    and start_date <= '" . date('Y-m-d', strtotime('yesterday')) . "') 
                as sakit,
                
                (select sum(datediff(end_date,start_date)+1) from g_permission 
                where parent_id = a.id and permission_type_id IN (1,2,3,4,5,6,7,8,9,15,19) and concat(year(start_date), lpad(month(start_date),2,'0')) = " . date('Y') . date('m') . " 
                    and start_date <= '" . date('Y-m-d', strtotime('yesterday')) . "') 
                as special

            FROM g_person a

            WHERE (select 
                    `o`.`id` AS `id`
                from
                    (`g_person_career` `c`
                    left join `a_organization` `o` ON ((`o`.`id` = `c`.`company_id`)))
                where
                    ((`a`.`id` = `c`.`parent_id`)
                        and (`c`.`status_id` in (1 , 2, 3, 4, 5, 6, 15)))
                order by `c`.`start_date` desc
                limit 1) = " . sUser::model()->myGroup . "
            AND

                ((select count(id) from g_attendance 
                where parent_id = a.id and CONCAT(year(cdate),lpad(month(cdate),2,'0')) = " . date('Y') . date('m') . " 
                    and cdate <= '" . date('Y-m-d', strtotime('yesterday')) . "' 
                    and realpattern_id NOT IN (90,89)  and `out` is null and `in` is null) 
                    -
                (ifnull((select sum(number_of_day) from g_leave where parent_id = a.id and CONCAT(year(start_date),lpad(month(start_date),2,'0')) = " . date('Y') . date('m') . " and start_date <= '" . date('Y-m-d', strtotime('yesterday')) . "' and approved_id = 2),0)) 
                -
                (ifnull((select sum(datediff(end_date,start_date)+1) from g_permission 
                where parent_id = a.id and permission_type_id = 10 and concat(year(start_date), lpad(month(start_date),2,'0')) = " . date('Y') . date('m') . " 
                    and start_date <= '" . date('Y-m-d', strtotime('yesterday')) . "'),0))
                    ) 
                -
                (ifnull((select sum(datediff(end_date,start_date)+1) from g_permission 
                where parent_id = a.id and permission_type_id IN (1,2,3,4,5,6,7,8,9,15,19) and concat(year(start_date), lpad(month(start_date),2,'0')) = " . date('Y') . date('m') . " 
                    and start_date <= '" . date('Y-m-d', strtotime('yesterday')) . "'),0)) >= 3


            ORDER BY 
                (select count(g.id) from g_attendance g 
                    inner join g_param_timeblock t on t.id = g.realpattern_id
                    where g.parent_id = a.id and CONCAT(year(g.cdate), lpad(month(g.cdate),2,'0')) = " . date('Y') . date('m') . " and g.cdate <= '" . date('Y-m-d', strtotime('yesterday')) . "' and g.realpattern_id NOT IN (90,89)
                    and TIMEDIFF(CONCAT(date_format(g.in,'%Y-%m-%d'),' ', date_format(t.in,'%H:%i:59')),g.`in`) < 0) DESC
            LIMIT 10";

            $rawData = Yii::app()->db->createCommand($sql)->queryAll();
            $dataProvider = new CArrayDataProvider($rawData, [
                'id' => 'stat',
                'pagination' => false,
            ]);

            Yii::app()->cache->set('absencelist' . Yii::app()->user->id, $dataProvider, 3600, $dependency);
        } else
            $dataProvider = Yii::app()->cache->get('absencelist' . Yii::app()->user->id);

        return $dataProvider;
    }

}
