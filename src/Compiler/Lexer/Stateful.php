<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Compiler\Lexer;

use Railt\Compiler\TokenInterface;
use Railt\Io\Readable;

/**
 * Interface Stateful
 */
interface Stateful
{
    /**
     * Compiling the current state of the lexer and returning stream tokens from the source file
     *
     * @param Readable $input
     * @return \Traversable|TokenInterface[]|\Traversable
     */
    public function lex(Readable $input): \Traversable;
}
