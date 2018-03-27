<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Foundation\Console;

use Railt\Compiler\Generator\LexerGenerator;
use Railt\Compiler\Grammar\Lexer\Runtime;
use Railt\Compiler\Lexer\NativeStateless;
use Railt\Compiler\Lexer\Stateless;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class CompilerRebuildCommand
 */
class CompilerGrammarRebuildCommand extends Command
{
    /**
     * @param InputInterface $in
     * @param OutputInterface $out
     * @return int|null|void
     * @throws \Symfony\Component\Console\Exception\InvalidArgumentException
     * @throws \Railt\Io\Exceptions\NotReadableException
     * @throws \RuntimeException
     * @throws \LogicException
     * @throws \ReflectionException
     */
    public function execute(InputInterface $in, OutputInterface $out)
    {
        $gen = new LexerGenerator($this->lexerFromRuntime());
        $gen->class($this->getClass());
        $gen->namespace($this->getNamespace());
        $gen->build()->saveTo($this->getDirectory());

        $out->writeln('<info>OK</info>');
    }

    /**
     * @return Stateless
     */
    private function lexerFromRuntime(): Stateless
    {
        $lexer = new NativeStateless();

        foreach (Runtime::getTokenDefinitions() as $name => $value) {
            $lexer->add($name, $value);
        }

        foreach (Runtime::getSkippedTokens() as $name) {
            $lexer->skip($name);
        }

        return $lexer;
    }

    /**
     * @return string
     */
    private function getClass(): string
    {
        return 'Grammar';
    }

    /**
     * @return string
     */
    private function getNamespace(): string
    {
        return 'Railt\\Compiler\\Grammar\\Lexer';
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    private function getDirectory(): string
    {
        return \dirname((new \ReflectionClass(Runtime::class))->getFileName());
    }

    /**
     * @return void
     * @throws \Symfony\Component\Console\Exception\InvalidArgumentException
     */
    protected function configure(): void
    {
        $this->setName('grammar:build');
        $this->setDescription('Builds a new optimised lexer for grammar');
    }
}
