<?php

class Application_Model_Property
{
    protected $_name;

    protected $_address;

    protected $_city;

    protected $_state;

    protected $_postalCode;

    protected $_phoneNumber;

    public function __construct(array $options = null)
    {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }

    public function __set($name, $value)
    {
        $method = 'set' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid field property');
        }
        $this->$method($value);
    }

    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid field property');
        }
        return $this->$method();
    }

    public function setOptions(array $options)
    {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }

    public function setName($text)
    {
        $this->_name = (string) $text;
        return $this;
    }

    public function getName()
    {
        return $this->_name;
    }

    public function setAddress($text)
    {
        $this->_address = (string) $text;
        return $this;
    }

    public function getAddress()
    {
        return $this->_address;
    }

    public function setCity($text)
    {
        $this->_city = (string) $text;
        return $this;
    }

    public function getCity()
    {
        return $this->_city;
    }

    public function setState($text)
    {
        $this->_state = (string) $text;
        return $this;

    }

    public function getState()
    {
        return $this->_state;
    }

    public function setPostalCode($text)
    {
        $this->_postalCode = (string) $text;
        return $this;
    }

    public function getPostalCode()
    {
        return $this->_postalCode;
    }

    public function setPhoneNumber($text)
    {
        $this->_phoneNumber = (string) $text;
        return $this;
    }

    public function getPhoneNumber()
    {
        return $this->_phoneNumber;
    }

}