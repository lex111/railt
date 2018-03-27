<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

use Railt\Io\File;
use Railt\SDL\Parser\Factory;

require __DIR__ . '/../vendor/autoload.php';

$gql = File::fromPathname(__DIR__ . '/complex.graphqls');

$ast = (new Factory())->parse($gql);

dd((string)$ast);