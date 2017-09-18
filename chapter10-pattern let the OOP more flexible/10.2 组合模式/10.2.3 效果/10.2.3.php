<?php
abstract class Unit
{
    /*
     * composite: n 合成物
     * */
    public function getComposite()
    {
        return null;
    }

    public abstract function bombardStrength();
}

/*
 * 问题:为什么要把CompositeUnit也设计为抽象类？
 * 答案:因为CompositeUnit继承自Unit但是却没有实现bombardStrength()方法
 * 所以把CompositeUnit设计为抽象类
 *
 * 注意:抽象类A继承了抽象类B 是可以不实现抽象类B中的接口的 但是抽象类A的实现要实现B的接口
 * */
abstract class CompositeUnit extends Unit
{
    private $units = [];

    public function getComposite()
    {
        return $this;
    }

    protected function getUnits()
    {
        return $this->units;
    }

    public function removeUnit(Unit $unit)
    {
        $this->units = array_udiff($this->units, array($unit),
        function ($a, $b){ return ($a === $b) ? 0 : 1 ;}
            );
    }

    public function addUnit(Unit $unit)
    {
        if(in_array($unit, $this->units, true))
        {
            return;
        }
        $this->units[] = $unit;
    }
}