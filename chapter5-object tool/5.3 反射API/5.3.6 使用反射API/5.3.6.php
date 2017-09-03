<?php
/*
 * 需求:我们现在需要这样一个类:
 * 1. 能动态调用Module对象
 * 2. 这个类可以自由加载第三方插件 而不需要把第三方代码硬编码进原有的代码中
 * 该如何做？
 * */

class Person
{
    public $name;
    public function __construct($name)
    {
        $this->name = $name;
    }
}

interface Module
{
    /*
     * Module的每个实现都必须有一个execute()方法
     * 目的:加载第三方插件
     * */

    public function execute();
}

/*
 * 之所以每个方法都以set开头，是为了方便从XML文件中读取属性，
 * 并根据这个属性的名称去调用方法
 * 系统规定:所有setFoo()方法必须带有单个参数:字符串或可以用字符串参数来实例化的对象
 * */
class FtpModule implements Module
{
    public function setHost($host)
    {
        echo "FtpModule::setHost():$host\n";
    }

    public function setUser($user)
    {
        echo "FtpModule::setUser():$user\n";
    }

    public function execute()
    {
        // 执行FtpModule的操作
    }
}

class PersonModule implements Module
{
    public function setPerson(Person $person)
    {
        echo "PersonModule::setPerson():{$person->name}\n";
    }

    public function execute()
    {
        // 执行PersonModule的操作
    }
}

/*
 * ModuleRunner类 用于调用FtpModule和PersonModule类
 * */
class ModuleRunner
{
    private $configData = [
        "PersonModule" => ['person' => 'bob'],
        "FtpModule" => [
            'host' => 'example.com',
            'user' => 'anon'
        ]
    ];

    private $modules = [];

    // init()方法:用于创建正确的Module对象
    public function init()
    {
        $interface = new ReflectionClass('Module');
        foreach ($this->configData as $moduleName => $params)
        {
            $moduleClass = new ReflectionClass($moduleName);

            // 检测模块是否为Module接口的实现
            if(!$moduleClass->isSubclassOf($interface))
            {
                throw new Exception("unknown module type: $moduleName");
            }

            // newInstance():接收任意个数的参数，并传递给类的构造方法，以便实例化该类的对象
            $module = $moduleClass->newInstance();
            foreach ($moduleClass->getMethods() as $method)
            {
                $this->handleMethod($module, $method, $params);
            }
            array_push($this->modules, $module);
        }
    }

    // handleMethod():检验并调用Module对象的setFoo()方法
    private function handleMethod(Module $module, ReflectionMethod $method, $params)
    {
        // 方法名
        $name = $method->getName();
        // 所需参数
        $args = $method->getParameters();

        // 检验方法是否合法(方法的参数是否是一个 且方法是否以"set"开头)
        if(count($args) != 1 || substr($name, 0 , 3) != "set")
        {
            return false;
        }

        // 检验要调用的方法所需的实参是否存在
        $property = strtolower(substr($name, 3));
        if(!isset($params[$property]))
        {
            return false;
        }

        $argClass = $args[0]->getClass();
        // 如果这个参数没有被声明类型 则直接调用
        if(empty($argClass))
        {
            $method->invoke($module, $params[$property]);
        }
        // 否则 先实例化这个类 再将这个对象作为参数传递给invoke()
        else
        {
            $method->invoke($module, $argClass->newInstance($params[$property]));
        }
    }
}

$test = new ModuleRunner();
$test->init();