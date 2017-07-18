<?php

/*
 * Router class
 * Used to detect which controlled and action should be called
 */

namespace framework;

class Router
{
    /** @var string Request URI in string format*/
    private $requestUri;

    /** @var array Array of words from splitted URI by '/' separator */
    private $splittedUri;

    /** @var string Name of controller received from URI */
    private $controllerName;

    /** @var string Name of action received from URI */
    private $actionName;

    /** @var array Array of parameters, which are located after controller and action names */
    private $params;

    /**
     * Router constructor.
     * @param $requestUri
     */
    function __construct($requestUri)
    {
        $this->requestUri = $requestUri;
        $this->splittedUri = explode('/', $this->requestUri);
        $this->controllerName = $this->splittedUri[1];
        $this->actionName = $this->splittedUri[2];
        $this->params = array_slice($this->splittedUri, 3);
    }

    /**
     * @return string
     * Getter for controller name variable
     * Returns controller name
     */
    public function getControllerName() {
        return $this->controllerName;
    }

    /**
     * @return string
     * Getter for action name variable
     * Returns action name
     */
    public function getActionName() {
        return $this->actionName;
    }

    /**
     * @return array
     * Getter for parameters array
     * Returns an array of parameters
     */
    public function getParams() {
        return $this->params;
    }

    /**
     * @param $controller
     * @param $action
     * @param $params
     * @return string
     * Method is used to generate URI from controller name, action name and array of params
     * Returns URI in string format
     */
    public function getUri($controller, $action, $params) {
        $result = "/{$controller}/{$action}/";
        foreach ($params as $param) {
            $result .= $param . '/';
        }
        return $result;
    }
}