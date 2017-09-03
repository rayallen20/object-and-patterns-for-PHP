<?php
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
            throw new Exception(" file '$file' does not exist");
        }
        $this->xml = simplexml_load_file($file);
    }

    public function write()
    {
        // 文件不可写 抛出异常
        if(! is_writable($this->file))
        {
            throw new Exception("file '$this->file' is not writeable");
        }
        file_put_contents($this->file, $this->xml->asXML());
    }

    public function get($str)
    {
        $matches = $this->xml->xpath("\conf\item[@name\"$str\"]");
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