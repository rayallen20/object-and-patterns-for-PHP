<?php
require_once '../../3.3 使用方法/3.3-1 UseConstructFunction.php';

// 设 类shopProductWriter 中有一个方法 接收shopProduct类的对象
class ShopProductWriter
{
    public function write($shopProduct)
    {
        $str = $shopProduct->title . ' ' .
            $shopProduct->getProducer() . ' (' . $shopProduct->price . ') ';
        echo $str;
    }
}

$product1 = new ShopProduct('My Antonia', 'Willa', 'Cather', 5.99);
$writer = new ShopProductWriter();
$writer->write($product1);