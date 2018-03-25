<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Defintions\Object;

use Railt\Reflection\Definitions\Common\Dependent;
use Railt\Reflection\Definitions\Common\HasTypeIndication;
use Railt\Reflection\Definitions\InterfaceDefinition;
use Railt\Reflection\Definitions\ObjectDefinition;
use Railt\Reflection\Definitions\TypeDefinition;

/**
 * Interface FieldDefinition
 */
interface FieldDefinition extends Dependent, TypeDefinition, HasArguments, HasTypeIndication
{
    /**
     * @return ObjectDefinition|InterfaceDefinition
     */
    public function getParent(): InterfaceDefinition;
}
