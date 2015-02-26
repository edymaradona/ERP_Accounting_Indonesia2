<?php
Yii::import('application.extensions.iwi.Iwi');
Yii::import('application.extensions.iwi.vendors.image.CImageComponent');

/**
 * Description of CImageComponent
 *
 * @author Administrator
 */
class IwiComponent extends CImageComponent
{
    public function load($image)
    {
        $config = [
            'driver' => $this->driver,
            'params' => $this->params,
        ];
        return new Iwi($image, $config);
    }
}

?>
