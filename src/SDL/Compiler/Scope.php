<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\SDL\Compiler;

use Railt\Reflection\Definition;
use Railt\Reflection\Definitions\TypeDefinition;
use Railt\SDL\Compiler\Collections\Collection;
use Railt\SDL\Compiler\Collections\UniqueDefinitions;
use Railt\SDL\Exceptions\TypeConflictException;

/**
 * Class Scope
 */
class Scope implements Dictionary
{
    /**
     * @var UniqueDefinitions
     */
    private $types;

    /**
     * Scope constructor.
     */
    public function __construct()
    {
        $this->types = new UniqueDefinitions();
    }

    /**
     * @param Definition $type
     * @return $this|Scope
     */
    public function append(Definition $type): Collection
    {
        \assert($type instanceof TypeDefinition, 'Only type definitions can be added to scope');

        $this->types->append($type);

        return $this;
    }

    /**
     * @param string $type
     * @return TypeDefinition
     * @throws \Railt\SDL\Exceptions\TypeConflictException
     */
    public function get(string $type): TypeDefinition
    {
        $result = $this->types->get($type);

        if ($result instanceof TypeDefinition) {
            return $result;
        }

        $error = \sprintf('Type %s not found or could not be loaded', $type);
        throw new TypeConflictException($error);
    }

    /**
     * @return iterable|TypeDefinition[]|\Traversable
     */
    public function getTypeDefinitions(): iterable
    {
        return new \ArrayIterator($this->types->getIterator());
    }

    /**
     * @return \Traversable
     */
    public function getIterator(): \Traversable
    {
        return $this->getTypeDefinitions();
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return $this->types->count();
    }
}
