<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Compiler\Generator;

use Railt\Compiler\Lexer\Common\PCRECompiler;
use Railt\Compiler\Lexer\Stateless;
use Railt\Compiler\LexerInterface;

/**
 * Class LexerGenerator
 */
class LexerGenerator extends BaseCodeGenerator
{
    /**
     * @var string
     */
    protected $template = 'lexer.php.twig';

    /**
     * @var LexerInterface
     */
    private $lexer;

    /**
     * LexerGenerator constructor.
     * @param Stateless $lexer
     */
    public function __construct(Stateless $lexer)
    {
        $this->lexer = $lexer;
    }

    /**
     * @return \Generator
     * @throws \Zend\Code\Generator\Exception\RuntimeException
     */
    protected function getContext(): \Generator
    {
        $pcre = new PCRECompiler($this->lexer->getTokens());

        yield from parent::getContext();

        yield 'pattern' => $pcre->compile();
        yield 'tokens' => $this->lexer->getTokens();
        yield 'skip' => $this->lexer->getIgnoredTokens();
    }
}
