<?php


namespace App\Service\Config\Database;


use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class Api implements CompilerPassInterface
{

    /**
     * @inheritDoc
     */
    public function process(ContainerBuilder $container)
    {
        $container
            ->getDefinition('doctrine.dbal.customer_connection')
            ->addMethodCall('setDbSwitcher', [
                new Reference('database.switcher')
            ]);
    }
}