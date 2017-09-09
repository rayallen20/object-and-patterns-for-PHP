<?php
class Sea{}
class EarthSea extends Sea{}
class MarsSea extends Sea{}

class Plains{}
class EarthPlains extends Plains{}
class MarsPlains extends Plains{}

class Forest{}
class EarthForest extends Forest{}
class MarsForest extends Forest{}

class TerrainFactory
{
    private $sea;
    private $forset;
    private $plains;

    public function __construct(Sea $sea, Plains $plains, Forest $forest)
    {
        $this->sea = $sea;
        $this->forset = $forest;
        $this->plains = $plains;
    }

    public function getSea()
    {
        return clone $this->sea;
    }

    public function getPlains()
    {
        return clone $this->plains;
    }

    public function getForest()
    {
        return clone $this->forset;
    }
}

$factory = new TerrainFactory(new EarthSea(), new EarthPlains(), new EarthForest());
var_dump($factory->getSea());
var_dump($factory->getPlains());
var_dump($factory->getForest());