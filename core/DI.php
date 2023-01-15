<?php

class DI
{

    private $service = array();
    
    public function __get($object)
    {
        return $this->factory($object);
    }
    
    public function factory($object, $alias = null, $args = null)
    {
        if(empty($this->service[$alias ?: $object])) $this->service[$alias ?: $object] = is_array($args) ? new $object(...$args) : new $object($this);
        return $this->service[$alias ?: $object];
    }

    public function kill($instance)
    {
        if (!empty($this->service[$instance])) unset($this->service[$instance]);
    }
}