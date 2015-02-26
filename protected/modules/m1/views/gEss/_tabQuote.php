<div style="border: 1px #D5D5D5;border-bottom-style: solid;padding:3px 0;margin:10px 0;">
    <h4>Quote of the Day</h4>
</div>

<div class="row">
    <div class="col-md-5">
        <?php $this->renderPartial("//site/_quote"); ?>
    </div>
    <div class="col-md-4">
        <?php
        $this->beginWidget('booster.widgets.TbPanel', [
            'title' => false,
            'headerIcon' => 'fa fa-globe fa-fw',
            //'htmlHeaderOptions' => ['style' => 'background:white'],
            //'htmlContentOptions' => ['style' => 'background:white'],
        ]);
        ?>
        <script type="text/javascript" src="http://www.brainyquote.com/link/quotebr.js"></script>
        <small><i><a href="http://www.brainyquote.com/quotes_of_the_day.html" target="_blank">Powered by Brainy
                    Quotes</a></i></small>

        <?php $this->endWidget(); ?>

    </div>
</div>
