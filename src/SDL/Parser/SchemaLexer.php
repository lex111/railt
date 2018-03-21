<?php
/**
 * This file is part of Parser package.
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\SDL\Parser;

use Railt\Compiler\Lexer\Runtime as SchemaLexerRuntime;

/**
 * This class has been auto-generated by the Railt\Compiler\Generator
 */
final class SchemaLexer extends SchemaLexerRuntime
{
    /**#@+
     * List of SchemaLexer::class tokens defined as public constants
     */
    public const T_AND                 = 'T_AND';
    public const T_OR                  = 'T_OR';
    public const T_PARENTHESIS_OPEN    = 'T_PARENTHESIS_OPEN';
    public const T_PARENTHESIS_CLOSE   = 'T_PARENTHESIS_CLOSE';
    public const T_BRACKET_OPEN        = 'T_BRACKET_OPEN';
    public const T_BRACKET_CLOSE       = 'T_BRACKET_CLOSE';
    public const T_BRACE_OPEN          = 'T_BRACE_OPEN';
    public const T_BRACE_CLOSE         = 'T_BRACE_CLOSE';
    public const T_NON_NULL            = 'T_NON_NULL';
    public const T_THREE_DOTS          = 'T_THREE_DOTS';
    public const T_COLON               = 'T_COLON';
    public const T_EQUAL               = 'T_EQUAL';
    public const T_DIRECTIVE_AT        = 'T_DIRECTIVE_AT';
    public const T_NUMBER              = 'T_NUMBER';
    public const T_TRUE                = 'T_TRUE';
    public const T_FALSE               = 'T_FALSE';
    public const T_NULL                = 'T_NULL';
    public const T_BLOCK_STRING        = 'T_BLOCK_STRING';
    public const T_STRING              = 'T_STRING';
    public const T_NAMESPACE           = 'T_NAMESPACE';
    public const T_NAMESPACE_SEPARATOR = 'T_NAMESPACE_SEPARATOR';
    public const T_IMPORT              = 'T_IMPORT';
    public const T_IMPORT_FROM         = 'T_IMPORT_FROM';
    public const T_EXTENDS             = 'T_EXTENDS';
    public const T_IMPLEMENTS          = 'T_IMPLEMENTS';
    public const T_ON                  = 'T_ON';
    public const T_TYPE                = 'T_TYPE';
    public const T_ENUM                = 'T_ENUM';
    public const T_UNION               = 'T_UNION';
    public const T_INPUT_UNION         = 'T_INPUT_UNION';
    public const T_INTERFACE           = 'T_INTERFACE';
    public const T_SCHEMA              = 'T_SCHEMA';
    public const T_SCALAR              = 'T_SCALAR';
    public const T_DIRECTIVE           = 'T_DIRECTIVE';
    public const T_INPUT               = 'T_INPUT';
    public const T_EXTEND              = 'T_EXTEND';
    public const T_FRAGMENT            = 'T_FRAGMENT';
    public const T_VARIABLE            = 'T_VARIABLE';
    public const T_NAME                = 'T_NAME';
    public const T_WHITESPACE          = 'T_WHITESPACE';
    public const T_COMMENT             = 'T_COMMENT';
    public const T_COMMA               = 'T_COMMA';
    public const T_EOF                 = 'T_EOF';
    /**#@-*/

    /**
     * @var string The PCRE compiled pattern
     */
    protected $pattern = '/(?P<T_AND>&)|(?P<T_OR>\\|)|(?P<T_PARENTHESIS_OPEN>\\()|(?P<T_PARENTHESIS_CLOSE>\\))|(?P<T_BRACKET_OPEN>\\[)|(?P<T_BRACKET_CLOSE>\\])|(?P<T_BRACE_OPEN>{)|(?P<T_BRACE_CLOSE>})|(?P<T_NON_NULL>!)|(?P<T_THREE_DOTS>\\.\\.\\.)|(?P<T_COLON>:)|(?P<T_EQUAL>=)|(?P<T_DIRECTIVE_AT>@)|(?P<T_NUMBER>\\-?(0|[1-9][0-9]*)(\\.[0-9]+)?([eE][\\+\\-]?[0-9]+)?\\b)|(?P<T_TRUE>true\\b)|(?P<T_FALSE>false\\b)|(?P<T_NULL>null\\b)|(?P<T_BLOCK_STRING>"""(?:\\\\"""|(?!""").|\\s)+""")|(?P<T_STRING>"[^"\\\\]+(\\\\.[^"\\\\]*)*")|(?P<T_NAMESPACE>namespace\\b)|(?P<T_NAMESPACE_SEPARATOR>\\/)|(?P<T_IMPORT>import\\b)|(?P<T_IMPORT_FROM>from\\b)|(?P<T_EXTENDS>extends\\b)|(?P<T_IMPLEMENTS>implements\\b)|(?P<T_ON>on\\b)|(?P<T_TYPE>type\\b)|(?P<T_ENUM>enum\\b)|(?P<T_UNION>union\\b)|(?P<T_INPUT_UNION>inputUnion\\b)|(?P<T_INTERFACE>interface\\b)|(?P<T_SCHEMA>schema\\b)|(?P<T_SCALAR>scalar\\b)|(?P<T_DIRECTIVE>directive\\b)|(?P<T_INPUT>input\\b)|(?P<T_EXTEND>extend\\b)|(?P<T_FRAGMENT>fragment\\b)|(?P<T_VARIABLE>(\\$[_A-Za-z][_0-9A-Za-z]*))|(?P<T_NAME>([_A-Za-z][_0-9A-Za-z]*))|(?P<T_WHITESPACE>(\\xfe\\xff|\\x20|\\x09|\\x0a|\\x0d)+)|(?P<T_COMMENT>#[^\\n]*)|(?P<T_COMMA>,)/mu';

    /**
     * @var array|bool[] List of tokens in format "[ token_name => kept_or_skipped ]"
     */
    protected $tokens = [
        self::T_AND                 => true,
        self::T_OR                  => true,
        self::T_PARENTHESIS_OPEN    => true,
        self::T_PARENTHESIS_CLOSE   => true,
        self::T_BRACKET_OPEN        => true,
        self::T_BRACKET_CLOSE       => true,
        self::T_BRACE_OPEN          => true,
        self::T_BRACE_CLOSE         => true,
        self::T_NON_NULL            => true,
        self::T_THREE_DOTS          => true,
        self::T_COLON               => true,
        self::T_EQUAL               => true,
        self::T_DIRECTIVE_AT        => true,
        self::T_NUMBER              => true,
        self::T_TRUE                => true,
        self::T_FALSE               => true,
        self::T_NULL                => true,
        self::T_BLOCK_STRING        => true,
        self::T_STRING              => true,
        self::T_NAMESPACE           => true,
        self::T_NAMESPACE_SEPARATOR => true,
        self::T_IMPORT              => true,
        self::T_IMPORT_FROM         => true,
        self::T_EXTENDS             => true,
        self::T_IMPLEMENTS          => true,
        self::T_ON                  => true,
        self::T_TYPE                => true,
        self::T_ENUM                => true,
        self::T_UNION               => true,
        self::T_INPUT_UNION         => true,
        self::T_INTERFACE           => true,
        self::T_SCHEMA              => true,
        self::T_SCALAR              => true,
        self::T_DIRECTIVE           => true,
        self::T_INPUT               => true,
        self::T_EXTEND              => true,
        self::T_FRAGMENT            => true,
        self::T_VARIABLE            => true,
        self::T_NAME                => true,
        self::T_WHITESPACE          => false,
        self::T_COMMENT             => false,
        self::T_COMMA               => false,
        self::T_EOF                 => true,
            ];

    /**
     * @return string Returns the lexer compilation date and time in RFC3339 format
     */
    public function getBuiltDate(): string
    {
        return '2018-03-21UTC00:09:03.964+00:00';
    }
}