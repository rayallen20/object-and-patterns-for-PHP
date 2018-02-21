<?php
// 抽象超类
abstract class Unit
{
    public function addUnit(Unit $unit)
    {
        throw new UnitException(get_class($this)."is a leaf (是叶子对象)");
    }

    public function removeUnit(Unit $unit)
    {
        throw new UnitException(get_class($this)."is a leaf (是叶子对象)");
    }
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

//异常类 供抛出异常用
class UnitException extends Exception
{
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
// 叶子类Archer
class Archer extends Unit
{
    public function bombardStrength()
    {
        return 4;
    }
}

// 叶子类LaserCannon
class LaserCannon extends Unit
{
    public function bombardStrength()
    {
        return 44;
    }
}

//客户端代码

// 创建一个Army对象
$mainArmy = new Army();

// 添加一些Unit
$mainArmy->addUnit(new Archer());
$mainArmy->addUnit(new LaserCannon());

// 创建一个新的Army对象
$subArmy = new Army();

// 给新的Army对象添加一些Unit
$subArmy->addUnit(new Archer());
$subArmy->addUnit(new Archer());
$subArmy->addUnit(new Archer());

// 把第二个Army对象添加到第一个Army对象中去
$mainArmy->addUnit($subArmy);

// 计算攻击力
echo $mainArmy->bombardStrength();

// 可以看到 组合结构的复杂性被隐藏起来了 从客户端的角度来看 只能看到一个计算攻击力方法
