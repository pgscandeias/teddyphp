<?php
namespace Common\Entity;

use Common\Component\Inflect;

abstract class Entity implements EntityInterface
{
    public function __construct($data = array())
    {
        if (!empty($data) && is_array($data)) {
            foreach ($data as $property => $value) {
                $this->__set($property, $value);
            }
        }
    }
    
    public function __set($property, $value)
    {
        $setter = 'set'.ucfirst($property);
        if (method_exists(get_called_class(), $setter)) {
            $this->$setter($value);
        }
        elseif (property_exists(get_called_class(), $property)) {
            $this->{$property} = $value;
        }
    }
    
    public function __get($property)
    {
        $getter = 'get'.ucfirst($property);
        $out = null;
        
        if (method_exists(get_called_class(), $getter)) {
            $out = $this->$getter();
        }
        elseif (property_exists(get_called_class(), $property)) {
            $out = $this->{$property};
        }
        
        return $out;
    }
    
    public function __call($method, $args)
    {
        if (substr($method, 0, 3) == 'add') {
            $collectionName = Inflect::pluralize(lcfirst(substr($method, 3)));
            if(property_exists(get_called_class(), $collectionName)) {
                $this->{$collectionName}[] = $args[0];
            }
        }
    }
    
    public function getFields()
    {
        $fields = array();
        foreach ($this as $field => $value) {
            $fields[] = $field;
        }
        
        return $fields;
    }
}