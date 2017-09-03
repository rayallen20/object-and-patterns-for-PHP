<?php
abstract class ShopProductWriter
{
    protected $products = array();

    public function addProduct(ShopProduct $shopProduct)
    {
        $this->products[] = $shopProduct;
    }

    // 抽象方法
    abstract public function write();
}

// 继承抽象类的子类 必须实现抽象类中的抽象方法
class XmlProductWriter extends ShopProductWriter
{
    public function write()
    {
        $str = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
        $str .= "<products>\n";
        foreach ($this->products as $shopProduct)
        {
            $str .= "\t <product title=\"{$shopProduct->getTitle()}\">\n";
            $str .= "\t\t<summary>\n";
            $str .= "\t\t{$shopProduct->getSummaryLine()}\n";
            $str .= "\t\t</summary>\n";
            $str .= "\t</product>\n";
        }
        $str .= "</products>\n";
        print $str;
    }
}

class TextProductWriter extends ShopProductWriter
{
    public function write()
    {
        $str = "PRODUCTS:\n";
        foreach ($this->products as $shopProduct)
        {
            $str .= $shopProduct->getSummaryLine()."\n";
        }
        print $str;
    }
}