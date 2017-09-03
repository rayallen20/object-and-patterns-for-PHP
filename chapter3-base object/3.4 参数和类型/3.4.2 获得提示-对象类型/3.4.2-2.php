<?php
require_once '../../3.3 使用方法/3.3-1 UseConstructFunction.php';

class ShopProductWriter
{
    // 类型提示:强制规定参数是指定的类的实例
    public function write( ShopProduct $shopProduct)
    {
        $str = $shopProduct->title . ' ' .
            $shopProduct->getProducer() . ' (' . $shopProduct->price . ') ';
        echo $str;
    }
}

class Wrong
{

}

$product1 = new Wrong();
$writer = new ShopProductWriter();
$writer->write($product1);