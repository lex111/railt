<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Extensions;

use Railt\Reflection\Definitions\ObjectDefinition;

/**
 * Interface ObjectExtension
 */
interface ObjectExtension extends TypeExtension
{
    /**
     * @return ObjectDefinition
     */
    public function getInnerType(): ObjectDefinition;

    /**
     * @return ObjectDefinition
     */
    public function getRelatedType(): ObjectDefinition;
}
