<?php

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
