<?php

/*
 * Student Model Class
 * Used to interact between raw data from database and 'Student' ORM class
 */

namespace src\model;

use framework\ConfigParser;
use framework\MysqlConnector;
use src\orm\Student;

class StudentModel
{
    /** @var object Instance of database connector class, used to work with database */
    private $dbConnector;

    /** @var object Instance of config parser class, used to get config of application*/
    private $config;

    /** @var array Associative array with database connection parameters, stored in config file*/
    private $dbaseSettings;

    /**
     * StudentModel constructor.
     * creates config parser object and put database connection parameters to dbaseSettings array;
     * creates database connector object and tries to connect to database with parameters from dbaseSettings array;
     */
    function __construct()
    {
        $this->config = new ConfigParser();
        $this->dbaseSettings = $this->config->getConfigArray()['database_config'];
        $this->dbConnector = new MysqlConnector();
        $this->dbConnector->createConnection($this->dbaseSettings['host'], $this->dbaseSettings['user'], $this->dbaseSettings['password'], $this->dbaseSettings['base']);
    }

    /**
     * @return array
     * Receives an array with string data about all students stored in database;
     * Forms and returns an array of 'Student' class objects
     */
    public function getStudents() {
        $studentsArray = [];
        $queryResult = $this->dbConnector->getAllStudents();
        foreach ($queryResult as $student) {
            $studentsArray[] = new Student($student['id'], $student['name'], $student['group']);
        }
        return $studentsArray;
    }

    /**
     * @param $id
     * @return Student
     * Receives string data about one student, identified by id
     * Forms and returns 'Student' object with revelant data
     */
    public function getStudentById($id) {
        $queryResult = $this->dbConnector->getStudentById($id);
        return new Student($id, $queryResult['name'], $queryResult['group']);
    }

    /**
     * @param $id
     * @return bool
     * Removes data about student, identified by id, from database table
     * Returns true if remove was successful
     */
    public function removeStudentById($id) {
        return $this->dbConnector->removeStudentById($id);
    }

    /**
     * @param $student
     * @return bool
     * Update data about student, identified by id, in database table
     * Returns true if update process was successful
     */
    public function editStudent($student) {
        return $this->dbConnector->editStudent($student->getId(), $student->getName(), $student->getGroup());
    }

    /**
     * @param $student student object
     * @return mixed ID of new student
     * Creates new row in students database table, filled with revelant to 'Student' object data
     * Returns the ID of new student if the addition process was successful
     */
    public function addNewStudent($student) {
        return $this->dbConnector->addStudent($student->getName(), $student->getGroup());
    }
}