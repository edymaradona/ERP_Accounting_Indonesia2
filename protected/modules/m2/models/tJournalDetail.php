<?php

class tJournalDetail extends BaseModel
{

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 't_journal_detail';
    }

    public function rules()
    {
        return [
            ['account_no_id, debit, credit', 'required'],
            ['sub_account_id', 'numerical', 'integerOnly' => true],
            ['account_no_id, sub_account_id, debit, credit, user_remark, system_remark', 'safe', 'on' => 'search'],
        ];
    }

    public function relations()
    {
        return [
            'account' => [self::BELONGS_TO, 'tAccount', ['account_no_id' => 'id']],
            'journal' => [self::BELONGS_TO, 'tJournal', 'parent_id'],
            'purchasing' => [self::BELONGS_TO, 'vPurchasing', 'sub_account_id'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent',
            'account_no_id' => 'Account No',
            'sub_account_id' => 'Sub Account',
            'debit' => 'Debit',
            'credit' => 'Credit',
            'user_remark' => 'User Remark',
            'user_remarkk' => 'User Remark',
            'system_remark' => 'System Remark',
            'created_date' => 'Created Date',
            'created_by' => 'Created',
            'updated_date' => 'Updated Date',
            'updated_by' => 'Updated',
        ];
    }

    public function search($id = 0)
    {
        $criteria = new CDbCriteria;

        $criteria->compare('parent_id', $id);
        $criteria->order = 'debit DESC';

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            'pagination' => false,
        ]);
    }

    public function searchByAccount($id)
    {
        $criteria = new CDbCriteria;

        $criteria->compare('user_remark', $this->user_remark, true);
        $criteria->compare('account_no_id', $id);
        $criteria->with = ('journal');
        $criteria->compare('yearmonth_periode', Yii::app()->params["cCurrentPeriod"]);

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            'pagination' => [
                'pageSize' => 50,
            ],
            'sort' => [
                'defaultOrder' => 'journal.input_date',
            ],
        ]);
    }

    public static function getTopCreated()
    {

        $models = self::model()->findAll(['limit' => 10, 'order' => 'created_date DESC']);

        $returnarray = [];

        foreach ($models as $model) {
            $returnarray[] = ['id' => $model->user_ref, 'label' => $model->user_ref, 'icon' => 'list-alt', 'url' => ['view', 'id' => $model->id]];
        }

        return $returnarray;
    }

    public static function getTopUpdated()
    {

        $models = self::model()->findAll(['limit' => 10, 'order' => 'updated_date DESC']);

        $returnarray = [];

        foreach ($models as $model) {
            $returnarray[] = ['id' => $model->user_ref, 'label' => $model->user_ref, 'icon' => 'list-alt', 'url' => ['view', 'id' => $model->id]];
        }

        return $returnarray;
    }

    public static function getTopRelated($name)
    {

        //$_related = self::model()->find((int)$id)->account_name;
        $_exp = explode(" ", $name);


        $criteria = new CDbCriteria;

        if (isset($_exp[0]))
            $criteria->compare('user_ref', $_exp[0], true, 'OR');

        if (isset($_exp[1]))
            $criteria->compare('user_ref', $_exp[1], true, 'OR');

        $criteria->limit = 10;
        $criteria->order = 'updated_date DESC';

        $models = self::model()->findAll($criteria);

        $returnarray = [];

        foreach ($models as $model) {
            $returnarray[] = ['id' => $model->account_name, 'label' => $model->account_no . " " . $model->account_name, 'url' => ['view', 'id' => $model->id]];
        }

        return $returnarray;
    }

    public function getUser_remarkk()
    {
        if ($this->user_remark == $this->journal->remark)
            $remark = "**idem**";
        elseif ($this->user_remark == $this->journal->cb_custom1 . ". " . $this->journal->remark)
            $remark = "**idem**";
        else
            $remark = $this->user_remark;
        return $remark;
    }

    public function getDebitt()
    {
        return peterFunc::indoFormat($this->debit);
    }

    public function getCreditt()
    {
        return peterFunc::indoFormat($this->credit);
    }

    public function afterSave()
    {
        tJournal::model()->updateByPk((int)$this->parent_id, ['updated_date' => time()]);
        return true;
    }

}
