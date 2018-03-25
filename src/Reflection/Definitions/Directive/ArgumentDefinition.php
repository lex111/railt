<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Defintions\Directive;

use Railt\Reflection\Definitions\Common\Dependent;
use Railt\Reflection\Definitions\Common\HasDefaultValue;
use Railt\Reflection\Definitions\Common\HasTypeIndication;
use Railt\Reflection\Definitions\DirectiveDefinition;
use Railt\Reflection\Definitions\TypeDefinition;

/**
 * Interface ArgumentDefinition
 */
interface ArgumentDefinition extends Dependent, TypeDefinition, HasDefaultValue, HasTypeIndication
{
    /**
     * @return DirectiveDefinition
     */
    public function getParent(): DirectiveDefinition;
}
