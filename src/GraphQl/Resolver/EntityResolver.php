<?php

namespace App\GraphQl\Resolver;


use ApiPlatform\Core\GraphQl\Resolver\QueryItemResolverInterface;
use App\Entity\Entity;

/**
 * Class EntityResolver
 * @package App\GraphQl\Resolver
 */
final class EntityResolver implements QueryItemResolverInterface
{
    /**
     * @param object|null $item
     * @param array $context
     * @return object
     */
    public function __invoke($item, array $context): ?object
    {
        if($item instanceof Entity){
        }
        return $item;
    }
}
