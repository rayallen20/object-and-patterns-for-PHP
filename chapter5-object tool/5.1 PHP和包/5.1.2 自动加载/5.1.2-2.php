<?php
function className($className)
{
    require_once ("$className.php");
}

function className2()
{
    echo 'spl_autoload_register()方法第二次调用的函数';
}

// 如果把className2和className调换位置，则无法打印出className2的那句话
spl_autoload_register('className2');
spl_autoload_register('className');

$obj = new ShopProduct();