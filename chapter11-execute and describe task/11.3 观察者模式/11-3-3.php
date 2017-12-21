<?php
/*
 * 在本例中，我们用rand()函数来模拟一个用户登录的过程和可能发生的结果。
 * */
class Login
{
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
        // 添加记录用户登录时的IP和状态功能
        Log::logIp($user, $ip, $this->status);

        // 添加登录失败时发送邮件功能
        if(!$ret)
        {
            Notifier::mailWarning($user, $ip, $this->status);
        }
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
}

// 记录日志类(模拟)
class Log
{
    public static function logIp($user, $ip, $status)
    {

    }
}

// 发送邮件类(模拟)
class Notifier
{
    public static function mailWarning($user, $ip, $status)
    {

    }
}
