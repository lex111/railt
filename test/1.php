<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

use Railt\Compiler\Grammar\Lexer\Grammar;
use Railt\Compiler\Grammar\Lexer\Runtime;
use Railt\Compiler\Lexer;
use Railt\Compiler\Lexer\NativeStateless;
use Railt\Compiler\Lexer\Parle;
use Railt\Io\File;
use Railt\SDL\Parser\Factory;

require __DIR__ . '/../vendor/autoload.php';

$schema = File::fromPathname(Factory::GRAMMAR_FILE);

$lexer = new NativeStateless();
//$lexer = new Parle();

foreach (Runtime::getTokenDefinitions() as $name => $value) {
    $lexer->add($name, $value, Runtime::getTokenContexts()[$name] ?? 0);
}

foreach (Runtime::getSkippedTokens() as $name) {
    $lexer->skip($name);
}


foreach ($lexer->lex($schema) as $token) {
    echo $token . "\n";
}
