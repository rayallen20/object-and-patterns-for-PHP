<?php
class RequestHelper{}

// 处理请求类
abstract class ProcessRequest
{
    public abstract function process(RequestHelper $req);
}

// 组件
class MainProcess extends ProcessRequest
{
    public  function process(RequestHelper $req)
    {
        echo __CLASS__.': doing something useful with request (这个类正在做一些对请求的处理)' . "\n";
    }
}

// 抽象装饰类
abstract class DecorateProcess extends ProcessRequest
{
    protected $processRequest;

    public function __construct(ProcessRequest $processRequest)
    {
        $this->processRequest = $processRequest;
    }
}

// 记录请求装饰者
class LogRequest extends DecorateProcess
{
    public  function process(RequestHelper $req)
    {
        echo __CLASS__ . ': logging request (正在记录请求)' . "\n";
        echo '<br/>';
        $this->processRequest->process($req);
    }
}

// 验证请求装饰者
class AuthenticateRequest extends DecorateProcess
{
    public  function process(RequestHelper $req)
    {
        echo __CLASS__ . ': authenticating request (正在验证请求)' . "\n";
        echo '<br/>';
        $this->processRequest->process($req);
    }
}

// 结构化请求装饰者
class StructureRequest extends DecorateProcess
{
    public  function process(RequestHelper $req)
    {
        echo __CLASS__ . ': structuring request data (正在结构化请求数据)' . "\n";
        echo '<br/>';
        $this->processRequest->process($req);
    }
}

$process = new StructureRequest(
    new AuthenticateRequest(
        new LogRequest(
            new MainProcess()
        )
    )
);
$process->process(new RequestHelper());
