<?php
class Preferences
{
    private $props = [];

    // 由于构造方法被设置为了private 所以无法从外部实例化Preferences对象
    private function __construct(){}

    public function setProperty($key, $val)
    {
        $this->props[$key] = $val;
    }

    public function getProperty($key)
    {
        return $this->props[$key];
    }
}