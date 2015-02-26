<?php

$contents = scandir(Yii::app()->basePath . "/modules/m1/views/zHelp/pages/", 1);

foreach ($contents as $content) {
    if ($content != ".tmb" && $content != "." && $content != "..") {
        $exp = explode('.', $content);
        echo CHtml::link($exp[0], Yii::app()->createUrl("m1/zHelp/link", ["view" => $exp[0]]));
        echo "<br/>";
    }
};

