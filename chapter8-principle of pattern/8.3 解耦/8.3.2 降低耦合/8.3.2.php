<?php
require_once ("../../8.2 组合与继承/8.2.2 使用组合/8.2.2.php");
class RegistrationMgr
{
    public function register(Lesson $lesson)
    {
        // 处理该课程 例如添加到数据库等

        $notifier = Notifier::getNotifier();

        $notifier->inform("new lesson: cost(" . $lesson->cost() . ")");
    }
}

abstract class Notifier
{
    public static function getNotifier()
    {
        /*
         * 此处应该写的是根据业务逻辑和不同场景，返回不同的Notifier的实现。
         * 也就是说，场景A要返回MailerNotifier，场景B要返回TextNotifier。
         * 这个根据场景创建不同Notifier的实现的工作，如果要在系统内部完成，
         * 那么就会使系统对推送组件产生依赖。所以这个创建Notifier的实现的工作，
         * 应该由组件自己完成。
         *
         * 那么问题又来了。创建Notifier的实现这部分的代码应该放在哪儿是合适呢？
         * 答案是抽象类Notifier。因为这样系统(即这个组件的客户端代码)在调用时，可以不管
         * 它调用的是MailerNotifier的inform()方法还是TextNotifier的inform()方法，
         * 客户端代码只需要知道这个对象有inform()就可以了。这样就完全解除了系统和组件的耦合。
         * */
        if(rand(1,2) == 1)
        {
            return new MailerNotifier();
        }
        else
        {
            return new TextNotifier();
        }
    }

    public abstract function inform($message);
}

class MailerNotifier extends Notifier
{
    public function inform($message)
    {
        echo "MAIL notification: $message \n";
        echo '<br/>';
    }
}

class TextNotifier extends Notifier
{
    public function inform($message)
    {
        echo "TEXT notification: $message \n";
        echo '<br/>';
    }
}

$lesson1 = new Seminar(4, new TimedCostStrategy());
$lesson2 = new Lecture(4, new FixedCostStrategy());
$mgr = new RegistrationMgr();
$mgr->register($lesson1);
$mgr->register($lesson2);