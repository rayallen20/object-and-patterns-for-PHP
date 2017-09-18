<?php
class Product
{
    public $id;
    public $name;

    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }
}

function getProductFileLines($file)
{
    return file($file);
}

function getProductObjectFromId($id, $productName)
{
    // 一些数据库查询操作
    return new Product($id, $productName);
}

function getNameFromLine($line)
{
    if(preg_match("/.*-(.*)\s\d+/", $line, $array))
    {
        return str_replace('_', ' ', $array[1]);
    }
    return '';
}

function getIdFromLine($line)
{
    if(preg_match("/^(\d{1,3})-/", $line, $array))
    {
        return $array[1];
    }
    return -1;
}

// 负责调用过程式代码的接口
class ProductFacade
{
    private $products = [];

    public function __construct($file)
    {
        $this->file = $file;
        $this->compile();
    }

    private function compile()
    {
        $lines = getProductFileLines($this->file);
        foreach ($lines as $line)
        {
            $id = getIdFromLine($line);
            $name = getNameFromLine($line);
            $this->products[$id] = getProductObjectFromId($id, $name);
        }
    }

    public function getProducts()
    {
        return $this->products;
    }

    public function getProduct($id)
    {
        return $this->products[$id];
    }
}

// 新的客户端代码
$facade = new ProductFacade('./test.txt');
var_dump($facade->getProduct(234));
