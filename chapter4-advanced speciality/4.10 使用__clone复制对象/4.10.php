<?php
class Person
{
    private $name;
    private $age;
    private $id;

    public function __construct($name, $age)
    {
        $this->name = $name;
        $this->age = $age;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function __clone()
    {
        $this->id = 0;
    }
}

$person = new Person('bob', 44);
$person->setId(343);
$person2 = clone $person;
var_dump($person);
var_dump($person2);
die;
