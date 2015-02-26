<hr/>

<div class="row">
    <div class="col-md-4">

        <h4><i class="fa fa-twitter-sign"></i>Twitter</h4>

        <a class="twitter-timeline" href="<?php echo Yii::app()->params['twitterlink'] ?>"
           data-widget-id="403182329515872256">Tweets by @aplcareer</a>

        <script>!function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
                if (!d.getElementById(id)) {
                    js = d.createElement(s);
                    js.id = id;
                    js.src = p + "://platform.twitter.com/widgets.js";
                    fjs.parentNode.insertBefore(js, fjs);
                }
            }(document, "script", "twitter-wjs");</script>


    </div>
    <div class="col-md-4">
        <h4><i class="fa fa-facebook-sign"></i>Facebook</h4>

        <div class="fb-like-box" data-href="<?php echo Yii::app()->params['fbpages'] ?>" data-colorscheme="light"
             data-show-faces="true" data-header="true" data-stream="true" data-show-border="true"></div>

    </div>
    <div class="col-md-4">
        <h4><i class="fa fa-linkedin-sign"></i>LinkedIn</h4>
    </div>
</div>
