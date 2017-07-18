<?php

/*
 * Student ORM class
 * All fields in this class correspond to one record in 'students' table
 */

namespace src\orm;


class Student
{
    /** @var integer Identifier of a student*/
    private $id;

    /** @var integer Student's name*/
    private $name;

    /** @var integer Student's group*/
    private $group;

    /**
     * Student ORM constructor.
     * @param null $id
     * @param string $name
     * @param string $group
     */
    function __construct($id = null, $name = 'ФИО', $group = 'Группа')
    {
        $this->id = $id;
        $this->name = $name;
        $this->group = $group;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * @param mixed $group
     */
    public function setGroup($group)
    {
        $this->group = $group;
    }


}