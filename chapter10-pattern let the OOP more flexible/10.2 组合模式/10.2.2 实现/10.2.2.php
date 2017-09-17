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
        // 第三个参数的意思是是否严格比较 即不仅比较值是否相同，还会比较类型是否相同
        if(in_array($unit, $this->units, true))
        {
            return;
        }
        $this->units[] = $unit;
    }

    public function removeUnit(Unit $unit)
    {
        // array_udiff的解释见array_udiff.php
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