<?php
namespace App\Entity;
use Common\Entity\DoctrineEntity;

/**
 * @Entity(repositoryClass="Backend\Repository\TodoRepository")
 * @Table(name="todos")
 */
class Todo extends DoctrineEntity
{
    /**
     * @Id
     * @Column(name="id", type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @Column(name="title", type="string")
     */
    protected $title;
    
	/**
	 * @Column(name="isDone", type="boolean")
	 */
	protected $isDone = false;
}