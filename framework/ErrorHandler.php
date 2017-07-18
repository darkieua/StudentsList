<?php

/*
 * Error Handler class
 * Used to notify user about errors arising during the work of application
 */

namespace framework;

class ErrorHandler
{
    /** @var object Instance of response object, used to send response to client */
    private $response;

    /**
     * ErrorHandler constructor.
     */
    function __construct()
    {
        $this->response = new Response();
    }

    /**
     * @param $error
     * Used to render error template with error message
     */
    public function printError($error) {
        $this->response->renderContent('error', ['error' => $error]);
        die();
    }

}