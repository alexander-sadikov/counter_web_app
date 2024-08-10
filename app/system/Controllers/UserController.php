<?php
declare(strict_types=1);

namespace App\Controllers;

use App\View;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class UserController
{
    public static function login_form(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface{
        $page_html = View::render('pages/login_form.tpl');

        $response->getBody()->write($page_html);
        return $response;
    }

    public static function login(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface{
        return $response;
    }
}