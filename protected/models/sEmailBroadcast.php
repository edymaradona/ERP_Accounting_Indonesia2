<?php

/**
 * This is the model class for table "s_email_broadcast".
 *
 * The followings are the available columns in table 's_email_broadcast':
 * @property integer $id
 * @property string $input_date
 * @property integer $no_ref
 * @property string $description
 * @property string $email_content
 * @property string $receiver_list
 * @property integer $created_date
 * @property integer $created_by
 * @property integer $updated_date
 * @property integer $updated_by
 */
class sEmailBroadcast extends BaseModel
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 's_email_broadcast';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('input_date, no_ref, description, email_content, receiver_list, created_date, created_by, updated_date, updated_by', 'required'),
			array('no_ref, created_date, created_by, updated_date, updated_by', 'numerical', 'integerOnly'=>true),
			array('description', 'length', 'max'=>500),
			array('subject_email', 'length', 'max'=>250),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, input_date, no_ref, description, email_content, receiver_list, created_date, created_by, updated_date, updated_by', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'input_date' => 'Input Date',
			'no_ref' => 'No Ref',
			'description' => 'Description',
			'subject_email' => 'Subject Email',
			'email_content' => 'Email Content',
			'receiver_list' => 'Receiver List',
			'created_date' => 'Created Date',
			'created_by' => 'Created By',
			'updated_date' => 'Updated Date',
			'updated_by' => 'Updated By',
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
		$criteria->compare('input_date',$this->input_date,true);
		$criteria->compare('no_ref',$this->no_ref);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('email_content',$this->email_content,true);
		$criteria->compare('receiver_list',$this->receiver_list,true);
		$criteria->compare('created_date',$this->created_date);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('updated_date',$this->updated_date);
		$criteria->compare('updated_by',$this->updated_by);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return sEmailBroadcast the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
