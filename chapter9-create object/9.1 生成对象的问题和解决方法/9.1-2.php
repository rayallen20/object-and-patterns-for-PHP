<?php
abstract class Employee
{
    protected $name;
    public function __construct($name)
    {
        $this->name = $name;
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
$boss->addEmployee(new Minion('harry'));
$boss->addEmployee(new CluedUp('bob'));
$boss->addEmployee(new Minion('mary'));
$boss->projectFails();
$boss->projectFails();
$boss->projectFails();