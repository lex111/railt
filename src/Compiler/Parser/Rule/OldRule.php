<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Compiler\Parser\Rule;

/**
 * Class Rule
 */
abstract class OldRule implements Arrayable, Symbol
{
    /**
     * Rule name.
     *
     * @var string
     */
    protected $name;

    /**
     * Rule's children. Can be an array of names or a single name.
     *
     * @var array|int|null
     */
    protected $children;

    /**
     * Node ID.
     *
     * @var string
     */
    protected $nodeId;

    /**
     * Constructor.
     *
     * @param string $name Rule name.
     * @param array $children Children.
     * @param string $nodeId Node ID.
     */
    public function __construct($name, array $children, string $nodeId = null)
    {
        $this->name     = $name;
        $this->children = $children;
        $this->nodeId   = $nodeId;
    }

    /**
     * @return bool
     */
    public function isKept(): bool
    {
        return $this->nodeId !== null;
    }

    /**
     * @return int|string
     */
    public function getId()
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            $this->name,
            $this->children,
            $this->nodeId,
        ];
    }

    /**
     * @param string|int $name
     * @return OldRule
     */
    public function rename($name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return array
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Get node ID.
     *
     * @return  string
     */
    public function getNodeId()
    {
        return $this->nodeId;
    }

    /**
     * @param $nodeId
     */
    public function setNodeId($nodeId): void
    {
        $this->nodeId = $nodeId;
    }
}
