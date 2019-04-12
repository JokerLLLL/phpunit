<?php


namespace base;


class DataTeller
{
    public  $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function getData($isString)
    {
        if(empty($this->data)) {
            throw new \Exception('data is not init!');
        }
        if($isString) {
            return date('Y-m-d H:i:s',$this->data);
        }
        return $this->data;
    }
}