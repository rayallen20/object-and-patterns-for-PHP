<?php
// 基类
class ShopProduct
{
    public $title;
    public $producerMainName;
    public $producerFirstName;
    public $price;

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
}

// CD商品类
class CDProduct extends ShopProduct
{
    public $playLength;
    public function __construct($title, $firstName, $producerMainName, $producerFirstName, $price, $playLength)
    {
        parent::__construct($title, $firstName, $producerMainName, $producerFirstName, $price);
        $this->playLength = $playLength;
    }

    public function getPlayLength()
    {
        return $this->playLength;
    }

    public function getSummaryLine()
    {
        $base = parent::getSummaryLine();
        $base .= ' : playing time - ' .$this->playLength;
        return $base;
    }
}

// 书籍商品类
class BookProduct extends ShopProduct
{
    public $numPages;

    public function __construct($title, $firstName, $producerMainName, $producerFirstName, $price, $numPages)
    {
        parent::__construct($title, $firstName, $producerMainName, $producerFirstName, $price);
        $this->numPages = $numPages;
    }

    public function getNumberOfPages()
    {
        return $this->numPages;
    }

    public function getSummaryLine()
    {
        $base = parent::getSummaryLine();
        $base .= ' : page count - ' .$this->numPages;
        return $base;
    }
}