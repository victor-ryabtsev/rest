<?php

class JsonResponse
{
    /**
     * @var integer HTTP status code, such as 403, 404, 500, etc.
     */
    public $statusCode = 200;

    /**
     * @var mixed Response content.
     */
    protected $data = array();

    /**
     * Render array to json. Static helper.
     * @param array $data
     * @param int|string $code
     */
    public static function render($data, $code = '200')
    {
        $jr = new self;
        $jr->setData($data);
        $jr->setStatusCode($code);
        $jr->send();
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function setStatusCode($code)
    {
        $this->statusCode = $code;
    }

    public function send()
    {
        header("HTTP/1.1 " . $this->statusCode . ' ' . $this->getStatusMessage($this->statusCode));

        // insert access controll origin headers
        if (isset(Yii::app()->params->origin) && strlen(Yii::app()->params->origin)) {
            header('Access-Control-Allow-Origin: ' . Yii::app()->params->origin);
            header('Access-Control-Allow-Headers: Cookie');
            header('Access-Control-Allow-Credentials: true');
        }

        // Vary is strictly for those cases where it's hopeless or excessively
        // complicated for a proxy to replicate what the server would do.
        header('Vary: Accept');

        // IE supports only text/plain
//		isset($_SERVER['HTTP_ACCEPT']) && strpos($_SERVER['HTTP_ACCEPT'], 'application/html') !== false
//			? header('Content-type: application/json; charset=utf-8')
//			: header('Content-type: text/plain; charset=utf-8');

        header('Content-type: application/json; charset=utf-8');

        if ($this->data !== null) {
            echo CJSON::encode($this->data);
        }
        Yii::app()->end();
    }

    /**
     * Get status message by http status code
     * @param int $statusCode
     * @return string
     */
    public function getStatusMessage($statusCode)
    {
        switch ($statusCode) {
            case 100:
                return 'Continue';
            case 101:
                return 'Switching Protocols';
            case 200:
                return 'OK';
            case 201:
                return 'Created';
            case 202:
                return 'Accepted';
            case 203:
                return 'Non-Authoritative Information';
            case 204:
                return 'No Content';
            case 205:
                return 'Reset Content';
            case 206:
                return 'Partial Content';
            case 300:
                return 'Multiple Choices';
            case 301:
                return 'Moved Permanently';
            case 302:
                return 'Found';
            case 303:
                return 'See Other';
            case 304:
                return 'Not Modified';
            case 305:
                return 'Use Proxy';
            case 306:
                return '(Unused)';
            case 307:
                return 'Temporary Redirect';
            case 400:
                return 'Bad Request';
            case 401:
                return 'Unauthorized';
            case 402:
                return 'Payment Required';
            case 403:
                return 'Forbidden';
            case 404:
                return 'Not found';
            case 405:
                return 'Method Not Allowed';
            case 406:
                return 'Not Acceptable';
            case 407:
                return 'Proxy Authentication Required';
            case 408:
                return 'Request Timeout';
            case 409:
                return 'Conflict';
            case 410:
                return 'Gone';
            case 411:
                return 'Length Required';
            case 412:
                return 'Precondition Failed';
            case 413:
                return 'Request Entity Too Large';
            case 414:
                return 'Request-URI Too Long';
            case 415:
                return 'Unsupported Media Type';
            case 416:
                return 'Requested Range Not Satisfiable';
            case 417:
                return 'Expectation Failed';
            case 500:
                return 'Internal Server Error';
            case 501:
                return 'Not Implemented';
            case 502:
                return 'Bad Gateway';
            case 503:
                return 'Service Unavailable';
            case 504:
                return 'Gateway Timeout';
            case 505:
                return 'HTTP Version Not Supported';
            default:
                return '';
        }
    }
}
