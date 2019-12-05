<?php


namespace base;


class Observer
{
    private $name;

    public function __construct($name = '')
    {
        $this->name = $name;
    }

    public function update($argument)
    {
        return true;
    }
    public function delete($argument)
    {
        return true;
    }
}