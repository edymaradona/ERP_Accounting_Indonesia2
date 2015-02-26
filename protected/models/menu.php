<?php

class menu extends BaseModel
{

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 's_module';
    }

    public function relations()
    {
        return [
            'getparent' => [self::BELONGS_TO, 'menu', 'parent_id'],
            'childsAuth' => [self::HAS_MANY, 'menu', 'parent_id', 'order' => 'childsAuth.sort,childsAuth.id ASC', 'with' => 'user'],
            'childs' => [self::HAS_MANY, 'menu', 'parent_id', 'order' => 'childs.sort,childs.id ASC'],
            'user' => [self::HAS_MANY, 'sUserModule', 's_module_id', 'condition' => 's_user_id =' . Yii::app()->user->id],
        ];
    }

    public function getListed()
    {
        $subitems = [];

        if ($this->childs) {
            if (Yii::app()->user->name == 'admin') {
                foreach ($this->childs as $child)
                    $subitems[] = $child->getListed();
            } else {
                foreach ($this->childsAuth as $child)
                    $subitems[] = $child->getListed();
            }
        }

        $_image = (!isset($this->image) || $this->image == '') ? 'th-large' : $this->image;

        $returnarray = ['label' => $this->title, 'icon' => $_image, 'url' => [$this->link]];

        if ($subitems != [])
            $returnarray = array_merge($returnarray, ['items' => $subitems]);

        return $returnarray;
    }

    public function getTree()
    {
        $subitems = [];

        if ($this->childs)
            foreach ($this->childs as $child) {
                $subitems[] = $child->getTree();
            }
        $returnarray = [
            'text' => CHtml::link($this->title, Yii::app()->createUrl($this->link)) . " " .
                CHtml::link('.E.', Yii::app()->createUrl('smodule/update', ['id' => $this->id])),
            'id' => [$this->id]];
        if ($subitems != [])
            $returnarray = array_merge($returnarray, ['children' => $subitems]);
        return $returnarray;
    }

    public function getData($cnd = " = 0")
    {
        $data = [];
        foreach (menu::model()->findAll('parent_id' . $cnd) as $model) {
            $row['text'] = $model->title;
            $row['id'] = $model->id;
            $row['children'] = Menu::getData(' =' . $model->id);
            $data[] = $row;
        }
        return $data;
    }

}
