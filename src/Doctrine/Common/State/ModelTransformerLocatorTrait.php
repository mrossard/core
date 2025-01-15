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

namespace ApiPlatform\Doctrine\Common\State;

use ApiPlatform\Metadata\Operation;
use Psr\Container\ContainerInterface;

/**
 * Maybe merge this and LinksHandlerLocatorTrait into a OptionsHooksLocatorTrait or something similar?
 */
trait ModelTransformerLocatorTrait
{
    private ?ContainerInterface $transformEntityLocator;

    protected function getEntityTransformer(Operation $operation): ?callable
    {
        if (!($options = $operation->getStateOptions()) || !$options instanceof Options) {
            return null;
        }

        $transformModel = $options->getTransformModel();
        if (\is_callable($transformModel)) {
            return $transformModel;
        }

        if ($this->transformEntityLocator && \is_string($transformModel) && $this->transformEntityLocator->has($transformModel)) {
            return [$this->transformEntityLocator->get($transformModel), 'transformModel'];
        }

        return null;
    }
}
