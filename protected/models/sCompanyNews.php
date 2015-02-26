<?php

/**
 * This is the model class for table "s_company_news".
 *
 * The followings are the available columns in table 's_company_news':
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $tags
 * @property integer $created_date
 * @property integer $updated_date
 * @property integer $created_by
 */
class sCompanyNews extends BaseModel
{

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return SCompanyNews the static model class
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
        return 's_company_news';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['title, content, publish_date', 'required'],
            ['expire_date', 'required', 'on' => 'businessunit'],
            ['category_id, priority_id, approved_id, created_date, updated_date, created_by, updated_by', 'numerical', 'integerOnly' => true],
            ['title', 'length', 'max' => 128],
            //array('content', 'ext.FTextValidator'),
            ['tags, publish_date, expire_date', 'safe'],
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            ['id, title, content, tags, created_date, updated_date, created_by, updated_by', 'safe', 'on' => 'search'],
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
            'category' => [self::BELONGS_TO, 'sParameterNews', 'category_id'],
            'priority' => [self::HAS_ONE, 'sParameter', ['code' => 'priority_id'], 'condition' => 'type = "cPriority"'],
            'approved' => [self::HAS_ONE, 'sParameter', ['code' => 'approved_id'], 'condition' => 'type = "cStatusP"'],
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'category_id' => 'Category',
            'content' => 'Content',
            'tags' => 'Tags',
            'publish_date' => 'Publish Date',
            'expire_date' => 'Expire Date',
            'priority_id' => 'Priority',
            'approved_id' => 'Approved',
            'photo_path' => 'Photo Article',
            'created_date' => 'Create Time',
            'updated_date' => 'Update Time',
            'updated_by' => 'Update By',
            'created_by' => 'Author',
        ];
    }

    public static function getTopCreated()
    {

        $criteria = new CDbCriteria;
        $criteria->limit = 10;
        $criteria->scopes = ['app_publish', 'noQuote_Announcement'];
        $criteria->order = 'created_date DESC';


        $models = self::model()->findAll($criteria);

        $returnarray = [];

        foreach ($models as $model) {
            $returnarray[] = ['id' => $model->id, 'label' => peterFunc::shorten_string($model->title, 7), 'icon' => 'list-alt', 'url' => ['/sCompanyNews/view', 'id' => $model->id]];
        }

        return $returnarray;
    }

    public static function getTopUpdated()
    {

        $criteria = new CDbCriteria;
        $criteria->scopes = ['app_publish', 'noQuote_Announcement'];
        $criteria->limit = 10;
        $criteria->order = 'updated_date DESC';


        $models = self::model()->findAll($criteria);

        $returnarray = [];

        foreach ($models as $model) {
            $returnarray[] = ['id' => $model->id, 'label' => peterFunc::shorten_string($model->title, 7), 'icon' => 'list-alt', 'url' => ['/sCompanyNews/view', 'id' => $model->id]];
        }

        return $returnarray;
    }

    public function search()
    {
        $criteria = new CDbCriteria;
        //$criteria->scopes=array('app_publish','noQuote_Announcement');

        return new CActiveDataProvider(get_class($this), [
            'criteria' => $criteria,
            'pagination' => [
                'pageSize' => 20
            ],
            'sort' => [
                'defaultOrder' => 'created_date DESC',
            ]
        ]);
    }

    //Widget2

    public function getAnnouncement()
    {
        $criteria = new CDbCriteria;
        $criteria->order = "created_date DESC";
        $criteria->limit = 1;
        $criteria->compare('category_id', 6);
        $criteria->scopes = ['app_publish', 'notExpire'];

        $model = self::model()->find($criteria);

        if ($model == null) {
            return false;
        } else
            return $model;
    }

    public function getAnnouncementUnit()
    {
        $criteria = new CDbCriteria;
        $criteria->order = "t.created_date DESC";
        $criteria->limit = 1;
        $criteria->compare('category_id', 8);
        $criteria->with = ['created'];
        $criteria->together = true;
        $criteria->compare('created.default_group', sUser::getMyGroup());
        $criteria->scopes = ['app_publish', 'notExpire'];

        $model = self::model()->find($criteria);

        if ($model == null) {
            return false;
        } else
            return $model;
    }

    public static function businessUnitNews()
    {

        $criteria = new CDbCriteria;
        $criteria->order = "t.created_date DESC";
        $criteria->limit = 15;
        $criteria->compare('category_id', 8);
        $criteria->with = ['created'];
        $criteria->together = true;
        $criteria->compare('created.default_group', sUser::getMyGroup());
        $criteria->scopes = ['app_publish'];


        $models = self::model()->findAll($criteria);

        if ($models == null) {
            return false;
        } else
            return $models;
    }

    public function getQuote()
    {
        $criteria = new CDbCriteria;
        $criteria->order = "rand ()";
        $criteria->limit = 1;
        $criteria->compare('category_id', 5);
        $criteria->scopes = ['app_publish'];

        $model = self::model()->find($criteria);

        if ($model == null) {
            return false;
        } else
            return $model;
    }

    public static function getCategory($cat_id)
    {
        $criteria = new CDbCriteria;
        $criteria->compare('category_id', $cat_id);
        $criteria->scopes = ['app_publish', 'recently'];
        $criteria->limit = 2;

        $models = self::model()->findAll($criteria);

        if ($models == null) {
            return false;
        } else
            return $models;
    }

    public function getFullArticle()
    {
        $criteria = new CDbCriteria;
        $criteria->limit = 1;
        $criteria->compare('priority_id', 3);
        $criteria->scopes = ['app_publish', 'recently'];
        $model = self::model()->find($criteria);

        if ($model == null) {
            return false;
        } else
            return $model;
    }

    public function getLatestNews()
    {
        $criteria = new CDbCriteria;
        $criteria->scopes = ['app_publish', 'noQuote_Announcement', 'recently'];
        $criteria->limit = 3;

        $models = self::model()->findAll($criteria);

        if ($models == null) {
            return false;
        } else
            return $models;
    }

    public function scopes()
    {
        return [
            'app_publish' => [
                'condition' => 'approved_id = 2 AND unix_timestamp(publish_date) < unix_timestamp()',
            ],
            'noQuote_Announcement' => [ //and no Corporate Calendar NOT IN (5,6,7)
                'condition' => 'category_id  IN (1,2,3,4)',
            ],
            'noQuote_Announcement_WithCalendar' => [
                'condition' => 'category_id  IN (1,2,3,4,7)',
            ],
            'notBusinessUnit' => [
                'condition' => 'category_id  <> 8',
            ],
            'businessUnit' => [
                'condition' => 'category_id  = 8',
            ],
            'notExpire' => [
                'condition' => 'unix_timestamp(expire_date) > unix_timestamp()',
            ],
            'recently' => [
                'order' => 'created_date DESC',
            ],
            'promotion' => [
                'condition' => 'category_id  IN (1,4,5)',
            ],
        ];
    }

    public function searchNews()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('title', $this->title, true);
        $criteria->scopes = ['notBusinessUnit'];

        $criteria->order = 'created_date DESC';

        return new CActiveDataProvider(get_class($this), [
            'criteria' => $criteria,
            'pagination' => [
                'pageSize' => 20
            ]
        ]);
    }

    public function searchNewsPromotion()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('title', $this->title, true);
        $criteria->scopes = ['promotion'];

        $criteria->order = 'created_date DESC';

        return new CActiveDataProvider(get_class($this), [
            'criteria' => $criteria,
            'pagination' => [
                'pageSize' => 20
            ]
        ]);
    }

    public function searchNewsUnit()
    {
        $criteria = new CDbCriteria;
        $criteria->with = ['created'];
        $criteria->together = true;
        $criteria->scopes = ['businessUnit'];
        $criteria->compare('title', $this->title, true);
        $criteria->compare('created.default_group', sUser::getMyGroup());

        $criteria->order = 't.created_date DESC';

        return new CActiveDataProvider(get_class($this), [
            'criteria' => $criteria,
            'pagination' => [
                'pageSize' => 20
            ]
        ]);
    }

    //public function defaultScope() 
    //{
    // return array(
    //'condition'=>'approved_id = 2',
    //);
    //}	
}
