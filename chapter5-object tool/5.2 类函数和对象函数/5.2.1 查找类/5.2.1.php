<?php
$className = "Task";
$path = "$className.php";
if(!file_exists($path))
{
    throw new Exception("No such file as $path");
}

require_once ($path);

$qClassName = "tasks\\$className";
if(!class_exists($qClassName))
{
    throw new Exception("No such class as $qClassName");
}

$myObj = new $qClassName();
$myObj->doSpeak();

$classArr = get_declared_classes();
var_dump($classArr);

class afterFunc
{

}