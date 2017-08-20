<?php
/**
 * This file is part of Railgun package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Example;

use Railgun\Adapters\RequestInterface;
use Railgun\Endpoint;
use Railgun\Routing\Route;
use Railgun\Routing\Router;
use Railgun\Foundation\ApiKernel;

/**
 * Class HttpApiKernel
 * @package Example
 */
class HttpApiKernel extends ApiKernel
{
    /**
     * HttpApiKernel constructor.
     * @param Endpoint $endpoint
     * @throws \Railgun\Exceptions\CompilerException
     * @throws \Railgun\Exceptions\IndeterminateBehaviorException
     */
    public function __construct(Endpoint $endpoint)
    {
        parent::__construct($endpoint);

        $this->bootLogger($endpoint);
    }

    /**
     * @param Endpoint $endpoint
     * @throws \Railgun\Exceptions\CompilerException
     * @throws \Railgun\Exceptions\IndeterminateBehaviorException
     */
    private function bootLogger(Endpoint $endpoint)
    {
        // On all requests
        $this->on('request:*', function (RequestInterface $request) use ($endpoint) {
            $endpoint->debug('Request(' . $request->getPath() . ')');
        });

        // On all responses
        $this->on('response:*', function ($response, RequestInterface $request) use ($endpoint) {
            $endpoint->debug('    Body(' . json_encode($response) . ')');
            $endpoint->debug('Response(' . $request->getPath() . ')');
            $endpoint->debug(str_repeat('-', 80));
        });

        // On all responses
        $this->on('route:*', function (Route $route) use ($endpoint) {
            $endpoint->debug('    Route(' . $route->getRoute() . ') => ' . $route->getPattern());
        });
    }

    /**
     * @param Router $router
     * @throws \InvalidArgumentException
     */
    public function resolve(Router $router): void
    {
        $router
            ->when('user', 'Example\\UsersController@showAction');

        $router
            ->when('{any}.friends', 'Example\\UsersController@indexAction')
            ->where('any', '.+?');
    }

    /**
     * @param Router $router
     * @throws \InvalidArgumentException
     */
    public function decorate(Router $router): void
    {
        $router->when('{any}.{dateTime}', 'Example\\SupportController@dateTime')
            ->where('any', '.*?')
            ->where('dateTime', 'createdAt|updatedAt');
    }
}
