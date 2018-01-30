<?php
// 主体类 需要实现SplSubject接口
class Login implements SplSubject
{
    private $storage;

    const LOGIN_USER_UNKNOWN = 1;
    const LOGIN_WRONG_PASS = 2;
    const LOGIN_ACCESS = 3;

    private $status = array();

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

    public function __construct()
    {
        $this->storage = new SplObjectStorage();
    }

    public function attach(SplObserver $observer)
    {
        $this->storage->attach($observer);
    }

    public function detach(SplObserver $observer)
    {
        $this->storage->detach($observer);
    }

    public function notify()
    {
        foreach ($this->storage as $obj)
        {
            $obj->update($this);
        }
    }
}

// 观察者抽象类 需要实现SplObserver接口
abstract class LoginObserver implements SplObserver
{
    private $login;

    public function __construct(Login $login)
    {
        $this->login = $login;
        $login->attach($this);
    }

    public function update(SplSubject $subject)
    {
        if($subject === $this->login)
        {
            $this->doUpdate($subject);
        }
    }

    abstract public function doUpdate(Login $login);
}

// 观察者抽象类的实现 发送邮件观察者类
class SecurityMonitor extends LoginObserver
{
    public function doUpdate(Login $login)
    {
        $status = $login->getStatus();
        if($status[0] == Login::LOGIN_WRONG_PASS || $status[0] == Login::LOGIN_USER_UNKNOWN)
        {
            echo __CLASS__ . "\t登录状态异常 给系统管理员发送邮件\n\r";
        }
    }
}

// 观察者抽象类的实现 记录IP观察者类
class GeneralLogger extends LoginObserver
{
    public function doUpdate(Login $login)
    {
        $status = $login->getStatus();
        echo __CLASS__ . "\t在日志文件中写入登录信息\n\r";
    }
}

// 观察者抽象类的实现 设置cookie观察者类
class PartnershipTool extends LoginObserver
{
    public function doUpdate(Login $login)
    {
        $status = $login->getStatus();
        echo __CLASS__ . "\t如果IP在登录列表中 则设置cookie\n\r";
    }
}

$login = new Login();
$login->handleLogin('allenRay', '127.0.0.1');
$securityMonitor = new SecurityMonitor($login);
$generalLogger = new GeneralLogger($login);
$partnershipTool = new PartnershipTool($login);
$securityMonitor->doUpdate($login);
$generalLogger->doUpdate($login);
$securityMonitor->doUpdate($login);