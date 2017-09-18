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

// 调用方法
$lines = getProductFileLines('./test.txt');
$objects = [];
foreach ($lines as $line)
{
    $id = getIdFromLine($line);
    $name = getNameFromLine($line);
    $objects[$id] = getProductObjectFromId($id, $name);
}
var_dump($objects);
