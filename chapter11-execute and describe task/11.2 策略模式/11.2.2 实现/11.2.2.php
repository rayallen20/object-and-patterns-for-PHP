<?php
abstract class Question
{
    // prompt: n 提示
    protected $prompt;
    // 接收算法类的成员属性
    protected $marker;

    public function __construct($prompt, Marker $marker)
    {
        $this->marker = $marker;
        $this->prompt = $prompt;
    }

    public function mark($response)
    {
        return $this->marker->mark($response);
    }
}

// 处理文本问题的类
class TextQuestion extends Question
{
    // 处理文本问题特有的操作
}

// 处理多媒体问题的类
class AVQuestion extends Question
{
    // 处理多媒体问题特有的操作
}

// 统一接口基类
abstract class Marker
{
    protected $test;

    public function __construct($test)
    {
        // 问题的答案
        $this->test = $test;
    }

    public abstract function mark($response);
}

class MarkLogicMarker extends Marker
{
    private $engine;

    public function __construct($test)
    {
        parent::__construct($test);
        // $this->engine = new MarkParse($test);
    }

    public function mark($response)
    {
        // return $this->engine->evaluate($response);

        // 这个true只是模拟的返回值 因为MarkParse类和我们要讲述的策略模式
        // 本身没有太大关系
        return true;
    }
}

class MatchMarker extends Marker
{
    public function mark($response)
    {
        return $this->test == $response;
    }
}

class RegexpMarker extends Marker
{
    public function mark($response)
    {
        return (preg_match($this->test, $response));
    }
}

// 客户端代码
$markers = [
    new RegexpMarker("/f.ve/"),
    new MatchMarker("five"),
    new MarkLogicMarker('$input equals "five')
];

foreach ($markers as $marker)
{
    echo get_class($marker);
    echo '<br/>';
    $question = new TextQuestion("how many beans make five", $marker);
    foreach (["five", "four"] as $response)
    {
        echo "response: $response";
        if ($question->mark($response))
        {
            echo "well done";
            echo "<br/>";
        }
        else
        {
            echo "never mind";
            echo "<br/>";
        }
    }
}