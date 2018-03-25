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
 * Class MultipleDefinitions
 */
class MultipleDefinitions implements Collection
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
        $this->items[] = $definition;

        return $this;
    }

    /**
     * @param string $name
     * @return Definition[]|mixed
     */
    public function get(string $name): \Traversable
    {
        foreach ($this->items as $definition) {
            if ($definition->getName() === $name) {
                yield $definition;
            }
        }
    }

    /**
     * @return \ArrayIterator|\Traversable
     */
    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->items);
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return \count($this->items);
    }
}
