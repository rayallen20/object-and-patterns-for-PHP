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
    public function attach(Observer $observer);     // 绑定观察者到主体
    public function detach(Observer $observer);     // 解绑观察者和主体
    function notify();                               // 通知观察者事件发生
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
            /*
             * 如果$a 和 $b 是同一个类的2个不同实例,那么使用$a == $b来判断
             * $a 和 $b是否相等的条件为:
             * 1. $a 和 $b是否是同一个类的实例
             * 2. 他们的属性和值是否都相等
             * 如果满足这2个条件 则判定 $a == $b 为 true
             * 如果使用 $a === $b 则必须满足:
             * 1.当且仅当 $a 和 $b 引用的是同一个类的同一个实例时 $a === $b 为 true
             * */
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
        else
        {
            print __CLASS__ . "\tdon't need send mail\n";
        }
    }
}

/*
$manjor = new Login();

// 绑定"发送邮件"观察者到主体
$securityMonitor = new SecurityMonitor();
$manjor->attach($securityMonitor);

// 调用实现功能方法
$manjor->handleLogin('allenRay', '127.0.0.1');
*/
$login = new Login();
$login->attach(new SecurityMonitor());
$login->handleLogin('allenRay', '127.0.0.1');