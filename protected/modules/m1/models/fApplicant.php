<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class fApplicant extends CFormModel
{

    public $keyword;
    public $sex_id;
    public $age_start;
    public $age_end;
    public $education_id;
    public $experience_start;
    public $experience_end;

    public function rules()
    {
        return [
            // username and password are required
            ['keyword', 'length', 'max' => 25],
            ['sex_id, age_start, age_end, education_id, experience_start, experience_end', 'numerical', 'integerOnly' => true],
        ];
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return [
            'keyword' => 'Keyword',
            'sex_id' => 'Gender',
            'age_start' => 'Age',
            'age_end' => 'To',
            'education_id' => 'Education Level',
            'experience_start' => 'Experience',
            'experience_end' => 'To',
        ];
    }

}
