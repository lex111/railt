<?php
/**
 * This file is part of railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Compiler\Reflection\Validation;

use Railt\Compiler\Kernel\CallStack;
use Railt\Compiler\Reflection\Validation\Base\Factory;
use Railt\Compiler\Reflection\Validation\Inheritance\InheritanceValidator;
use Railt\Compiler\Reflection\Validation\Inheritance\Types;
use Railt\Compiler\Reflection\Validation\Inheritance\Wrappers;

/**
 * Class Inheritance
 */
final class Inheritance extends Factory
{
    /**
     * Inheritance constructor.
     * @param Validator $factory
     * @param CallStack $stack
     * @param null|string $name
     * @throws \InvalidArgumentException
     * @throws \OutOfBoundsException
     */
    public function __construct(Validator $factory, CallStack $stack, ?string $name)
    {
        parent::__construct($factory, $stack, $name ?? static::class);

        $this->bootChildrenValidators();
        $this->bootMatcher();
    }

    /**
     * @return void
     * @throws \InvalidArgumentException
     * @throws \OutOfBoundsException
     */
    private function bootChildrenValidators(): void
    {
        $this->addValidator(Types::class);
        $this->addValidator(Wrappers::class);
    }

    /**
     * @return void
     */
    private function bootMatcher(): void
    {
        $this->setMatcher(function (InheritanceValidator $validator, $type): bool {
            return $validator->match($type);
        });
    }
}
