<?php
namespace Tests\UseCase\Todo;

use Common\Component\Response;
use Tests\BaseTestCase;

class CreateTodoTest extends BaseTestCase
{
    private function checkOutput($input, Response $output)
    {
        $this->assertGreaterThan(0, $output->data['id']);
        $this->assertEquals($input['title'], $output->data['title']);
        $this->assertEquals($input['isDone'], $output->data['isDone']);
    }
    
    private function checkDbTodo($input, $id)
    {
        $dbTodo = $this->getRepo('Todo')->find($id);
        $this->assertEquals($input['title'],  $dbTodo->title);
        $this->assertEquals($input['isDone'], $dbTodo->isDone);
    }
    
    
    public function testCreate()
    {
        $input = array(
            'title'     => 'Sample todo list item',
            'isDone'    => false,
        );
        
        $output = $this->getUseCase('Todo\CreateTodo')->run($input);
        
        $this->checkOutput($input, $output);
        $this->checkDbTodo($input, $output->data['id']);
    }
}