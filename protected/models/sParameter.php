<?php

class sParameter extends BaseModel
{

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 's_parameter';
    }

    public function rules()
    {
        return [
            ['name, code, type', 'required'],
            ['code,status_id', 'numerical', 'integerOnly' => true],
            ['name, type', 'length', 'max' => 128],
            ['name, code, type', 'safe', 'on' => 'search'],
        ];
    }

    public function relations()
    {
        return [
            'status' => [self::HAS_ONE, 'sParameter', ['code' => 'status_id'], 'condition' => 'type = "cStatus"'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'code' => 'Code',
            'type' => 'Type',
            'status_id' => 'Status',
        ];
    }

    public static function lastItem($type)
    {
        $_item = self::model()->find([
            'order' => 'code DESC',
            'condition' => 'type = :type and status_id = 1',
            'params' => [':type' => $type],
        ]);
        if (isset($_item)) {
            $_code = $_item->code + 1;
        } else
            $_code = false;

        return $_code;
    }

    public function search($type = null)
    {
        $criteria = new CDbCriteria;

        $criteria->compare('name', $this->name, true);
        $criteria->compare('code', $this->code);
        $criteria->compare('type', $type);
        $criteria->order = 'type,code';

        return new CActiveDataProvider(get_class($this), [
            'criteria' => $criteria,
            'pagination' => [
                'pageSize' => 30,
            ],
        ]);
    }

    public function searchP()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('name', $this->name, true);
        $criteria->compare('code', $this->code);
        $criteria->compare('type', 'cPeriode');

        return new CActiveDataProvider(get_class($this), [
            'criteria' => $criteria,
        ]);
    }

    private static $_items = [];

    public static function itemsWithName($type)
    {

        $_items[$type] = [];
        $models = self::model()->findAll([
            'condition' => 'type=:type and status_id = 1',
            'params' => [':type' => $type],
        ]);

        foreach ($models as $model)
            $_items[$type][$model->name] = $model->name;

        return $_items;
    }

    public static function itemsWithAll($type)
    {

        $_items[$type] = [];
        $_items[$type][''] = 'ALL';
        $models = self::model()->findAll([
            'condition' => 'type=:type and status_id = 1',
            'params' => [':type' => $type],
        ]);

        foreach ($models as $model)
            $_items[$type][$model->code] = $model->name;

        return $_items;
    }

    public static function items($type, $all = 0, $exception = [])
    {
        if (!isset(self::$_items[$type]))
            self::loadItems($type, $all, $exception);
        return self::$_items[$type];
    }

    public static function item($type, $code)
    {
        if (!isset(self::$_items[$type]))
            self::loadItems($type);
        return isset(self::$_items[$type][$code]) ? self::$_items[$type][$code] : false;
    }

    private static function loadItems($type, $all = null, $exception = null)
    {
        self::$_items[$type] = [];
        $criteria = new CDbCriteria;
        $criteria->compare('type', $type);
        $criteria->compare('status_id', 1); //active only
        $criteria->addNotInCondition('code', $exception);
        $models = self::model()->findAll($criteria);

        if ($all != null)
            self::$_items[$type][0] = '*inherited*';

        foreach ($models as $model)
            self::$_items[$type][$model->code] = $model->name;
    }

    public function ItemsOther($type)
    {
        $_items = [];
        $models = self::model()->findAll([
            'condition' => 'type=:type and status_id = 1',
            'params' => [':type' => $type],
        ]);

        foreach ($models as $model)
            $_items[$model->name] = $model->name;

        return $_items;
    }

    private static $_items3 = [];

    public static function items3($type)
    {
        if (!isset(self::$_items3[$type]))
            self::loadItems3($type);
        return self::$_items3[$type];
    }

    private static function loadItems3($type)
    {
        self::$_items3[$type] = [];
        $models = self::model()->findAllBySql('select distinct type from s_parameter');
        self::$_items3[$type][''] = '(ALL)';
        foreach ($models as $model)
            self::$_items3[$type][$model->type] = $model->type;
    }

    private static $_items2 = [];

    public static function items2($type)
    {
        if (!isset(self::$_items2[$type]))
            self::loadItems2($type);
        return self::$_items2[$type];
    }

    private static function loadItems2($type)
    {
        self::$_items2[$type] = [];
        $models = self::model()->findAllBySql('select distinct type from s_parameter');
        //self::$_items3[$type]['']='(ALL)';
        foreach ($models as $model)
            self::$_items2[$type][$model->type] = $model->type;
    }

    public function menuList($type, $route)
    {

        $criteria = new CDbCriteria;
        $criteria->compare('type', $type);
        $models = self::model()->findAll($criteria);

        $returnarray = [];

        foreach ($models as $model) {
            $returnarray[] = ['id' => $model->code, 'label' => $model->name, 'icon' => 'list-alt', 'url' => ['/' . $route . '/filter', 'id' => $model->code]];
        }

        return $returnarray;
    }

}
