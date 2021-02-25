<?php


namespace base;


class Myabc
{

    public static function getBool()
    {
        return true;
    }

    public function getRandNum($times)
    {
        return rand(0, $times);
    }

    public function test()
    {
        foreach ([10,100,1000] as $times){
            var_dump($this->getRandNum($times));
        }
    }

}