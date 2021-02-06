<?php


namespace App\Service\Config\Database;


use App\Service\Http\Request;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ApiDatabaseSwitcher
{
    use ContainerAwareTrait;

    /**
     * @return ContainerInterface
     */
    public function getContainer(): ContainerInterface
    {
        return $this->container;
    }

    public function getWorkingEntityManager(){
        return Request::getHeader('IM-COMPANY') ?? 'default' ;
    }

}