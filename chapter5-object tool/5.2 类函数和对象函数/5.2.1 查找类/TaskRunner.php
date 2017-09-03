<?php
$className = "Task";
require_once ("{$className}.php");
$className = "tasks\\$className";
$myObj = new $className();
$myObj->doSpeak();