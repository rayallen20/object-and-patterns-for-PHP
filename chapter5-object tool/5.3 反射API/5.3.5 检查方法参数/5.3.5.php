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

function argData(ReflectionParameter $arg)
{
    $details = " ";

    $declaringClass = $arg->getDeclaringClass();

    // getName():返回参数的变量名
    $name = $arg->getName();

    // 如果参数有对象类型提示 则getClass()方法返回一个ReflectionClass对象
    $class = $arg->getClass();

    // getPosition():返回这个参数在方法的形参列表的位置 从0开始计算
    $position = $arg->getPosition();
    $details .= "\$$name has position $position \n";
    if(!empty($class))
    {
        $className = $class->getName();
        $details .= "\$$name must be a $className object \n";
    }

    // isPassedByReference():检测参数是否为引用
    if($arg->isPassedByReference())
    {
        $details .= "\$$name is passed by reference \n";
    }

    // 检测参数是否有默认值
    if($arg->isDefaultValueAvailable())
    {
        $def = $arg->getDefaultValue();
        $details .= "\$$name has default: $def \n";
    }

    return $details;
}


$prodClass = new ReflectionClass('CDProduct');
$method = $prodClass->getMethod('__construct');
$paramsConstruct = $method->getParameters();

foreach ($paramsConstruct as $parameter)
{
    echo argData($parameter);
    echo '<br/>';
}