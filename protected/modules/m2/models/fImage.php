<?php

class fImage extends CFormModel
{

    public $image;

    public function rules()
    {
        return [
            ['image', 'required'],
            ['image', 'file', 'types' => 'jpg, gif, png'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'image' => 'Nama File Image',
        ];
    }

}
