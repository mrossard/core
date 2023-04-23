<?php

/*
 * This file is part of the API Platform project.
 *
 * (c) Kévin Dunglas <dunglas@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace ApiPlatform\Doctrine\Orm\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use RuntimeException;

final class EntityClassItemProvider implements ProviderInterface
{

    public function __construct(protected readonly ProviderInterface $provider)
    {
    }

    /**
     * @inheritDoc
     */
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        // Proxy to a standard Item provider
        $options = $operation->getStateOptions();
        $operation = $operation->withClass($options->getEntityClass());
        $entity = $this->provider->provide($operation, $uriVariables, $context);

        // Then map the entity onto the expected resource
        $mapper = $options->getMapper();
        if (null === $mapper) {
            throw new RuntimeException('you need to provide either a mapper or use a custom provider');
        }
        return $mapper->entityToResource($entity);
    }
}