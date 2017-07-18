<?php

/*
 * Request Class
 * Used to work with request data
 */

namespace framework;

use src\orm\Student;

class Request
{
    /**
     * @param $request array with data from GET/POST request
     * @return Student
     * Parse request raw data and creates revelant Student ORM object
     * Remove HTML tags from input data to prevent injections of third-party code
     */
    public function getStudentFromRequest($request) {
        $id = strip_tags($request['id']);
        $name = strip_tags($request['name']);
        $group = strip_tags($request['group']);
        return new Student($id, $name, $group);
    }
}