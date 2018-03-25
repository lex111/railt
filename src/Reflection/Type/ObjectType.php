<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Type;

/**
 * Class ObjectType
 */
class ObjectType extends BaseType
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return 'Object';
    }

    /**
     * @return bool
     */
    public function isInputable(): bool
    {
        return false;
    }

    /**
     * @return bool
     */
    public function isOutputable(): bool
    {
        return true;
    }
}
