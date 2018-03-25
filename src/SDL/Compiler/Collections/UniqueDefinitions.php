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
use Railt\SDL\Exceptions\TypeConflictException;

/**
 * Class UniqueDefinitions
 */
class UniqueDefinitions implements Collection
{
    /**
     * @var array|Definition[]
     */
    private $items = [];

    /**
     * @param Definition $definition
     * @return Collection
     */
    public function append(Definition $definition): Collection
    {
        if (\array_key_exists($definition->getName(), $this->items)) {
            throw new TypeConflictException(\sprintf('', $definition));
        }

        $this->items[$definition->getName()] = $definition;

        return $this;
    }

    /**
     * @param string $name
     * @return null|Definition
     */
    public function get(string $name): ?Definition
    {
        return $this->items[$name] ?? null;
    }

    /**
     * @return \ArrayIterator|\Traversable
     */
    public function getIterator(): \Traversable
    {
        return new \ArrayIterator(\array_values($this->items));
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return \count($this->items);
    }
}
