<?php
abstract class Lesson
{
    protected $duration;
    const FIXED = 1;
    const TIMED = 2;
    private $costType;

    public function __construct($duration, $costType)
    {
        $this->duration = $duration;
        $this->costType = $costType;
    }

    public function cost()
    {
        switch ($this->costType)
        {
            case self::TIMED:
                return (5 * $this->duration);
                break;
            case self::FIXED:
                return 30;
                break;
            default:
                $this->costType = self::FIXED;
                return 30;
        }
    }

    public function chargeType()
    {
        switch ($this->costType)
        {
            case self::TIMED:
                return "hourly rate(按小时收费)";
                break;
            case self::FIXED:
                return "fixed rate(固定收费)";
                break;
            default:
                $this->costType = self::FIXED;
                return "fixed rate(固定收费)";
        }
    }
}

class Lecture extends Lesson
{

}

class Seminar extends Lesson
{

}

$lecture = new Lecture(5, Lesson::FIXED);
echo $lecture->cost()."(" . $lecture->chargeType() . ") \n";

$seminar = new Seminar(3, Lesson::TIMED);
echo $seminar->cost()."(" . $seminar->chargeType() . ") \n";