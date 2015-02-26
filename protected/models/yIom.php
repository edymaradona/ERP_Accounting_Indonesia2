<?php

/**
 * This is the model class for table "y_iom".
 *
 * The followings are the available columns in table 'y_iom':
 * @property integer $id
 * @property string $iom_number
 * @property string $iom_to
 * @property string $iom_cc
 * @property string $iom_from
 * @property string $subject
 * @property string $attachment
 * @property string $iom_date
 * @property string $content
 * @property string $sender_by
 * @property string $sender_title
 * @property string $approved_by
 * @property string $approved_title
 * @property string $other_by
 * @property string $other_title
 * @property integer $created_date
 * @property integer $created_by
 * @property integer $updated_date
 * @property integer $updated_by
 */
class yIom extends BaseModel
{

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return yIom the static model class
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
        return 'y_iom';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['iom_to, iom_from, subject, iom_date, content,iom_number', 'required'],
            ['created_date, created_by, updated_date, updated_by', 'numerical', 'integerOnly' => true],
            ['iom_number', 'length', 'max' => 50],
            ['iom_to, iom_cc, iom_from, attachment, sender_by, sender_title, approved_by, approved_title, other_by, other_title', 'length', 'max' => 100],
            ['subject', 'length', 'max' => 300],
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            ['id, iom_number, iom_to, iom_cc, iom_from, subject, attachment, iom_date, content, sender_by, sender_title, approved_by, approved_title, other_by, other_title, created_date, created_by, updated_date, updated_by', 'safe', 'on' => 'search'],
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
            'created' => [self::BELONGS_TO, 'sUser', 'created_by'],
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'iom_number' => 'Number',
            'iom_to' => 'To',
            'iom_cc' => 'Cc',
            'iom_from' => 'From',
            'subject' => 'Subject',
            'attachment' => 'Attachment',
            'iom_date' => 'Date',
            'content' => 'Content',
            'sender_by' => 'Sender By',
            'sender_title' => 'Sender Title',
            'approved_by' => 'Approved By',
            'approved_title' => 'Approved Title',
            'other_by' => 'Other By',
            'other_title' => 'Other Title',
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
        $criteria->compare('iom_number', $this->iom_number, true);
        $criteria->compare('iom_to', $this->iom_to, true);
        $criteria->compare('iom_cc', $this->iom_cc, true);
        $criteria->compare('iom_from', $this->iom_from, true);
        $criteria->compare('subject', $this->subject, true);
        $criteria->compare('attachment', $this->attachment, true);
        $criteria->compare('iom_date', $this->iom_date, true);
        $criteria->compare('content', $this->content, true);
        $criteria->compare('sender_by', $this->sender_by, true);
        $criteria->compare('sender_title', $this->sender_title, true);
        $criteria->compare('approved_by', $this->approved_by, true);
        $criteria->compare('approved_title', $this->approved_title, true);
        $criteria->compare('other_by', $this->other_by, true);
        $criteria->compare('other_title', $this->other_title, true);
        $criteria->compare('created_date', $this->created_date);
        $criteria->compare('created_by', $this->created_by);
        $criteria->compare('updated_date', $this->updated_date);
        $criteria->compare('updated_by', $this->updated_by);

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => [
                'defaultOrder' => 'updated_date DESC',
            ]
        ]);
    }

    public static function getTopCreated()
    {

        $criteria = new CDbCriteria;
        $criteria->limit = 10;
        $criteria->order = 'created_date DESC';


        $models = self::model()->findAll($criteria);

        $returnarray = [];

        foreach ($models as $model) {
            $returnarray[] = ['id' => $model->id, 'label' => peterFunc::shorten_string($model->subject, 7), 'icon' => 'list-alt', 'url' => ['/yIom/view', 'id' => $model->id]];
        }

        return $returnarray;
    }

    public static function getTopUpdated()
    {

        $criteria = new CDbCriteria;
        $criteria->limit = 10;
        $criteria->order = 'updated_date DESC';


        $models = self::model()->findAll($criteria);

        $returnarray = [];

        foreach ($models as $model) {
            $returnarray[] = ['id' => $model->id, 'label' => peterFunc::shorten_string($model->subject, 7), 'icon' => 'list-alt', 'url' => ['/yIom/view', 'id' => $model->id]];
        }

        return $returnarray;
    }

    public function afterSave()
    {
        if ($this->isNewRecord) {
            self::model()->updateByPk((int)$this->id, ['iom_number' => $this->lastID]);
        }
        return true;
    }

    public function getLastID()
    {
        $connection = Yii::app()->db;
        //$sqlRaw="select iom_number from y_iom ORDER BY iom_number DESC limit 1";
        $sqlRaw = 'select if (mid(iom_number,3,1) = "/" ,left(iom_number,2) , left(iom_number,3))
		from y_iom  where year(iom_date) = ' . date("Y") . ' order by CONVERT(if (mid(iom_number,3,1) = "/" ,left(iom_number,2) , left(iom_number,3)),UNSIGNED) DESC LIMIT 1';
        $last = Yii::app()->db->createCommand($sqlRaw)->queryScalar();
        $number = (int)$last + 1;
        $format = str_pad($number, 3, '0', STR_PAD_LEFT) . "/IOM/HR/" . peterFunc::bulanromawi() . "/" . date("y");

        return $format;
    }

    public function getCurrentID()
    {
        $connection = Yii::app()->db;
        //$sqlRaw="select iom_number from y_iom ORDER BY iom_number DESC limit 1";
        $sqlRaw = 'select if (mid(iom_number,3,1) = "/" ,left(iom_number,2) , left(iom_number,3))
        from y_iom  where year(iom_date) = ' . date("Y") . ' order by CONVERT(if (mid(iom_number,3,1) = "/" ,left(iom_number,2) , left(iom_number,3)),UNSIGNED) DESC LIMIT 1';
        $last = Yii::app()->db->createCommand($sqlRaw)->queryScalar();
        $number = (int)$last;
        $format = str_pad($number, 3, '0', STR_PAD_LEFT) . "/IOM/HR/" . peterFunc::bulanromawi() . "/" . date("y");

        return $format;
    }

}
