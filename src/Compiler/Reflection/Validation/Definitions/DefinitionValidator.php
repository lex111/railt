<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Compiler\Reflection\Validation\Definitions;

use Railt\Compiler\Reflection\Validation\Base\ValidatorInterface;
use Railt\Reflection\Contracts\Definitions\Definition;

/**
 * Interface DefinitionValidator
 */
interface DefinitionValidator extends ValidatorInterface
{
    /**
     * @param Definition $definition
     * @return bool
     */
    public function match(Definition $definition): bool;

    /**
     * @param Definition $definition
     * @return void
     */
    public function validate(Definition $definition): void;
}