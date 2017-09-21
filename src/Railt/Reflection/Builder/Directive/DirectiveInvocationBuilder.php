<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Builder\Directive;

use Hoa\Compiler\Llk\TreeNode;
use Railt\Reflection\Builder\AbstractBuilder;
use Railt\Reflection\Builder\DocumentBuilder;
use Railt\Reflection\Builder\Support\NameBuilder;
use Railt\Reflection\Contracts\Behavior\Nameable;
use Railt\Reflection\Contracts\Types\Directive\Argument;
use Railt\Reflection\Contracts\Types\Directive\DirectiveInvocation;
use Railt\Reflection\Contracts\Types\DirectiveType;
use Railt\Reflection\Contracts\Types\TypeInterface;
use Railt\Reflection\Exceptions\BuildingException;
use Railt\Reflection\Exceptions\TypeNotFoundException;

/**
 * Class DirectiveInvocationBuilder
 */
class DirectiveInvocationBuilder extends AbstractBuilder implements DirectiveInvocation
{
    use NameBuilder;

    /**
     *
     */
    protected const AST_ID_ARGUMENT = '#Argument';

    /**
     * @var array|Argument[]
     */
    private $arguments = [];

    /**
     * @var Nameable
     */
    private $parent;

    /**
     * DirectiveInvocationBuilder constructor.
     * @param TreeNode $ast
     * @param DocumentBuilder $document
     * @param Nameable $parent
     * @throws BuildingException
     */
    public function __construct(TreeNode $ast, DocumentBuilder $document, Nameable $parent)
    {
        $this->parent = $parent;
        parent::__construct($ast, $document);

        $this->bootNameBuilder($ast);

        $this->compileIfNotCompiled();
    }

    /**
     * @param TreeNode $ast
     * @return bool
     * @throws \Railt\Reflection\Exceptions\BuildingException
     */
    public function compile(TreeNode $ast): bool
    {
        if ($ast->getId() === static::AST_ID_ARGUMENT) {
            $argument = new ArgumentBuilder($ast, $this->getDocument(), $this);
            $this->arguments[$argument->getName()] = $argument;

            return true;
        }

        return false;
    }

    /**
     * @return DirectiveType|TypeInterface
     * @throws \Railt\Reflection\Exceptions\TypeNotFoundException
     */
    public function getDirective(): DirectiveType
    {
        $directive = $this->getCompiler()->get($this->getName());

        if ($directive === null) {
            $error = 'Directive @%s is not defined.';
            throw new TypeNotFoundException(\sprintf($error, $this->getName()));
        }

        return $directive;
    }

    /**
     * @return iterable|Argument[]
     */
    public function getArguments(): iterable
    {
        return \array_values($this->arguments);
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasArgument(string $name): bool
    {
        return \array_key_exists($name, $this->arguments);
    }

    /**
     * @param string $name
     * @return null|Argument
     */
    public function getArgument(string $name): ?Argument
    {
        return $this->arguments[$name] ?? null;
    }

    /**
     * @return int
     */
    public function getNumberOfArguments(): int
    {
        return \count($this->arguments);
    }

    /**
     * @return Nameable
     */
    public function getParent(): Nameable
    {
        return $this->parent;
    }
}