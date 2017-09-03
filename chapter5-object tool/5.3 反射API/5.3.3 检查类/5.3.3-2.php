<?php
class ShopProduct
{
    // 商品的公有属性
    private $title;
    private $producerMainName;
    private $producerFirstName;
    protected $price;
    private $discount = 0;

    public function __construct($title, $firstName, $mainName, $price)
    {
        $this->title = $title;
        $this->producerFirstName = $firstName;
        $this->producerMainName = $mainName;
        $this->price = $price;
    }

    public function getProducerFirstName()
    {
        return $this->producerFirstName;
    }

    public function getProducerMainName()
    {
        return $this->producerMainName;
    }

    public function setDiscount($num)
    {
        $this->discount = $num;
    }

    public function getDiscount()
    {
        return $this->discount;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getPrice()
    {
        return $this->price - $this->discount;
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
    private $playLength = 0;

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
    private $numPages = 0;

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

    // 因为书籍商品类不能打折 所以直接返回$price
    public function getPrice()
    {
        return $this->price;
    }
}

class ShopProductWriter
{
    private $products = [];

    protected function addProduct( ShopProduct $shopProduct)
    {
        $this->products[] = $shopProduct;
    }

    public function write()
    {
        $str = '';
        foreach ( $this->products as $product)
        {
            $str .= $product->title;
            $str .= $product->getProducter();
            $str .= $product->getPrice();
            $str .= "\n";
        }
        echo $str;
    }
}

$prodClass = new ReflectionClass('CDProduct');

class ReflectionUtil
{
    public static function getClassSource(ReflectionClass $class)
    {
        $path = $class->getFileName();
        $lines = @file($path);
        $from = $class->getStartLine();
        $to = $class->getEndLine();
        $len = $to - $from + 1;
        // array_slice($arr, $start, $end) 从数组的$start位置开始取，直到$end位置为止。
        return implode(array_slice($lines, $from - 1, $len));
    }
}

var_dump(ReflectionUtil::getClassSource(new ReflectionClass('CDProduct')));
