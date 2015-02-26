<?php

class HttpRequest extends CHttpRequest
{

    public $cdn = '';
    private $_baseUrl;

    public function getBaseUrlCdn()
    {
        return isset($this->cdn) ? $this->cdn : $this->baseUrl;
    }

}
