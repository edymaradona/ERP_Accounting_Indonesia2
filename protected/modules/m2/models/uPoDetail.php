<?php

/**
 * This is the model class for table "u_po_detail".
 *
 * The followings are the available columns in table 'u_po_detail':
 * @property integer $id
 * @property integer $parent_id
 * @property integer $item_id
 * @property string $description
 * @property string $user
 * @property integer $qty
 * @property string $uom
 * @property string $amount
 * @property string $need_date
 * @property integer $created_date
 * @property string $created_by
 * @property integer $updated_date
 * @property string $updated_by
 */
class uPoDetail extends BaseModel
{

    public $sub_total;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return bPorderDetail the static model class
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
        return 'u_po_detail';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['parent_id, item_id', 'required'],
            ['parent_id, item_id, qty, created_date, updated_date', 'numerical', 'integerOnly' => true],
            ['description', 'length', 'max' => 500],
            ['user', 'length', 'max' => 255],
            ['uom, amount, created_by, updated_by', 'length', 'max' => 15],
            ['need_date', 'safe'],
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            ['id, parent_id, item_id, payment_date, description, user, qty, uom, amount, need_date, created_date, created_by, updated_date, updated_by', 'safe', 'on' => 'search'],
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
            'po' => [self::BELONGS_TO, 'uPo', 'parent_id'],
            'item' => [self::BELONGS_TO, 'uProduct', 'item_id'],
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
            'item_id' => 'Item',
            'description' => 'Description',
            'qty' => 'Qty',
            'uom' => 'Uom',
            'amount' => 'Amount',
            'need_date' => 'Need Date',
            'created_date' => 'Created Date',
            'created_by' => 'Created By',
            'updated_date' => 'Updated Date',
            'updated_by' => 'Updated By',
        ];
    }

    public function search($id)
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('parent_id', $id);
        $criteria->order = 'id';

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            'pagination' => [
                'pageSize' => 30
            ]
        ]);
    }

    public function amountf()
    {
        $_format = Yii::app()->numberFormatter->format("#,##0.00", $this->amount);

        return $_format;
    }

    public function totalf()
    {
        $_format = Yii::app()->numberFormatter->format("#,##0.00", $this->qty * $this->amount);

        return $_format;
    }

}
