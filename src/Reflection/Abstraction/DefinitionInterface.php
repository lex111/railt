<?php
/**
 * This file is part of Railgun package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railgun\Reflection\Abstraction;

/**
 * Interface CalleeDefinitionInterface
 * @package Railgun\Reflection\Abstraction
 */
interface DefinitionInterface
{
    /**
     * @return string
     */
    public function getTypeName(): string;

    /**
     * @return DocumentTypeInterface
     */
    public function getDocument(): DocumentTypeInterface;
}
