<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Definitions\Enum;

use Railt\Reflection\Definitions\Common\Dependent;
use Railt\Reflection\Definitions\TypeDefinition;

/**
 * Interface ValueDefinition
 */
interface ValueDefinition extends TypeDefinition, Dependent
{
    /**
     * @return string
     */
    public function getValue(): string;
}
