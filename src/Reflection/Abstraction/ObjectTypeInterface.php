<?php
/**
 * This file is part of Railgun package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railgun\Reflection\Abstraction;

use Railgun\Reflection\Abstraction\Common\HasDirectivesInterface;
use Railgun\Reflection\Abstraction\Common\HasFieldsInterface;

/**
 * Interface ObjectTypeInterface
 * @package Railgun\Reflection\Abstraction
 */
interface ObjectTypeInterface extends
    NamedDefinitionInterface,
    HasFieldsInterface,
    HasDirectivesInterface
{
    /**
     * @return iterable|InterfaceTypeInterface[]
     */
    public function getInterfaces(): iterable;

    /**
     * @param string $name
     * @return bool
     */
    public function hasInterface(string $name): bool;

    /**
     * @param string $name
     * @return null|InterfaceTypeInterface
     */
    public function getInterface(string $name): ?InterfaceTypeInterface;
}
