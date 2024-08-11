<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\CounterModel;
use App\View;
use PDO;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class CounterController
{
    private CounterModel $counterModel;
    public function __construct(
        ContainerInterface $container
    ){
        $pdo = $container->get(PDO::class);
        $this->counterModel = new CounterModel($pdo);
    }

    public function index(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface{
        $page_html = View::render('pages/counter.tpl');

        $response->getBody()->write($page_html);

        return $response;
    }

    public function setCounterAction() {
        if (isset($_POST['user_id']) && isset($_POST['counter'])) {
            $userId = intval($_POST['user_id']);
            $newCounterValue = intval($_POST['counter']);

            if ($this->counterModel->setCounter($userId, $newCounterValue)) {
                echo json_encode(['status' => 'success', 'message' => 'Counter updated successfully.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to update counter.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid input.']);
        }
    }
}