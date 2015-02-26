<?php

/**
 * This is the model class for table "i_learning".
 *
 * The followings are the available columns in table 'i_learning':
 * @property integer $id
 * @property string $learning_title
 * @property string $objective
 * @property string $outline
 * @property string $participant
 * @property string $duration
 * @property integer $type_id
 * @property integer $created_date
 * @property string $created_by
 * @property integer $updated_date
 * @property string $updated_by
 */
class iLearning extends BaseModel
{

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return iLearning the static model class
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
        return 'i_learning';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['learning_title, objective, outline, participant, duration, type_id', 'required'],
            ['type_id, prerequisites_id, created_date, updated_date', 'numerical', 'integerOnly' => true],
            ['learning_title, participant', 'length', 'max' => 100],
            ['objective, outline', 'length', 'max' => 1000],
            ['duration', 'length', 'max' => 3],
            ['created_by, updated_by', 'length', 'max' => 15],
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            ['id, learning_title, objective, outline, participant, duration, type_id, created_date, created_by, updated_date, updated_by', 'safe', 'on' => 'search'],
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
            'type' => [self::BELONGS_TO, 'sParameter', ['type_id' => 'code'], 'condition' => 'type = \'cTraining\''],
            'schedule' => [self::HAS_MANY, 'iLearningSch', 'parent_id', 'condition' => 'schedule_date > now()', 'order' => 'schedule_date', 'limit' => '20'],
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'learning_title' => 'Learning Title',
            'objective' => 'Objective',
            'outline' => 'Outline',
            'participant' => 'Target Participant',
            'duration' => 'Duration (Hours)',
            'type_id' => 'Type',
            'prerequisites_id' => 'Pre Requisites',
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
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('learning_title', $this->learning_title, true);
        $criteria->compare('objective', $this->objective, true);
        $criteria->compare('outline', $this->outline, true);
        $criteria->compare('participant', $this->participant, true);
        $criteria->compare('duration', $this->duration, true);
        $criteria->compare('type_id', $this->type_id);
        $criteria->compare('created_date', $this->created_date);
        $criteria->compare('created_by', $this->created_by, true);
        $criteria->compare('updated_date', $this->updated_date);
        $criteria->compare('updated_by', $this->updated_by, true);

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
        ]);
    }

    public static function getTopCreated()
    {

        $criteria = new CDbCriteria;
        $criteria->limit = 10;
        $criteria->order = "created_date DESC";
        $models = self::model()->findAll($criteria);

        $returnarray = [];

        foreach ($models as $model) {
            $_nama = (strlen($model->learning_title) > 28) ? substr($model->learning_title, 0, 28) . "..." : $model->learning_title;
            $returnarray[] = ['id' => $model->id, 'label' => $_nama, 'icon' => 'list-alt', 'url' => ['view', 'id' => $model->id]];
        }

        return $returnarray;
    }

    public static function getTopUpdated()
    {

        $criteria = new CDbCriteria;
        $criteria->limit = 10;
        $criteria->order = "t.updated_date DESC";
        $models = self::model()->findAll($criteria);

        $returnarray = [];

        foreach ($models as $model) {
            $_nama = (strlen($model->learning_title) > 28) ? substr($model->learning_title, 0, 28) . "..." : $model->learning_title;
            $returnarray[] = ['id' => $model->id, 'label' => $_nama, 'icon' => 'list-alt', 'url' => ['view', 'id' => $model->id,]];
        }

        return $returnarray;
    }

    public static function sylabusList()
    {
        $_items = [];

        $criteria = new CDbCriteria;
        $criteria->order = 'learning_title';
        $models = self::model()->findAll($criteria);

        $_items['0'] = ".:NONE:.";
        foreach ($models as $model)
            $_items[$model->id] = $model->learning_title;

        return $_items;
    }

    public function afterSave()
    {
        if ($this->isNewRecord) {
            $model = new sNotification;
            $model->group_id = 1;
            $model->link = 'm1/iLearning/view/id/' . $this->id;
            $model->content = 'Learning. New Sylabus created: <read>' . $this->learning_title . '</read>';
            $model->save(false);
        }
        return true;
    }

}
