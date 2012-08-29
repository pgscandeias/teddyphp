<?php
namespace App\UseCase\Todo;

use Common\Component\Response;
use App\Entity\Todo;

class CreateTodo extends \Common\UseCase\BaseUseCase
{
    public function run(array $request)
    {
        $todo = new Todo;
        $todo->title = $request['title'];
        $todo->isDone = $request['isDone'];
        
        $this->em->persist($todo);
        $this->em->flush();
        
        return $this->success($this->responsify($todo));
    }
}