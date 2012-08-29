<?php
namespace Common\Component;
use Common\Entity\EntityInterface;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Symfony\Component\Validator\Validator as SymfonyValidator;
use Symfony\Component\Validator\ConstraintValidatorFactory;
use Symfony\Component\Validator\Mapping\ClassMetadataFactory;
use Symfony\Component\Validator\Mapping\Loader\AnnotationLoader;

use Symfony\Component\Validator\Constraints as Assert;

class Validator
{
    /**
     * @var SymfonyValidator
     */
    private $validator;
    
    
    public function __construct()
    {
        $this->registerConstraintsNamespace();
        $this->initValidator();
    }
    
    public function validate(EntityInterface $entity)
    {
        return $this->validator->validate($entity);
    }
    
    
    private function registerConstraintsNamespace()
    {
        AnnotationRegistry::registerAutoloadNamespace(
            'Symfony\Component\Validator\Constraints',
            __DIR__ . '/../../vendor/'
        );
    }
    
    private function initValidator()
    {
        $this->validator = new SymfonyValidator(
            new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader)),
            new ConstraintValidatorFactory()
        );
    }
}