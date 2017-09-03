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
    public static function warnAmount($amt)
    {
        $count = 0;
        return function ($product) use($amt, &$count){
            $count += $product->price;
            print " count: $count \n";
            if($count > $amt)
            {
                print "high price reached: {$count} \n";
            }
        };
    }
}

$processer = new ProcessSale();
$processer->registerCallback(Totalizer::warnAmount(7));
$processer->sale(new Product('shoes', 6));
print "\n";
$processer->sale(new Product('coffee', 6));