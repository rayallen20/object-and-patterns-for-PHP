<?php
// 创建一个抽象的基类来定义类型接口
abstract class ParamHandler
{
    protected $path;
    protected $params = [];
    
    public function __construct($path)
    {
        $this->path = $path;
    }
    
    public function addParam($key, $val)
    {
        $this->params[$key] = $val;
    }
    
    public function getAllParams()
    {
        return $this->params;
    }
    
    public static function getInstance($fileName)
    {
        if(preg_match("/.xml$/i",$fileName))
        {
            return new XmlParamHandler($fileName);
        }
        return new TextParamHandler($fileName);
    }

    public abstract function write();
    public abstract function read();
}

// 定义子类
class XmlParamHandler extends ParamHandler
{
    public function write()
    {
        // 写入XML文件
        // 使用$this->params
    }

    public function read()
    {
        // 读取XML文件
        // 并赋值给$this->params
    }
}

class TextParamHandler extends ParamHandler
{
    public function write()
    {
        // 写入文本文件
        // 使用$this->params
    }

    public function read()
    {
        // 读取文本文件
        // 并赋值给$this->params
    }
}

// 客户端代码
$test = ParamHandler::getInstance('./params.xml');
$test->addParam("key1","value1");
$test->addParam("key2","value2");
$test->addParam("key3","value3");
$test->write();

$test = ParamHandler::getInstance('./params.txt');
$test->read();