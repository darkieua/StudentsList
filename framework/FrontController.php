<?php

/*
 * Front Controller
 * Used to handle requests to index.php and call needed controller and action
 */

namespace framework;

class FrontController
{
    /** @var object Router object, used to detect controller and action name from URI */
    private $router;
    /** @var object Instance of controller which should be called based on data from URI */
    private $controllerInstance;
    /** @var object Error handler object, used to notify user about errors*/
    private $errorHandler;

    /**
     * FrontController constructor.
     * @param $request
     */
    function __construct($request)
    {
        $this->errorHandler = new ErrorHandler();
        $this->router = new Router($request);
        $this->controllerInstance = $this->createControllerInstance($this->router->getControllerName());
        $this->callAction($this->controllerInstance, $this->router->getActionName(), $this->router->getParams());
    }

    /**
     * @param $controllerShortName
     * Creates and returns instance of controller class with the name, appropriate to an argument of this method
     */
    private function createControllerInstance($controllerShortName){
        $controllerShortName =  !empty($controllerShortName) ? $controllerShortName : 'index';
        $controllerFullName = '\\src\\controllers\\' . $controllerShortName . 'Controller';
        if (class_exists($controllerFullName)) {
            return new $controllerFullName();
        } else {
            $this->errorHandler->printError(404);
            return null;
        }
    }

    /**
     * @param $controller
     * @param $action
     * @param $params
     * @return mixed
     * Calls an action from controller with given parameters
     */
    private function callAction($controller, $action, $params) {
        if (empty($action))
            $action = 'home';

        if(method_exists($controller, $action . 'Action')) {
            return $controller->{$action . 'Action'}($params);
        }
        else {
            $this->errorHandler->printError(404);
        }
    }
}