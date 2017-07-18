<?php
/*
 * Index Controller class
 * Used to determine application behaviour on index page
 */

namespace src\controllers;

use framework\Response;
use src\model\StudentModel;

class IndexController
{
    /** @var object Object of student model class, used to work with 'Student' instance */
    private $studentModel;
    /** @var object Instance of response object, used to send response to client */
    private $response;

    /**
     * IndexController constructor.
     */
    function __construct()
    {
        $this->studentModel = new StudentModel();
        $this->response = new Response();
    }

    /**
     * Default action, called when no action name is specified
     */
    function homeAction(){
        $students = $this->studentModel->getStudents();
        $this->response->renderContent('list', ['students' => $students, 'title' => 'Список студентов']);
    }
}