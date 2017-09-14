<?php
//战斗单元接口
abstract class Unit
{
    /*
     * bombard: v 轰炸
     * strength: n 力量
     * bombardStrength:攻击力
     * */
    public abstract function bombardStrength();
}

/*
 * archer: n 弓箭手
 * 战斗单元的实现:弓箭手类
 * */
class Archer extends Unit
{
    public function bombardStrength()
    {
        return 4;
    }
}

/*
 * laser: n 激光
 * cannon: n 大炮
 * 战斗单元的实现:激光炮类
 * */
class LaserCannonUnit extends Unit
{
    public function bombardStrength()
    {
        return 44;
    }
}

/*
 * army: n 军队
 * 军队类 用于组合战斗单元和军队
 * */
class Army
{
    private $units = [];
    private $armies = [];

    // 增加战斗单元
    public function addUnit(Unit $unit)
    {
        array_push($this->units, $unit);
    }

    // 增加部队
    public function addArmy(Army $army)
    {
        array_push($this->armies, $army);
    }

    // 这个组合战斗单元的攻击力
    public function bombardStrength()
    {
        $ret = 0;

        /*
         * Q: 这两个foreach为什么都没有走进来？
         * A: foreach不会遍历空数组
        */
        foreach ($this->units as $unit)
        {
            $ret += $unit->bombardStrength();
        }

        foreach ($this->armies as $army)
        {
            $ret += $army->bombardStrength();
        }

        return $ret;
    }
}
