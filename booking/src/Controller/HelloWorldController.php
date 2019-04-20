<?php
// src/Controller/HelloWorldController.php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class HelloWorldController
{

    public function index()
    {
        return new Response(
            'Hello, World!'
        );
    }
}