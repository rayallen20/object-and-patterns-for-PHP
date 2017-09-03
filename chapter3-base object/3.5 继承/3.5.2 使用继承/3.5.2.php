<?php
class ShopProduct
{
    public $numPages;
    public $playLength;
    public $title;
    public $producerMainName;
    public $producerFirstName;
    public $price;

    public function __construct($title, $firstName, $producerMainName, $producerFirstName, $price, $numPages, $playLength)
    {
        $this->title = $title;
        $this->producerMainName = $producerMainName;
        $this->producerFirstName = $producerFirstName;
        $this->price = $price;
        $this->numPages = $numPages;
        $this->playLength = $playLength;
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

class CDProduct extends ShopProduct
{
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
}

class BookProduct extends ShopProduct
{
    public function getNumberOfPages()
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
}