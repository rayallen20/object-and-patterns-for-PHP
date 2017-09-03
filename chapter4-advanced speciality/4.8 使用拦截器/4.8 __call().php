<?php
class PersonWriter
{
    public function writeName(Person $p)
    {
        print $p->getName()."\n";
    }

    public function writeAge(Person $p)
    {
        print $p->getAge()."\n";
    }
}

class Person
{
    private $writer;

    public function __construct(PersonWriter $writer)
    {
        $this->writer = $writer;
    }

    public function __call($methodName, $args)
    {
        if(method_exists($this->writer, $methodName))
        {
            return $this->writer->$methodName($this);
        }
    }

    public function getName()
    {
        return 'Bob';
    }

    public function getAge()
    {
        return 44;
    }
}

$person = new Person(new PersonWriter());
$person->writeName();