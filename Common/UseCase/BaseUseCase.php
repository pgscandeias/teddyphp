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
    protected $em;  // Doctrine Entity Manager
    
    public function __construct($entityManager)
    {
        $this->validator = new Validator;
        $this->em = $entityManager;
    }
    
    protected function getRepo($entityName)
    {
        return $this->em->getRepository('\App\Entity\\'.$entityName);
    }
    
    protected function persistEntity($entity)
    {
        if (!$this->validate($entity)) {
            return false;
        }
        
        $this->em->persist($entity);
        $this->em->flush();
        
        return true;
    }
    
    protected function responsify($entity)
    {
        $data = array();
        foreach ($entity->getFields() as $property) {
            $value = $entity->{$property};
            if ($value instanceof EntityInterface) {
                $data[$property] = $value->id;
            }
            elseif ($value instanceof \Doctrine\Common\Collections\Collection) {
                $ids = array();
                foreach ($value as $item) {
                    $ids[] = $item->id;
                }
                $data[$property] = $ids;
            }
            elseif ($value instanceof \DateTime) {
                $data[$property] = $value->format($this->getDateTimePropertyFormat($entity, $property));
            }
            else {
                $data[$property] = $value;
            }
        }
        
        return $data;
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
    
    protected function getDateTimePropertyFormat(EntityInterface $entity, $property)
    {
        if (!$entity->{$property} instanceof \DateTime) {
            return false;
        }
        
        $cmf = $this->em->getMetadataFactory();
        $class = $cmf->getMetadataFor(get_class($entity));
        
        if ($class->fieldMappings[$property]['type'] == 'date') {
            return 'Y-m-d';
        }
        elseif ($class->fieldMappings[$property]['type'] == 'datetime') {
            return 'Y-m-d H:i:s';
        }
    }
}