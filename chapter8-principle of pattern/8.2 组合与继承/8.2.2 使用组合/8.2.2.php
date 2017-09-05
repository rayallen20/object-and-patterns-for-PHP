<?php
abstract class Lesson
{
    private $duration;
    private $costStrategy;

    public function __construct($duration, CostStrategy $costStrategy)
    {
        $this->duration = $duration;
        $this->costStrategy = $costStrategy;
    }

    public function cost()
    {
        return $this->costStrategy->cost($this);
    }

    public function chargeType()
    {
        return $this->costStrategy->chargeType();
    }

    public function getDuration()
    {
        return $this->duration;
    }
}

class Lecture extends Lesson
{

}

class Seminar extends Lesson
{

}

abstract class CostStrategy
{
    abstract function cost(Lesson $lesson);
    abstract function chargeType();
}

class TimedCostStrategy extends CostStrategy
{
    public function cost(Lesson $lesson)
    {
        return $lesson->getDuration() * 5;
    }

    public function chargeType()
    {
        return "hourly rate(按小时收费 1小时5块) \n";
    }
}

class FixedCostStrategy extends CostStrategy
{
    public function cost(Lesson $lesson)
    {
        return 30;
    }

    public function chargeType()
    {
        return "fixed rate(按次数收费 1次30块) \n";
    }
}

$lessons[] = new Seminar(4, new TimedCostStrategy());
$lessons[] = new Lecture(4, new FixedCostStrategy());

foreach ($lessons as $lesson)
{
    echo "lesson charge(价格):".$lesson->cost();
    echo '<br/>';
    echo "charge type(类型):".$lesson->chargeType();
    echo '<hr/>';
}