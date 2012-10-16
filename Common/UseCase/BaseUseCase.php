<?php
namespace Common\UseCase;

use Common\Backend\GatewayLoaderInterface;
use Common\Entity\EntityInterface;
use Common\Component\Validator;
use Common\Component\Response;
use Common\Component\ValidationErrorResponse;

class BaseUseCase
{
    protected $validator;
    protected $validationErrors = array();
    
    public function __construct()
    {
        $this->validator = new Validator;
    }
    
    protected function success(array $data)
    {
        $response = new Response($data);
        $response->status = Response::SUCCESS;
        
        return $response;
    }
    
    protected function notFound()
    {
        $response = new Response;
        $response->status = Response::NOT_FOUND;
        
        return $response;
    }
    
    protected function validate(EntityInterface $entity)
    {
        $errors = $this->validator->validate($entity);
        if ($errors->count() > 0) {
            $this->validationErrors = $errors;
            return false;
        } else {
            return true;
        }
    }
    
    protected function validationError()
    {
        $response = new ValidationErrorResponse;
        $response->status = ValidationErrorResponse::ERROR_VALIDATION;
        $response->errors = $this->validationErrors;
        
        return $response;
    }
    
    protected function notFoundError($message) {
        $response = new Response;
        $response->status = Response::NOT_FOUND;
        $response->errors[] = $message;
        
        return $response;
    }
}