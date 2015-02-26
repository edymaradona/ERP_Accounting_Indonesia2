<?php

class tBalanceSheet extends BaseModel
{

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 't_balance_sheet';
    }

    public function rules()
    {
        return [
            ['yearmonth_periode, type_balance_id, created_date, created_by', 'numerical', 'integerOnly' => true],
            ['beginning_balance, debit, credit, end_balance', 'numerical'],
            ['remark', 'length', 'max' => 50],
            ['id, parent_id, input_date, yearmonth_periode, type_balance_id, remark, balance, created_date, created_by', 'safe', 'on' => 'search'],
        ];
    }

    public function relations()
    {
        return [
            'account' => [self::BELONGS_TO, 'tAccount', 'parent_id'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent',
            'yearmonth_periode' => 'Periode',
            'type_balance_id' => 'Type Balance',
            'remark' => 'Remark',
            'budget' => 'Budget',
            'beginning_balance' => 'Begin Balance',
            'debit' => 'Debit',
            'credit' => 'Credit',
            'end_balance' => 'End Balance',
            'created_date' => 'Created Date',
            'created_by' => 'Created',
        ];
    }

    public function search($id)
    {
        $criteria = new CDbCriteria;

        $criteria->compare('parent_id', $id);

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            'pagination' => [
                'pageSize' => 50,
            ],
            'sort' => [
                'defaultOrder' => 'type_balance_id,yearmonth_periode DESC',
            ],
        ]);
    }

    public function searchTrialBalance($curperiode)
    {
        $criteria = new CDbCriteria;
        $criteria->compare('yearmonth_periode', $curperiode);
        $criteria->with = ['account'];
        $criteria->together = true;

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            'pagination' => [
                'pageSize' => 100,
            ],
            'sort' => [
                'defaultOrder' => 'account.account_no',
            ],
        ]);
    }

    public function searchTop20($curperiode)
    {
        $sql = '
			SELECT CONCAT(a.account_no," ",a.account_name) as account_name,t.id, t.parent_id, t.beginning_balance, t.debit, t.credit, t.end_balance
			FROM t_balance_sheet t
			INNER JOIN t_account a on t.parent_id = a.id
			INNER JOIN t_journal_detail d ON d.account_no_id = a.id
			WHERE t.yearmonth_periode = ' . $curperiode . '
			GROUP BY CONCAT(a.account_no," ",a.account_name),t.id, t.parent_id, t.beginning_balance, t.debit, t.credit, t.end_balance
			ORDER BY d.updated_date DESC
			LIMIT 20
		';
        $rawData = Yii::app()->db->createCommand($sql)->queryAll();

        return new CArrayDataProvider($rawData, [
            'pagination' => false,
        ]);
    }

    public function searchFavouriteAccount($curperiode)
    {
        $sql = '
			SELECT CONCAT(a.account_no," ",a.account_name) as account_name,t.id, t.parent_id, t.beginning_balance, t.debit, t.credit, t.end_balance
			FROM t_balance_sheet t
			INNER JOIN t_account a on t.parent_id = a.id
			INNER JOIN t_journal_detail d ON d.account_no_id = a.id
			WHERE t.yearmonth_periode = ' . $curperiode . '
			GROUP BY CONCAT(a.account_no," ",a.account_name),t.id, t.parent_id, t.beginning_balance, t.debit, t.credit, t.end_balance
			ORDER BY d.updated_date DESC
			LIMIT 20
		';
        $rawData = Yii::app()->db->createCommand($sql)->queryAll();

        return new CArrayDataProvider($rawData, [
            'pagination' => false,
        ]);
    }

    public function getBeginning_balancee()
    {
        return peterFunc::indoFormat($this->beginning_balance);
    }

    public function getEnd_balancee()
    {
        return peterFunc::indoFormat($this->end_balance);
    }

    public function afterSave()
    {
        tJournal::model()->updateByPk((int)$this->parent_id, ['updated_date' => time()]);
        return true;
    }

}
