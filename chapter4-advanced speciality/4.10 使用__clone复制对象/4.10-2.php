<?php
class Account
{
    public $balance;

    public function __construct($balance)
    {
        $this->balance = $balance;
    }
}

class Person
{
    private $name;
    private $age;
    private $id;
    public $account;

    public function __construct($name, $age, Account $account)
    {
        $this->name = $name;
        $this->age = $age;
        $this->account = $account;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function __clone()
    {
        $this->id = 0;
        // 不希望对象属性在被复制之后共享 显式的在__clone方法中复制指向的对象
        $this->account = clone $this->account;
    }
}

$person = new Person('bob', 44, new Account(200));
$person->setId(343);
$person2 = clone $person;

// 给person充一些钱
$person->account->balance += 10;

// 问题:给$person充了10块， $person2也得到了这10块，这不合理。
var_dump($person);
var_dump($person2);
die;