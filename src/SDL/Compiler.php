<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\SDL;

use Railt\Compiler\ParserInterface;
use Railt\Io\Readable;
use Railt\SDL\Compiler\SymbolTable;
use Railt\SDL\Parser\Factory;

/**
 * Class Compiler
 */
class Compiler
{
    /**
     * @var Factory|ParserInterface
     */
    private $parser;

    /**
     * Compiler constructor.
     */
    public function __construct()
    {
        $this->parser = new Factory();
    }

    public function compile(Readable $input)
    {
        $ast = $this->parser->parse($input);


    }
}
