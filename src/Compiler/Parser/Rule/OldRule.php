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
abstract class OldRule implements Arrayable, Symbol, Production
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

    public function then(): array
    {
        return (array)$this->children;
    }

    public function getName(): ?string
    {
        return $this->nodeId;
    }

    /**
     * @param string|int $name
     * @return OldRule
     */
    public function move($name): Symbol
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param null|string $name
     * @return Production
     */
    public function rename(?string $name): Production
    {
        $this->nodeId = $name;

        return $this;
    }
}
