<?php
abstract class Employee
{
    protected $name;
    private static $types = ['minion', 'cluedUp', 'wellConnected'];

    public function __construct($name)
    {
        $this->name = $name;
    }

    public static function recruit($name)
    {
        $num = rand(1, count(self::$types)) - 1;
        $class = self::$types[$num];
        return new $class($name);
    }

    public abstract function fire();
}

// 受压迫员工
class Minion extends Employee
{
    public function fire()
    {
        echo $this->name . ': I\'ll clear my desk(我马上打包走人)';
        echo '<br/>';
    }
}

// 很了解职场的员工
class CluedUp extends Employee
{
    public function fire()
    {
        echo $this->name . ': I\'ll call my lawyer(我打电话给我的律师)';
        echo '<br/>';
    }
}

// 与达官豪富有亲友关系的员工
class WellConnected extends Employee
{
    public function fire()
    {
        echo $this->name . ': I\'ll call my dad(我打电话给我老爸)';
        echo '<br/>';
    }
}

// 苛刻的老板
class NastyBoss
{
    private $employees = [];

    public function addEmployee(Employee $employee)
    {
        $this->employees[] = $employee;
    }

    public function projectFails()
    {
        if(count($this->employees) > 0)
        {
            $emp = array_pop($this->employees);
            $emp->fire();
        }
    }
}

$boss = new NastyBoss();
$boss->addEmployee(Employee::recruit('harry'));
$boss->addEmployee(Employee::recruit('bob'));
$boss->addEmployee(Employee::recruit('mary'));
$boss->projectFails();
$boss->projectFails();
$boss->projectFails();