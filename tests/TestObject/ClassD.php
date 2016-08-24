<?php namespace Svz\GenericTest\TestObject;

class ClassD
{

    public $publicField;

    /**
     * ClassD constructor.
     * @param $publicField
     */
    public function __construct($publicField)
    {
        $this->publicField = $publicField;
    }


}