<?php
// 场景:该类需要把自身的信息写入数据库 使用destruct()方法在对象实例被删除时
// 确保实例把自己保存到了数据库中
class Person
{
    private $name;
    private $age;
    private $id;

    public function __construct($name, $age)
    {
        $this->name = $name;
        $this->age = $age;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function __destruct()
    {
        if(! empty($this->id))
        {
            print "saving person\n";
        }
    }
}

$person = new Person('Bob', 44);
$person->setId(433);
unset($person);