<?php

namespace App\DBRepository\Contracts;

use Exception;

abstract class ModelDto
{
    public function toArray()
    {
        return array_filter( get_object_vars($this) );
    }

    public function __set($name, $value)
    {
        if (!property_exists($this, $name)) {
            throw new Exception('property mismatch. ' . get_class($this) . ' - ' . $name);
        }
        
        $this->{$name} = $value;
    }

    public function __get($name)
    {
        if (!property_exists($this, $name)) {
            throw new Exception('property mismatch. ' . get_class($this) . ' - ' . $name);
        }
        
        return $this->{$name};
    }
}
