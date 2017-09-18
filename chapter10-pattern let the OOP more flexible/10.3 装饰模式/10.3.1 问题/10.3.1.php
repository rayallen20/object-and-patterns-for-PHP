<?php

/*
 * tile: n 瓷砖 瓦片 这里指区域 即游戏中的一个小方格
 * */
abstract class Tile
{
    /*
     * wealth: n 财富
     * factor: n 因素 要素
     * */
    public abstract function getWealthFactor();
}

/*
 * plain: n 平原
 * */
class Plains extends Tile
{
    private $wealthFactor = 2;

    public function getWealthFactor()
    {
        return $this->wealthFactor;
    }
}

// 钻石区域
class DiamondPlains extends Plains
{
    public function getWealthFactor()
    {
        return parent::getWealthFactor() + 2;
    }
}

// 被污染的区域
class PollutedPlains extends Plains
{
    public function getWealthFactor()
    {
        return parent::getWealthFactor() - 4;
    }
}
