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
 * Class BufferedIterator
 */
class BufferedIterator extends \IteratorIterator implements Buffer
{
    /**
     * Buffer key index.
     *
     * @const int
     */
    public const BUFFER_KEY = 0;

    /**
     * Buffer value index.
     *
     * @const int
     */
    public const BUFFER_VALUE = 1;

    /**
     * Current iterator.
     *
     * @var \Iterator
     */
    protected $iterator;

    /**
     * Buffer.
     *
     * @var \SplDoublyLinkedList
     */
    protected $buffer;

    /**
     * Maximum buffer size.
     *
     * @var int
     */
    protected $bufferSize = 1;

    /**
     * Construct.
     *
     * @param \Traversable|\Iterator $iterator Iterator.
     * @param int $bufferSize Buffer size.
     */
    public function __construct(\Traversable $iterator, $bufferSize)
    {
        $this->iterator   = $iterator;
        $this->bufferSize = \max($bufferSize, 1);
        $this->buffer     = new \SplDoublyLinkedList();
    }

    /**
     * @return mixed
     */
    public function top()
    {
        return $this->buffer->top()[self::BUFFER_VALUE];
    }

    /**
     * @return mixed
     */
    public function bottom()
    {
        return $this->buffer->bottom()[self::BUFFER_VALUE];
    }

    /**
     * Return the current element.
     *
     * @return mixed
     */
    public function current()
    {
        return $this->getBuffer()->current()[self::BUFFER_VALUE];
    }

    /**
     * Get buffer.
     *
     * @return \SplDoublyLinkedList
     */
    protected function getBuffer(): \SplDoublyLinkedList
    {
        return $this->buffer;
    }

    /**
     * Return the key of the current element.
     *
     * @return mixed
     */
    public function key()
    {
        return $this->getBuffer()->current()[self::BUFFER_KEY];
    }

    /**
     * Move forward to next element.
     *
     * @return void
     */
    public function next(): void
    {
        $innerIterator = $this->getInnerIterator();
        $buffer        = $this->getBuffer();

        $buffer->next();

        // End of the buffer, need a new value.
        if (false === $buffer->valid()) {
            for (
                $bufferSize = \count($buffer),
                $maximumBufferSize = $this->getBufferSize();
                $bufferSize >= $maximumBufferSize;
                --$bufferSize
            ) {
                $buffer->shift();
            }

            $innerIterator->next();

            $buffer->push([
                self::BUFFER_KEY   => $innerIterator->key(),
                self::BUFFER_VALUE => $innerIterator->current(),
            ]);

            // Seek to the end of the buffer.
            $buffer->setIteratorMode($buffer::IT_MODE_LIFO | $buffer::IT_MODE_KEEP);
            $buffer->rewind();
            $buffer->setIteratorMode($buffer::IT_MODE_FIFO | $buffer::IT_MODE_KEEP);
        }
    }

    /**
     * Get inner iterator.
     *
     * @return \Iterator
     */
    public function getInnerIterator(): \Iterator
    {
        return $this->iterator;
    }

    /**
     * Get buffer size.
     *
     * @return int
     */
    public function getBufferSize(): int
    {
        return $this->bufferSize;
    }

    /**
     * Move backward to previous element.
     *
     * @return void
     */
    public function previous(): void
    {
        $this->getBuffer()->prev();
    }

    /**
     * Rewind the iterator to the first element.
     *
     * @return void
     */
    public function rewind(): void
    {
        $innerIterator = $this->getInnerIterator();
        $buffer        = $this->getBuffer();

        $innerIterator->rewind();

        if (true === $buffer->isEmpty()) {
            $buffer->push([
                self::BUFFER_KEY   => $innerIterator->key(),
                self::BUFFER_VALUE => $innerIterator->current(),
            ]);
        }

        $buffer->rewind();
    }

    /**
     * Check if current position is valid.
     *
     * @return bool
     */
    public function valid(): bool
    {
        return $this->getBuffer()->valid() &&
            $this->getInnerIterator()->valid();
    }
}
