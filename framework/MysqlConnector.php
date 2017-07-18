<?php

/*
 * MySQL connector class
 * Used to work with MySQL database management system
 * Uses MySQL Improved driver to interact with database
 */

namespace framework;

use mysqli;

class MysqlConnector
{
    /** @var object Instance of MySQLi class, used to work with MySQL */
    private $connection;

    /** @var object Instance of ErrorHandler class, used to notify user about errors*/
    private $errorHandler;

    /**
     * MysqlConnector constructor.
     */
    function __construct()
    {
        $this->errorHandler = new ErrorHandler();
    }

    /**
     * @param $host
     * @param $user
     * @param $password
     * @param $base
     * Used to create connection to database management system with specified host, username, password and database name
     */
    public function createConnection($host, $user, $password, $base) {
        $this->connection = new mysqli($host, $user, $password, $base);
        if ($this->connection->connect_error) {
           $this->errorHandler->printError('Database connection failed: ' . $this->connection->connect_error);
        }
        if (!$this->isStudentsTableExist())
            $this->createTable();
    }

    /**
     * @return bool
     * 'students' table is used to store all data of this application
     * Returns true if 'students' table exists in database
     */
    private function isStudentsTableExist() {
        $query = 'SELECT * FROM students';
        return mysqli_query($this->connection, $query) ? true : false;
    }

    /**
     * @return bool
     * Creates 'students' table in database with fields: id, name, group
     * Returns true if creation was successfull
     */
    private function createTable() {
        $query =
            'CREATE TABLE IF NOT EXISTS students (
            `id` INT NOT NULL AUTO_INCREMENT,
            PRIMARY KEY(id),
            `name`    VARCHAR(50) NOT NULL,
            `group`   VARCHAR(20) NOT NULL
            )';
        if ($this->connection->query($query) === true) {
            return true;
        } else {
            $this->errorHandler->printError('Database error: ' . $this->connection->error);
        }
    }

    /**
     * @return array
     * Returns an array with data about all students, stored in the database table
     */
    public function getAllStudents() {
        $students = [];
        $query = 'SELECT * FROM students';
        $result = mysqli_query($this->connection, $query);
        while($student = $result->fetch_assoc()) {
            $students[] = $student;
        }
        $result->close();
        return $students;
    }

    /**
     * @param $id
     * @return array
     * Returns an array with raw string data about one student, identified by ID
     */
    public function getStudentById($id) {
        $query = 'SELECT `name`, `group` FROM students WHERE `id`=' . $id;
        $result = mysqli_query($this->connection, $query);
        return $result->fetch_array(MYSQLI_ASSOC);
    }

    /**
     * @param $id
     * @return bool
     * Removes data about one student, identified by ID, from database table
     */
    public function removeStudentById($id) {
        $query = "DELETE FROM students WHERE `id`={$id}";
        if ($this->connection->query($query) === true) {
            return true;
        } else {
            $this->errorHandler->printError('Database error: ' . $this->connection->error);
        }
    }

    /**
     * @param $id
     * @param $name
     * @param $group
     * @return bool
     * Updates an info about one student, identified by ID
     */
    public function editStudent($id, $name, $group) {
        $query = "UPDATE students SET `name`='{$name}', `group`='{$group}' WHERE id={$id}";
        if ($this->connection->query($query) === true) {
            return true;
        } else {
            $this->errorHandler->printError('Database error: ' . $this->connection->error);
        }
    }

    /**
     * @param $name
     * @param $group
     * @return mixed
     * Adds an info about new student
     * Returns the ID of new student
     */
    public function addStudent($name, $group) {
        $query = "INSERT INTO students (`name`, `group`) VALUES ('{$name}', '{$group}')";
        if ($this->connection->query($query) === true) {
            $last_id = $this->connection->insert_id;
            return $last_id;
        } else {
            $this->errorHandler->printError('Database error: ' . $this->connection->error);
        }
    }
}