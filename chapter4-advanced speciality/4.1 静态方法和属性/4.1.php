<?php
// 静态属性和静态方法的定义和使用
class StaticExample
{
    public static $aNum = 0;
    public static function sayHello()
    {
        // 在当前类中访问静态方法或属性 self关键字
        self::$aNum++;
        print 'Hello' . self::$aNum;
    }
}

// 使用
StaticExample::$aNum;
StaticExample::sayHello();