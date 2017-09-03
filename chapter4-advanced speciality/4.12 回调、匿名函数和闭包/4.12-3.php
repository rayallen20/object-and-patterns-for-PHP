<?php
class Product
{
    public $name;
    public $price;

    public function __construct($name, $price)
    {
        $this->name = $name;
        $this->price = $price;
    }
}

class ProcessSale
{
    private $callbacks;

    public function registerCallback($callback)
    {
        if(!is_callable($callback))
        {
            throw new Exception('callback not callable');
        }
        $this->callbacks[] = $callback;
    }

    public function sale($product)
    {
        print "{$product->name}:processing \n";
        foreach ($this->callbacks as $callback)
        {
            call_user_func($callback, $product);
        }
    }
}

class Mailer
{
    public function doMail($product)
    {
        print " mailing ({$product->name}) \n";
    }
}

$processor = new ProcessSale();
$processor->registerCallback([new Mailer(), 'doMail']);

$processor->sale(new Product('shoes', 6));
$processor->sale(new Product('coffee', 6));
