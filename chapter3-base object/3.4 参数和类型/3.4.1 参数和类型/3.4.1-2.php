<?php
class addressManager
{
    private $addresses = ['192.168.1.1', '127.0.0.1'];

    public function outputAddresses($resolve)
    {
        foreach ($this->addresses as $address)
        {
            print $address;
            if(is_string($resolve))
            {
                // 使用正则表达式匹配$resolve的值 如果$resolve是字符串"false" "no" "off"中的一种
                // 则$resolve的值为布尔值false,否则为布尔值true
                $resolve = preg_match("/false|no|off/i",$resolve)? false:true;
            }
            if($resolve)
            {
                print "(" . gethostbyaddr($address) . ")";
                print "\n";
            }
        }
    }
}

$settings = simplexml_load_file("settings.xml");
$manager = new addressManager();
$manager->outputAddresses((string)$settings->resolve);