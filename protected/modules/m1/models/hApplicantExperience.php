<?php

/**
 * This is the model class for table "g_person_experience".
 *
 * The followings are the available columns in table 'g_person_experience':
 * @property integer $id
 * @property integer $parent_id
 * @property string $company_name
 * @property string $industries
 * @property string $start_date
 * @property string $end_date
 * @property string $job_title
 */
class hApplicantExperience extends BaseModel
{

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return gPersonExperience the static model class
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
        return 'h_applicant_experience';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['company_name,job_title,job_description', 'required'],
            ['parent_id,year_length,month_length', 'numerical', 'integerOnly' => true],
            ['company_name', 'length', 'max' => 300],
            ['industries', 'length', 'max' => 75],
            ['job_description', 'length', 'max' => 1000],
            ['start_date, end_date', 'length', 'max' => 50],
            ['job_title', 'length', 'max' => 150],
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            ['id, parent_id, company_name, industries, start_date, end_date, job_title', 'safe', 'on' => 'search'],
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
            'company_name' => 'Company Name',
            'industries' => 'Industries',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'year_length' => 'Year Length',
            'month_length' => 'Month Length',
            'job_title' => 'Job Title',
            'job_description' => 'Job Description',
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

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            'pagination' => false,
        ]);
    }

    public static function getJobTitleCloud()
    {

        $dependency = new CDbCacheDependency('SELECT MAX(id) FROM h_applicant');

        if (!Yii::app()->cache->get('jobtitlecloud' . Yii::app()->user->id)) {
            $connection = Yii::app()->db;
            $sql = '
                SELECT job_title FROM h_applicant_experience ORDER BY id DESC 
            ';

            $rows = $connection->createCommand($sql)->queryAll();
            $count_tag = [];

            $exclude = [
                '', 'genset', 'manager', 'staff', 'marketing', 'officer', 'supervisor', 'and',
                'senior', 'of', 'junior', '-', 'dan', 'staf', 'data', 'to', 'as', 'part', 'out', 'kepala',
                'head', 'department', 'dept', 'branch', 'spv', 'at', 'in', 'the', 'vice', 'kerja', 'gm', 'unit',
                'back', 'medan', 'umum', 'jr', 'team', 'for', 'owner'
            ];

            foreach ($rows as $row) {
                $breaks = explode(" ", $row['job_title']);

                foreach ($breaks as $key => $break) {
                    $break = self::model()->sanitize2($break);

                    if (array_key_exists($break, $count_tag) && !in_array(strtolower($break), $exclude)) {
                        $count_tag[$break] += 1;
                    } else {
                        $count_tag[$break] = 1;
                    }
                }
            }

            arsort($count_tag); //sort by size
            $returnarray = array_slice($count_tag, 0, 300); //slice into 300
            ksort($returnarray); //sort by key

            Yii::app()->cache->set('jobtitlecloud' . Yii::app()->user->id, $returnarray, 3600, $dependency);
        } else
            $returnarray = Yii::app()->cache->get('jobtitlecloud' . Yii::app()->user->id);


        return $returnarray;
    }

    public static function sanitize2($string = '', $is_filename = FALSE)
    {
        // Replace all weird characters with dashes
        $string = preg_replace('/[^\w\-' . ($is_filename ? '~_\.' : '') . ']+/u', '', $string);
        $string = preg_replace('/\d+/', '', $string);

        // Only allow one dash separator at a time (and make string lowercase)
        //return mb_strtolower(preg_replace('/--+/u', '-', $string), 'UTF-8');
        return $string;
    }

}
