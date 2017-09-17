<?php
abstract class Unit
{
    public abstract function addUnit(Unit $unit);
    public abstract function removeUnit(Unit $unit);
    public abstract function bombardStrength();
}

// 组合类
class Army extends Unit
{
    private $units = [];

    public function addUnit(Unit $unit)
    {
        if(in_array($unit, $this->units, true))
        {
            return;
        }
        $this->units[] = $unit;
    }

    public function removeUnit(Unit $unit)
    {
        $this->units = array_udiff($this->units, array($unit),
            function ($a, $b){ return ($a == $b) ? 0 : 1; }
        );
    }

    public function bombardStrength()
    {
        $ret = 0;
        foreach ($this->units as $unit)
        {
            $ret += $unit->bombardStrength();
        }
        return $ret;
    }
}

//异常类 供叶子类使用
class UnitException extends Exception
{

}
// 叶子类Archer
class Archer extends Unit
{
    public function addUnit(Unit $unit)
    {
        throw new UnitException(get_class($this)."is a leaf (是叶子对象)");
    }

    public function removeUnit(Unit $unit)
    {
        throw new UnitException(get_class($this)."is a leaf (是叶子对象)");
    }

    public function bombardStrength()
    {
        return 4;
    }
}

// 叶子类LaserCannon
class LaserCannon extends Unit
{
    public function addUnit(Unit $unit)
    {
        throw new UnitException(get_class($this)."is a leaf (是叶子对象)");
    }

    public function removeUnit(Unit $unit)
    {
        throw new UnitException(get_class($this)."is a leaf (是叶子对象)");
    }

    public function bombardStrength()
    {
        return 44;
    }
}
