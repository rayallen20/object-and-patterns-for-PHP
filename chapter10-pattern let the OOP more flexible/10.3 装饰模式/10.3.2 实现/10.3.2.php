<?php
abstract class Tile
{
    public abstract function getWealthFactor():int;
}

class Plains extends Tile
{
    private $wealthFactor = 2;

    public function getWealthFactor():int
    {
        return $this->wealthFactor;
    }
}

abstract class TileDecorator extends Tile
{
    protected $tile;

    // Decorator类会持有另一个类的实例
    public function __construct(Tile $tile)
    {
        $this->tile = $tile;
    }
}

class DiamondDecorator extends TileDecorator
{
    // Decorator对象会实现和被调用对象的方法相对应的类方法
    public  function getWealthFactor():int
    {
        return $this->tile->getWealthFactor() + 2;
    }
}

class PollutedDecorator extends TileDecorator
{
    // Decorator对象会实现和被调用对象的方法相对应的类方法
    public  function getWealthFactor():int
    {
        return $this->tile->getWealthFactor() - 4;
    }
}

$tile = new Plains();
echo $tile->getWealthFactor();

echo '<br/>';

$tile = new DiamondDecorator(new Plains());
echo $tile->getWealthFactor();

echo '<br/>';

$tile = new PollutedDecorator(new DiamondDecorator(new Plains()));
echo $tile->getWealthFactor();