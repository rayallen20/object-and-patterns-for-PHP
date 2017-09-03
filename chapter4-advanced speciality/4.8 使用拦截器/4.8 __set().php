<?php
class Person
{
private $_name;
private $_age;

public function __set($property, $value)
{
    $method = "set{$property}";
    if(method_exists($this, $method))
    {
        return $this->$method($value);
    }
}

public function setName($name)
{
    $this->_name = $name;
    if(!is_null($this->_name))
    {
        $this->_name = strtoupper($name);
    }
}

public function setAge($age)
{
    $this->_age = strtoupper($age);
}
}

$p = new Person();
$p->name = 'YangLei';
var_dump($p);
die;