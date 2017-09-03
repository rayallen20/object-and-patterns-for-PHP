<?php
// 基类
class ShopProduct
{
    public $title;
    public $producerMainName;
    public $producerFirstName;
    protected $price;
    public $discount;

    public function __construct($title, $firstName, $producerMainName, $producerFirstName, $price)
    {
        $this->title = $title;
        $this->producerMainName = $producerMainName;
        $this->producerFirstName = $producerFirstName;
        $this->price = $price;
    }

    public function getSummaryLine()
    {
        $base = (string)$this->title . ' ( ' . $this->producerMainName;
        $base .= $this->producerFirstName;
        return $base;
    }

    public function getProducer()
    {
        return $this->producerFirstName . $this->producerMainName;
    }

    public function setDiscount($num)
    {
        $this->discount = $num;
    }

    public function getPrice()
    {
        return $this->price - $this->discount;
    }
}