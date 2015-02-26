<?php

/**
 * This is the model class for table "ec_library".
 *
 * The followings are the available columns in table 'ec_library':
 * @property integer $id
 * @property integer $category_id
 * @property string $title
 * @property string $description
 * @property string $code
 * @property string $location
 * @property integer $quantity
 */
class ecLibrary extends BaseModel
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ec_library';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title', 'required'),
			array('category_id, quantity', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>150),
			array('code', 'length', 'max'=>50),
			array('location', 'length', 'max'=>100),
			array('description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, category_id, title, description, code, location, quantity', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'category' => [self::BELONGS_TO, 'sParameter', ['category_id' => 'code'], 'condition' => 'type = \'cBookCategory\''],
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'category_id' => 'Category',
			'title' => 'Title',
			'description' => 'Description',
			'code' => 'Code',
			'location' => 'Location',
			'quantity' => 'Quantity',
		);
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

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('location',$this->location,true);
		$criteria->compare('quantity',$this->quantity);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ecLibrary the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
