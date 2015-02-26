<?php

/* 		$Hierarchy=ABudget::model()->findAll(array('condition'=>'parent_id = 0 and department_id = '.sUser::model()->myGroupRoot.' ORDER BY code'));

  foreach ($Hierarchy as $Hierarchy){
  $models = ABudget::model()->findBypk($Hierarchy->id);
  $items[] = $models->getTree();
  }
 */
if (!isset($_GET['pro_id']) || $_GET['pro_id'] == 1) {
    $this->beginWidget('CTreeView', [
        'id' => 'module-tree',
        //'data'=>$items,
        'url' => ['/aBudget/ajaxFillTreeCP'],
    ]);
    $this->endWidget();
} else {
    $this->beginWidget('CTreeView', [
        'id' => 'module-tree',
        //'data'=>$items,
        'url' => ['/aBudget/ajaxFillTreeRMG'],
    ]);
    $this->endWidget();
}
?>

