<?php
// 预约接口
abstract class ApptEncoder
{
    public abstract function encode();
}

// 预约实现--BloggsApptEncoder
class BloggsApptEncoder extends ApptEncoder
{
    public function encode()
    {
        return "Appointment data encoded in BloggsCal format \n(预约数据被编码为BloggsCal数据格式)" .'<br/>';
    }
}

// 预约实现--MegaApptEncoder
class MegaApptEncoder extends ApptEncoder
{
    public function encode()
    {
        return "Appointment data encoded in MegaCal format \n(预约数据被编码为MegaCal数据格式)" . "<br/>";
    }
}

// 待办事项接口
abstract class TtdEncoder
{
    public abstract function encode();
}

// 待办事项实现--BloggsTtdEncoder
class BloggsTtdEncoder extends TtdEncoder
{
    public function encode()
    {
        return "Ttd data encoded in BloggsCal format \n(待办事项数据被编码为BloggsCal数据格式)" .'<br/>';
    }
}

// 待办事项实现--MegaTtdEncoder
class MegaTtdEncoder extends TtdEncoder
{
    public function encode()
    {
        return "Ttd data encoded in MegaCal format \n(待办事项数据被编码为MegaCal数据格式)" . "<br/>";
    }
}

// 联系人接口
abstract class ContactEncoder
{
    public abstract function encode();
}

// 联系人实现--BloggsContactEncoder
class BloggsContactEncoder extends ContactEncoder
{
    public function encode()
    {
        return "Contact data encoded in BloggsCal format \n(联系人数据被编码为BloggsCal数据格式)" .'<br/>';
    }
}

// 联系人实现--MegaContactEncoder
class MegaContactEncoder extends ContactEncoder
{
    public function encode()
    {
        return "Contact data encoded in MegaCal format \n(联系人数据被编码为MegaCal数据格式)" . "<br/>";
    }
}

// 抽象工厂
abstract class CommsManager
{
    public abstract function getHeaderText();
    public abstract function getApptEncoder();
    public abstract function getTtdEncoder();
    public abstract function getContactEncoder();
    public abstract function getFooterText();
}

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

    public function getTtdEncoder()
    {
        return new BloggsTtdEncoder();
    }

    public function getContactEncoder()
    {
        return new BloggsContactEncoder();
    }

    public function getFooterText()
    {
        return "BloggsCal footer \n(BloggsCal数据格式的页脚)" . "<br/>";
    }
}

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

    public function getTtdEncoder()
    {
        return new MegaTtdEncoder();
    }

    public function getContactEncoder()
    {
        return new MegaContactEncoder();
    }

    public function getFooterText()
    {
        return "MegaCal footer \n(MegaCal数据格式的页脚)" . "<br/>";
    }
}
