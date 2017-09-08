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

// 苛刻的老板
class NastyBoss
{
    private $employees = [];

    public function addEmployee($employeeName)
    {
        $this->employees[] = new Minion($employeeName);
    }

    public function projectFails()
    {
        if(count($this->employees) > 0)
        {
            // array_pop():取出数组中最后一个元素 并从数组中把它删除
            $emp = array_pop($this->employees);
            $emp->fire();
        }
    }
}

$boss = new NastyBoss();
$boss->addEmployee('harry');
$boss->addEmployee('bob');
$boss->addEmployee('mary');
$boss->projectFails();