<?php
$this->pageTitle = Yii::app()->name . ' - Help';
$this->breadcrumbs = [
    'Empty',
];
?>

    <div class="page-header">
        <h1>
            <i class="fa fa-document"></i>
            Company Document Search</h1>
    </div>

    <?php $this->widget('ext.esearch.SearchBoxPortlet'); ?>

    <div class="raw">
        <div class="col-md-12">


            <h4>Search Results for: "<?php echo CHtml::encode($term); ?>"</h4>
            <?php if (!empty($results)): ?>
                <?php foreach ($results as $result):
                    ?>
                    <h4><?php echo CHtml::tag('a', ['href' => Yii::app()->request->HostInfo . "/sharedocs/companydocuments/" .  substr($result->longpath,54)], $result->filename); ?></h4>
                    <p>
                        <?php //echo peterFunc::shorten_string($query->highlightMatches($result->body),80); ?>
                    </p>
                    <p>Created: <?php echo $result->created; ?> | Last Modified: <?php echo $result->modified; ?> |
                        Indexing Time: <?php echo peterFunc::nicetime($result->indexTime); ?></p>
                    <hr/>
                <?php endforeach; ?>

            <?php else: ?>
                <p class="error">No results matched your search terms.</p>
            <?php endif; ?>


        </div>
    </div>