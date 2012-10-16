<?php
namespace Tests\Common\Entity;

use Common\Entity\Entity;

class EntityTest extends \PHPUnit_Framework_TestCase
{
    protected $sample;
    
    public function setUp()
    {
        parent::setUp();
        $this->sample = new Sample(array(
            'foo' => 'fubar',
            'bar' => 'barfu',
        ));
    }
    public function testMagicGetter()
    {
        $this->assertEquals('barfu', $this->sample->bar);
    }
    
    public function testDiscreteGetter()
    {
        $this->assertEquals('fubar', $this->sample->foo);
    }
}

class Sample extends Entity
{
    protected $foo;
    protected $bar;
    
    public function getFoo() { return $this->foo; }
    public function setFoo($foo) { $this->foo = $foo; }
}