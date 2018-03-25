<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Invocations;

use Railt\Reflection\Invocations\Common\HasPassedArguments;

/**
 * Interface InputInvocation
 */
interface InputInvocation extends TypeInvocation, HasPassedArguments, \ArrayAccess, \IteratorAggregate, \JsonSerializable
{
}
