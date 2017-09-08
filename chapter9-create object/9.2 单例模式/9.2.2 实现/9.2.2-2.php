<?php
class Preferences
{
    private $props = [];
    private static $instance;

    // 由于构造方法被设置为了private 所以无法从外部实例化Preferences对象
    private function __construct(){}

    public static function getInstance()
    {
        if(empty(self::$instance))
        {
            self::$instance = new Preferences();
        }
        return self::$instance;
    }

    public function setProperty($key, $val)
    {
        $this->props[$key] = $val;
    }

    public function getProperty($key)
    {
        return $this->props[$key];
    }
}

$pref = Preferences::getInstance();
$pref->setProperty('name', 'matt');
/*
 * 此处的unset($pref)，只是释放变量，但并没有把Preferences类的静态属性$instance中
 * 持有的Preferences类的对象实例释放掉，因而在下面$pref2调用getInstance()方法时，
 * 得到的是同一个Preferences对象
 * */
unset($pref);

$pref2 = Preferences::getInstance();
echo $pref2->getProperty('name');