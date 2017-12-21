<?php
$a = 2;
$b = '2';

if($a != $b)
{
    echo 'int2 不等于 string2';
    echo '<br/>';
}

if($a !== $b)
{
    echo 'int2 强不等于 string2';
    echo '<br/>';
}

class A
{

}

$a = new A();
$b = new A();

if($a != $b)
{
    echo '类A的实例$a 和 类B的实例$b !=';
    echo '<br/>';
}

// 即:在2个变量承载的都是同1个类的实例时 !==判断的是这2个变量是否承载的是相同的实例 而不是同1个类的2个不同实例
if($a !== $b)
{
    echo '类A的实例$a 和 类B的实例$b !==';
    echo '<br/>';
}