<?php
// 定义接口
interface Chargeable
{
    public function getPrice();
}

// 实现接口
class ShopProduct implements Chargeable
{
    // 类常量属性
    const AVAILABLE = 0;
    const OUT_OF_STOCK = 1;
    // 商品的公有属性
    private $title;
    private $producerMainName;
    private $producerFirstName;
    protected $price;
    private $discount = 0;

    // DB中的ID
    private $id = 0;

    public function __construct($title, $firstName, $mainName, $price)
    {
        $this->title = $title;
        $this->producerFirstName = $firstName;
        $this->producerMainName = $mainName;
        $this->price = $price;
    }

    public function setId($id)
    {
        $this->id = $id;
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

    // 实现Chargeable接口的方法
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

    public static function getInstance($id, PDO $pdo)
    {
        $stmt = $pdo->prepare("SELECT * FROM `products` WHERE `id` = $id");
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        // 未查询到结果
        if(empty($row))
        {
            return null;
        }

        // 书籍商品类
        if($row['type'] == 'book')
        {
            $product = new BookProduct(
                $row['title'],
                $row['firstname'],
                $row['mainname'],
                $row['price'],
                $row['numpages']
            );
        }

        // CD商品类
        else if($row['type'] == 'cd')
        {
            $product = new CDProduct(
                $row['title'],
                $row['firstname'],
                $row['mainname'],
                $row['price'],
                $row['playlength']
            );
        }

        // 不是书籍商品类或CD商品类
        else
        {
            $product = new ShopProduct(
                $row['title'],
                $row['firstname'],
                $row['mainname'],
                $row['price']
            );
        }

        // 返回商品类
        $product->setId($row['id']);
        $product->setDiscount($row['discount']);
        return $product;
    }
}

// CD商品类
class CDProduct extends ShopProduct
{
    private $playLength = 0;

    public function __construct($title, $firstName, $mainName, $price, $playLength)
    {
        parent::__construct($title, $firstName, $mainName, $price);
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

    public function __construct($title, $firstName, $mainName, $price, $numPages)
    {
        parent::__construct($title, $firstName, $mainName, $price);
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

$pdo = new PDO("mysql:host=localhost;dbname=obj","root","");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->query("SET NAMES utf8");
$obj = ShopProduct::getInstance(1, $pdo);
var_dump($obj);
die;