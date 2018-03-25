<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\SDL\Compiler\Reflection;

use Railt\Compiler\Parser\Ast\NodeInterface;
use Railt\Io\Readable;
use Railt\Reflection\Definitions\TypeDefinition;
use Railt\Reflection\Document;
use Railt\Reflection\Invocations\DirectiveInvocation;
use Railt\SDL\Compiler\Collections\Duplicator;
use Railt\SDL\Compiler\Collections\MultipleDefinitions;
use Railt\SDL\Compiler\Collections\UniqueDefinitions;
use Railt\SDL\Compiler\Scope;

/**
 * Class DocumentBuilder
 */
class DocumentBuilder implements Document
{
    /**
     * @var Readable
     */
    private $input;

    /**
     * @var NodeInterface
     */
    private $ast;

    /**
     * @var MultipleDefinitions|DirectiveInvocation[]
     */
    private $directives;

    /**
     * @var Scope
     */
    private $scope;

    private $types;

    /**
     * DocumentBuilder constructor.
     * @param Readable $input
     * @param NodeInterface $ast
     */
    public function __construct(Readable $input, NodeInterface $ast)
    {
        $this->ast = $ast;
        $this->input = $input;
        $this->scope = new Scope();
        $this->types = new Duplicator(new UniqueDefinitions(), $this->scope);
        $this->directives = new MultipleDefinitions();
    }

    /**
     * @return iterable
     */
    public function getTypeDefinitions(): iterable
    {
        return $this->types->getIterator();
    }

    public function getTypeDefinition(string $name): ?TypeDefinition
    {
        try {
            return $this->types->get($name);
        } catch ()
    }

    public function hasTypeDefinition(string $name): bool
    {
        throw new \LogicException('The ' . __METHOD__ . ' not implemented yet');
    }

    public function getNumberOfTypeDefinitions(): int
    {
        throw new \LogicException('The ' . __METHOD__ . ' not implemented yet');
    }
}
