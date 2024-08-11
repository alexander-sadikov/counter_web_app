<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\UserModel\Exceptions\UserLoginException;
use App\View;
use PDO;
use Psr\Container\ContainerInterface;
use Slim\Http\Response;
use Slim\Http\ServerRequest as Request;

class UserController
{
    private UserModel $userModel;
    public function __construct(
        ContainerInterface $container
    ){
        $pdo = $container->get(PDO::class);
        $this->userModel = new UserModel($pdo);
    }

    public function loginForm(Request $request, Response $response): Response{
        $page_html = View::render('pages/login_form.tpl');

        $response->getBody()->write($page_html);
        return $response;
    }

    public function login(Request $request, Response $response): Response{
        $parsedBody = $request->getParsedBody();

        $username = $parsedBody['username'];
        $password = $parsedBody['password'];

        try{
            $user = $this->userModel->loginOrSignUp($username, $password);
            $_SESSION['user'] = $user;
            return $response->withJson(['success' => true]);

        }catch(UserLoginException $e){
            return $response->withJson([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}