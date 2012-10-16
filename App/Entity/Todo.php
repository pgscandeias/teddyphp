<?php
namespace App\Entity;
use Common\Entity\Entity;

class Todo extends Entity
{
    protected $id;
    protected $title;
	protected $isDone = false;
}