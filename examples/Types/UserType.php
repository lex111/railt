<?php
/**
 * This file is part of Railgun package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Serafim\Railgun\Example\Types;

use Serafim\Railgun\Types\Schemas\Fields;
use Serafim\Railgun\Types\AbstractObjectType;

/**
 * Class UserType
 * @package Serafim\Railgun\Example\Types
 */
class UserType extends AbstractObjectType
{
    /**
     * @param Fields $field
     * @return iterable
     */
    public function getFields(Fields $field): iterable
    {
        yield 'id' => $field->id();
        yield 'name' => $field->string();
        yield 'comments' => $field->hasMany(CommentType::class);
    }
}