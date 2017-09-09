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

// 创建者类 在本例中即为管理员类
class CommsManager
{
    public function getApptEncoder()
    {
        return new BloggsApptEncoder();
    }
}