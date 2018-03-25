<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\SDL\Compiler;

use Railt\Reflection\Definitions\TypeDefinition;
use Railt\SDL\Compiler\Collections\Collection;

/**
 * Interface Dictionary
 */
interface Dictionary extends Collection
{
    /**
     * @param string $type
     * @return TypeDefinition
     */
    public function get(string $type): TypeDefinition;

    /**
     * @return iterable|TypeDefinition[]
     */
    public function getTypeDefinitions(): iterable;
}
