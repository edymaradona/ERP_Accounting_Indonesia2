<?php

if (isset($modelFinalRating)) {
    echo $this->renderPartial('_tabFinalRating', ["model" => $model, "modelFinalRating" => $modelFinalRating]);
    echo $this->renderPartial('_formFinalRating', ['model' => $modelFinalRating]);
}