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

abstract class CommsManager
{
    const APPT = 1;
    const TTD = 2;
    const CONTACT = 3;
    abstract function getHeaderText();
    abstract function make($flagInt);
    abstract function getFooterText();
}

class BloggsCommsManager extends CommsManager
{
    public function getHeaderText()
    {
        return "BloggsCal header \n(BloggsCal数据格式的页眉)" . "<br/>";
    }

    public function make($flagInt)
    {
        switch ($flagInt)
        {
            case self::APPT:
                return new BloggsApptEncoder();
                break;
            case self::TTD:
                return new BloggsTtdEncoder();
                break;
            case self::CONTACT:
                return new BloggsContactEncoder();
                break;
        }
    }

    public function getFooterText()
    {
        return "BloggsCal footer \n(BloggsCal数据格式的页脚)" . "<br/>";
    }
}