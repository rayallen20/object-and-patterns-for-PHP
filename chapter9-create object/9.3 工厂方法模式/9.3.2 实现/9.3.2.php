<?php
// 编码器接口
abstract class ApptEncoder
{
    public abstract function encode();
}

// 编码器接口的实现--BloggsApptEncoder
class BloggsApptEncoder extends ApptEncoder
{
    public function encode()
    {
        return "Appointment data encoded in BloggsCal format \n(预约数据被编码为BloggsCal数据格式)" .'<br/>';
    }
}

// 编码器接口的实现--MegaApptEncoder
class MegaApptEncoder extends ApptEncoder
{
    public function encode()
    {
        return "Appointment data encoded in MegaCal format \n(预约数据被编码为MegaCal数据格式)" . "<br/>";
    }
}

// 创建者类接口 在本例中即为管理员类
abstract class CommsManager
{
    public abstract function getHeaderText();
    public abstract function getApptEncoder();
    public abstract function getFooterText();
}

// 创建者类接口的实现--BloggsCommsManager 和产品子类 BolggsApptEncoder类是1对1的
class BloggsCommsManager extends CommsManager
{
    public function getHeaderText()
    {
        return "BloggsCal header \n(BloggsCal数据格式的页眉)" . "<br/>";
    }

    public function getApptEncoder()
    {
        return new BloggsApptEncoder();
    }

    public function getFooterText()
    {
        return "BloggsCal footer \n(BloggsCal数据格式的页脚)" . "<br/>";
    }
}

// 创建者类接口的实现--MegaCommsManager 和产品子类 MegaApptEncoder类是1对1的
class MegaCommsManager extends CommsManager
{
    public function getHeaderText()
    {
        return "MegaCal header \n(MegaCal数据格式的页眉)" . "<br/>";
    }

    public function getApptEncoder()
    {
        return new MegaApptEncoder();
    }

    public function getFooterText()
    {
        return "MegaCal footer \n(MegaCal数据格式的页脚)" . "<br/>";
    }
}