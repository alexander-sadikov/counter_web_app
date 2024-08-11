<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\CounterModel;
use App\User;
use App\View;
use DI\Container;
use PDO;
use Slim\Http\Response;
use Slim\Http\ServerRequest as Request;

class CounterController
{
    private CounterModel $counterModel;
    private User $user;
    public function __construct(
        Container $container
    ){
        $pdo = $container->get(PDO::class);
        $this->counterModel = new CounterModel($pdo);
        $this->user = $container->get(User::class);
    }

    public function index(Request $request, Response $response): Response{
        $counter = $this->user->getCounter();

        $page_html = View::render('pages/counter.tpl', [
            'counter' => $counter ?? 0,
            'user_name' => $this->user->getUserName(),
        ]);

        $response->getBody()->write($page_html);

        return $response;
    }

    public function increaseCounter(Request $request, Response $response): Response{
        $parsedBody = $request->getParsedBody();

        $newCounterVal = $parsedBody['counter_val'];
        $userId = $this->user->getUserId();

        if(!is_numeric($newCounterVal))
            throw new \Exception('Not valid counter value');

        $this->counterModel->setCounter($userId, intval($newCounterVal));

        return $response->withJson([]);
    }
}