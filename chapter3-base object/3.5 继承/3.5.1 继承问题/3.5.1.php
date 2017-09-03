<?php
class ShopProduct
{
    // 书籍商品的页数属性
    public $numPages;
    // CD类商品的播放时长属性
    public $playLength;

    // 商品的公有属性
    public $title;
    public $producerMainName;
    public $producerFirstName;
    public $price;

    public function __construct($title, $firstName, $mainName, $price, $numPages=0, $playLength=0)
    {
        $this->title = $title;
        $this->producerFirstName = $firstName;
        $this->producerMainName = $mainName;
        $this->price = $price;
        $this->numPages = $numPages;
        $this->playLength = $playLength;
    }

    public function getNumberOfPages()
    {
        return $this->numPages;
    }

    public function getPlayLength()
    {
        return $this->playLength;
    }

    public function getProducer()
    {
        return $this->producerFirstName . $this->producerMainName;
    }
}