<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection;

/**
 * Interface Type
 */
interface Type
{
    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return bool
     */
    public function isInputable(): bool;

    /**
     * @return bool
     */
    public function isOutputable(): bool;

    /**
     * @return string
     */
    public function __toString(): string;
}
