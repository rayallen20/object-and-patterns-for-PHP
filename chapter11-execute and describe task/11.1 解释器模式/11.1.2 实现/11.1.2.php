<?php
abstract class Expression
{
    private static $keyCount = 0;
    private $key;

    public abstract function interpret(InterpreterContext $context);

    public function getKey()
    {
        if(!isset($this->key))
        {
            self::$keyCount++;
            $this->key = self::$keyCount;
        }
        return $this->key;
    }
}

class LiteralExpression extends Expression
{
    private $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function interpret(InterpreterContext $context)
    {
        $context->replace($this, $this->value);
    }
}

class InterpreterContext
{
    private $expressionStore = [];

    public function replace(Expression $exp, $value)
    {
        $this->expressionStore[$exp->getKey()] = $value;
    }

    public function lookUp(Expression $exp)
    {
        return $this->expressionStore[$exp->getKey()];
    }
}

$context = new InterpreterContext();
$literal = new LiteralExpression('four');
$literal->interpret($context);
echo $context->lookUp($literal);