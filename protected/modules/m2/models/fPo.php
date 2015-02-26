<?php

/**
 * This is the model class for table "u_so".
 *
 * The followings are the available columns in table 'u_so':
 * @property integer $id
 * @property integer $entity_id
 * @property integer $customer_id
 * @property string $input_date
 * @property string $system_ref
 * @property integer $periode_date
 * @property integer $so_type_id
 * @property string $remark
 * @property integer $created_date
 * @property integer $created_by
 * @property integer $updated_date
 * @property integer $updated_by
 * @property integer $approved_date
 * @property integer $approved_by
 */
class fPo extends CFormModel
{

    public $entity_id;
    public $supplier_id;
    public $input_date;
    public $system_ref;
    public $periode_date;
    public $po_type_id;
    public $remark;
    public $item_id;
    public $item_name;
    public $description;
    public $qty;
    public $amount;

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['input_date', 'required'],
            ['supplier_id, po_type_id', 'numerical', 'integerOnly' => true],
            ['system_ref', 'length', 'max' => 100],
            ['remark', 'safe'],
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            ['id, entity_id, supplier_id, input_date, system_ref, po_type_id, remark', 'safe', 'on' => 'search'],
            //array('item_id, qty, amount', 'required'),
            //array('item_id, qty, amount, customer_id', 'numerical'),
            //array('description, item_name', 'length', 'max' => 255),
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'entity_id' => 'Entity',
            'supplier_id' => 'Supplier',
            'input_date' => 'Input Date',
            'system_ref' => 'System Ref',
            'po_type_id' => 'PO Type',
            'state_id' => 'Status',
            'remark' => 'Remark',
        ];
    }

}
