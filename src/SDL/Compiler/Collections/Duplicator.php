<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\SDL\Compiler\Collections;

use Railt\Reflection\Definition;

/**
 * Class Duplicator
 */
class Duplicator implements Collection
{
    /**
     * @var Collection
     */
    private $context;

    /**
     * @var Collection
     */
    private $target;

    /**
     * Duplicator constructor.
     * @param Collection $context
     * @param Collection $duplicateTo
     */
    public function __construct(Collection $context, Collection $duplicateTo)
    {
        $this->context = $context;
        $this->target  = $duplicateTo;
    }

    /**
     * @param Definition $definition
     * @return Collection
     */
    public function append(Definition $definition): Collection
    {
        $this->context->append($definition);
        $this->target->append($definition);

        return $this;
    }

    /**
     * @param string $name
     * @return mixed|null
     */
    public function get(string $name)
    {
        return $this->context->get($name);
    }

    /**
     * @return \Traversable
     */
    public function getIterator(): \Traversable
    {
        return $this->context->getIterator();
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return $this->context->count();
    }
}
