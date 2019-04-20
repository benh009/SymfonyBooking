<?php
// src/Controller/HelloWorldController.php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class HelloWorldController
{

    public function index()
    {
        return new Response(
            'Hello, World!'
        );
    }
	
	public function index2(Environment $twig)
  {
    $content = $twig->render('HelloWorld/index.html.twig',['name' => 'winzou']);

    return new Response($content);
  }
}