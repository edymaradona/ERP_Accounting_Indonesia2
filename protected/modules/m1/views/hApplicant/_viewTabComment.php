<?php if ($data->commentC != 0) { ?>
    <div style="border: 1px solid #cbcbcb;padding:2px 4px; margin:5px 0"
         id="c<?php echo $data->id ?>">
        <ul>
            <strong>Comment:</strong>
            <?php
            foreach ($data->comment as $comment) {
                echo CHtml::opentag('li', []);
                echo CHtml::tag("strong", [], $comment->user->username) . ". " . peterFunc::nicetime($comment->created_date) . " : " . $comment->comment;
                echo CHtml::closetag('li');
            }
            ?>

        </ul>
    </div>
<?php } ?>

<p>
    <?php
    $model = new hApplicantComment;

    $form = $this->beginWidget('booster.widgets.TbActiveForm', [
        'id' => 'comment-form',
        'type' => 'horizontal',
        'enableAjaxValidation' => false,
    ]);

    echo CHtml::openTag('div', ['class' => 'row']);
    echo CHtml::tag('div', [], $form->textArea($model, 'comment'));

    echo CHtml::tag('div', [], CHtml::AjaxSubmitButton('Comment', ['/m1/hApplicant/comment', 'id' => $data->id], [
            'success' => '
						function() {
							$.fn.yiiGridView.update("c' . $data->id . '", {
								data: $(this).serialize()
							})
							return false;	
						}'
        ]
    ));
    echo CHtml::closeTag('div');
    $this->endWidget();
    ?>
</p>
