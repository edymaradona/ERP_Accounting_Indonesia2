<?php
$this->pageTitle = Yii::app()->name . ' - Help';
$this->breadcrumbs = [
    'Empty',
];
?>

    <div class="page-header">
        <h1>
            <i class="fa fa-wrench"></i>
            Empty</h1>
    </div>

    <div class="raw">
        <div class="col-md-12">


            <h3>Search Results for: "<?php echo CHtml::encode($term); ?>"</h3>
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

<?php /*
            Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/css/bic_calendar/js/bic_calendar.min.js');
            Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/css/bic_calendar/css/bic_calendar.css');

?>

<script>
    $(document).ready(function() {

        var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

        var dayNames = ["S", "M", "T", "W", "T", "F", "S"];

        var events = [
            {
                date: "09/09/2014",
                title: 'SPORT & WELLNESS',
                link: 'http://bic.cat',
                linkTarget: '_blank',
                color: '',
                content: '<img src="http://gettingcontacts.com/upload/jornadas/sport-wellness_portada.png" ><br>06-11-2013 - 09:00 <br> Tecnocampus Mataró Auditori',
                class: '',
                displayMonthController: true,
                displayYearController: true,
                nMonths: 6
            }
        ];

        $('#calendari_lateral1').bic_calendar({
            //list of events in array
            events: events,
            //enable select
            enableSelect: true,
            //enable multi-select
            //multiSelect: true,
            //set day names
            dayNames: dayNames,
            //set month names
            monthNames: monthNames,
            //show dayNames
            showDays: true,
            //show month controller
            displayMonthController: true,
            //show year controller
            displayYearController: true,                                
            //set ajax call
            //reqAjax: {
            //    type: 'get',
            //    url: <?php Yii::app()->createUrl('/menu/calendarEvents') ?>
            //}
        });
    });
</script>
<div id="calendari_lateral1"></div>
*/
?>