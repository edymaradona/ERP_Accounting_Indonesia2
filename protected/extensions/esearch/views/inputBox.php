<?php echo CHtml::beginForm($url, 'get') ?>
	<?php echo CHtml::openTag('div',['class'=>'input-group']) ?>
		<?php echo CHtml::textField('q', Yii::app()->request->getQuery('q'), ['class'=>'form-control','width'=>'100%','placeholder'=>'Search any document like Pedoman, APHRIS, Form, etc']) ?>
		<?php echo CHtml::openTag('span',['class'=>'input-group-btn','width'=>'1%']) ?>
			<?php echo CHtml::htmlButton('Search', array('class'=>'btn btn-default', 'type'=>'button','name'=>null)) ?>
		<?php echo CHtml::closeTag('span') ?>
	<?php echo CHtml::closeTag('div') ?>
<?php echo CHtml::endForm() ?>

