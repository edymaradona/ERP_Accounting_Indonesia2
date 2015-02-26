<?php
if (!Yii::app()->user->isGuest) {
    if (Yii::app()->user->name == 'admin') {
        $dependency = new CDbCacheDependency('SELECT max(updated_date) AS t  FROM s_module;');
    } else
        $dependency = new CDbCacheDependency('SELECT max(um.updated_date) AS t  FROM s_user_module um WHERE um.s_user_id =' . Yii::app()->user->id);


    if (!Yii::app()->cache->get('hierarchy1m1' . Yii::app()->user->id)) {
        if (Yii::app()->user->name == 'admin') {
            $Hierarchy = menu::model()->findAll(['condition' => 'parent_id = \'0\' AND (name = \'m1\' OR name = \'m0\') ', 'order' => 'sort']);
        } else {

            $criteria = new CDbCriteria;
            $criteria->with = ['user'];
            $criteria->compare('parent_id', 0);
            $criteria->compare('user.s_user_id', Yii::app()->user->id);
            $criteria->order = 't.sort';
            $criteria1 = new CDbCriteria;
            $criteria1->compare('name', 'm1', true, 'OR');
            $criteria1->compare('name', 'm0', true, 'OR');
            $criteria->mergeWith($criteria1);

            //$Hierarchy=menu::model()->findAllBySql('SELECT a.id FROM s_module a
            //		LEFT JOIN s_user_module b ON a.id = b.s_module_id
            //		WHERE a.parent_id = "0"
            //		AND b.s_user_id = '.Yii::app()->user->id .' order by sort');
            $Hierarchy = menu::model()->cache(3600, $dependency)->findAll($criteria);
        }
        Yii::app()->cache->set('hierarchy1m1' . Yii::app()->user->id, $Hierarchy, 86400, $dependency);
    } else
        $Hierarchy = Yii::app()->cache->get('hierarchy1m1' . Yii::app()->user->id);

    if (!Yii::app()->cache->get('hierarchy2m1' . Yii::app()->user->id)) {
        foreach ($Hierarchy as $Hierarchy) {
            $models = menu::model()->findByPk($Hierarchy->id);
            $items[] = $models->getListed();
        }
        Yii::app()->cache->set('hierarchy2m1' . Yii::app()->user->id, $items, 86400, $dependency);
    } else
        $items = Yii::app()->cache->get('hierarchy2m1' . Yii::app()->user->id);

    $this->widget('booster.widgets.TbNavbar', [
        //'fixed'=>true,
        //'brand' => Yii::app()->name,
        'brand' => '',
        //'brand'=>CHtml::image(Yii::app()->request->baseUrlCdn . "/shareimages/company/logo.jpg", Yii::app()->name, array("height"=>"100%",'id'=>'photo','padding'=>0)),
        'brandUrl' => Yii::app()->createUrl("menu"),
        'collapse' => true, // requires bootstrap-responsive.css
        'items' => [
            [
                'class' => 'booster.widgets.TbMenu',
                'items' => $items,
                'type' => 'navbar',
            ],
            include(Yii::app()->basePath . '/components/AuthenticatedMenu.php'),
        ],
    ]);
} else {
    ?>

    <div class="row">
        <div class="col-md-4">
            <?php echo CHtml::image(Yii::app()->request->baseUrlCdn . "/shareimages/company/logo.jpg", Yii::app()->name, ["height" => "100%", 'id' => 'photo', 'style' => 'padding:0']); ?>
        </div>

        <div class="col-md-8">
            <div class="pull-right">
                <?php
                $this->widget('booster.widgets.TbTabs', [
                    'type' => 'pills', // '', 'tabs', 'pills' (or 'list')
                    'stacked' => false, // whether this is a stacked menu
                    'tabs' => [
                        ['label' => 'Home', 'url' => Yii::app()->createUrl('/site/login')],
                        ['label' => 'Photo', 'url' => Yii::app()->createUrl('/site/photo')],
                        ['label' => 'Learning', 'url' => Yii::app()->createUrl('/site/learning')],
                        ['label' => 'Career', 'url' => (Yii::app()->params['webcareer']), 'linkOptions' => ['target' => '_blank', 'style' => 'background-color:#ddeeee']],
                    ],
                ]);
                ?>
            </div>
        </div>
    </div>

    <div style="margin-top:-20px">
        <hr/>
    </div>

<?php
}
?>
