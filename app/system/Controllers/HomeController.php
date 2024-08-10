<?php
declare(strict_types=1);

namespace App\Controllers;

use App\View;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class HomeController
{
    public static function index(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface{
        $page_html = View::render('pages/home.tpl');

        $response->getBody()->write($page_html);

        return $response;
    }
}