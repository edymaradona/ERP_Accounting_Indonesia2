<?php
/**
 * @var $this EmailWebController
 * @var $content string
 *
 * @author Brett O'Donnell <cornernote@gmail.com>
 * @author Zain Ul abidin <zainengineer@gmail.com>
 * @copyright 2013 Mr PHP
 * @link https://github.com/cornernote/yii-email-module
 * @license BSD-3-Clause https://raw.github.com/cornernote/yii-email-module/master/LICENSE
 *
 * @package yii-email-module
 */
$cs = Yii::app()->clientScript;
$cs->coreScriptPosition = CClientScript::POS_HEAD;
$cs->scriptMap = [];
$baseUrl = $this->module->assetsUrl;
$cs->registerCoreScript('jquery');
Yii::app()->bootstrap->register();
$cs->registerCssFile($baseUrl . '/font-awesome/css/font-awesome.min.css');
$cs->registerScriptFile($baseUrl . '/fancybox2/jquery.fancybox.pack.js');
$cs->registerCssFile($baseUrl . '/fancybox2/jquery.fancybox.css');
$cs->registerCssFile($baseUrl . '/css/main.css');
$cs->registerScriptFile($baseUrl . '/js/main.js');
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="language" content="en"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body>

<?php
$items = [];
foreach (array_keys($this->module->controllerMap) as $controllerName) {
    $items[] = [
        'label' => Yii::t('email', ucfirst($controllerName)),
        'url' => Yii::app()->getUser()->getState('index.email' . ucfirst($controllerName), [$controllerName . '/index']),
        'active' => $this->id == $controllerName,
    ];
}
$this->widget('booster.widgets.TbNavbar', [
    'brandLabel' => $this->module->getName(),
    'brandUrl' => ['/' . $this->module->id],
    'items' => [
        [
            'class' => 'bootstrap.widgets.TbNav',
            'items' => $items,
        ],
        [
            'class' => 'bootstrap.widgets.TbNav',
            'htmlOptions' => ['class' => 'pull-right'],
            'items' => [['label' => Yii::app()->name, 'url' => Yii::app()->homeUrl]],
        ],
    ],
]);

echo CHtml::tag('div', ['class' => 'container'], $this->widget('bootstrap.widgets.TbBreadcrumb', [
    'links' => array_merge($this->getBreadcrumbs(), [$this->pageTitle]),
], true));

echo $content;
?>

<div id="footer" class="container small text-center">
    <?php
    if (Yii::app()->hasModule('audit')) {
        $this->renderPartial('audit.views.request.__footer');
        echo '<br/>';
    }
    echo EmailModule::powered();
    echo '<br/>A product of <a href="http://mrphp.com.au">Mr PHP</a>.';
    ?>
</div>

</body>
</html>
