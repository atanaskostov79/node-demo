<?php
namespace Application\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Application\Service\CoinManager;
use Application\Controller\CoinController;

/**
 * This is the factory for CoinController. Its purpose is to instantiate the
 * controller.
 */
class CoinControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $CoinManager = $container->get(CoinManager::class);
        
        // Instantiate the controller and inject dependencies
        return new CoinController($entityManager, $CoinManager);
    }
}


