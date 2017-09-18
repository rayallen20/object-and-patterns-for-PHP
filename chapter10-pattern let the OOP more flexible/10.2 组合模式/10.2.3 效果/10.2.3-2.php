<?php
class UnitScript
{
    public static function joinExisting(Unit $newUnit, Unit $occupyingUnit)
    {
        // 如果getComposite()方法返回的不是null 那么说明原先是个组合对象
        // 直接把新的单位放入组合对象中即可
        if(!is_null($comp = $occupyingUnit->getComposite()))
        {
            $comp->addUnit($newUnit);
        }
        // 如果是空 说明原先就是个叶子对象 需要把两个叶子对象放入到一个组合对象中
        else
        {
            $comp = new Army();
            $comp->addUnit($newUnit);
            $comp->addUnit($occupyingUnit);
        }
        return $comp;
    }
}
