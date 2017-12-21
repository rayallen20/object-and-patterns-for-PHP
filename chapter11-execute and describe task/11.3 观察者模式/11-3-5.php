<?php

/*
 * attach
 * vt. 使依附；贴上；系上；使依恋
 * vi. 附加；附属；伴随
 *
 * detach
 * vt. 分离；派遣；使超然
 *
 * observable
 * adj. 显著的；觉察得到的；看得见的
 * n. [物] 可观察量；感觉到的事物
 * */

/**
 * 主体类接口
*/
interface Observable
{
    public function attach(Observer $observer);
    public function detach(Observer $observer);
    function notify();
}

/**
 * 主体类
*/
class Login implements Observable
{
    const LOGIN_USER_UNKNOWN = 1;
    const LOGIN_WRONG_PASS = 2;
    const LOGIN_ACCESS = 3;

    private $status = array();
    private $observers;

    public function __construct()
    {
        // TODO: 既然$observers一定是个数组 为什么不直接在定义$observers中 定义这个变量是个空数组呢？
        $this->observers = array();
    }

    public function handleLogin($user, $ip)
    {
        switch (rand(1, 3))
        {
            case 1:
                $this->setStatus(self::LOGIN_ACCESS, $user, $ip);
                $ret = true;
                break;
            case 2:
                $this->setStatus(self::LOGIN_WRONG_PASS, $user, $ip);
                $ret = false;
                break;
            case 3:
                $this->setStatus(self::LOGIN_USER_UNKNOWN, $user, $ip);
                $ret = false;
                break;
            default:
                $ret = false;
        }
        $this->notify();
        return $ret;
    }

    private function setStatus($status, $user, $ip)
    {
        $this->status = array($status, $user, $ip);
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function attach(Observer $observer)
    {
        $this->observers[] = $observer;
    }

    public function detach(Observer $observer)
    {
        $newObservers = array();
        foreach ($this->observers as $obs)
        {
            // 此处 判断的是$obs和$observer中承载的是不是同1个类的同1个实例
            if($obs !== $observer)
            {
                $newObservers[] = $observer;
            }
        }
        $this->observers = $newObservers;
    }

    public function notify()
    {
        foreach ($this->observers as $obs)
        {
            $obs->update($this);
        }
    }
}

/**
 * 观察者类接口
*/
interface Observer
{
    public function update(Observable $observable);
}

/**
 * 观察者类的抽象类
*/
abstract class LoginObserver implements Observer
{
    private $login;

    public function __construct(Login $login)
    {
        $this->login = $login;
        $login->attach($this);
    }

    public function update(Observable $observable)
    {
        if($observable === $this->login)
        {
            self::doUpdate($observable);
        }
    }

    abstract function doUpdate(Login $login);
}
/**
 * 观察者类-发送邮件
 * monitor
 * n. 监视器；监听器；监控器；显示屏；班长
 * vt. 监控
*/
class SecurityMonitor implements Observer
{
    public function update(Observable $observable)
    {
        // 这里 就有一个问题:你作为一个观察者类，你怎么知道主体类接口的实现一定存在getStatus()方法？
        $status = $observable->getStatus();
        if($status[0] == Login::LOGIN_WRONG_PASS || $status[0] == Login::LOGIN_USER_UNKNOWN)
        {
            print __CLASS__ . "\tsending mail to sysadmin\n";
        }
    }
}
