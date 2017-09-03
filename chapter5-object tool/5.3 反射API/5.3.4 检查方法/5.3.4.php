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

function methodData(ReflectionMethod $method)
{
    $details = " ";

    // 获取方法名
    $name = $method->getName();

    // 是否用户定义方法
    if($method->isUserDefined())
    {
        $details .= "$name is user defined \n";
    }

    // 是否内置方法
    if($method->isInternal())
    {
        $details .= "$name is built-in \n";
    }

    // 是否抽象方法
    if($method->isAbstract())
    {
        $details .= "$name is abstract \n";
    }

    // 方法是否被声明为public
    if($method->isPublic())
    {
        $details .= "$name is public \n";
    }

    // 方法是否被声明为protected
    if($method->isProtected())
    {
        $details .= "$name is protected \n";
    }

    // 方法是否被声明为private
    if($method->isPrivate())
    {
        $details .= "$name is private \n";
    }

    // 方法是否被声明为static
    if($method->isStatic())
    {
        $details .= "$name is static \n";
    }

    // 方法是否被声明为final
    if($method->isFinal())
    {
        $details .= "$name is final \n";
    }

    // 方法是否是构造方法
    if($method->isConstructor())
    {
        $details .= "$name is the constructor \n";
    }

    // 方法是否返回引用
    if($method->returnsReference())
    {
        $details .= "$name returns a reference (as opposed to a value) \n";
    }
    return $details;
}

$prodClass = new ReflectionClass('CDProduct');
$methodArr = $prodClass->getMethods();

foreach ($methodArr as $method)
{
    echo methodData($method);
    echo "<br/> ---- <br/>";
}
