<?php

/*
 * Student Controller class
 * Used to work with student's model and give results to view
 */

namespace src\controllers;

use framework\ErrorHandler;
use framework\Request;
use framework\Response;
use src\model\StudentModel;
use src\orm\Student;

class StudentController
{
    /** @var object Object of student model class, used to work with 'Student' instance */
    private $studentModel;

    /** @var object Instance of request class, used to handle input requests */
    private $request;

    /** @var object Instance of response object, used to send response to client */
    private $response;

    /** @var object Error handler object, used to notify user about errors*/
    private $errorHandler;

    /**
     * StudentController constructor.
     */
    function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
        $this->studentModel = new StudentModel();
        $this->errorHandler = new ErrorHandler();
    }

    /**
     * @param array $params
     * Used to render edit template with student's data
     */
    public function editAction ($params = []) {
        $id = $params[0];
        $student = $this->studentModel->getStudentById($id);
        $this->response->renderContent('edit', ['student' => $student, 'title' => 'Редактирование: ' . $student->getName()]);
    }

    /**
     * @param array $params
     * Used to render edit template with new generated student's data
     */
    public function addAction ($params = []) {
        $this->response->renderContent('edit', ['student' => new Student(), 'title' => 'Добавление нового студента']);
    }

    /**
     * @param array $params
     * Used to save student's data from request to database
     */
    public function saveAction($params = []) {
        $id = $params[0];
        $student = $this->request->getStudentFromRequest($_REQUEST);
        if ($id != null) {
            $this->studentModel->editStudent($student);
        }
        else {
            $this->studentModel->addNewStudent($student);
        }
        $this->response->redirect('/');
    }

    /**
     * @param array $params
     * Used to remove requested student from database
     */
    public function removeAction($params = []) {
        $id = $params[0];
        if ($id != null) {
            $this->studentModel->removeStudentById($id);
            $this->response->redirect('/');
        }
        else {
            $this->errorHandler->printError('Can not remove student without ID');
        }
    }
}