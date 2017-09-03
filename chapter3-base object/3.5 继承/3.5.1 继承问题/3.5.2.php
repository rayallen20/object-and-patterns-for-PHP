<?php
// CD商品类
class CDProduct
{
    public $playLength;
    public $title;
    public $producerMainName;
    public $producerFirstName;
    public $price;

    public function __construct($title, $firstName, $producerMainName, $producerFirstName, $price, $playLength)
    {
        $this->title = $title;
        $this->producerMainName = $producerMainName;
        $this->producerFirstName = $producerFirstName;
        $this->price = $price;
        $this->playLength = $playLength;
    }

    public function getPlayLength()
    {
        return $this->playLength;
    }

    public function getSummaryLine()
    {
        $base = (string)$this->title . ' ( ' . $this->producerMainName;
        $base .= $this->producerFirstName;
        $base .= ' : playing time - ' .$this->playLength;
        return $base;
    }

    public function getProducer()
    {
        return $this->producerFirstName . $this->producerMainName;
    }
}

// 书籍商品类
class BookProduct
{
    public $numPages;
    public $title;
    public $producerMainName;
    public $producerFirstName;
    public $price;

    public function __construct($title, $firstName, $producerMainName, $producerFirstName, $price, $numPages)
    {
        $this->title = $title;
        $this->producerMainName = $producerMainName;
        $this->producerFirstName = $producerFirstName;
        $this->price = $price;
        $this->numPages = $numPages;
    }

    public function getNumberPages()
    {
        return $this->numPages;
    }

    public function getSummaryLine()
    {
        $base = (string)$this->title . ' ( ' . $this->producerMainName;
        $base .= $this->producerFirstName;
        $base .= ' : page count - ' .$this->numPages;
        return $base;
    }

    public function getProducer()
    {
        return $this->producerFirstName . $this->producerMainName;
    }
}

// ShopWriter类
class ShopProductWriter
{
    public function write($shopProduct)
    {
        if(!($shopProduct instanceof CDProduct) && !($shopProduct instanceof  BookProduct))
        {
            die('wrong type supplied');
        }
        $str = $shopProduct->title . ' ' .
            $shopProduct->getProducer() . ' (' . $shopProduct->price . ') ';
        echo $str;
    }
}