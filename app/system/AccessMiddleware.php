<?php
declare(strict_types=1);

namespace App;

use DI\Container;
use PDO;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Psr7\Response;

readonly class AccessMiddleware implements MiddlewareInterface
{
    public function __construct(
        private Container $container
    ){}

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if(!isset($_SESSION['user'])){
            $response = new Response();
            return $response->withHeader('Location', '/login_form')->withStatus(302);
        }

        $user = new User($_SESSION['user'], $this->container->get(PDO::class));
        $this->container->set(User::class, $user);

        return $handler->handle($request);
    }
}