<?php
abstract class DomainObject
{
    public static function create()
    {
        /*
         * 此处 如果写成下面的 new self()
         * 则代码会被解析为要实例化一个抽象类DomainObject 会报错
         * 写成static 就会像我们期望的那样 根据调用这个方法的类的不同 而实例化不同的类的对象
         * 这说明 self的指代 是死的 self写在哪就指代哪个类
         * 而 static 是活的 哪个类调用了static所在的方法 static就指代哪个类
        return new self();
        */
        return new static();
    }
}

class User extends DomainObject
{

}

class Document extends DomainObject
{

}

var_dump(User::create());
var_dump(Document::create());