<?php
class XmlException extends Exception
{
    private $error;

    public function __construct(LibXMLError $error)
    {
        $shortfile = basename($error->file);
        $msg = "[{$shortfile}, line{$error->line}, col {$error->column}]";
        $this->error = $error;
        parent::__construct($msg, $error->code);
    }

    public function getLibXmlError()
    {
        return $this->error;
    }
}

class FileException extends Exception
{

}

class ConfException extends Exception
{

}

// 自定义异常类的使用
class Conf
{
    private $file;
    private $xml;
    private $lastmatch;

    public function __construct($file)
    {
        $this->file = $file;
        // 文件不存在 抛出异常
        if(!file_exists($file))
        {
            throw new FileException(" file '$file' does not exist");
        }
        $this->xml = simplexml_load_file($file, null, LIBXML_NOERROR);

        if(!is_object($this->xml))
        {
            throw new XmlException(libxml_get_last_error());
        }
        print gettype($this->xml);

        $matches = $this->xml->xpath("/conf");

        if(! count($matches))
        {
            throw new ConfException("could not find root element: conf");
        }
    }

    public function write()
    {
        // 文件不可写 抛出异常
        if(! is_writable($this->file))
        {
            throw new FileException("file '$this->file' is not writeable");
        }
        file_put_contents($this->file, $this->xml->asXML());
    }

    public function get($str)
    {
        $matches = $this->xml->xpath("/conf/item[@name\"$str\"]");
        if(count($matches))
        {
            $this->lastmatch = $matches[0];
            return (string)$matches[0];
        }
        return null;
    }

    public function set($key, $value)
    {
        if(!is_null( $this->get($key)))
        {
            $this->lastmatch[0] = $value;
            return ;
        }
        $conf = $this->xml->conf;
        $this->xml->addChild('item', $value)->addAttribute('name', $key);
    }
}

// 如何使用抛出异常呢？
class Runner
{
    public static function init()
    {
        try
        {
            $conf = new Conf(dirname(__FILE__)."/conf01.xml");
            print "user: ".$conf->get('user')."\n";
            print "host: ".$conf->get('host')."\n";
            $conf->set('pass','newpass1');
            $conf->write();
        }
        catch (FileException $e)
        {
            // 文件权限问题或文件不存在
        }
        catch(XmlException $e)
        {
            // XML文件损坏
        }
        catch(ConfException $e)
        {
            // 错误的XML文件格式
        }
        catch( Exception $e)
        {
            // 备用异常 正常情况下不应该被调用
        }
    }
}