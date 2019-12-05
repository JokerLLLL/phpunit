<?php


namespace base;


class Subject
{
    private  $observers = [];
    public function attach(Observer $observer)
    {
        $this->observers[] = $observer;
    }

    public function notify($argument)
    {
        foreach ($this->observers as $observer)
        {
            $observer->update($argument);
        }
    }

}