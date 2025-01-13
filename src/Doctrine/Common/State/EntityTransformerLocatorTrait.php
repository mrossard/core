<?php

namespace ApiPlatform\Doctrine\Common\State;

use ApiPlatform\Metadata\Operation;
use Psr\Container\ContainerInterface;

/**
 * Maybe merge this and LinksHandlerLocatorTrait into a OptionsHooksLocatorTrait or something similar?
 */
trait EntityTransformerLocatorTrait
{
    private ?ContainerInterface $transformEntityLocator;

    protected function getEntityTransformer(Operation $operation): ?callable
    {
        if (!($options = $operation->getStateOptions()) || !$options instanceof Options) {
            return null;
        }

        $transformEntity = $options->getTransformEntity();
        if (\is_callable($transformEntity)) {
            return $transformEntity;
        }

        if ($this->transformEntityLocator && \is_string($transformEntity) && $this->transformEntityLocator->has($transformEntity)) {
            return [$this->transformEntityLocator->get($transformEntity), 'transformEntity'];
        }

        return null;
    }
}
