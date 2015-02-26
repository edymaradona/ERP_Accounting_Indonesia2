<?php

$this->widget('zii.widgets.CBreadcrumbs', [
    'links' => ['Forum']
]);
?>

    <br/>

<?php
$isAdmin = !Yii::app()->user->isGuest && (Yii::app()->user->name == "admin");
if ($isAdmin)
    echo 'Admin: ' . CHtml::link('New forum', ['/forum/forum/create'], ['class' => 'btn btn-primary btn-xs']) . '<br />';

foreach ($categories as $category) {
    $this->renderpartial('_subforums', [
        'forum' => $category,
        'subforums' => new CActiveDataProvider('Forum', [
                'criteria' => [
                    'scopes' => ['forums' => [$category->id]],
                ],
                'pagination' => false,
            ]),
    ]);
}