<?php

/**
 * This is the model class for table "s_addressbook".
 *
 * The followings are the available columns in table 's_addressbook':
 * @property integer $id
 * @property string $category_name
 * @property string $complete_name
 * @property string $company_name
 * @property string $title
 * @property string $address
 * @property string $handphone
 * @property string $email
 */
class sAddressbook extends BaseModel
{

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 's_addressbook';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['complete_name, title, handphone, member_of', 'required'],
            ['category_name', 'length', 'max' => 15],
            ['complete_name', 'length', 'max' => 50],
            ['company_name, title, handphone', 'length', 'max' => 100],
            ['handphone', 'ext.IndoHpValidator'],
            ['address', 'length', 'max' => 255],
            ['email', 'length', 'max' => 150],
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            ['id, category_name, complete_name, company_name, title, address, handphone, email', 'safe', 'on' => 'search'],
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
            'category_name' => 'Category Name',
            'complete_name' => 'Complete Name',
            'company_name' => 'Company Name',
            'title' => 'Title',
            'address' => 'Address',
            'handphone' => 'Handphone',
            'email' => 'Email',
            'member_of' => 'Member Of',
        ];
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('category_name', $this->category_name, true);
        $criteria->compare('complete_name', $this->complete_name, true);
        $criteria->compare('company_name', $this->company_name, true);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('address', $this->address, true);
        $criteria->compare('handphone', $this->handphone, true);
        $criteria->compare('email', $this->email, true);

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            'pagination' => [
                'pageSize' => 30,
            ]
        ]);
    }

    public static function getList()
    {
        $_items = [];
        $models = self::model()->findAll([
        ]);

        foreach ($models as $model) {
            $_items[] = $model->complete_name;
        }

        return CJSON::encode($_items);
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return sAddressbook the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

}
