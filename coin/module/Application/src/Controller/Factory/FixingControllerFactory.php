<?php
namespace Application\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Application\Service\FixingManager;
use Application\Controller\FixingController;

/**
 * This is the factory for FixingController. Its purpose is to instantiate the
 * controller.
 */
class FixingControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $FixingManager = $container->get(FixingManager::class);
        
        // Instantiate the controller and inject dependencies
        return new FixingController($entityManager, $FixingManager);
    }
}


