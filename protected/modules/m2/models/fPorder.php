<?php

class fPorder extends CFormModel
{

    public $input_date;
    public $supplier_id;
    public $remark;
    public $parent_id;
    public $item_id;
    public $item_name;
    public $description;
    public $qty;
    public $amount;

    public function attributeLabels()
    {
        return [
            'parent_id' => 'Parent',
            'input_date' => 'Input Date',
            'supplier_id' => 'Supplier',
            'remark' => 'Remark',
            'item_id' => 'Item',
            'description' => 'description',
            'qty' => 'Qty',
            'amount' => 'Amount',
        ];
    }

    public function rules()
    {
        return [
            ['item_id, qty, amount, input_date', 'required'],
            ['item_id, qty, amount, supplier_id', 'numerical'],
            ['description, item_name,parent_id', 'length', 'max' => 255],
            ['input_date', 'safe'],
        ];
    }

}
