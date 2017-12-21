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