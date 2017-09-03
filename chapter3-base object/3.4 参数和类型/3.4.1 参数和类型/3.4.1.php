<?php
class addressManager
{
    private $addresses = ['192.168.1.1', '127.0.0.1'];

    public function outputAddresses($resolve)
    {
        foreach ($this->addresses as $address)
        {
            // 此处 由于PHP5和PHP7的差异 会将字符串"false"解析为布尔值false
            if($resolve)
            {
                print "(" . gethostbyaddr($address) . ")";
            }
            print "\n";
        }
    }
}

$settings = simplexml_load_file("settings.xml");
$manager = new addressManager();
$manager->outputAddresses((string)$settings->resolve);