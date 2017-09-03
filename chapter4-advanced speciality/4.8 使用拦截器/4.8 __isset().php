<?php
class Person
{
    /*
     * 打开这个注释 结果依旧为Bob 可以判定__get()对无法访问的属性也可以处理
     * private $name;
     * protected $name;
     * */
    public function __get($property)
    {
        $method = "get{$property}";
        if(method_exists($this, $method))
        {
            return $this->$method();
        }
    }

    public function __isset($property)
    {
        $method = "get{$property}";
        return (method_exists($this, $method));
    }

    public function getName()
    {
        return "Bob";
    }

    public function getAge()
    {
        return 44;
    }
}

$p = new Person();
if(isset($p->name))
{
    print $p->name;
}