<?php if (isset($model->company->department_id)): ?>

    <h4>Same Level (<?php echo gPerson::model()->sameLevel($model->mLevelId())->totalItemCount ?>)</h4>
    <?php
    $this->widget('booster.widgets.TbGridView', [
        'id' => 'g-person2-grid',
        'dataProvider' => gPerson::model()->sameLevel($model->mLevelId()),
        'enableSorting' => false,
        'template' => '{items}{pager}',
        'columns' => [
            [
                'type' => 'raw',
                'value' => 'CHtml::link($data->PhotoPath,Yii::app()->createUrl("' . $this->route . '/../view",array("id"=>$data->id,)))',
                'htmlOptions' => ["width" => "60px"],
            ],
            [
                'header' => 'Name',
                'type' => 'raw',
                'value' => function ($data) {
                        return CHtml::tag('div', ['style' => 'font-weight: bold'], $data->GPersonLink)
                        . CHtml::tag('div', ['style' => 'color: #999; font-size: 11px'], $data->mDepartment())
                        . CHtml::tag('div', [], $data->mJobTitle())
                        . CHtml::tag('div', ['style' => 'color: #999; font-size: 11px'], $data->mLevel());
                    },
                'visible' => $this->id == "gPerson",
            ],
            [
                'header' => 'Name',
                'type' => 'raw',
                'value' => function ($data) {
                        return CHtml::tag('div', ['style' => 'font-weight: bold'], $data->GTalentLink)
                        . CHtml::tag('div', ['style' => 'color: #999; font-size: 11px'], $data->mDepartment())
                        . CHtml::tag('div', [], $data->mJobTitle())
                        . CHtml::tag('div', ['style' => 'color: #999; font-size: 11px'], $data->mLevel());
                    },
                'visible' => $this->id == "gPerformance",
            ],
        ],
    ]);
    ?>

<?php endif; ?>

<?php /*
  EQuickDlgs::contentButton(
  array(
  'content' => 'This is the help text', //$this->renderPartial('_help',[],true),
  'dialogTitle' => 'Help',
  'dialogWidth' => 200,
  'dialogHeight' => 300,
  'openButtonText' => 'Help me',
  'closeButtonText' => 'Close', //comment to remove the close button from the dialog
  )
  );
 */
?>

<?php
//$this->widget('ext.xupload.XUploadWidget', array(
//$this->widget('ext.xupload.XUpload', array(
//			'url' => Yii::app()->createUrl("/bphgbi/bPejabat/upload", array("folder" =>'photo','id'=>$model->id)),
//'model' => $model,
//'attribute' => 'file',
//'multiple' => true,
//));

