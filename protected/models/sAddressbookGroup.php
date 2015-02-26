<?php

/**
 * This is the model class for table "s_addressbook_group".
 *
 * The followings are the available columns in table 's_addressbook_group':
 * @property integer $id
 * @property integer $parent_id
 * @property string $group_name
 * @property string $description
 */
class sAddressbookGroup extends BaseModel
{

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 's_addressbook_group';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['group_name', 'required'],
            ['group_name', 'unique'],
            ['parent_id', 'numerical', 'integerOnly' => true],
            ['group_name', 'length', 'max' => 25],
            ['description', 'length', 'max' => 255],
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            ['id, parent_id, group_name, description', 'safe', 'on' => 'search'],
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
            'member' => [self::HAS_MANY, 'sAddressbook', ['group_name', 'member_of']],
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
            'group_name' => 'Group Name',
            'description' => 'Description',
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
        $criteria->compare('parent_id', $this->parent_id);
        $criteria->compare('group_name', $this->group_name, true);
        $criteria->compare('description', $this->description, true);

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
        ]);
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return sAddressbookGroup the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function getGroupList()
    {
        $_items = [];
        $models = self::model()->findAll([
            'order' => 'group_name',
        ]);

        foreach ($models as $model) {
            $_items[] = $model->group_name;
        }

        return CJSON::encode($_items);
    }

    public function getListMembers()
    {

        $criteria = new CDbCriteria;
        $criteria->condition = 'member_of LIKE "%' . $this->group_name . '%"';

        return new CActiveDataProvider('sAddressbook', [
            'criteria' => $criteria,
            'pagination' => [
                'pageSize' => 100
            ]
        ]);
    }

    public function listRecepient($id)
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $model = sSmsout::model()->findByPk((int)$id);
        $list = explode(",", $model->receivergroup_tag);

        $criteria = new CDbCriteria;
        foreach ($list as $key => $ls) {
            $key = new CDbCriteria;
            $key->condition = 'member_of LIKE "%' . $ls . '"';

            $criteria->mergeWith($key, 'OR');
        }

        return new CActiveDataProvider('sAddressbook', [
            'criteria' => $criteria,
            'pagination' => [
                'pageSize' => 100
            ]
        ]);
    }

}
