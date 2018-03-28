<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Compiler\Grammar\Builder;

use Railt\Compiler\Parser\Rule\Repetition;

/**
 * Class RepetitionBuilder
 */
class RepetitionBuilder extends Repetition implements Buildable
{
    use Movable;
    use Renameable;
    use Instantiable;

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [$this->id, $this->min, $this->max, $this->children, $this->name];
    }

    /**
     * @return string
     */
    public function getClass(): string
    {
        return Repetition::class;
    }
}
