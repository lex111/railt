<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Compiler\Iterator;

/**
 * Interface Buffer
 */
interface Buffer extends \Iterator
{
    /**
     * Peeks at the node from the end of the doubly linked list.
     *
     * @return mixed The value of the last node.
     */
    public function top();

    /**
     * Peeks at the node from the beginning of the doubly linked list.
     *
     * @return mixed The value of the first node.
     */
    public function bottom();

    /**
     * Move backward to previous element.
     *
     * @return void Any returned value is ignored.
     */
    public function previous(): void;
}
