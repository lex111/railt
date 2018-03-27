<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

use Railt\Compiler\Parser;
use Railt\Io\File;

require __DIR__ . '/../vendor/autoload.php';

$gql     = File::fromPathname(__DIR__ . '/complex.graphqls');
$grammar = File::fromPathname(__DIR__ . '/../src/SDL/resources/grammar/sdl.pp2');

$ast = Parser::fromGrammar($grammar)->parse($gql);

dd((string)$ast);
