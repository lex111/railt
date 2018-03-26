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
 * Interface Collection
 */
interface Collection extends \IteratorAggregate, \Countable
{
    /**
     * @param Definition $definition
     * @return Collection
     */
    public function append(Definition $definition): self;

    /**
     * @param string $name
     * @return null|mixed
     */
    public function get(string $name);

    /**
     * @return \Traversable
     */
    public function getIterator(): \Traversable;
}
