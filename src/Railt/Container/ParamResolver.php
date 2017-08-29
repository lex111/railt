<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Container;

use Psr\Container\ContainerInterface;
use Railt\Container\Exceptions\ParameterResolutionException;

/**
 * Class ParamResolver
 * @package Railt\Container
 */
class ParamResolver
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * ParamResolver constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param \ReflectionFunctionAbstract $action
     * @param Parameters|null $additional
     * @return \Traversable
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function resolve(\ReflectionFunctionAbstract $action, Parameters $additional = null): \Traversable
    {
        $container = $additional !== null ? new Proxy($additional, $this->container) : $this->container;

        foreach ($this->parameters($action) as $parameter) {
            yield $this->getValueForParameter($parameter, $container);
        }
    }

    /**
     * @param \ReflectionParameter $parameter
     * @param ContainerInterface $container
     * @return mixed
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    private function getValueForParameter(\ReflectionParameter $parameter, ContainerInterface $container)
    {
        /**
         * Resolve parameter by class or interface type-hint
         */
        $classDefinition = $parameter->getClass() ? $parameter->getClass()->getName() : null;

        if ($classDefinition !== null && $container->has($classDefinition)) {
            return $container->get($classDefinition);
        }

        /**
         * Resolve parameter by parameter type-hint
         */
        $typeDefinition = $parameter->hasType() ? $parameter->getType()->getName() : null;

        if ($typeDefinition !== null && $container->has($typeDefinition)) {
            return $container->get($typeDefinition);
        }

        /**
         * Resolve parameter by parameter name
         */
        $parameterName = $parameter->getName();

        if ($container->has($parameterName)) {
            return $container->get($parameterName);
        }

        return $this->tryFallback($parameter);
    }

    /**
     * @param \ReflectionParameter $parameter
     * @return mixed
     * @throws \Railt\Container\Exceptions\ParameterResolutionException
     */
    private function tryFallback(\ReflectionParameter $parameter)
    {
        if ($parameter->isDefaultValueAvailable()) {
            return $parameter->getDefaultValue();
        }

        if ($parameter->allowsNull() || $parameter->isVariadic()) {
            return null;
        }

        throw new ParameterResolutionException($parameter);
    }

    /**
     * @param \ReflectionFunctionAbstract $function
     * @return \Traversable|\ReflectionParameter[]
     */
    private function parameters(\ReflectionFunctionAbstract $function): \Traversable
    {
        foreach ($function->getParameters() as $parameter) {
            yield $parameter;
        }
    }
}