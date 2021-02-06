<?php


namespace App\GraphQl\Resolver;


use ApiPlatform\Core\GraphQl\Resolver\QueryCollectionResolverInterface;
use App\Entity\Entity;

final class CollectionResolver implements QueryCollectionResolverInterface
{

    /**
     * @param iterable|object[] $collection
     * @param array $context
     * @return iterable|object[]
     */
    public function __invoke(iterable $collection, array $context): iterable
    {
        foreach ($collection as $entity) {

        }

        return $collection;
    }
}