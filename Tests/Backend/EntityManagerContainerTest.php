<?php
namespace Tests\Backend;

use Backend\EntityManagerContainer;

class EntityManagerContainerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @group doctrine
     */
    public function testEntityManagerLoader()
    {
        $em = EntityManagerContainer::get();
        $this->assertInstanceOf('\Doctrine\ORM\EntityManager', $em);
    }
}