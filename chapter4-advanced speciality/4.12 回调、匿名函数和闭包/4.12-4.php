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

class Totalizer
{
    public static function warnAmount()
    {
        return function ($product){
            if($product->price > 5)
            {
                print "reached high price: {$product->price} \n";
            }
        };
    }
}

$processer = new ProcessSale();
$processer->registerCallback(Totalizer::warnAmount());
$processer->sale(new Product('shoes', 6));
$processer->sale(new Product('coffee', 6));